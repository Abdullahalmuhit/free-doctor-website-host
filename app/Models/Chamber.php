<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamber extends Model
{
    protected $fillable = [
        'name', 'room_number', 'address', 'phone', 'visiting_hours', 'is_active'
    ];

    protected $casts = [
        'visiting_hours' => 'array',
        'is_active' => 'boolean',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
