<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $fillable = ['name','brand_category_id','image','status'];
    
    public function brandCategory()
    {
        return $this->belongsTo(BrandCategory::class);
    }
    public function categories()
    {
        return $this->belongsTo(Category::class,'brand_category_id','id');
    }
}
