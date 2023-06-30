<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'statuses';
    protected $fillable = ['name', 'statusable_id', 'statusable_type'];

    public function statusable()
    {
        return $this->morphTo();
    }
}
