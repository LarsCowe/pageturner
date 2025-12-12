<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FaqCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'order',
    ];

    /**
     * Boot method to handle cascade deletes.
     */
    protected static function booted(): void
    {
        static::deleting(function (FaqCategory $category) {
            // Delete all FAQ items in this category
            $category->faqItems()->delete();
        });
    }

    /**
     * Get the FAQ items in this category.
     */
    public function faqItems(): HasMany
    {
        return $this->hasMany(FaqItem::class)->orderBy('order');
    }
}
