<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'subscriptions';
    protected $fillable = [
                    'name',
                    'no_of_ads',
                    'subscription_validity',
                    'ad_validity',
                    'mrp',
                    'discount',
                    'offer_price',
                    'status',
                    'detail',
                    'icon',
                ];
    
    public function categorysubscription(){
        return $this->belongsTo(CategorySubscription::class,'id','subscription_id');
    }
    public function features(){
        return $this->hasMany(SubscriptionFeature::class,'subscription_id')->orderBy('id', 'ASC');
    }
}
