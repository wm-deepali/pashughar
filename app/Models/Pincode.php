<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    use HasFactory;
    protected $table = 'pincode';
    protected $fillable = ['pincode','city_id','status'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
