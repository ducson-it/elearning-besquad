<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beesquad extends Model
{
    use HasFactory;

    const LIMIT = 10;
    const RULE = [
        'ADMIN' => 1,
        'STUDENT' => 2,
        'TEACHER' => 3,
    ];
}
