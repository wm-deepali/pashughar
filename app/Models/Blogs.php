<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'short_description',
        'detail_content',
        'thumb_image',
        'thumb_alt',
        'banner_image',
        'banner_alt',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'canonical',
        'status'
    ];


    public function comments()
    {
        return $this->hasMany(Comments::class,'blog_id');
    }
}
