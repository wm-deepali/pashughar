<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    protected $fillable = ['category_id','name','meta_title','meta_keyword','meta_description','canonical_url'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function ads(){
        return $this->hasMany(Ad::class, 'subcategory_id', 'id');
    }
}
