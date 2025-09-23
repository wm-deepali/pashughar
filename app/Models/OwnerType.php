<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerType extends Model
{
    use HasFactory;
    protected $table = 'owner_type';
    protected $fillable = ['name','status'];
}
