<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->word;
        $name = substr($name, 0, 30);
        return [
            'name' => $name,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
        ];
    }
}
