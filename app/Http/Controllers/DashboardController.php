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

        $department = Department::count();

        $employee = Employee::count();

        $totalUsers = User::count();

        $totalEmployees = Employee::count();


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

        $approvedRequests = RequestModel::where('status', 'approved')
            ->count();

        $rejectedRequests = RequestModel::where('status', 'rejected')
            ->count();



        $totalQuotations = Quotation::count();

        $totalPurchaseOrders = PurchaseOrder::count();


        $budgets = DepartmentBudget::with('department')
            ->latest()
            ->take(5)
            ->get();


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
