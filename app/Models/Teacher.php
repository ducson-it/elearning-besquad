<?php

namespace App\Models;

use App\Models\Scopes\TeacherScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new TeacherScope);
    }
}
