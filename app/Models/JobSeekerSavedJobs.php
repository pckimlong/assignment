<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerSavedJobs extends Model
{
    protected $fillable = ['job_seeker_id', 'job_post_id'];
    use HasFactory;
}
