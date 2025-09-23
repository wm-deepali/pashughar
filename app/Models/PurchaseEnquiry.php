<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseEnquiry extends Model
{
    use HasFactory;
    protected $table = 'purchase_enquiry';
    protected $fillable = [
                        'ad_id',
                        'name',
                        'email',
                        'status',
                        'mobile_number',
                        'telegram_id',
                        'country',
                        'state',
                        'city',
                        'type',
                        'detail',
                    ];
    
    public function ad(){
        return $this->belongsTo(Ad::class,'ad_id','id');
    }
    
    

    public function statename()
    {
        return $this->belongsTo(State::class, 'state','id');
    }

    public function cityname()
    {
        return $this->belongsTo(City::class, 'city','id');
    }
}