<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JobSeekerEducation extends Model
{
    use HasFactory;
    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    public function startYear()
    {
        return date('Y', strtotime($this->start_date));
    }

    public function endYear()
    {
        if($this->is_current){
            return 'Present';
        }else{
            return date('Y', strtotime($this->graduated_date));
        }
    }
}
