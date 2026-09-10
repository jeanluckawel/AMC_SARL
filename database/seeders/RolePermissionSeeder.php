<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | IT - ALL PERMISSIONS
        |--------------------------------------------------------------------------
        */
        $it = Role::findByName('IT', 'web');

        $it->syncPermissions(
            Permission::where('guard_name', 'web')->get()
        );


        /*
        |--------------------------------------------------------------------------
        | MD
        |--------------------------------------------------------------------------
        */
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


        /*
        |--------------------------------------------------------------------------
        | CEO
        |--------------------------------------------------------------------------
        */
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

            'ceo.view',
            'ceo.approve',
            'ceo.reject',
        ]);


        /*
        |--------------------------------------------------------------------------
        | HR
        |--------------------------------------------------------------------------
        */
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


        /*
        |--------------------------------------------------------------------------
        | HSE
        |--------------------------------------------------------------------------
        */
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


        /*
        |--------------------------------------------------------------------------
        | LOGISTICS
        |--------------------------------------------------------------------------
        */
        $logistics = Role::findByName('Logistics', 'web');

        $logistics->syncPermissions([
            'employees.view',

            'departments.view',
            'sections.view',
            'job_titles.view',

            'reports.view',
            'reports.export',
        ]);


        /*
        |--------------------------------------------------------------------------
        | EMPLOYEE
        |--------------------------------------------------------------------------
        */
        $employee = Role::findByName('Employee', 'web');

        $employee->syncPermissions([
            'employees.view',
        ]);
    }
}

