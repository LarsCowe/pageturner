<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BookUser extends Pivot
{
    /**
     * The table associated with the pivot model.
     */
    protected $table = 'book_user';

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'started_at' => 'date',
        'finished_at' => 'date',
    ];
}
