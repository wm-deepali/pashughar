<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email_address',
        'country_code',
        'mobile_number',
        'message',
    ];
}