<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'designation', 'title', 'profile_photo',
        'date_of_birth', 'gender', 'phone', 'phone_secondary', 'emergency_contact',
        'bio', 'about', 'specialization', 'years_of_experience',
        'medical_license_number', 'license_issue_date', 'license_expiry_date',
        'address', 'city', 'state', 'country', 'postal_code',
        'website', 'facebook_url', 'linkedin_url', 'twitter_url', 'instagram_url', 'youtube_url',
        'is_active', 'is_accepting_patients', 'consultation_fee', 'follow_up_fee',
        'role', 'languages_spoken', 'consultation_types'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
        'license_issue_date' => 'date',
        'license_expiry_date' => 'date',
        'is_active' => 'boolean',
        'is_accepting_patients' => 'boolean',
        'languages_spoken' => 'array',
        'consultation_types' => 'array',
        'password' => 'hashed',
    ];

    // Relationships
    public function qualifications()
    {
        return $this->hasMany(Qualification::class)->orderBy('order');
    }

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class)->orderBy('order');
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class)->orderBy('order');
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class)->orderBy('order');
    }

    public function specializations()
    {
        return $this->hasMany(Specialization::class)->orderBy('order');
    }

    public function awards()
    {
        return $this->hasMany(Award::class)->orderBy('order');
    }

    public function trainingPrograms()
    {
        return $this->hasMany(TrainingProgram::class)->orderBy('order');
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->title . ' ' . $this->name;
    }

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo) {
            return asset('storage/' . $this->profile_photo);
        }
        return asset('images/default-doctor.png');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeDoctors($query)
    {
        return $query->where('role', 'doctor');
    }
}
