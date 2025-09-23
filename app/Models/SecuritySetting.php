<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecuritySetting extends Model
{
    use HasFactory;

    protected $table = 'security_setting';

    protected $fillable = [
        'max_failed_login_user',
        'max_failed_login_admin',
        'is_change_password_required',
    ];
}
