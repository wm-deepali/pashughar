<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name', 'image', 'meta_title', 'meta_keyword', 'meta_description', 'canonical_url', 'description', 'bottom_image', 'bottom_categories'];
    public function subcategory()
    {
        return $this->hasMany(SubCategory::class)->with('ads');
    }
    public function ads()
    {
        return $this->hasMany(Ad::class)
            ->where('delete_status', '0')
            ->where(function ($q) {
                $q->whereNull('expire_at')->orWhere('expire_at', '>=', now());
            });
    }

}
