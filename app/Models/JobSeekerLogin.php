<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JobSeekerLogin extends Authenticatable 
{
    use HasFactory;
    public function jobSeeker()
    {
        return $this->hasOne(JobSeeker::class, 'id');
    }

    protected $guard = 'jobseeker';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
