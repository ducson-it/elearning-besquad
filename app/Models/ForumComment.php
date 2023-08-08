<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumComment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'forum_comments';

    protected $fillable = [
        'user_id', 'content', 'status', 'post_id', 'parent_id','is_active'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(ForumPost::class, 'post_id');
    }

    public function parentComment()
    {
        return $this->belongsTo(ForumComment::class, 'parent_id');
    }

    public function childComments()
    {
        return $this->hasMany(ForumComment::class, 'parent_id');
    }
}
