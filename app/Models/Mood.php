<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mood extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'emoji',
        'description',
    ];

    /**
     * Get the books with this mood.
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
