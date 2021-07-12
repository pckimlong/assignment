<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerSkill extends Model
{
    use HasFactory;
    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }
    public function skill()
    {
        return $this->belongsTo(SkillSet::class);
    }
}
