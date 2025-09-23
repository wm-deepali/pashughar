<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdSpecification extends Model
{
    use HasFactory;
    protected $table = 'ad_specifications';
    protected $fillable = [
                        'ad_id',
                        'specification',
                        ];
}
