<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CompanyLogin extends Authenticatable
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected $guard = 'company';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
