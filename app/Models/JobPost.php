<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Location;

class JobPost extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function skill()
    {
        return $this->belongsTo(SkillSet::class);
    }

    public function activities()
    {
        return $this->hasMany(JobPostActivity::class);
    }

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    
}
