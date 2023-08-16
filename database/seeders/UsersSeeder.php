<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()->count(10)->create();
        $user = User::create(
            [
                'name' => 'admin',
                'email' => 'admin@beesquad.com',
                'password' => bcrypt('12345678'),
                'avatar' => 'random',
                'username' => 'admin',
                'phone' => '098123123123',
                'address' => 'address',
                'point' => 0,
                // 'role_id' => 1,
                'active' => 1,
            ]
            );

        $user->assignRole(1);
    }
}
