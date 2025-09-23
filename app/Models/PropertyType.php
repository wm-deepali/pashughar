<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;
    protected $fillable = ['name','status','property_categories'];
    
     public function propertyCategories(){
        return $this->belongsTo(PropertyCategories::class,'property_categories','id');
    }
    
}
