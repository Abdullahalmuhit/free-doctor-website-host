<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'chamber_id', 'appointment_date', 'appointment_time',
        'patient_name', 'guardian_name', 'phone', 'age',
        'gender', 'problem_details', 'status'
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    public function chamber()
    {
        return $this->belongsTo(Chamber::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }
}
