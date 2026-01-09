<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'rating',
        'review_text',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * Boot method to update book rating cache when reviews change.
     */
    protected static function booted(): void
    {
        static::created(function (Review $review) {
            $review->book->updateRatingCache();
        });

        static::updated(function (Review $review) {
            $review->book->updateRatingCache();
        });

        static::deleted(function (Review $review) {
            $review->book->updateRatingCache();
        });
    }

    /**
     * Get the user who wrote the review.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book being reviewed.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
