<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappClick extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'user_id',
        'ip_address',
    ];

    // Relations
    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }

    public function user()
    {
        return $this->belongsTo(Member::class, 'user_id'); // assuming your users are members
    }
}
