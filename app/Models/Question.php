<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table='questions';
    protected $fillable = ['name','slug','quiz_id'];
    public function answers()
    {
        return $this->hasMany(Answer::class,'question_id','id');
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

}
