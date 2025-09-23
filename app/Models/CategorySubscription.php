<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySubscription extends Model
{
    use HasFactory;
    protected $table = 'category_subscriptions';
    protected $fillable = ['category_id','subscription_id'];
    
    
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }


}
