<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryBlog>
 */
class CategoryBlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->realText(50);
        $name = Str::limit($name, 30);
        return [
            'name' => $name,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
        ];
    }
}
