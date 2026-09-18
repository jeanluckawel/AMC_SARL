@extends('layouts.admin')

@section('content')



    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-7">

                    <h3 class="mb-1">
{{--                        <i class="bi bi-grid-1x2 me-2"></i>--}}
                        HI, {{ Auth::user()->name }}
                    </h3>

                    <div class="text-muted">
                        Welcome to AMC SARL
                    </div>

                </div>

                <div class="col-md-5 text-md-end mt-3 mt-md-0">

                    <div class="dashboard-date">

                        <i class="bi bi-calendar3 me-2"></i>

                        Tuesday, September 8, 2026

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



            <div class="row g-3 mb-4">

                {{-- =====================================================
                    PENDING REQUESTS
                ====================================================== --}}

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


                {{-- =====================================================
                    APPROVED REQUESTS
                ====================================================== --}}

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


                {{-- =====================================================
                    EMPLOYEES
                ====================================================== --}}

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


                {{-- =====================================================
                    DEPARTMENT BUDGET
                ====================================================== --}}

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
                                ${{ number_format(
                        $budgets->sum('amount'),
                        0
                    ) }}
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

            </div>


            {{-- =====================================================
                SECONDARY STATISTICS
            ====================================================== --}}

            <div class="row g-3 mb-4">


                {{-- =================================================
                    DEPARTMENTS
                ================================================== --}}

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


                {{-- =================================================
                    USERS
                ================================================== --}}

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


                {{-- =================================================
                    ROLES
                ================================================== --}}

                <div class="col-xl-2 col-md-4 col-6">

                    <div class="mini-stat-card">

                        <i class="bi bi-shield-lock"></i>

                        <div>

                <span>
                    Roles
                </span>

                            <strong>
                                -
                            </strong>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    REJECTED
                ================================================== --}}

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


                {{-- =================================================
                    AUDIT LOGS
                ================================================== --}}

                <div class="col-xl-2 col-md-4 col-6">

                    <div class="mini-stat-card">

                        <i class="bi bi-journal-text"></i>

                        <div>

                <span>
                    Audit Logs
                </span>

                            <strong>
                                -
                            </strong>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    TODAY
                ================================================== --}}

                <div class="col-xl-2 col-md-4 col-6">

                    <div class="mini-stat-card">

                        <i class="bi bi-clock-history"></i>

                        <div>

                <span>
                    Today
                </span>

                            <strong>
                                {{ \App\Models\RequestModel::whereDate(
                                    'created_at',
                                    today()
                                )->count() }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                MAIN DASHBOARD ROW
            ================================================== --}}

            <div class="row g-4">


                {{-- =================================================
                    RECENT REQUESTS
                ================================================== --}}


                <div class="col-xl-8">

                    <div class="dashboard-card">

                        {{-- Header --}}
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


                        {{-- Table --}}
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

                                        {{-- Request --}}
                                        <td>

                                            <div class="request-name">

                                                <div class="request-icon">

                                                    @php
                                                        $icon = 'bi-cart3';

                                                        if (str_contains(strtolower($request->title), 'laptop')) {
                                                            $icon = 'bi-laptop';
                                                        } elseif (str_contains(strtolower($request->title), 'travel')) {
                                                            $icon = 'bi-car-front';
                                                        } elseif (str_contains(strtolower($request->title), 'maintenance')) {
                                                            $icon = 'bi-tools';
                                                        } elseif (str_contains(strtolower($request->title), 'stock')) {
                                                            $icon = 'bi-box-seam';
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


                                        {{-- Employee --}}
                                        <td>

                                            {{ $request->requester?->name ?? 'Unknown' }}

                                        </td>


                                        {{-- Department --}}
                                        <td>

                                            {{ $request->requester?->employee?->department?->name ?? 'N/A' }}

                                        </td>


                                        {{-- Amount --}}
                                        <td>

                                            ${{ number_format((float) $request->total_amount, 2) }}

                                        </td>


                                        {{-- Status --}}
                                        <td>

                                            @php
                                                $status = $request->status;

                                                $statusValue = $status instanceof \BackedEnum
                                                    ? $status->value
                                                    : (string) $status;

                                                $statusLabel = match ($statusValue) {
                                                    'pending_procurement',
                                                    'pending_finance',
                                                    'pending_ceo' => 'Pending',

                                                    'approved' => 'Approved',

                                                    'rejected' => 'Rejected',

                                                    default => ucfirst(
                                                        str_replace('_', ' ', $statusValue)
                                                    ),
                                                };

                                                $statusClass = match ($statusValue) {
                                                    'approved' => 'status-approved',

                                                    'rejected' => 'status-rejected',

                                                    default => 'status-pending',
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


                            {{-- =====================================================
                                 NEW REQUEST
                            ====================================================== --}}

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


                            {{-- =====================================================
                                 EMPLOYEES
                            ====================================================== --}}

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


                            {{-- =====================================================
                                 DEPARTMENT BUDGET
                            ====================================================== --}}

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


                            {{-- =====================================================
                                 ROLES & PERMISSIONS
                            ====================================================== --}}

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


                            {{-- =====================================================
                                 AUDIT LOGS
                            ====================================================== --}}

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


                        </div>

                    </div>

                </div>



            </div>



            {{-- =================================================
                BOTTOM ROW
            ================================================== --}}

            <div class="row g-4 mt-1">


                {{-- BUDGET OVERVIEW --}}


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

                            <a href="#" class="dashboard-link">
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





                {{-- RECENT ACTIVITY --}}

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

                            <a href="#" class="dashboard-link">
                                View logs
                            </a>

                        </div>


                        <div class="activity-list">


                            <div class="activity-item">

                                <div class="activity-icon activity-blue">
                                    <i class="bi bi-person-plus"></i>
                                </div>

                                <div class="activity-content">

                                    <strong>
                                        New employee added
                                    </strong>

                                    <span>
                                        Sarah Johnson was added to Finance
                                    </span>

                                    <small>
                                        10 minutes ago
                                    </small>

                                </div>

                            </div>


                            <div class="activity-item">

                                <div class="activity-icon activity-green">
                                    <i class="bi bi-check-circle"></i>
                                </div>

                                <div class="activity-content">

                                    <strong>
                                        Request approved
                                    </strong>

                                    <span>
                                        Request REQ-2026-00123 was approved
                                    </span>

                                    <small>
                                        25 minutes ago
                                    </small>

                                </div>

                            </div>


                            <div class="activity-item">

                                <div class="activity-icon activity-orange">
                                    <i class="bi bi-pencil"></i>
                                </div>

                                <div class="activity-content">

                                    <strong>
                                        Budget updated
                                    </strong>

                                    <span>
                                        Finance department budget was updated
                                    </span>

                                    <small>
                                        1 hour ago
                                    </small>

                                </div>

                            </div>


                            <div class="activity-item">

                                <div class="activity-icon activity-red">
                                    <i class="bi bi-x-circle"></i>
                                </div>

                                <div class="activity-content">

                                    <strong>
                                        Request rejected
                                    </strong>

                                    <span>
                                        Request REQ-2026-00122 was rejected
                                    </span>

                                    <small>
                                        2 hours ago
                                    </small>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

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
           WELCOME
        ====================================================== */

        .dashboard-welcome {
            background: #212529;
            color: #fff;

            padding: 25px 28px;

            border-radius: 0;

            box-shadow: 0 2px 8px rgba(0,0,0,.08);
        }


        .welcome-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }


        .welcome-icon {
            width: 54px;
            height: 54px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #FF6600;

            font-size: 24px;
        }


        .dashboard-welcome h4 {
            margin: 0 0 5px;
            font-weight: 600;
        }


        .dashboard-welcome p {
            color: rgba(255,255,255,.7);
            font-size: 14px;
        }


        .dashboard-main-btn {
            border-radius: 0;
            font-weight: 600;
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

            border-radius: 0;

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

            border-radius: 0;

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


        .activity-item {

            display: flex;

            gap: 12px;

            padding: 13px 0;

            border-bottom: 1px solid #f0f1f2;

        }


        .activity-item:last-child {
            border-bottom: none;
        }


        .activity-icon {

            width: 36px;
            height: 36px;

            min-width: 36px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 14px;

        }


        .activity-blue {
            background: #cfe2ff;
            color: #084298;
        }


        .activity-green {
            background: #d1e7dd;
            color: #146c43;
        }


        .activity-orange {
            background: #fff1e8;
            color: #FF6600;
        }


        .activity-red {
            background: #f8d7da;
            color: #b02a37;
        }


        .activity-content {
            min-width: 0;
        }


        .activity-content strong {

            display: block;

            font-size: 12px;

            font-weight: 600;

            color: #212529;

        }


        .activity-content span {

            display: block;

            margin-top: 2px;

            color: #6c757d;

            font-size: 11px;

        }


        .activity-content small {

            display: block;

            margin-top: 4px;

            color: #adb5bd;

            font-size: 10px;

        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 768px) {

            .dashboard-welcome {
                padding: 20px;
            }


            .welcome-content {
                align-items: flex-start;
            }


            .dashboard-main-btn {
                width: 100%;
            }


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

            .dashboard-welcome h4 {
                font-size: 17px;
            }


            .dashboard-welcome p {
                font-size: 12px;
            }


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

