<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionStatus extends Model
{
    use HasFactory;
    protected $table = 'construction_status';
    protected $fillable = ['name','status'];
}
