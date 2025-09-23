<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RAM extends Model
{
    use HasFactory;
    protected $table = "rams";
    protected $fillable =['capacity','type','speed','status'];
}
