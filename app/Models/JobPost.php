<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Location;
use Carbon\Carbon;

class JobPost extends Model
{
    protected $guarded = array();
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function activities()
    {
        return $this->belongsToMany(JobSeeker::class, 'job_post_activities');
    }

    public function getActivityAppliedDate($jobseekerId)
    {
        $date = JobPostActivity::where('job_seeker_id', $jobseekerId)->where('job_post_id', $this->id)->first()->created_at;
        return Carbon::parse($date)->timestamp;
    }
    public function deadlineTimestamp()
    {
        return Carbon::parse($this->deadline)->timestamp;
    }

    public function remainingDays()
    {
        $deadline = $this->deadline;
        $timestamp = Carbon::parse($deadline)->timestamp - Carbon::now()->timestamp;
        return $timestamp;
    }
    
    public function getSkills()
    {
        return explode(',', $this->skills);
    }

}
