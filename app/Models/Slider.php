<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'sliders';
    protected $fillable = ['name', 'content', 'text_color', 'url_btn', 'content_btn', 'image', 'status'];

    public function scopeActiveSlider(Builder $query): void
    {
        $query->where('status', 1);
    }
}
