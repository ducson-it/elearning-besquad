<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->realText(50);
        $name = Str::limit($name, 30);
        $roleIds = Role::pluck('id')->toArray();
        $roleId = $this->faker->randomElement($roleIds);

        return [
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('12345678'),
            'avatar' => $this->faker->imageUrl(200, 200, 'avatar'),
            'username' => $this->faker->userName,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'point' => $this->faker->numberBetween(0, 100),
            'role_id' => $roleId,
            'active' => 1,
        ];
    }

    /**
     * Customize the factory to create a specific user.
     *
     * @return $this
     */
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'admin',
                'email' => 'dinhhuuthanh99@gmail.com',
                'password' => Hash::make('12345678'),
                'role_id' => Role::factory()->create(['name' => 'Admin'])->id,
            ];
        });
    }
}
