<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsItem extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'author_id',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    /**
     * Boot method to handle cascade deletes.
     */
    protected static function booted(): void
    {
        static::deleting(function (NewsItem $newsItem) {
            // Delete all comments
            $newsItem->comments()->delete();

            // Delete image if exists
            if ($newsItem->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($newsItem->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($newsItem->image);
            }
        });
    }

    /**
     * Get the author of the news item.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the comments for the news item.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(NewsComment::class);
    }
}
