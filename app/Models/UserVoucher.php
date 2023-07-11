<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserVoucher extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'user_voucher';
    protected $fillable = ['user_id', 'voucher_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
