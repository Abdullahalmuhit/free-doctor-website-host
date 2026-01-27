<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'user_id', 'certification_name', 'issuing_organization',
        'credential_id', 'issue_date', 'expiry_date',
        'does_not_expire', 'certification_url', 'certificate_file', 'order'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'does_not_expire' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsExpiredAttribute()
    {
        if ($this->does_not_expire || !$this->expiry_date) {
            return false;
        }
        return $this->expiry_date->isPast();
    }

    public function getIsValidAttribute()
    {
        return !$this->is_expired;
    }
}
