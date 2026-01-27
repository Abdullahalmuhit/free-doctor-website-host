<?php
// app/Models/Slider.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'button_text',
        'button_url',
        'button_new_tab',
        'order',
        'is_active'
    ];

    protected $casts = [
        'button_new_tab' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/slider-default.jpg');
    }

    /**
     * Scope for active sliders
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope ordered by display order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    /**
     * Delete associated image when model is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($slider) {
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
        });
    }
}
