<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLanguage extends Model
{
    use HasFactory;

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

}

