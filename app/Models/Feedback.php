<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'feebacks';
    protected $fillable = [
        'content', 'user_id', 'view', 'star','is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}