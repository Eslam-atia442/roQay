<?php

namespace Database\Seeders;

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
        $data = [

            // shifts permissions
            [
                'path' => 'shifts',
                'name' => 'read-shifts',
                'display_name' => 'read shifts',
                'description' => 'عرض الدوام',
            ],
            [
                'path' => 'shifts',
                'name' => 'update-shifts',
                'display_name' => 'update shifts',
                'description' => 'تعديل الدوام',
            ],
            [
                'path' => 'shifts',
                'name' => 'create-shifts',
                'display_name' => 'create shifts',
                'description' => 'إضافة الدوام',
            ],
            [
                'path' => 'shifts',
                'name' => 'delete-shifts',
                'display_name' => 'delete shifts',
                'description' => 'مسح الدوام',
            ],
            // pharmacies permissions
            [
                'path' => 'pharmacies',
                'name' => 'read-pharmacies',
                'display_name' => 'read pharmacies',
                'description' => 'عرض الصيدليات',
            ],
            [
                'path' => 'pharmacies',
                'name' => 'update-pharmacies',
                'display_name' => 'update pharmacies',
                'description' => 'تعديل الصيدليات',
            ],
            [
                'path' => 'pharmacies',
                'name' => 'create-pharmacies',
                'display_name' => 'create pharmacies',
                'description' => 'إضافة الصيدليات',
            ],
            [
                'path' => 'pharmacies',
                'name' => 'delete-pharmacies',
                'display_name' => 'delete pharmacies',
                'description' => 'مسح الصيدليات',
            ],
            // users permissions
            [
                'path' => 'users',
                'name' => 'read-users',
                'display_name' => 'read users',
                'description' => 'عرض العملاء',
            ],
            [
                'path' => 'users',
                'name' => 'update-users',
                'display_name' => 'update users',
                'description' => 'تعديل العملاء',
            ],
            [
                'path' => 'users',
                'name' => 'create-users',
                'display_name' => 'create users',
                'description' => 'إضافة العملاء',
            ],
            [
                'path' => 'users',
                'name' => 'delete-users',
                'display_name' => 'delete users',
                'description' => 'مسح العملاء',
            ],
            // settings permissions
            [
                'path' => 'settings',
                'name' => 'read-settings',
                'display_name' => 'read settings',
                'description' => 'عرض الاعدادت',
            ],
            [
                'path' => 'settings',
                'name' => 'update-settings',
                'display_name' => 'update settings',
                'description' => 'تعديل الاعدادت',
            ],

            // roles permissions
            [
                'path' => 'roles',
                'name' => 'read-roles',
                'display_name' => 'read roles',
                'description' => 'عرض الصلاحيات',
            ],
            [
                'path' => 'roles',
                'name' => 'update-roles',
                'display_name' => 'update roles',
                'description' => 'تعديل الصلاحيات',
            ],
            [
                'path' => 'roles',
                'name' => 'create-roles',
                'display_name' => 'create roles',
                'description' => 'إضافة الصلاحيات',
            ],
            [
                'path' => 'roles',
                'name' => 'delete-roles',
                'display_name' => 'delete roles',
                'description' => 'مسح الصلاحيات',
            ],
            // admins permissions
            [
                'path' => 'admins',
                'name' => 'read-admins',
                'display_name' => 'read admins',
                'description' => 'عرض المديرين',
            ],
            [
                'path' => 'admins',
                'name' => 'update-admins',
                'display_name' => 'update admins',
                'description' => 'تعديل المديرين',
            ],
            [
                'path' => 'admins',
                'name' => 'create-admins',
                'display_name' => 'create admins',
                'description' => 'إضافة المديرين',
            ],
            [
                'path' => 'admins',
                'name' => 'delete-admins',
                'display_name' => 'delete admins',
                'description' => 'مسح المديرين',
            ],
        ];


        foreach ($data as $get) {
            Permission::updateOrCreate($get);
        }
    }
}
