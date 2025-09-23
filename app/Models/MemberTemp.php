<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MemberTemp extends Authenticatable
{
    protected $table = 'members_temp';
    protected $fillable = [
        'full_name', 'email', 'password','mobile','mobile_verified_at','email_verified_at','google_id', 'profile_pic'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    
}
