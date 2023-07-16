<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Module extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'modules';
    protected $fillable = ['name', 'slug', 'course_id', 'description'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
