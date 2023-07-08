<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\CategoryBlog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(6);
        $title = Str::limit($title, 60);

        return [
            'user_id' => User::factory()->create()->id,
            'title' => $title,
            'slug' => $this->faker->slug,
            'image' => $this->faker->imageUrl(200, 200),
            'view' => $this->faker->numberBetween(0, 1000),
            'description_short' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'category_blog_id' => CategoryBlog::inRandomOrder()->first()->id,
        ];
    }
}
