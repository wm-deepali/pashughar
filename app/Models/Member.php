<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    protected $table = 'members';
    protected $fillable = [
        'full_name', 'email', 'password','otp','mobile','mobile_verified_at','email_verified_at','google_id', 'profile_pic',
        'member_id',
        'no_of_ads',
        'user_type',
        'referral_code',
        'referralto',
        'expiry_date',
        'membership_expiry_at',
        'fcm_token',
        'wallet_points',
        'address',
        'country',
        'state',
        'city',
        'zipcode',
        'active_subscription_id',
        'used_wallet_points',
        'remark',
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    public function ads(){
        return $this->hasMany(Ad::class, 'user_id', 'id');
    }
    public function cityname()
    {
        return $this->hasOne(City::class, 'id', 'city');
    }
    public function statename()
    {
        return $this->hasOne(State::class, 'id', 'state');
    }
    public function countryname()
    {
        return $this->hasOne(Countries::class, 'id', 'country');
    }
    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class, 'id', 'active_subscription_id');
    }
}
