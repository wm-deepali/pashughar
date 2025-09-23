<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
       'blog_id',
       'name',
       'email',
       'comment',
       'approve'
    ];


    public function blog()
    {
        return $this->belongsTo(Blogs::class, 'blog_id');
    }
}
