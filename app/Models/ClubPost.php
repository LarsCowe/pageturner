<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClubPost extends Model
{
    protected $fillable = [
        'book_club_id',
        'user_id',
        'title',
        'body',
    ];

    /**
     * Boot method to handle cascade deletes.
     */
    protected static function booted(): void
    {
        static::deleting(function (ClubPost $post) {
            $post->comments()->delete();
        });
    }

    public function bookClub(): BelongsTo
    {
        return $this->belongsTo(BookClub::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ClubComment::class);
    }
}
