<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'is_admin',
        'birthday',
        'avatar',
        'bio',
        'favorite_genres',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthday' => 'date',
            'favorite_genres' => 'array',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Boot the model.
     * Handle cleanup when user is deleted.
     */
    protected static function booted(): void
    {
        static::deleting(function (User $user) {
            // Reassign book clubs to first moderator or first admin
            $createdBookClubs = $user->createdBookClubs;
            
            foreach ($createdBookClubs as $bookClub) {
                // Try to find a moderator in the book club
                $newCreator = $bookClub->members()
                    ->wherePivot('role', 'moderator')
                    ->where('users.id', '!=', $user->id)
                    ->first();
                
                // If no moderator, find first admin user globally
                if (!$newCreator) {
                    $newCreator = User::where('is_admin', true)
                        ->where('id', '!=', $user->id)
                        ->first();
                }
                
                // Update book club creator
                if ($newCreator) {
                    $bookClub->creator_id = $newCreator->id;
                    $bookClub->save();
                    
                    // Make sure new creator is a moderator in the club
                    $bookClub->members()->syncWithoutDetaching([
                        $newCreator->id => ['role' => 'moderator']
                    ]);
                } else {
                    // If no suitable replacement found, creator will be set to null by database
                    // Book club will remain orphaned but visible
                }
            }
        });
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Get the books on the user's shelves.
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)
            ->withPivot('shelf', 'current_page', 'started_at', 'finished_at')
            ->withTimestamps()
            ->using(BookUser::class);
    }

    /**
     * Get the reviews written by the user.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the book clubs the user is a member of.
     */
    public function bookClubs(): BelongsToMany
    {
        return $this->belongsToMany(BookClub::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Get the book clubs created by the user.
     */
    public function createdBookClubs(): HasMany
    {
        return $this->hasMany(BookClub::class, 'creator_id');
    }

    /**
     * Get the news items authored by the user.
     */
    public function newsItems(): HasMany
    {
        return $this->hasMany(NewsItem::class, 'author_id');
    }

    /**
     * Get the user's reading activities.
     */
    public function readingActivities(): HasMany
    {
        return $this->hasMany(ReadingActivity::class);
    }

    /**
     * Get the count of books read (on 'read' shelf).
     * Cache this to avoid N+1 queries on profile pages.
     */
    public function getBooksReadCountAttribute(): int
    {
        if (!$this->relationLoaded('books')) {
            return $this->books()
                ->wherePivot('shelf', 'read')
                ->count();
        }
        
        return $this->books->filter(fn($book) => $book->pivot->shelf === 'read')->count();
    }

    /**
     * Get the user's current reading streak (consecutive days).
     * Only loads activities until streak breaks for better performance.
     */
    public function getCurrentStreakAttribute(): int
    {
        $today = now()->startOfDay();
        $yesterday = now()->copy()->subDay()->startOfDay();
        
        // Get most recent activity to check if streak is active
        $latestActivity = $this->readingActivities()
            ->orderBy('activity_date', 'desc')
            ->first();
            
        if (!$latestActivity) {
            return 0;
        }
        
        $latestDate = $latestActivity->activity_date->startOfDay();
        
        // Streak must start today or yesterday
        if (!$latestDate->equalTo($today) && !$latestDate->equalTo($yesterday)) {
            return 0;
        }

        $streak = 0;
        $expectedDate = $latestDate->copy();
        
        // Use cursor for memory efficiency with large datasets
        $activities = $this->readingActivities()
            ->orderBy('activity_date', 'desc')
            ->cursor();
        
        foreach ($activities as $activity) {
            $activityDate = $activity->activity_date->startOfDay();

            if ($activityDate->equalTo($expectedDate)) {
                $streak++;
                $expectedDate = $expectedDate->copy()->subDay();
            } else {
                break;
            }
        }

        return $streak;
    }

    /**
     * Get the user's longest reading streak ever.
     * Uses cursor for memory efficiency with large datasets.
     */
    public function getLongestStreakAttribute(): int
    {
        $activities = $this->readingActivities()
            ->orderBy('activity_date', 'asc')
            ->cursor();

        $longestStreak = 0;
        $currentStreak = 0;
        $previousDate = null;

        foreach ($activities as $activity) {
            if ($previousDate === null) {
                $currentStreak = 1;
            } else {
                $daysDiff = $previousDate->diffInDays($activity->activity_date);

                if ($daysDiff == 1) { // Loose comparison: diffInDays returns float
                    $currentStreak++;
                } else {
                    $longestStreak = max($longestStreak, $currentStreak);
                    $currentStreak = 1;
                }
            }

            $previousDate = $activity->activity_date;
        }

        return max($longestStreak, $currentStreak);
    }

    /**
     * Log a reading activity for today.
     * If activity already exists, it increments the values.
     */
    public function logReadingActivity(int $pagesRead = 0, int $minutesRead = 0): ReadingActivity
    {
        $today = now()->toDateString();
        $existing = $this->readingActivities()->where('activity_date', $today)->first();
        
        if ($existing) {
            // Increment existing activity
            $existing->update([
                'pages_read' => $existing->pages_read + $pagesRead,
                'minutes_read' => $existing->minutes_read + $minutesRead,
            ]);
            return $existing;
        }
        
        return $this->readingActivities()->create([
            'activity_date' => $today,
            'pages_read' => $pagesRead,
            'minutes_read' => $minutesRead,
        ]);
    }

    public function clubPosts(): HasMany
    {
        return $this->hasMany(ClubPost::class);
    }

    public function clubComments(): HasMany
    {
        return $this->hasMany(ClubComment::class);
    }
}
