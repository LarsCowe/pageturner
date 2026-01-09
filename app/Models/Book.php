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
     * Boot method to handle cascade deletes.
     */
    protected static function booted(): void
    {
        static::deleting(function (Book $book) {
            // Delete all reviews
            $book->reviews()->delete();
            
            // Detach all relationships
            $book->genres()->detach();
            $book->moods()->detach();
            $book->users()->detach();
            
            // Delete cover image if exists
            if ($book->cover_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($book->cover_image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($book->cover_image);
            }
        });
    }

    /**
     * Get the calculated average rating from reviews.
     * Uses loaded relationship if available, otherwise uses stored value.
     */
    public function getCalculatedRatingAttribute(): float
    {
        // If reviews are eager loaded, calculate from them
        if ($this->relationLoaded('reviews')) {
            $reviews = $this->reviews;
            if ($reviews->isEmpty()) {
                return 0;
            }
            return round($reviews->avg('rating'), 1);
        }

        // Fall back to stored value to avoid N+1
        return (float) ($this->average_rating ?? 0);
    }

    /**
     * Get the actual reviews count.
     * Uses loaded relationship or withCount if available, otherwise uses stored value.
     */
    public function getReviewsCountAttribute(): int
    {
        // If reviews_count was eager loaded with withCount('reviews')
        if (isset($this->attributes['reviews_count'])) {
            return (int) $this->attributes['reviews_count'];
        }

        // If reviews are eager loaded, count them
        if ($this->relationLoaded('reviews')) {
            return $this->reviews->count();
        }

        // Fall back to stored value to avoid N+1
        return (int) ($this->ratings_count ?? 0);
    }

    /**
     * Recalculate and update the stored rating values.
     * Call this after a review is added, updated, or deleted.
     */
    public function updateRatingCache(): void
    {
        $this->update([
            'average_rating' => $this->reviews()->avg('rating') ?? 0,
            'ratings_count' => $this->reviews()->count(),
        ]);
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
