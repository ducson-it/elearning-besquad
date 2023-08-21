<?php

namespace Database\Seeders;

use App\Models\GroupPermission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupPermission = GroupPermission::create(['name' => 'Admin']);

        $permission = Permission::create([
            'name' => 'super-admin',
            'description' => 'Super Admin',
            'group_permission_id' => $groupPermission->id,
        ]);
    }
}
