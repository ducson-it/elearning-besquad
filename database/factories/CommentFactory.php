<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'content' => $this->faker->sentence,
            'status' => $this->faker->randomElement([0, 1]),
            'commentable_id' => random_int(1, 10),
            'commentable_type' => random_int(1, 10),
        ];
    }
}
