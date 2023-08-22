<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beesquad extends Model
{
    use HasFactory;

    const LIMIT = 10;
    const PAGINATE_BLOG = 8;
    const RULE = [
        'ADMIN' => 1,
        'STUDENT' => 2,
        'TEACHER' => 3,
    ];
    const QUIZ_TYPE = [
        "0"=>"Theo chủ đề",
        "1"=>"Theo khoá học"
    ];

    const DONE = 1;
    const PENDING = 2;
    const CANCEL = 3;
    const TRUE = 1;
    const FALSE = 0;
    const PAGINATE =10;

    const MAIL_ADMIN = 'beesquadfpoly@gmail.com';
    const CONFIG_MAIL = ['admin@beesquad.com','doxuanhoang802@gmail.com','dinhhuuthanh99@gmail.com','tranghant2006@gmail.com'];
}
