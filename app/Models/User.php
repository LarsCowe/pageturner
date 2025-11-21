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
            ->withTimestamps();
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
}
