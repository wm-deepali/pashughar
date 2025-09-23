<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $table = 'ads';
    protected $fillable = [
                        'user_id',
                        'title',
                        'plan_id',
                        'category_id',
                        'subcategory_id',
                        'subscription_id',
                        'brand_category',
                        'brand_id',
                        'price',
                        'price_type',
                        'location',
                        'description',
                        'tags',
                        'author_name',
                        'author_email',
                        'author_mobile',
                        'author_address',
                        'status',
                        'email_alert',
                        'is_edit',
                        'admin_edited_at',
                        'views',
                        'total_enquiry',
                        'expire_at',
                        'published_date',
                        'slug',
                        'meta_title',
                        'meta_keyword',
                        'meta_description'
                    ];
    
    public function brandCategory()
    {
        return $this->belongsTo(BrandCategory::class,'brand_category','id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }
    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function user(){
        return $this->belongsTo(Member::class,'user_id','id')->where('status', 'Active');
    }
    public function subscription(){
        return $this->belongsTo(Subscription::class,'subscription_id','id');
    }
    public function adFeature(){
        return $this->hasMany(AdFeature::class);
    }
    public function AdImage(){
        return $this->hasMany(AdImage::class);
    }
    public function adSpecification(){
        return $this->hasMany(AdSpecification::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function enquiries(){
        return $this->hasMany(Enquiry::class);
    }

    public function scopeSearch($query, $min_price,$max_price)
    {
        if($max_price == null) return $query;
        return $query->whereBetween('price', [$min_price, $max_price]);
    }
    public function scopeSearchData($query, $search)
    {
        if($search == null) return $query;
        return $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('tags', 'LIKE', "%{$search}%");
    }
    public function scopeType($query, $type)
    {
        
        if($type == 'trending')
        {
            return $query->orderBy('views', 'desc')->orderBy('price', 'desc');
        }
        else if($type == 'recommend')
        {
            return $query->orderBy('total_enquiry', 'desc')->orderBy('price', 'desc');
        }
        else if($type == 'featured')
        {
            return $query->orderBy('price', 'desc');
        }
        else{
            $query->orderBy('id', 'desc')->orderBy('price', 'desc');
        }
        
    }
}
