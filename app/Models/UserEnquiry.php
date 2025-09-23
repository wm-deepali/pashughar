<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEnquiry extends Model
{
    use HasFactory;

    protected $table = 'user_enquiries';

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'telephones',
        'order_qty',
        'detail',
        'category_id',
        'state_id',
        'city_id',
        'code'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}

