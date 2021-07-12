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

    public function login()
    {
        return $this->hasOne(JobSeekerLogin::class);
    }
    public function langauges()
    {
        return $this->belongsToMany(Language::class);
    }
    public function experiences()
    {
        return $this->hasMany(JobSeekerExperience::class);
    }
    public function educations()
    {
        return $this->hasMany(JobSeekerEducation::class);
    }
    public function skills()
    {
        return $this->belongsToMany(SkillSet::class);
    }
}
