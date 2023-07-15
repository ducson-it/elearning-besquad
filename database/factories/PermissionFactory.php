<?php

namespace Database\Factories;
use App\Models\RolePermission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->word;
        $name = Str::limit($name, 30);

        return [
            'name' => $name,
            'description' => $this->faker->sentence,
        ];
    }

}
