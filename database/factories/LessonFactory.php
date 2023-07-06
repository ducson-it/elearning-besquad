<?php

namespace Database\Factories;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
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
            'course_id' => Course::factory()->create()->id,
            'module_id' => Module::factory()->create()->id,
            'document' => $this->faker->word . '.pdf',
            'video_id' => $this->faker->uuid,
            'status' => $this->faker->randomElement([0, 1]),
            'description' => $this->faker->paragraph,
        ];
    }
}
