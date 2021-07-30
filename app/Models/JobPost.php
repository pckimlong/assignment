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
        return $this->hasMany(JobPostActivity::class);
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
