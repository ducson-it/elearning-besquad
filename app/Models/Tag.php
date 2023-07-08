<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tags';
    protected $fillable = ['name', 'description'];

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable', 'taggables', 'tag_id', 'taggable_id');
    }

    public function blogs()
    {
        return $this->morphedByMany(Blog::class, 'taggable', 'taggables', 'tag_id', 'taggable_id');
    }
}
