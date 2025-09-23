<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'locations';
    protected $fillable = ['location','city_id','status'];
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
