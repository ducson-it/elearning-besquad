<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slider extends Model implements HasMedia
{
    use HasFactory; use InteractsWithMedia;
    protected $table = 'sliders';
    protected $fillable = ['name', 'content', 'text_color', 'url_btn', 'content_btn', 'image', 'status'];
    protected $casts=[
        'image' =>'json'
];
    public function scopeActiveSlider(Builder $query): void
    {
        $query->where('status', 1);
    }
}
