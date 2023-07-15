<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CategoryBlog extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'category_blogs';
    protected $fillable = ['name', 'slug', 'description'];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
