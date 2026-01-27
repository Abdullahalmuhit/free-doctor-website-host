<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LifestyleItem extends Model
{
    protected $fillable = [
        'category', 'title', 'icon', 'description', 'points', 'order', 'is_active'
    ];

    protected $casts = [
        'points' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
