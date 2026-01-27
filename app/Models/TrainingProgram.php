<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    protected $fillable = [
        'user_id', 'program_name', 'institution', 'location',
        'start_date', 'end_date', 'description', 'certificate_file', 'order'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDurationAttribute()
    {
        if ($this->start_date && $this->end_date) {
            return $this->start_date->format('M Y') . ' - ' . $this->end_date->format('M Y');
        }
        return $this->end_date ? $this->end_date->format('M Y') : 'N/A';
    }
}
