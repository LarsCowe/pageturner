<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BookClub extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'creator_id',
        'is_private',
    ];

    protected $casts = [
        'is_private' => 'boolean',
    ];

    /**
     * Boot method to handle cascade deletes.
     */
    protected static function booted(): void
    {
        static::deleting(function (BookClub $bookClub) {
            // Delete image if exists
            if ($bookClub->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($bookClub->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($bookClub->image);
            }
            
            // Detach all members
            $bookClub->members()->detach();
        });
    }

    /**
     * Get the creator of the book club.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * Get the members of the book club.
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Get the posts for the book club.
     */
    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ClubPost::class);
    }
}
