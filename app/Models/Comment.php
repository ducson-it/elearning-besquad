<?php

namespace App\Models;
use App\Models\Post;
use App\Models\Course;
use App\Models\Lesson;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'comments';
    protected $fillable = ['user_id', 'content', 'status', 'commentable_id', 'commentable_type','parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function commentable():MorphTo
    {
        return $this->morphTo();
    }
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
