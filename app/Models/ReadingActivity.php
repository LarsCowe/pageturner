<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReadingActivity extends Model
{
    protected $fillable = [
        'user_id',
        'activity_date',
        'pages_read',
        'minutes_read',
    ];

    protected $casts = [
        'activity_date' => 'date',
    ];

    /**
     * Get the user that owns this reading activity.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
