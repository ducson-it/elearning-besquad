<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Notifycation_user extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
      'notifycation_id',
        'user_id'
    ];
}
