<?php

namespace Database\Factories;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Status>
 */
class StatusFactory extends Factory
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
            'statusable_id' => random_int(1, 10),
            'statusable_type' => random_int(1, 10),
        ];
    }
}
