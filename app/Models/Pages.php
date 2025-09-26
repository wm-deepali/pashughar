<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = [
        'name',
        'slug',
        'heading',
        'detail_content',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'canonical',
        'status'
    ];
}
