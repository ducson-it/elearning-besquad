<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quiz';
    protected $fillable = ['name','slug','quiz_type','course_id','module_id'];
    public function courses()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }
    public function modules()
    {
        return $this->belongsTo(Module::class,'module_id','id');
    }
    public function questions ()
    {
        return $this->hasMany(Question::class);
    }
}
