<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = [
        'user_id', 'award_name', 'awarded_by',
        'description', 'award_date', 'certificate_file', 'order'
    ];

    protected $casts = [
        'award_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
