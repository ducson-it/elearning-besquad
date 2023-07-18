<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Voucher extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'vourchers';
    protected $fillable = ['name', 'value'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_voucher', 'voucher_id', 'user_id');
    }
}
