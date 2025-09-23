<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileOS extends Model
{
    use HasFactory;
    protected $table = 'mobile_os';
    protected $fillable = ['name'];
}
