<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        | DG
        |--------------------------------------------------------------------------
        */

        $dg = Role::findByName('DG', 'web');

        $dg->syncPermissions([
            // Employees
            'employees.view',
            'employees.create',
            'employees.edit',
            'employees.delete',

            // Organization
            'departments.view',
            'sections.view',
            'job_titles.view',
            'salaries.view',

            // Quotations
            'quotations.view',
            'quotations.create',
            'quotations.edit',

            // Purchase Orders
            'purchase_orders.view',
            'purchase_orders.create',

            // Requests
            'requests.view',
            'requests.create',
            'requests.edit',

            // Procurement
            'procurement.view',
            'procurement.approve',
            'procurement.reject',

            // Finance
            'finance.view',
            'finance.approve',
            'finance.reject',
            'finance.budget.view',

            // CEO
            'ceo.view',
            'ceo.approve',
            'ceo.reject',

            // Reports
            'reports.view',
            'reports.create',
            'reports.export',

            // Audit
            'audit_logs.view',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CEO
        |--------------------------------------------------------------------------
        */

        $ceo = Role::findByName('CEO', 'web');

        $ceo->syncPermissions([
            // Employees
            'employees.view',

            // Organization
            'departments.view',
            'sections.view',
            'job_titles.view',
            'salaries.view',

            // Quotations
            'quotations.view',

            // Purchase Orders
            'purchase_orders.view',

            // Requests
            'requests.view',

            // Procurement
            'procurement.view',
            'procurement.approve',
            'procurement.reject',

            // Finance
            'finance.view',
            'finance.approve',
            'finance.reject',
            'finance.budget.view',

            // CEO
            'ceo.view',
            'ceo.approve',
            'ceo.reject',

            // Reports
            'reports.view',
            'reports.create',
            'reports.export',

            // Audit
            'audit_logs.view',
        ]);


        /*
        |--------------------------------------------------------------------------
        | HR
        |--------------------------------------------------------------------------
        */

        $hr = Role::findByName('HR', 'web');

        $hr->syncPermissions([
            // Employees
            'employees.view',
            'employees.create',
            'employees.edit',
            'employees.delete',

            // Departments
            'departments.view',
            'departments.create',
            'departments.edit',
            'departments.delete',

            // Sections
            'sections.view',
            'sections.create',
            'sections.edit',
            'sections.delete',

            // Job Titles
            'job_titles.view',
            'job_titles.create',
            'job_titles.edit',
            'job_titles.delete',

            // Emergency Contacts
            'emergency_contacts.view',
            'emergency_contacts.create',
            'emergency_contacts.edit',
            'emergency_contacts.delete',

            // Salaries
            'salaries.view',
            'salaries.create',
            'salaries.edit',
            'salaries.delete',

            // Reports
            'reports.view',
            'reports.create',
            'reports.export',
        ]);


        /*
        |--------------------------------------------------------------------------
        | LOGISTICS
        |--------------------------------------------------------------------------
        */

        $logistics = Role::findByName('Logistics', 'web');

        $logistics->syncPermissions([
            // Employees
            'employees.view',

            // Organization
            'departments.view',
            'sections.view',
            'job_titles.view',

            // Quotations
            'quotations.view',

            // Purchase Orders
            'purchase_orders.view',
            'purchase_orders.create',

            // Procurement
            'procurement.view',

            // Requests
            'requests.view',

            // Reports
            'reports.view',
            'reports.export',
        ]);


        /*
        |--------------------------------------------------------------------------
        | PROCUREMENT
        |--------------------------------------------------------------------------
        */

        $procurement = Role::findByName('Procurement', 'web');

        $procurement->syncPermissions([
            // Employees
            'employees.view',

            // Quotations
            'quotations.view',
            'quotations.create',
            'quotations.edit',
            'quotations.delete',

            // Purchase Orders
            'purchase_orders.view',
            'purchase_orders.create',
            'purchase_orders.delete',

            // Requests
            'requests.view',
            'requests.create',
            'requests.edit',
            'requests.delete',

            // Procurement
            'procurement.view',
            'procurement.approve',
            'procurement.reject',

            // Reports
            'reports.view',
            'reports.create',
            'reports.export',
        ]);


        /*
        |--------------------------------------------------------------------------
        | FINANCE
        |--------------------------------------------------------------------------
        */

        $finance = Role::findByName('Finance', 'web');

        $finance->syncPermissions([
            // Employees
            'employees.view',

            // Quotations
            'quotations.view',

            // Purchase Orders
            'purchase_orders.view',

            // Requests
            'requests.view',

            // Procurement
            'procurement.view',

            // Finance
            'finance.view',
            'finance.approve',
            'finance.reject',

            // Budgets
            'finance.budget.view',
            'finance.budget.create',
            'finance.budget.edit',
            'finance.budget.delete',

            // Reports
            'reports.view',
            'reports.create',
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
            'requests.view',
            'requests.create',
        ]);
    }
}
