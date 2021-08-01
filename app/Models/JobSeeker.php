<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeeker extends Model
{
    use HasFactory;

    protected $guarded = array();

    public function fullname()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function avatar()
    {
        return $this->profile_image ?? 'images/user-profile.png';
    }

    public function login()
    {
        return $this->hasOne(JobSeekerLogin::class, 'id', 'id');
    }
    public function langauges()
    {
        return $this->belongsToMany(Language::class);
    }
    public function experiences()
    {
        return $this->hasMany(JobSeekerExperience::class)->orderBy('start_date', 'desc');
    }
    public function educations()
    {
        return $this->hasMany(JobSeekerEducation::class, 'job_seeker_id', 'id')->orderBy('start_date', 'desc');
    }
}
