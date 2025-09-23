<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;
    protected $table='vehicle_type';
    protected $fillable=['name','status'];

    public function fuelType()
    {
        return $this->hasMany(FuelType::class);
    }
    public function transmission()
    {
        return $this->hasMany(Transmission::class);
    }
}
