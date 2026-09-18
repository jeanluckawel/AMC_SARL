@extends('layouts.admin')

@section('content')


    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="app-content-header">
        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-7">

                    <h3 class="mb-1">
                        HI, {{ $user->name }}
                    </h3>

                    <div class="text-muted">
                        Welcome to AMC SARL
                    </div>

                </div>

                <div class="col-md-5 text-md-end mt-3 mt-md-0">

                    <div class="dashboard-date">
                        <i class="bi bi-calendar3 me-2"></i>
                        {{ now()->format('l, F d, Y') }}
                    </div>

                </div>

            </div>

        </div>
    </div>


    {{-- =========================================================
        CONTENT
    ========================================================== --}}

    <div class="app-content">

        <div class="container-fluid">


            {{-- =====================================================
                MAIN STATISTICS
            ====================================================== --}}

            <div class="row g-3 mb-4">

                {{-- PENDING REQUESTS --}}
                @can('requests.view')

                    <div class="col-xl-3 col-md-6">

                        <div class="dashboard-stat-card">

                            <div class="stat-icon stat-warning">
                                <i class="bi bi-hourglass-split"></i>
                            </div>

                            <div class="stat-content">

                            <span class="stat-label">
                                Pending Requests
                            </span>

                                <h3>
                                    {{ $pendingRequests }}
                                </h3>

                                <span class="stat-description">
                                Awaiting validation
                            </span>

                            </div>

                            <div class="stat-arrow">
                                <i class="bi bi-arrow-up-right"></i>
                            </div>

                        </div>

                    </div>

                @endcan


                {{-- APPROVED REQUESTS --}}
                @can('requests.view')

                    <div class="col-xl-3 col-md-6">

                        <div class="dashboard-stat-card">

                            <div class="stat-icon stat-success">
                                <i class="bi bi-check-circle"></i>
                            </div>

                            <div class="stat-content">

                            <span class="stat-label">
                                Approved Requests
                            </span>

                                <h3>
                                    {{ $approvedRequests }}
                                </h3>

                                <span class="stat-description">
                                Total approved
                            </span>

                            </div>

                            <div class="stat-arrow">
                                <i class="bi bi-arrow-up-right"></i>
                            </div>

                        </div>

                    </div>

                @endcan


                {{-- EMPLOYEES --}}
                @can('employees.view')

                    <div class="col-xl-3 col-md-6">

                        <div class="dashboard-stat-card">

                            <div class="stat-icon stat-primary">
                                <i class="bi bi-people"></i>
                            </div>

                            <div class="stat-content">

                            <span class="stat-label">
                                Employees
                            </span>

                                <h3>
                                    {{ $totalEmployees }}
                                </h3>

                                <span class="stat-description">
                                Active employees
                            </span>

                            </div>

                            <div class="stat-arrow">
                                <i class="bi bi-arrow-up-right"></i>
                            </div>

                        </div>

                    </div>

                @endcan


                {{-- DEPARTMENT BUDGET --}}
                @can('finance.budget.view')

                    <div class="col-xl-3 col-md-6">

                        <div class="dashboard-stat-card">

                            <div class="stat-icon stat-finance">
                                <i class="bi bi-wallet2"></i>
                            </div>

                            <div class="stat-content">

                            <span class="stat-label">
                                Department Budget
                            </span>

                                <h3>
                                    ${{ number_format($budgets->sum('amount'), 0) }}
                                </h3>

                                <span class="stat-description">
                                Current allocation
                            </span>

                            </div>

                            <div class="stat-arrow">
                                <i class="bi bi-arrow-up-right"></i>
                            </div>

                        </div>

                    </div>

                @endcan

            </div>


            {{-- =====================================================
                SECONDARY STATISTICS
            ====================================================== --}}

            <div class="row g-3 mb-4">


                {{-- DEPARTMENTS --}}
                @can('departments.view')

                    <div class="col-xl-2 col-md-4 col-6">

                        <div class="mini-stat-card">

                            <i class="bi bi-building"></i>

                            <div>

                            <span>
                                Departments
                            </span>

                                <strong>
                                    {{ $department }}
                                </strong>

                            </div>

                        </div>

                    </div>

                @endcan


                {{-- USERS --}}
                @can('users.view')

                    <div class="col-xl-2 col-md-4 col-6">

                        <div class="mini-stat-card">

                            <i class="bi bi-person-badge"></i>

                            <div>

                            <span>
                                Users
                            </span>

                                <strong>
                                    {{ $totalUsers }}
                                </strong>

                            </div>

                        </div>

                    </div>

                @endcan


                {{-- ROLES --}}
                @can('roles.view')

                    <div class="col-xl-2 col-md-4 col-6">

                        <div class="mini-stat-card">

                            <i class="bi bi-shield-lock"></i>

                            <div>

                            <span>
                                Roles
                            </span>

                                <strong>
                                    {{ \Spatie\Permission\Models\Role::count() }}
                                </strong>

                            </div>

                        </div>

                    </div>

                @endcan


                {{-- REJECTED --}}
                @can('requests.view')

                    <div class="col-xl-2 col-md-4 col-6">

                        <div class="mini-stat-card">

                            <i class="bi bi-x-circle"></i>

                            <div>

                            <span>
                                Rejected
                            </span>

                                <strong>
                                    {{ $rejectedRequests }}
                                </strong>

                            </div>

                        </div>

                    </div>

                @endcan


                {{-- AUDIT LOGS --}}
                @can('audit_logs.view')

                    <div class="col-xl-2 col-md-4 col-6">

                        <div class="mini-stat-card">

                            <i class="bi bi-journal-text"></i>

                            <div>

                            <span>
                                Audit Logs
                            </span>

                                <strong>
                                    <i class="bi bi-check-lg"></i>
                                </strong>

                            </div>

                        </div>

                    </div>

                @endcan


                {{-- TODAY --}}
                @can('requests.view')

                    <div class="col-xl-2 col-md-4 col-6">

                        <div class="mini-stat-card">

                            <i class="bi bi-clock-history"></i>

                            <div>

                            <span>
                                Today
                            </span>

                                <strong>
                                    {{ \App\Models\RequestModel::whereDate('created_at', today())->count() }}
                                </strong>

                            </div>

                        </div>

                    </div>

                @endcan

            </div>


            {{-- =====================================================
                MAIN DASHBOARD ROW
            ====================================================== --}}

            <div class="row g-4">


                {{-- =================================================
                    RECENT REQUESTS
                ================================================== --}}

                @can('requests.view')

                    <div class="col-xl-8">

                        <div class="dashboard-card">

                            <div class="dashboard-card-header">

                                <div>

                                    <h5>
                                        Recent Requests
                                    </h5>

                                    <span>
                                    Latest requests submitted by employees
                                </span>

                                </div>

                                <a
                                    href="{{ route('requests.index') }}"
                                    class="dashboard-link"
                                >
                                    View all
                                    <i class="bi bi-arrow-right ms-1"></i>
                                </a>

                            </div>


                            <div class="table-responsive">

                                <table class="table dashboard-table mb-0">

                                    <thead>

                                    <tr>

                                        <th>
                                            Request
                                        </th>

                                        <th>
                                            Employee
                                        </th>

                                        <th>
                                            Department
                                        </th>

                                        <th>
                                            Amount
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                    </tr>

                                    </thead>


                                    <tbody>

                                    @forelse($requests as $request)

                                        <tr>

                                            {{-- REQUEST --}}
                                            <td>

                                                <div class="request-name">

                                                    <div class="request-icon">

                                                        @php

                                                            $title = strtolower($request->title ?? '');

                                                            $icon = 'bi-cart3';

                                                            if (str_contains($title, 'laptop')) {
                                                                $icon = 'bi-laptop';
                                                            } elseif (str_contains($title, 'travel')) {
                                                                $icon = 'bi-car-front';
                                                            } elseif (str_contains($title, 'maintenance')) {
                                                                $icon = 'bi-tools';
                                                            } elseif (str_contains($title, 'stock')) {
                                                                $icon = 'bi-box-seam';
                                                            } elseif (str_contains($title, 'office')) {
                                                                $icon = 'bi-building';
                                                            }

                                                        @endphp

                                                        <i class="bi {{ $icon }}"></i>

                                                    </div>


                                                    <div>

                                                        <strong>
                                                            {{ $request->title }}
                                                        </strong>

                                                        <small>
                                                            {{ $request->reference }}
                                                        </small>

                                                    </div>

                                                </div>

                                            </td>


                                            {{-- EMPLOYEE --}}
                                            <td>

                                                {{ $request->requester?->name ?? 'Unknown' }}

                                            </td>


                                            {{-- DEPARTMENT --}}
                                            <td>

                                                {{ $request->requester?->employee?->department?->name ?? 'N/A' }}

                                            </td>


                                            {{-- AMOUNT --}}
                                            <td>

                                                ${{ number_format((float) $request->total_amount, 2) }}

                                            </td>


                                            {{-- STATUS --}}
                                            <td>

                                                @php

                                                    $status = $request->status;

                                                    $statusValue = $status instanceof \BackedEnum
                                                        ? $status->value
                                                        : (string) $status;

                                                    $statusLabel = match ($statusValue) {

                                                        'pending_procurement',
                                                        'pending_finance',
                                                        'pending_ceo'
                                                            => 'Pending',

                                                        'approved'
                                                            => 'Approved',

                                                        'rejected'
                                                            => 'Rejected',

                                                        default
                                                            => ucfirst(
                                                                str_replace('_', ' ', $statusValue)
                                                            ),

                                                    };

                                                    $statusClass = match ($statusValue) {

                                                        'approved'
                                                            => 'status-approved',

                                                        'rejected'
                                                            => 'status-rejected',

                                                        default
                                                            => 'status-pending',

                                                    };

                                                @endphp

                                                <span class="status-badge {{ $statusClass }}">
                                                {{ $statusLabel }}
                                            </span>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td
                                                colspan="5"
                                                class="text-center py-4"
                                            >
                                                No recent requests found.
                                            </td>

                                        </tr>

                                    @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                @endcan



                {{-- =================================================
                    QUICK ACTIONS
                ================================================== --}}

                <div class="col-xl-4">

                    <div class="dashboard-card">

                        <div class="dashboard-card-header">

                            <div>

                                <h5>
                                    Quick Actions
                                </h5>

                                <span>
                                Frequently used modules
                            </span>

                            </div>

                        </div>


                        <div class="quick-actions">


                            {{-- NEW REQUEST --}}
                            @can('requests.create')

                                <a
                                    href="{{ route('requests.create') }}"
                                    class="quick-action"
                                >

                                    <div class="quick-icon quick-orange">

                                        <i class="bi bi-file-earmark-plus"></i>

                                    </div>

                                    <div>

                                        <strong>
                                            New Request
                                        </strong>

                                        <small>
                                            Create a new request
                                        </small>

                                    </div>

                                    <i class="bi bi-chevron-right"></i>

                                </a>

                            @endcan


                            {{-- EMPLOYEES --}}
                            @can('employees.view')

                                <a
                                    href="{{ route('employees.index') }}"
                                    class="quick-action"
                                >

                                    <div class="quick-icon quick-blue">

                                        <i class="bi bi-people"></i>

                                    </div>

                                    <div>

                                        <strong>
                                            Employees
                                        </strong>

                                        <small>
                                            Manage employees
                                        </small>

                                    </div>

                                    <i class="bi bi-chevron-right"></i>

                                </a>

                            @endcan


                            {{-- DEPARTMENT BUDGET --}}
                            @can('finance.budget.view')

                                <a
                                    href="{{ route('finance.department-budgets') }}"
                                    class="quick-action"
                                >

                                    <div class="quick-icon quick-green">

                                        <i class="bi bi-wallet2"></i>

                                    </div>

                                    <div>

                                        <strong>
                                            Department Budget
                                        </strong>

                                        <small>
                                            Manage budgets
                                        </small>

                                    </div>

                                    <i class="bi bi-chevron-right"></i>

                                </a>

                            @endcan


                            {{-- ROLES --}}
                            @can('roles.view')

                                <a
                                    href="{{ route('roles.index') }}"
                                    class="quick-action"
                                >

                                    <div class="quick-icon quick-purple">

                                        <i class="bi bi-shield-lock"></i>

                                    </div>

                                    <div>

                                        <strong>
                                            Roles & Permissions
                                        </strong>

                                        <small>
                                            Manage access control
                                        </small>

                                    </div>

                                    <i class="bi bi-chevron-right"></i>

                                </a>

                            @endcan


                            {{-- AUDIT LOGS --}}
                            @can('audit_logs.view')

                                <a
                                    href="{{ route('audit-logs.index') }}"
                                    class="quick-action"
                                >

                                    <div class="quick-icon quick-dark">

                                        <i class="bi bi-journal-text"></i>

                                    </div>

                                    <div>

                                        <strong>
                                            Audit Logs
                                        </strong>

                                        <small>
                                            Review system activity
                                        </small>

                                    </div>

                                    <i class="bi bi-chevron-right"></i>

                                </a>

                            @endcan


                            {{-- PROCUREMENT --}}
                            @can('procurement.view')

                                <a
                                    href="#"
                                    class="quick-action"
                                >

                                    <div class="quick-icon quick-orange">

                                        <i class="bi bi-cart-check"></i>

                                    </div>

                                    <div>

                                        <strong>
                                            Procurement
                                        </strong>

                                        <small>
                                            Manage procurement
                                        </small>

                                    </div>

                                    <i class="bi bi-chevron-right"></i>

                                </a>

                            @endcan


                            {{-- QUOTATIONS --}}
                            @can('quotations.view')

                                <a
                                    href="{{ route('quotations.index') }}"
                                    class="quick-action"
                                >

                                    <div class="quick-icon quick-blue">

                                        <i class="bi bi-file-earmark-text"></i>

                                    </div>

                                    <div>

                                        <strong>
                                            Quotations
                                        </strong>

                                        <small>
                                            Manage quotations
                                        </small>

                                    </div>

                                    <i class="bi bi-chevron-right"></i>

                                </a>

                            @endcan


                            {{-- PURCHASE ORDERS --}}
                            @can('purchase_orders.view')

                                <a
                                    href="{{ route('purchase-orders.index') }}"
                                    class="quick-action"
                                >

                                    <div class="quick-icon quick-green">

                                        <i class="bi bi-receipt"></i>

                                    </div>

                                    <div>

                                        <strong>
                                            Purchase Orders
                                        </strong>

                                        <small>
                                            Manage purchase orders
                                        </small>

                                    </div>

                                    <i class="bi bi-chevron-right"></i>

                                </a>

                            @endcan

                        </div>

                    </div>

                </div>

            </div>



            {{-- =====================================================
                BOTTOM ROW
            ====================================================== --}}

            <div class="row g-4 mt-1">


                {{-- =================================================
                    BUDGET OVERVIEW
                ================================================== --}}

                @can('finance.budget.view')

                    <div class="col-xl-6">

                        <div class="dashboard-card">

                            <div class="dashboard-card-header">

                                <div>

                                    <h5>
                                        Budget Overview
                                    </h5>

                                    <span>
                                    Department budget utilization
                                </span>

                                </div>

                                <a
                                    href="{{ route('finance.department-budgets') }}"
                                    class="dashboard-link"
                                >
                                    View budgets
                                </a>

                            </div>


                            <div class="budget-list">

                                @forelse ($budgets as $budget)

                                    @php

                                        $amount = (float) $budget->amount;
                                        $used = (float) $budget->used_amount;

                                        $percentage = $amount > 0
                                            ? min(100, round(($used / $amount) * 100))
                                            : 0;

                                    @endphp


                                    <div class="budget-item">

                                        <div class="budget-header">

                                        <span>
                                            {{ $budget->department?->name ?? 'Unknown Department' }}
                                        </span>

                                            <strong>
                                                {{ $percentage }}%
                                            </strong>

                                        </div>


                                        <div class="progress">

                                            <div
                                                class="progress-bar"
                                                style="width: {{ $percentage }}%"
                                            ></div>

                                        </div>


                                        <div class="budget-footer">

                                        <span>
                                            Used:
                                            ${{ number_format($used, 0) }}
                                        </span>

                                            <span>
                                            ${{ number_format($amount, 0) }}
                                        </span>

                                        </div>

                                    </div>

                                @empty

                                    <div class="text-muted text-center py-3">

                                        No department budgets available.

                                    </div>

                                @endforelse

                            </div>

                        </div>

                    </div>

                @endcan



                {{-- =================================================
                    RECENT ACTIVITY
                ================================================== --}}

                @can('audit_logs.view')

                    <div class="col-xl-6">

                        <div class="dashboard-card">

                            <div class="dashboard-card-header">

                                <div>

                                    <h5>
                                        Recent Activity
                                    </h5>

                                    <span>
                                    Latest system activity
                                </span>

                                </div>

                                <a
                                    href="{{ route('audit-logs.index') }}"
                                    class="dashboard-link"
                                >
                                    View logs
                                </a>

                            </div>


                            <div class="activity-list">

                                <div class="activity-empty">

                                    <i class="bi bi-journal-text"></i>

                                    <span>
                                    Recent system activity is available in the audit logs.
                                </span>

                                    <a
                                        href="{{ route('audit-logs.index') }}"
                                        class="btn btn-sm btn-outline-secondary"
                                    >
                                        View Audit Logs
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                @endcan

            </div>

        </div>

    </div>



    {{-- =========================================================
        CSS
    ========================================================== --}}

    <style>

        .app-content {
            background: #f4f6f9;
        }

        .dashboard-date {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            background: #fff;
            border: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 13px;
        }

        /* =====================================================
           STAT CARDS
        ====================================================== */

        .dashboard-stat-card {
            position: relative;
            display: flex;
            align-items: center;
            min-height: 125px;
            padding: 20px;
            background: #fff;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 6px rgba(0,0,0,.04);
            transition: .2s ease;
        }

        .dashboard-stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,.08);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            min-width: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 22px;
        }

        .stat-warning {
            background: #fff3cd;
            color: #997404;
        }

        .stat-success {
            background: #d1e7dd;
            color: #146c43;
        }

        .stat-primary {
            background: #cfe2ff;
            color: #084298;
        }

        .stat-finance {
            background: #ffe5d0;
            color: #b34700;
        }

        .stat-content {
            min-width: 0;
        }

        .stat-label {
            display: block;
            color: #6c757d;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .stat-content h3 {
            margin: 0;
            font-size: 26px;
            font-weight: 700;
            color: #212529;
        }

        .stat-description {
            display: block;
            margin-top: 3px;
            color: #999;
            font-size: 11px;
        }

        .stat-arrow {
            position: absolute;
            right: 15px;
            top: 15px;
            color: #adb5bd;
            font-size: 14px;
        }

        /* =====================================================
           MINI STATS
        ====================================================== */

        .mini-stat-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            background: #fff;
            border: 1px solid #dee2e6;
        }

        .mini-stat-card > i {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f3f5;
            color: #FF6600;
            font-size: 17px;
        }

        .mini-stat-card span {
            display: block;
            color: #6c757d;
            font-size: 11px;
        }

        .mini-stat-card strong {
            display: block;
            color: #212529;
            font-size: 18px;
        }

        /* =====================================================
           DASHBOARD CARDS
        ====================================================== */

        .dashboard-card {
            background: #fff;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 6px rgba(0,0,0,.04);
        }

        .dashboard-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 20px;
            border-bottom: 1px solid #dee2e6;
        }

        .dashboard-card-header h5 {
            margin: 0 0 3px;
            font-size: 16px;
            font-weight: 600;
        }

        .dashboard-card-header span {
            color: #8a8f94;
            font-size: 12px;
        }

        .dashboard-link {
            color: #FF6600;
            font-size: 12px;
            text-decoration: none;
            white-space: nowrap;
        }

        .dashboard-link:hover {
            color: #cc5200;
        }

        /* =====================================================
           REQUEST TABLE
        ====================================================== */

        .dashboard-table {
            font-size: 13px;
        }

        .dashboard-table thead th {
            background: #f8f9fa;
            color: #6c757d;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 11px 15px;
            white-space: nowrap;
            border-bottom: 1px solid #dee2e6;
        }

        .dashboard-table tbody td {
            padding: 13px 15px;
            vertical-align: middle;
            border-color: #edf0f2;
            white-space: nowrap;
        }

        .request-name {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .request-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff1e8;
            color: #FF6600;
            font-size: 15px;
        }

        .request-name strong {
            display: block;
            color: #212529;
            font-size: 13px;
        }

        .request-name small {
            display: block;
            color: #999;
            font-size: 10px;
            margin-top: 2px;
        }

        /* =====================================================
           STATUS
        ====================================================== */

        .status-badge {
            display: inline-block;
            padding: 5px 9px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #997404;
        }

        .status-approved {
            background: #d1e7dd;
            color: #146c43;
        }

        .status-rejected {
            background: #f8d7da;
            color: #b02a37;
        }

        /* =====================================================
           QUICK ACTIONS
        ====================================================== */

        .quick-actions {
            padding: 5px 0;
        }

        .quick-action {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: #212529;
            text-decoration: none;
            border-bottom: 1px solid #f0f1f2;
            transition: .15s ease;
        }

        .quick-action:last-child {
            border-bottom: none;
        }

        .quick-action:hover {
            background: #f8f9fa;
        }

        .quick-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .quick-orange {
            background: #fff1e8;
            color: #FF6600;
        }

        .quick-blue {
            background: #cfe2ff;
            color: #084298;
        }

        .quick-green {
            background: #d1e7dd;
            color: #146c43;
        }

        .quick-purple {
            background: #e2d9f3;
            color: #59359a;
        }

        .quick-dark {
            background: #e9ecef;
            color: #343a40;
        }

        .quick-action > div:nth-child(2) {
            flex: 1;
            min-width: 0;
        }

        .quick-action strong {
            display: block;
            font-size: 13px;
            font-weight: 600;
        }

        .quick-action small {
            display: block;
            color: #999;
            font-size: 11px;
            margin-top: 2px;
        }

        .quick-action > i {
            color: #adb5bd;
            font-size: 12px;
        }

        /* =====================================================
           BUDGET
        ====================================================== */

        .budget-list {
            padding: 20px;
        }

        .budget-item {
            margin-bottom: 20px;
        }

        .budget-item:last-child {
            margin-bottom: 0;
        }

        .budget-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 7px;
            font-size: 13px;
        }

        .budget-header span {
            color: #495057;
        }

        .budget-header strong {
            color: #FF6600;
        }

        .budget-item .progress {
            height: 7px;
            border-radius: 0;
            background: #e9ecef;
        }

        .budget-item .progress-bar {
            background: #FF6600;
        }

        .budget-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            color: #999;
            font-size: 10px;
        }

        /* =====================================================
           ACTIVITY
        ====================================================== */

        .activity-list {
            padding: 8px 20px;
        }

        .activity-empty {
            min-height: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-align: center;
            color: #8a8f94;
            font-size: 13px;
        }

        .activity-empty > i {
            font-size: 35px;
            color: #FF6600;
        }

        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 768px) {

            .dashboard-card-header {
                align-items: flex-start;
            }

            .dashboard-card-header .dashboard-link {
                display: none;
            }

            .dashboard-table {
                min-width: 800px;
            }

            .mini-stat-card {
                min-height: 68px;
            }

        }

        @media (max-width: 480px) {

            .stat-content h3 {
                font-size: 22px;
            }

            .stat-icon {
                width: 45px;
                height: 45px;
                min-width: 45px;
            }

        }

    </style>


@endsection
