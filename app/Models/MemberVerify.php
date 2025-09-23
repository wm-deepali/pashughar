<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class MemberVerify extends Model
{
    use HasFactory;
  
    public $table = "member_verify";
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'member_id',
        'token',
    ];
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}