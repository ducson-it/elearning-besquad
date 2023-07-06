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
            'category_id' => Category::factory()->create()->id,
            'image' => $this->faker->imageUrl(200, 200),
            'description' => $this->faker->paragraph,
        ];
    }
}
