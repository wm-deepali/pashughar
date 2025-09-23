<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model
{
    use HasFactory;
    protected $table = 'login_attempts';
    protected $fillable = ['user_id','last_attempt_at','attempt_count','is_account_locked'];
    protected $casts = [
        'last_attempt_at' => 'datetime',
    ];
}
