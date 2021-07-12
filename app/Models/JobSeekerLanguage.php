<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerLanguage extends Model
{
    use HasFactory;

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
