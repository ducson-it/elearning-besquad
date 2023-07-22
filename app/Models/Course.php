<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Course extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'courses';
    protected $fillable = ['name', 'slug', 'price', 'user_id', 'discount', 'status', 'featured', 'category_id', 'image', 'description', 'is_free','subscribe'];
    public static $courseType = [
        '0'=>'Khoá học miễn phí',
        '1'=>"Khoá học mất phí"
    ];
    public function users()
    {
        return $this->belongsToMany(User::class,'user_course','course_id','user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function studies()
    {
        return $this->hasMany(Study::class);
    }

    public function scopeFreeCourse(Builder $query): void
    {
        $query->where('is_free', 0);
    }

    public function scopePaidCourse(Builder $query): void
    {
        $query->where('is_free', 1);
    }
}
