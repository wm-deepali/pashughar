<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','job_category_id','status'];

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }
}
