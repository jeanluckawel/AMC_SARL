<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {

        $it = Role::findByName('IT', 'web');
        $it->syncPermissions([
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

            'employees.view',
            'departments.view',
            'sections.view',
            'job_titles.view',

            'reports.view',
            'reports.export',
        ]);


        $md = Role::findByName('MD', 'web');
        $md->syncPermissions([
            'employees.view',
            'departments.view',
            'sections.view',
            'job_titles.view',
            'salaries.view',
            'reports.view',
            'reports.export',
        ]);


        $ceo = Role::findByName('CEO', 'web');
        $ceo->syncPermissions([
            'employees.view',
            'departments.view',
            'sections.view',
            'job_titles.view',
            'salaries.view',
            'reports.view',
            'reports.create',
            'reports.export',
        ]);


        $hr = Role::findByName('HR', 'web');
        $hr->syncPermissions([
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

            'emergency_contacts.view',
            'emergency_contacts.create',
            'emergency_contacts.edit',
            'emergency_contacts.delete',

            'salaries.view',

            'reports.view',
            'reports.create',
            'reports.export',
        ]);


        $hse = Role::findByName('HSE', 'web');
        $hse->syncPermissions([
            'employees.view',
            'employees.edit',
            'departments.view',
            'sections.view',
            'job_titles.view',
            'reports.view',
            'reports.export',
        ]);


        $logistics = Role::findByName('Logistics', 'web');
        $logistics->syncPermissions([
            'employees.view',
            'departments.view',
            'sections.view',
            'job_titles.view',
            'reports.view',
            'reports.export',
        ]);


        $employee = Role::findByName('Employee', 'web');
        $employee->syncPermissions([
            'employees.view',
        ]);
    }
}
