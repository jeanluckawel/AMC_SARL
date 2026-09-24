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
                        {{ __('menu.greeting', ['name' => $user->name]) }}
                    </h3>

                    <div class="text-muted">
                        {{ __('menu.welcome', ['app' => env('APP_NAME')]) }}
                    </div>
                </div>

                <div class="col-md-5 text-md-end mt-3 mt-md-0">
                    <div class="dashboard-date">
                        <i class="bi bi-calendar3 me-2"></i>
                        {{ now()->locale(app()->getLocale())->translatedFormat('l, d F Y') }}
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
                                    {{ __('menu.pending_requests') }}
                                </span>

                                <h3>
                                    {{ $pendingRequests }}
                                </h3>

                                <span class="stat-description">
                                    {{ __('menu.awaiting_validation') }}
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
                                    {{ __('menu.approved_requests') }}
                                </span>

                                <h3>
                                    {{ $approvedRequests }}
                                </h3>

                                <span class="stat-description">
                                    {{ __('menu.total_approved') }}
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
                                    {{ __('menu.employees') }}
                                </span>

                                <h3>
                                    {{ $totalEmployees }}
                                </h3>

                                <span class="stat-description">
                                    {{ __('menu.active_employees') }}
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
                                    {{ __('menu.department_budget') }}
                                </span>

                                <h3>
                                    ${{ number_format($budgets->sum('amount'), 0) }}
                                </h3>

                                <span class="stat-description">
                                    {{ __('menu.current_allocation') }}
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
                                    {{ __('menu.departments') }}
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
                                    {{ __('menu.users') }}
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
                                    {{ __('menu.roles') }}
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
                                    {{ __('menu.rejected') }}
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
                                    {{ __('menu.audit_logs') }}
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
                                    {{ __('menu.today') }}
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
                                        {{ __('menu.recent_requests') }}
                                    </h5>

                                    <span>
                                        {{ __('menu.recent_requests_desc') }}
                                    </span>
                                </div>

                                <a
                                    href="{{ route('requests.index') }}"
                                    class="dashboard-link"
                                >
                                    {{ __('menu.view_all') }}
                                    <i class="bi bi-arrow-right ms-1"></i>
                                </a>

                            </div>


                            <div class="table-responsive dashboard-table-wrapper">

                                <table class="table dashboard-table mb-0">

                                    <thead>
                                    <tr>
                                        <th>
                                            {{ __('menu.request') }}
                                        </th>

                                        <th>
                                            {{ __('menu.employee') }}
                                        </th>

                                        <th>
                                            {{ __('menu.departments') }}
                                        </th>

                                        <th>
                                            {{ __('menu.amount') }}
                                        </th>

                                        <th>
                                            {{ __('menu.status') }}
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
                                                {{ $request->requester?->name ?? __('menu.unknown') }}
                                            </td>


                                            {{-- DEPARTMENT --}}
                                            <td>
                                                {{ $request->requester?->employee?->department?->name ?? __('menu.na') }}
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
                                                            => __('menu.pending'),

                                                        'approved'
                                                            => __('menu.approved'),

                                                        'rejected'
                                                            => __('menu.rejected_status'),

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
                                                {{ __('menu.no_recent_requests') }}
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
                                    {{ __('menu.quick_actions') }}
                                </h5>

                                <span>
                                    {{ __('menu.frequently_used') }}
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
                                            {{ __('menu.new_request') }}
                                        </strong>

                                        <small>
                                            {{ __('menu.new_request_desc') }}
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
                                            {{ __('menu.employees') }}
                                        </strong>

                                        <small>
                                            {{ __('menu.manage_employees') }}
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
                                            {{ __('menu.department_budget') }}
                                        </strong>

                                        <small>
                                            {{ __('menu.manage_budgets') }}
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
                                            {{ __('menu.roles_permissions') }}
                                        </strong>

                                        <small>
                                            {{ __('menu.manage_access_control') }}
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
                                            {{ __('menu.audit_logs') }}
                                        </strong>

                                        <small>
                                            {{ __('menu.review_system_activity') }}
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
                                            {{ __('menu.procurement') }}
                                        </strong>

                                        <small>
                                            {{ __('menu.manage_procurement') }}
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
                                            {{ __('menu.quotations') }}
                                        </strong>

                                        <small>
                                            {{ __('menu.manage_quotations') }}
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
                                            {{ __('menu.purchase_orders') }}
                                        </strong>

                                        <small>
                                            {{ __('menu.manage_purchase_orders') }}
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
                                        {{ __('menu.budget_overview') }}
                                    </h5>

                                    <span>
                                        {{ __('menu.budget_overview_desc') }}
                                    </span>
                                </div>

                                <a
                                    href="{{ route('finance.department-budgets') }}"
                                    class="dashboard-link"
                                >
                                    {{ __('menu.view_budgets') }}
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
                                                {{ $budget->department?->name ?? __('menu.unknown_department') }}
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
                                                {{ __('menu.used') }}:
                                                ${{ number_format($used, 0) }}
                                            </span>

                                            <span>
                                                ${{ number_format($amount, 0) }}
                                            </span>

                                        </div>

                                    </div>

                                @empty

                                    <div class="text-muted text-center py-3">
                                        {{ __('menu.no_budgets') }}
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
                                        {{ __('menu.recent_activity') }}
                                    </h5>

                                    <span>
                                        {{ __('menu.recent_activity_desc') }}
                                    </span>
                                </div>

                                <a
                                    href="{{ route('audit-logs.index') }}"
                                    class="dashboard-link"
                                >
                                    {{ __('menu.view_logs') }}
                                </a>

                            </div>


                            <div class="activity-list">

                                <div class="activity-empty">

                                    <i class="bi bi-journal-text"></i>

                                    <span>
                                        {{ __('menu.activity_placeholder') }}
                                    </span>

                                    <a
                                        href="{{ route('audit-logs.index') }}"
                                        class="btn btn-sm btn-outline-secondary"
                                    >
                                        {{ __('menu.view_audit_logs') }}
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

        .dashboard-table-wrapper {
            width: 100%;
        }

        .dashboard-table {
            width: 100%;
            margin-bottom: 0 !important;
            font-size: 13px;
            color: #212529;
            border-collapse: separate;
            border-spacing: 0;
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

        .dashboard-table tbody {
            background: #fff;
        }

        .dashboard-table tbody tr {
            background: #fff;
            transition: background-color .15s ease;
        }

        .dashboard-table tbody tr:hover {
            background: #f8f9fa;
        }

        .dashboard-table tbody td {
            padding: 13px 15px;
            vertical-align: middle;
            border-color: #edf0f2;
            white-space: nowrap;
            color: #212529;
        }

        .dashboard-table tbody tr:hover td {
            background: #f8f9fa;
            color: #212529;
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


        /* =====================================================
           DARK MODE
        ====================================================== */

        [data-bs-theme="dark"] .app-content {
            background: #1a1d21 !important;
        }

        [data-bs-theme="dark"] .dashboard-date {
            background: #24282e !important;
            border-color: #383e46 !important;
            color: #adb5bd !important;
        }

        [data-bs-theme="dark"] .dashboard-stat-card,
        [data-bs-theme="dark"] .mini-stat-card,
        [data-bs-theme="dark"] .dashboard-card {
            background: #24282e !important;
            border-color: #383e46 !important;
            color: #dee2e6 !important;
        }

        [data-bs-theme="dark"] .dashboard-stat-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,.3);
        }

        [data-bs-theme="dark"] .stat-content h3 {
            color: #f1f3f5 !important;
        }

        [data-bs-theme="dark"] .stat-label,
        [data-bs-theme="dark"] .stat-description {
            color: #9aa1a9 !important;
        }

        [data-bs-theme="dark"] .stat-arrow {
            color: #5c636b !important;
        }

        [data-bs-theme="dark"] .mini-stat-card > i {
            background: #2d323a !important;
            color: #ff8533 !important;
        }

        [data-bs-theme="dark"] .mini-stat-card span {
            color: #9aa1a9 !important;
        }

        [data-bs-theme="dark"] .mini-stat-card strong {
            color: #f1f3f5 !important;
        }

        [data-bs-theme="dark"] .dashboard-card-header {
            border-bottom-color: #383e46 !important;
        }

        [data-bs-theme="dark"] .dashboard-card-header h5 {
            color: #f1f3f5 !important;
        }

        [data-bs-theme="dark"] .dashboard-card-header span {
            color: #9aa1a9 !important;
        }

        [data-bs-theme="dark"] .dashboard-link {
            color: #ff8533 !important;
        }

        [data-bs-theme="dark"] .dashboard-link:hover {
            color: #ffa366 !important;
        }


        /* =====================================================
           DARK MODE - TABLE
        ====================================================== */

        [data-bs-theme="dark"] .dashboard-table-wrapper {
            background: #24282e !important;
        }

        [data-bs-theme="dark"] .dashboard-table {
            --bs-table-bg: #24282e !important;
            --bs-table-color: #dee2e6 !important;
            --bs-table-border-color: #383e46 !important;
            background: #24282e !important;
            color: #dee2e6 !important;
        }

        [data-bs-theme="dark"] .dashboard-table thead {
            background: #2d323a !important;
        }

        [data-bs-theme="dark"] .dashboard-table thead tr {
            background: #2d323a !important;
        }

        [data-bs-theme="dark"] .dashboard-table thead th {
            background: #2d323a !important;
            color: #adb5bd !important;
            border-color: #383e46 !important;
        }

        [data-bs-theme="dark"] .dashboard-table tbody {
            background: #24282e !important;
        }

        [data-bs-theme="dark"] .dashboard-table tbody tr {
            background: #24282e !important;
            color: #dee2e6 !important;
        }

        [data-bs-theme="dark"] .dashboard-table tbody td {
            background: #24282e !important;
            color: #dee2e6 !important;
            border-color: #383e46 !important;
        }

        [data-bs-theme="dark"] .dashboard-table tbody tr:hover,
        [data-bs-theme="dark"] .dashboard-table tbody tr:hover td {
            background: #2d323a !important;
            color: #f1f3f5 !important;
        }

        [data-bs-theme="dark"] .dashboard-table tbody td.text-center {
            color: #9aa1a9 !important;
        }

        [data-bs-theme="dark"] .request-name strong {
            color: #f1f3f5 !important;
        }

        [data-bs-theme="dark"] .request-name small {
            color: #8b949e !important;
        }

        [data-bs-theme="dark"] .request-icon {
            background: #2d2418 !important;
            color: #ff8533 !important;
        }


        /* =====================================================
           DARK MODE - STATUS
        ====================================================== */

        [data-bs-theme="dark"] .status-pending {
            background: #3d3417 !important;
            color: #ffc94d !important;
        }

        [data-bs-theme="dark"] .status-approved {
            background: #17331f !important;
            color: #4dd68a !important;
        }

        [data-bs-theme="dark"] .status-rejected {
            background: #3a1a1e !important;
            color: #f28b93 !important;
        }


        /* =====================================================
           DARK MODE - QUICK ACTIONS
        ====================================================== */

        [data-bs-theme="dark"] .quick-action {
            color: #dee2e6 !important;
            border-bottom-color: #2d323a !important;
        }

        [data-bs-theme="dark"] .quick-action:hover {
            background: #2d323a !important;
        }

        [data-bs-theme="dark"] .quick-action strong {
            color: #f1f3f5 !important;
        }

        [data-bs-theme="dark"] .quick-action small {
            color: #8b949e !important;
        }

        [data-bs-theme="dark"] .quick-action > i {
            color: #6c757d !important;
        }

        [data-bs-theme="dark"] .quick-orange {
            background: #2d2418 !important;
            color: #ff8533 !important;
        }

        [data-bs-theme="dark"] .quick-blue {
            background: #16233d !important;
            color: #6ea8fe !important;
        }

        [data-bs-theme="dark"] .quick-green {
            background: #17331f !important;
            color: #4dd68a !important;
        }

        [data-bs-theme="dark"] .quick-purple {
            background: #271f3d !important;
            color: #b794f6 !important;
        }

        [data-bs-theme="dark"] .quick-dark {
            background: #2d323a !important;
            color: #dee2e6 !important;
        }


        /* =====================================================
           DARK MODE - BUDGET
        ====================================================== */

        [data-bs-theme="dark"] .budget-header span {
            color: #dee2e6 !important;
        }

        [data-bs-theme="dark"] .budget-header strong {
            color: #ff8533 !important;
        }

        [data-bs-theme="dark"] .budget-item .progress {
            background: #2d323a !important;
        }

        [data-bs-theme="dark"] .budget-item .progress-bar {
            background: #ff6600 !important;
        }

        [data-bs-theme="dark"] .budget-footer {
            color: #8b949e !important;
        }

        [data-bs-theme="dark"] .budget-list .text-muted {
            color: #9aa1a9 !important;
        }


        /* =====================================================
           DARK MODE - ACTIVITY
        ====================================================== */

        [data-bs-theme="dark"] .activity-empty {
            color: #9aa1a9 !important;
        }

        [data-bs-theme="dark"] .activity-empty .btn-outline-secondary {
            color: #adb5bd !important;
            border-color: #495057 !important;
        }

        [data-bs-theme="dark"] .activity-empty .btn-outline-secondary:hover {
            background: #2d323a !important;
            color: #fff !important;
            border-color: #6c757d !important;
        }


        /* =====================================================
           DARK MODE - BOOTSTRAP TABLE
        ====================================================== */

        [data-bs-theme="dark"] .table {
            --bs-table-bg: #24282e !important;
            --bs-table-color: #dee2e6 !important;
            --bs-table-border-color: #383e46 !important;
            --bs-table-striped-bg: #2d323a !important;
            --bs-table-striped-color: #dee2e6 !important;
            --bs-table-hover-bg: #2d323a !important;
            --bs-table-hover-color: #f1f3f5 !important;
        }


        /* =====================================================
           DARK MODE - PAGINATION

           Ces règles couvrent Bootstrap pagination.
           Si une pagination existe dans le layout ou une
           future liste, elle restera visible en dark mode.
        ====================================================== */

        [data-bs-theme="dark"] .pagination {
            --bs-pagination-bg: #24282e;
            --bs-pagination-color: #dee2e6;
            --bs-pagination-border-color: #383e46;
            --bs-pagination-hover-bg: #2d323a;
            --bs-pagination-hover-color: #ffffff;
            --bs-pagination-hover-border-color: #4a515b;
            --bs-pagination-focus-bg: #2d323a;
            --bs-pagination-focus-color: #ffffff;
            --bs-pagination-active-bg: #ff6600;
            --bs-pagination-active-border-color: #ff6600;
            --bs-pagination-disabled-bg: #1f2226;
            --bs-pagination-disabled-color: #5c636b;
            --bs-pagination-disabled-border-color: #30353c;
        }

        [data-bs-theme="dark"] .pagination .page-link {
            background-color: #24282e !important;
            color: #dee2e6 !important;
            border-color: #383e46 !important;
            box-shadow: none !important;
        }

        [data-bs-theme="dark"] .pagination .page-link:hover {
            background-color: #2d323a !important;
            color: #ffffff !important;
            border-color: #4a515b !important;
        }

        [data-bs-theme="dark"] .pagination .page-item.active .page-link {
            background-color: #ff6600 !important;
            color: #ffffff !important;
            border-color: #ff6600 !important;
        }

        [data-bs-theme="dark"] .pagination .page-item.disabled .page-link {
            background-color: #1f2226 !important;
            color: #5c636b !important;
            border-color: #30353c !important;
        }


        /* =====================================================
           DARK MODE - DATATABLES
        ====================================================== */

        [data-bs-theme="dark"] .dataTables_wrapper {
            color: #dee2e6 !important;
        }

        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_info {
            color: #9aa1a9 !important;
        }

        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_length,
        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_filter {
            color: #adb5bd !important;
        }

        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_length select,
        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_filter input {
            background-color: #24282e !important;
            color: #dee2e6 !important;
            border-color: #383e46 !important;
        }

        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_filter input::placeholder {
            color: #6c757d !important;
        }

        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: #24282e !important;
            color: #dee2e6 !important;
            border: 1px solid #383e46 !important;
            box-shadow: none !important;
        }

        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #2d323a !important;
            color: #ffffff !important;
            border-color: #4a515b !important;
        }

        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #ff6600 !important;
            color: #ffffff !important;
            border-color: #ff6600 !important;
        }

        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            background: #1f2226 !important;
            color: #5c636b !important;
            border-color: #30353c !important;
        }


        /* =====================================================
           DARK MODE - LINKS
        ====================================================== */

        [data-bs-theme="dark"] .dashboard-table a {
            color: #ff8533 !important;
        }

        [data-bs-theme="dark"] .dashboard-table a:hover {
            color: #ffa366 !important;
        }


        /* =====================================================
           DARK MODE - MUTED TEXT
        ====================================================== */

        [data-bs-theme="dark"] .text-muted {
            color: #9aa1a9 !important;
        }


        /* =====================================================
           DARK MODE - FORM CONTROLS
        ====================================================== */

        [data-bs-theme="dark"] .form-control,
        [data-bs-theme="dark"] .form-select {
            background-color: #24282e !important;
            color: #dee2e6 !important;
            border-color: #383e46 !important;
        }

        [data-bs-theme="dark"] .form-control::placeholder {
            color: #6c757d !important;
        }

        [data-bs-theme="dark"] .form-control:focus,
        [data-bs-theme="dark"] .form-select:focus {
            background-color: #24282e !important;
            color: #fff !important;
            border-color: #ff6600 !important;
            box-shadow: 0 0 0 .2rem rgba(255,102,0,.15) !important;
        }


        /* =====================================================
           DARK MODE - SCROLLBAR TABLE
        ====================================================== */

        [data-bs-theme="dark"] .dashboard-table-wrapper::-webkit-scrollbar {
            height: 7px;
        }

        [data-bs-theme="dark"] .dashboard-table-wrapper::-webkit-scrollbar-track {
            background: #1a1d21;
        }

        [data-bs-theme="dark"] .dashboard-table-wrapper::-webkit-scrollbar-thumb {
            background: #383e46;
        }

        [data-bs-theme="dark"] .dashboard-table-wrapper::-webkit-scrollbar-thumb:hover {
            background: #ff6600;
        }

    </style>

@endsection

