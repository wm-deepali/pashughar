<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactusContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile',
        'email',
        'address_line1',
        'address_line2',
    ];
}