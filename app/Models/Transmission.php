<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transmission extends Model
{
    use HasFactory;
    protected $table="transmission";
    protected $fillable=['name','vehicle_type_id','status'];

    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class);
    }
}
