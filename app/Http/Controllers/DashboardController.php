<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentBudget;
use App\Models\Employee;
use App\Models\PurchaseOrder;
use App\Models\Quotation;
use App\Models\RequestModel;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | DEFAULT VALUES
        |--------------------------------------------------------------------------
        | On initialise toutes les variables utilisées par le Blade.
        | Cela évite les "Undefined variable".
        |--------------------------------------------------------------------------
        */

        $department = 0;
        $employee = 0;
        $totalUsers = 0;
        $totalEmployees = 0;

        $requests = collect();

        $totalRequests = 0;
        $pendingRequests = 0;
        $approvedRequests = 0;
        $rejectedRequests = 0;

        $totalQuotations = 0;
        $totalPurchaseOrders = 0;

        $budgets = collect();


        /*
        |--------------------------------------------------------------------------
        | EXECUTIVE ACCESS
        |--------------------------------------------------------------------------
        |
        | CEO et DG peuvent voir les informations globales.
        |
        */

        $isExecutive =
            $user->can('ceo.view') ||
            $user->can('dg.view');


        /*
        |--------------------------------------------------------------------------
        | CEO / DG
        |--------------------------------------------------------------------------
        */

        if ($isExecutive) {

            /*
            |--------------------------------------------------------------------------
            | DEPARTMENTS
            |--------------------------------------------------------------------------
            */

            if ($user->can('departments.view')) {
                $department = Department::count();
            }


            /*
            |--------------------------------------------------------------------------
            | EMPLOYEES
            |--------------------------------------------------------------------------
            */

            if ($user->can('employees.view')) {
                $employee = Employee::count();
                $totalEmployees = Employee::count();
            }


            /*
            |--------------------------------------------------------------------------
            | USERS
            |--------------------------------------------------------------------------
            */

            if ($user->can('users.view')) {
                $totalUsers = User::count();
            }


            /*
            |--------------------------------------------------------------------------
            | REQUESTS
            |--------------------------------------------------------------------------
            */

            if ($user->can('requests.view')) {

                $requests = RequestModel::with([
                    'requester.employee.department',
                    'items',
                    'attachments',
                    'steps.user',
                ])
                    ->latest('created_at')
                    ->take(5)
                    ->get();


                $totalRequests = RequestModel::count();


                $pendingRequests = RequestModel::whereIn('status', [
                    'pending_procurement',
                    'pending_finance',
                    'pending_ceo',
                ])->count();


                $approvedRequests = RequestModel::where(
                    'status',
                    'approved'
                )->count();


                $rejectedRequests = RequestModel::where(
                    'status',
                    'rejected'
                )->count();
            }


            /*
            |--------------------------------------------------------------------------
            | QUOTATIONS
            |--------------------------------------------------------------------------
            */

            if ($user->can('quotations.view')) {
                $totalQuotations = Quotation::count();
            }


            /*
            |--------------------------------------------------------------------------
            | PURCHASE ORDERS
            |--------------------------------------------------------------------------
            */

            if ($user->can('purchase_orders.view')) {
                $totalPurchaseOrders = PurchaseOrder::count();
            }


            /*
            |--------------------------------------------------------------------------
            | BUDGET
            |--------------------------------------------------------------------------
            */

            if ($user->can('finance.budget.view')) {

                $budgets = DepartmentBudget::with('department')
                    ->latest()
                    ->take(5)
                    ->get();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | NORMAL USER
        |--------------------------------------------------------------------------
        |
        | Un utilisateur normal ne voit que SES demandes.
        |
        */

        else {

            if ($user->can('requests.view')) {

                $requestQuery = RequestModel::with([
                    'requester.employee.department',
                    'items',
                    'attachments',
                    'steps.user',
                ])
                    ->whereHas('requester', function ($query) use ($user) {
                        $query->where('id', $user->id);
                    });


                /*
                |--------------------------------------------------------------------------
                | RECENT REQUESTS
                |--------------------------------------------------------------------------
                */

                $requests = (clone $requestQuery)
                    ->latest('created_at')
                    ->take(5)
                    ->get();


                /*
                |--------------------------------------------------------------------------
                | TOTAL REQUESTS
                |--------------------------------------------------------------------------
                */

                $totalRequests = (clone $requestQuery)
                    ->count();


                /*
                |--------------------------------------------------------------------------
                | PENDING
                |--------------------------------------------------------------------------
                */

                $pendingRequests = (clone $requestQuery)
                    ->whereIn('status', [
                        'pending_procurement',
                        'pending_finance',
                        'pending_ceo',
                    ])
                    ->count();


                /*
                |--------------------------------------------------------------------------
                | APPROVED
                |--------------------------------------------------------------------------
                */

                $approvedRequests = (clone $requestQuery)
                    ->where('status', 'approved')
                    ->count();


                /*
                |--------------------------------------------------------------------------
                | REJECTED
                |--------------------------------------------------------------------------
                */

                $rejectedRequests = (clone $requestQuery)
                    ->where('status', 'rejected')
                    ->count();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('dashboard.index', compact(
            'user',

            'department',
            'employee',
            'totalEmployees',
            'totalUsers',

            'requests',
            'totalRequests',
            'pendingRequests',
            'approvedRequests',
            'rejectedRequests',

            'totalQuotations',
            'totalPurchaseOrders',

            'budgets',
        ));
    }
}
