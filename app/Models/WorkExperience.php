<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WorkExperience extends Model
{
    protected $fillable = [
        'user_id', 'position', 'institution', 'department',
        'location', 'start_date', 'end_date', 'is_current',
        'responsibilities', 'achievements', 'order'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDurationAttribute()
    {
        $start = $this->start_date->format('M Y');
        $end = $this->is_current ? 'Current' : $this->end_date->format('M Y');
        return $start . ' - ' . $end;
    }

    public function getTotalYearsAttribute()
    {
        $endDate = $this->is_current ? Carbon::now() : $this->end_date;
        return $this->start_date->diffInYears($endDate);
    }
}
