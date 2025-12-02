<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'description',
        'cover_image',
        'pages',
        'published_date',
        'publisher',
        'average_rating',
        'ratings_count',
    ];

    protected $casts = [
        'published_date' => 'date',
        'average_rating' => 'decimal:2',
    ];

    /**
     * Get the calculated average rating from reviews.
     */
    public function getCalculatedRatingAttribute(): float
    {
        if ($this->reviews()->count() === 0) {
            return 0;
        }
        return round($this->reviews()->avg('rating'), 1);
    }

    /**
     * Get the actual reviews count.
     */
    public function getReviewsCountAttribute(): int
    {
        return $this->reviews()->count();
    }

    /**
     * Get the genres for the book.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * Get the moods for the book.
     */
    public function moods(): BelongsToMany
    {
        return $this->belongsToMany(Mood::class);
    }

    /**
     * Get the reviews for the book.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the users who have this book on their shelves.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('shelf', 'current_page', 'started_at', 'finished_at')
            ->withTimestamps()
            ->using(BookUser::class);
    }
}
