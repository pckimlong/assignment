<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function industry(){
        return $this->hasOne('App\Models\Industry', 'id', 'industry_id');
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }

    
}
