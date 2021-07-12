<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerExperience extends Model
{
    use HasFactory;
    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    
}
