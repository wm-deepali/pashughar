<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;
    protected $table = 'user_activity';
    protected $fillable = [
        'user_id',
        'ip_address',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
