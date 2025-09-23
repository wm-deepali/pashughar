<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $table = 'manage_seo';

    protected $fillable = [
        'name',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'canonical'
    ];
    
    
    public function slugname(){
        return $this->belongsTo(Slug::class,'name','slug');
    }
    
}