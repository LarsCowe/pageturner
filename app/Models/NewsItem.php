<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * Get the author of the news item.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
