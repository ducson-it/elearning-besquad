<?php

namespace Database\Factories;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RolePermission>
 */
class RolePermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $roleId = Role::factory()->create()->getKey();
        $permissionId = Permission::factory()->create()->getKey();

        return [
            'role_id' => $roleId,
            'permission_id' => $permissionId,
        ];
    }

}
