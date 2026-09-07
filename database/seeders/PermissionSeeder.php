<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [


            'employees.view',
            'employees.create',
            'employees.edit',
            'employees.delete',


            'departments.view',
            'departments.create',
            'departments.edit',
            'departments.delete',


            'sections.view',
            'sections.create',
            'sections.edit',
            'sections.delete',


            'job_titles.view',
            'job_titles.create',
            'job_titles.edit',
            'job_titles.delete',


            'salaries.view',
            'salaries.create',
            'salaries.edit',
            'salaries.delete',


            'emergency_contacts.view',
            'emergency_contacts.create',
            'emergency_contacts.edit',
            'emergency_contacts.delete',


            'users.view',
            'users.create',
            'users.edit',
            'users.delete',


            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',


            'permissions.view',
            'permissions.create',
            'permissions.edit',
            'permissions.delete',


            'reports.view',
            'reports.create',
            'reports.export',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
