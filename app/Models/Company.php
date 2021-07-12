<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function industry(){
        return $this->belongsTo(Industry::class);
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }

    
}
