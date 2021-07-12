<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPostLocation extends Model
{
    use HasFactory;
    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
