<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'مدير النظام',
                'slug' => 'مدير-النظام',
                'display_name' => 'Administration',
            ]
        ];

        foreach ($data as $get)
        {
            Role::updateOrCreate($get);
        }

        $role = Role::first();
        // Assign Role To Admins
        $roleUsers = [
            [
                'role_id' => $role->id,
                'model_id' => 1,
                'model_type' => 'app\Models\Admin',
            ]
        ];

        foreach ($roleUsers as $get)
        {
            DB::table('model_has_roles')->updateOrInsert($get);
        }


        // Assign Role to Permissions

        if($role) {
            $permissions = Permission::get(['id']);
            foreach ($permissions as $get) {
                $item = [
                    'permission_id' => $get->id,
                    'role_id' => $role->id
                ];
                DB::table('role_has_permissions')->updateOrInsert($item);
            }
        }

    }

}
