<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSetting extends Model
{
    use HasFactory;

    protected $table = 'profile_setting';

    protected $fillable = [
        'company_name',
        'owner_name',
        'email',
        'mobile_number',
        'whatsapp_number',
        'header_logo',
        'logo',
    ];
}
