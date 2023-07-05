<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
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
            'content' => $this->faker->sentence,
            'text_color' => $this->faker->hexcolor,
            'url_btn' => $this->faker->url,
            'content_btn' => $this->faker->paragraph,
            'image' => $this->faker->image(storage_path('app/public/sliders'), 200, 200, null, false),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
