<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherSetting extends Model
{
    use HasFactory;
    protected $table = 'other_setting';

    protected $fillable = [
        'tds',
        'admin_charges',
        'other_charges',
        'point_value',
        'referral_points',
        'user_expiry',
        'welcome_bonus',
        'wallet_limit',
        'is_referral_enable',
    ];
}
