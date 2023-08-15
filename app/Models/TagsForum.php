<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagsForum extends Model
{
    protected $table = 'tagsforum';
    protected $fillable = ['name'];
    use HasFactory;
    public function posts()
    {
        return $this->hasMany(ForumPost::class);
    }

}
