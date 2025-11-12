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
     * Get the FAQ items in this category.
     */
    public function faqItems(): HasMany
    {
        return $this->hasMany(FaqItem::class)->orderBy('order');
    }
}
