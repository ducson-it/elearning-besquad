<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumPost extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'forum_posts';

    // Các trường có thể gán giá trị
    protected $fillable = [
        'title', 'content', 'view', 'user_id', 'is_active', 'star', 'category_id', 'type','tag_id'
    ];

    // Quan hệ với model User (một bài viết thuộc về một user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với model ForumComment (một bài viết có nhiều comment)
    public function comments()
    {
        return $this->hasMany(ForumComment::class, 'post_id');
    }

    // Quan hệ với model Category (một bài viết thuộc về một category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tagsforum()
    {
        return $this->belongsTo(TagsForum::class, 'tag_id');
    }

}
