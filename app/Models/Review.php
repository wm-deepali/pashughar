<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'ad_reviews';
   protected $fillable = [
                        'ad_id',
                        'member_id',
                        'name',
                        'email',
                        'mobile',
                        'quote',
                        'rating',
                        'review',
                    ];
                    
                    
    public function ad(){
        return $this->belongsTo(Ad::class,'ad_id','id');
    }
    
}
