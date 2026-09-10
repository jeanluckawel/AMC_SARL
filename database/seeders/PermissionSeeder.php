<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEES
            |--------------------------------------------------------------------------
            */
            'employees.view',
            'employees.create',
            'employees.edit',
            'employees.delete',


//quotation
            'quotations.view',
            'quotations.create',
            'quotations.edit',
            'quotations.delete',

//            PO

            'purchase_orders.view',
            'purchase_orders.create',
            'purchase_orders.delete',


            /*
            |--------------------------------------------------------------------------
            | ORGANIZATION
            |--------------------------------------------------------------------------
            */
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


            /*
            |--------------------------------------------------------------------------
            | USERS
            |--------------------------------------------------------------------------
            */
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',


            /*
            |--------------------------------------------------------------------------
            | ROLES
            |--------------------------------------------------------------------------
            */
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',


            /*
            |--------------------------------------------------------------------------
            | PERMISSIONS
            |--------------------------------------------------------------------------
            */
            'permissions.view',
            'permissions.create',
            'permissions.edit',
            'permissions.delete',


            /*
            |--------------------------------------------------------------------------
            | REQUESTS
            |--------------------------------------------------------------------------
            */
            'requests.view',
            'requests.create',
            'requests.edit',
            'requests.delete',


            /*
            |--------------------------------------------------------------------------
            | PROCUREMENT
            |--------------------------------------------------------------------------
            */
            'procurement.view',
            'procurement.approve',
            'procurement.reject',


            /*
            |--------------------------------------------------------------------------
            | FINANCE
            |--------------------------------------------------------------------------
            */
            'finance.view',
            'finance.approve',
            'finance.reject',
            'finance.budget.view',
            'finance.budget.create',
            'finance.budget.edit',
            'finance.budget.delete',


            /*
            |--------------------------------------------------------------------------
            | CEO
            |--------------------------------------------------------------------------
            */
            'ceo.view',
            'ceo.approve',
            'ceo.reject',


            /*
            |--------------------------------------------------------------------------
            | AUDIT
            |--------------------------------------------------------------------------
            */
            'audit_logs.view',


            /*
            |--------------------------------------------------------------------------
            | REPORTS
            |--------------------------------------------------------------------------
            */
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
