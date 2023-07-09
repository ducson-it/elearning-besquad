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
        $name = $this->faker->text(30);
        $name = substr($name, 0, 30);

        $contentBtn = $this->faker->text(10);
        $contentBtn = substr($contentBtn, 0, 10);

        return [
            'name' => $name,
            'content' => $this->faker->sentence,
            'text_color' => $this->faker->hexcolor,
            'url_btn' => $this->faker->url,
            'content_btn' => $contentBtn,
            'image' => $this->faker->imageUrl(700, 300),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
