<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubComment extends Model
{
    protected $fillable = [
        'club_post_id',
        'user_id',
        'body',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(ClubPost::class, 'club_post_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
