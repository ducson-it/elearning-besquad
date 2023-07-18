<?php

namespace Database\Factories;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
            'price' => $this->faker->numberBetween(100, 1000),
            'user_id' => User::factory()->create()->id,
            'discount' => $this->faker->numberBetween(0, 50),
            'status' => $this->faker->boolean ? 1 : 0,
            'featured' => $this->faker->boolean ? 1 : 0,
            'category_id' => Category::inRandomOrder()->first()->id,
            'image' => json_encode([
                'url' => $this->faker->imageUrl(700, 300),
                'width' => 700,
                'height' => 300,
            ]),
            'description' => $this->faker->paragraph,
            'is_free' => $this->faker->boolean ? 1 : 0,
        ];
    }
}
