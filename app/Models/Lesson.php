<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Lesson extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'lessons';
    protected $fillable = ['name', 'slug', 'course_id', 'module_id', 'document', 'video_id', 'status', 'description', 'is_trial_lesson'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function scopeTrialLesson(Builder $query): void
    {
        $query->where('is_trial_lesson', 1)->orderBy('id','desc');
    }
}
