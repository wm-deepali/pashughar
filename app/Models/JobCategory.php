<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','status'];

    public function jobSubCategory()
    {
        return $this->hasMany(JobSubCategory::class);
    }
}
