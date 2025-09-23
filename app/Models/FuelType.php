<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelType extends Model
{
    use HasFactory;
    protected $table = 'fuel_type';
    protected $fillable = ['name','vehicle_type','status'];

    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class);
    }
}
