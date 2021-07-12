<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPostActivity extends Model
{
    use HasFactory;

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }
    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }
}
