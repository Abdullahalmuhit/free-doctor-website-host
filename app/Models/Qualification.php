<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = [
        'user_id', 'degree', 'institution', 'specialization',
        'location', 'start_year', 'completion_year',
        'description', 'certificate_file', 'order'
    ];

    protected $casts = [
        'start_year' => 'integer',
        'completion_year' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDurationAttribute()
    {
        if ($this->start_year) {
            return $this->start_year . ' - ' . $this->completion_year;
        }
        return $this->completion_year;
    }
}
