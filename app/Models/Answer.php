<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answers';
    protected $fillable = ['name','correct_answer','question_id'];
    public static $correct_answer = [
        "0"=>"Đáp án sai",
        "1"=>"Đáp án đúng"
    ];
    public function questions()
    {
        return $this->belongsTo(Question::class,'question_id','id');
    }
}
