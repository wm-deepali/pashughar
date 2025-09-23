<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletAmount extends Model
{
    use HasFactory;
    protected $table = 'walletamout';
    protected $fillable = [
                        'points',
                        'type',
                        'status',
                        'user_id',
                        'description',
                        'remaining_points',
                    ];
    
    public function user(){
        return $this->belongsTo(Member::class,'user_id','id')->where('status', 'Active');
    }
   
}
