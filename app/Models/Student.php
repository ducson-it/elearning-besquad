<?php

namespace App\Models;

use App\Models\Scopes\StudentScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new StudentScope);
    }
}
