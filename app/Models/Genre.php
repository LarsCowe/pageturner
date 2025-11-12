<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Get the books in this genre.
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
