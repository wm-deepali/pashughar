<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandCategory extends Model
{
    use HasFactory;
    protected $table = 'brand_categories';
    protected $fillable = ['name','status'];

    public function brand()
    {
        return $this->hasMany(Brand::class);
    }
}
