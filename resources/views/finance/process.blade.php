





<!doctype html>
<html lang="en">
<!--begin::Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | Sidebar Mini</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE 4 | Sidebar Mini" />
    <meta name="author" content="ColorlibHQ" />
    <meta
        name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance."
    />
    <meta
        name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant"
    />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('css/adminlte.css')}}" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous"
        media="print"
        onload="this.media = 'all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary">
<!--begin::App Wrapper-->
<div class="app-wrapper">

    @include('components.navbar')

    @include('components.sidebar')
    <!--begin::App Main-->


    <main class="app-main">

        {{-- HEADER --}}
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">

                    <div class="col-md-7">
                        <div class="page-heading">
                            <div class="page-icon">
                                <i class="bi bi-cash-stack"></i>
                            </div>

                            <div>
                                <h3 class="mb-1">Process Request</h3>
                                <div class="text-muted small">
                                    Review and validate finance details
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <ol class="breadcrumb float-md-end mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Home</a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{ route('finance.pending') }}">
                                    Finance
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                Process Request
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>


        {{-- =========================================================
            PAGE CONTENT
        ========================================================== --}}

        <div class="app-content">

            <div class="container-fluid">

                {{-- =================================================
                    CARD
                ================================================== --}}

                <div class="card shadow-sm department-card">

                    <div class="card-body">

                        {{-- =================================================
                            REQUEST HEADER
                        ================================================== --}}

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div>

                                <h4 class="mb-1">
                                    <i class="bi bi-cash-stack me-2"></i>
                                    Process Request
                                </h4>

                                <div class="text-muted small">
                                    Review and validate finance details
                                </div>

                            </div>


                            <div>

                        <span class="badge bg-warning text-dark">

                            <i class="bi bi-hourglass-split me-1"></i>

                            Pending Finance

                        </span>

                            </div>

                        </div>


                        {{-- =================================================
                            DATA
                        ================================================== --}}

                        @php

                            $requester = $requestModel->requester;

                            $employee = $requester?->employee;

                            $department = $employee?->department;


                            $departmentBudget = $department?->budgets
                                ?->filter(fn ($budget) =>
                                    $budget->end_date &&
                                    !$budget->end_date->isPast()
                                )
                                ->sortBy('end_date')
                                ->first();


                            $requestedAmount =
                                (float) $requestModel->total_amount;


                            $budgetAmount =
                                (float) ($departmentBudget?->amount ?? 0);


                            $usedAmount =
                                (float) ($departmentBudget?->used_amount ?? 0);


                            $availableAmount = max(
                                0,
                                $budgetAmount - $usedAmount
                            );


                            $remainingAfterApproval =
                                $availableAmount - $requestedAmount;


                            $canApprove =
                                $departmentBudget &&
                                $requestedAmount <= $availableAmount;

                        @endphp


                        {{-- =================================================
                            TABLE
                        ================================================== --}}

                        <div class="department-table-wrapper">

                            <table
                                class="table table-bordered table-hover align-middle"
                            >

                                <thead>

                                <tr>

                                    <th style="width: 150px;">
                                        #
                                    </th>

                                    <th>
                                        Details
                                    </th>

                                </tr>

                                </thead>


                                <tbody>


                                {{-- =================================================
                                    REFERENCE
                                ================================================== --}}

                                <tr>

                                    <td class="font-weight-semibold">
                                        Reference
                                    </td>

                                    <td>

                                        <strong>
                                            {{ $requestModel->reference ?? '-' }}
                                        </strong>

                                        <div class="text-muted small">
                                            {{ $requestModel->title ?? '-' }}
                                        </div>

                                    </td>

                                </tr>


                                {{-- =================================================
                                    REQUESTER
                                ================================================== --}}

                                <tr>

                                    <td>
                                        Requester
                                    </td>

                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div class="department-avatar me-2">

                                                <i class="bi bi-person-fill"></i>

                                            </div>


                                            <div>

                                                <div class="fw-semibold">

                                                    {{
                                                        trim(
                                                            ($employee?->first_name ?? '') . ' ' .
                                                            ($employee?->middle_name ?? '') . ' ' .
                                                            ($employee?->last_name ?? '')
                                                        ) ?: ($requester?->name ?? 'Unknown')
                                                    }}

                                                </div>


                                                <div class="text-muted small">

                                                    ID:
                                                    {{ $employee?->employee_id ?? '-' }}

                                                    @if($department?->name)

                                                        <span class="mx-1">
                                                    ·
                                                </span>

                                                        {{ $department->name }}

                                                    @endif


                                                    @if($employee?->jobTitle?->name)

                                                        <span class="mx-1">
                                                    ·
                                                </span>

                                                        {{ $employee->jobTitle->name }}

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                    </td>

                                </tr>


                                {{-- =================================================
                                    BUDGET
                                ================================================== --}}

                                <tr>

                                    <td>
                                        Budget
                                    </td>

                                    <td>

                                        @if($departmentBudget)

                                            <div class="row g-2">


                                                <div class="col-lg-2 col-md-4 col-6">

                                                    <div class="finance-box">

                                                        <small>
                                                            Department Budget
                                                        </small>

                                                        <strong>
                                                            ${{ number_format(
                                                        $budgetAmount,
                                                        2,
                                                        '.',
                                                        ','
                                                    ) }}
                                                        </strong>

                                                    </div>

                                                </div>


                                                <div class="col-lg-2 col-md-4 col-6">

                                                    <div class="finance-box">

                                                        <small>
                                                            Used
                                                        </small>

                                                        <strong>
                                                            ${{ number_format(
                                                        $usedAmount,
                                                        2,
                                                        '.',
                                                        ','
                                                    ) }}
                                                        </strong>

                                                    </div>

                                                </div>


                                                <div class="col-lg-2 col-md-4 col-6">

                                                    <div class="finance-box">

                                                        <small>
                                                            Remaining
                                                        </small>

                                                        <strong class="text-success">
                                                            ${{ number_format(
                                                        $availableAmount,
                                                        2,
                                                        '.',
                                                        ','
                                                    ) }}
                                                        </strong>

                                                    </div>

                                                </div>


                                                <div class="col-lg-2 col-md-4 col-6">

                                                    <div class="finance-box">

                                                        <small>
                                                            Request
                                                        </small>

                                                        <strong>
                                                            ${{ number_format(
                                                        $requestedAmount,
                                                        2,
                                                        '.',
                                                        ','
                                                    ) }}
                                                        </strong>

                                                    </div>

                                                </div>


                                                <div class="col-lg-2 col-md-4 col-6">

                                                    <div class="finance-box">

                                                        <small>
                                                            After Validation
                                                        </small>

                                                        <strong
                                                            class="{{ $remainingAfterApproval < 0
                                                        ? 'text-danger'
                                                        : 'text-success' }}"
                                                        >
                                                            ${{ number_format(
                                                        max(
                                                            0,
                                                            $remainingAfterApproval
                                                        ),
                                                        2,
                                                        '.',
                                                        ','
                                                    ) }}
                                                        </strong>

                                                    </div>

                                                </div>


                                                <div class="col-lg-2 col-md-4 col-6">

                                                    <div class="finance-box">

                                                        <small>
                                                            Expiration
                                                        </small>

                                                        <strong>

                                                            {{ $departmentBudget->end_date
                                                                ->format('d/m/Y') }}

                                                        </strong>

                                                    </div>

                                                </div>

                                            </div>

                                        @else

                                            <div class="alert alert-danger mb-0">

                                                <i class="bi bi-x-circle me-1"></i>

                                                <strong>
                                                    No active department budget found.
                                                </strong>

                                                This request cannot be validated until
                                                an active budget is available.

                                            </div>

                                        @endif

                                    </td>

                                </tr>


                                {{-- =================================================
                                    ITEMS
                                ================================================== --}}

                                <tr>

                                    <td>
                                        Items
                                    </td>

                                    <td class="p-0">

                                        <table
                                            class="table table-sm table-bordered mb-0"
                                        >

                                            <thead>

                                            <tr>

                                                <th>
                                                    Item
                                                </th>

                                                <th class="text-center">
                                                    Qty
                                                </th>

                                                <th class="text-center">
                                                    Unit
                                                </th>

                                                <th class="text-end">
                                                    Unit Price
                                                </th>

                                                <th class="text-end">
                                                    Total
                                                </th>

                                            </tr>

                                            </thead>


                                            <tbody>

                                            @forelse($requestModel->items as $item)

                                                @php

                                                    $quantity =
                                                        (float) $item->quantity;

                                                    $unitPrice =
                                                        (float) $item->unit_price;

                                                    $itemTotal =
                                                        $quantity * $unitPrice;

                                                @endphp


                                                <tr>

                                                    <td>

                                                        <strong>
                                                            {{ $item->name }}
                                                        </strong>


                                                        @if($item->description)

                                                            <small class="d-block text-muted">
                                                                {{ $item->description }}
                                                            </small>

                                                        @endif

                                                    </td>


                                                    <td class="text-center">

                                                        {{ rtrim(
                                                            rtrim(
                                                                number_format(
                                                                    $quantity,
                                                                    2,
                                                                    '.',
                                                                    ''
                                                                ),
                                                                '0'
                                                            ),
                                                            '.'
                                                        ) }}

                                                    </td>


                                                    <td class="text-center">

                                                        @if($item->unit)

                                                            <span class="badge bg-light text-dark border">
                                                        {{ $item->unit }}
                                                    </span>

                                                        @else

                                                            -

                                                        @endif

                                                    </td>


                                                    <td class="text-end">

                                                        ${{ number_format(
                                                    $unitPrice,
                                                    2,
                                                    '.',
                                                    ','
                                                ) }}

                                                    </td>


                                                    <td class="text-end">

                                                        <strong>

                                                            ${{ number_format(
                                                        $itemTotal,
                                                        2,
                                                        '.',
                                                        ','
                                                    ) }}

                                                        </strong>

                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>

                                                    <td
                                                        colspan="5"
                                                        class="text-center text-muted py-3"
                                                    >

                                                        <i class="bi bi-info-circle me-1"></i>

                                                        No items found.

                                                    </td>

                                                </tr>

                                            @endforelse

                                            </tbody>

                                        </table>

                                    </td>

                                </tr>


                                {{-- =================================================
                                    DESCRIPTION
                                ================================================== --}}

                                @if($requestModel->description)

                                    <tr>

                                        <td>
                                            Description
                                        </td>

                                        <td>

                                            <div class="text-muted">

                                                {{ $requestModel->description }}

                                            </div>

                                        </td>

                                    </tr>

                                @endif


                                {{-- =================================================
                                    VALIDATION
                                ================================================== --}}

                                <tr>

                                    <td>
                                        Validation
                                    </td>

                                    <td>

                                        @if($canApprove)

                                            <div class="alert alert-success mb-0 py-2">

                                                <i class="bi bi-check-circle me-1"></i>

                                                <strong>
                                                    Budget sufficient
                                                </strong>

                                                <span class="ms-2">
                                            The request can be validated.
                                        </span>

                                            </div>

                                        @elseif($departmentBudget)

                                            <div class="alert alert-danger mb-0 py-2">

                                                <i class="bi bi-x-circle me-1"></i>

                                                <strong>
                                                    Insufficient budget
                                                </strong>

                                                <span class="ms-2">
                                            The request amount is greater than
                                            the available department budget.
                                        </span>

                                            </div>

                                        @else

                                            <div class="alert alert-danger mb-0 py-2">

                                                <i class="bi bi-x-circle me-1"></i>

                                                <strong>
                                                    Cannot validate
                                                </strong>

                                                <span class="ms-2">
                                            No active department budget is available.
                                        </span>

                                            </div>

                                        @endif

                                    </td>

                                </tr>


                                </tbody>

                            </table>

                        </div>


                        {{-- =================================================
                            ACTIONS
                        ================================================== --}}

                        <div class="d-flex justify-content-between align-items-center mt-3">

                            {{-- CANCEL --}}

                            <a
                                href="{{ route('finance.pending') }}"
                                class="btn btn-secondary btn-square"
                            >

                                <i class="bi bi-arrow-left me-1"></i>

                                Cancel

                            </a>


                            <div class="d-flex align-items-center gap-2">


                                {{-- REJECT --}}

                                <button
                                    type="button"
                                    class="btn btn-danger btn-square"
                                    data-bs-toggle="modal"
                                    data-bs-target="#rejectModal"
                                >

                                    <i class="bi bi-x-lg me-1"></i>

                                    Reject

                                </button>


                                {{-- VALIDATE --}}

                                @if($canApprove)

                                    <form
                                        action="{{ route(
                                    'finance.requests.approve',
                                    $requestModel
                                ) }}"
                                        method="POST"
                                        id="financeForm"
                                        class="d-inline"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-success btn-square"
                                            id="approveButton"
                                        >

                                            <i class="bi bi-check-lg me-1"></i>

                                            Validate

                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                REJECT MODAL
            ========================================================== --}}

            <div
                class="modal fade"
                id="rejectModal"
                tabindex="-1"
                aria-labelledby="rejectModalLabel"
                aria-hidden="true"
            >

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <form
                            action="{{ route(
                    'finance.requests.reject',
                    $requestModel
                ) }}"
                            method="POST"
                            id="rejectForm"
                        >

                            @csrf


                            <div class="modal-header">

                                <div>

                                    <h5
                                        class="modal-title"
                                        id="rejectModalLabel"
                                    >

                                        <i class="bi bi-x-circle text-danger me-2"></i>

                                        Reject Request

                                    </h5>

                                    <small class="text-muted">
                                        This action cannot be undone.
                                    </small>

                                </div>


                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>

                            </div>


                            <div class="modal-body">

                                <div class="reject-request-summary mb-3">

                                    <strong>
                                        {{ $requestModel->reference }}
                                    </strong>

                                    <div class="text-muted small">
                                        {{ $requestModel->title }}
                                    </div>

                                </div>


                                <div class="mb-3">

                                    <label
                                        for="reject-comment"
                                        class="form-label"
                                    >

                                        Reason

                                        <span class="text-danger">
                                *
                            </span>

                                    </label>


                                    <textarea
                                        name="comment"
                                        id="reject-comment"
                                        class="form-control"
                                        rows="5"
                                        maxlength="2000"
                                        placeholder="Enter the reason for rejection..."
                                        required
                                    >{{ old('comment') }}</textarea>

                                </div>

                            </div>


                            <div class="modal-footer">

                                <button
                                    type="button"
                                    class="btn btn-secondary btn-square"
                                    data-bs-dismiss="modal"
                                >

                                    <i class="bi bi-x-lg me-1"></i>

                                    Cancel

                                </button>


                                <button
                                    type="submit"
                                    class="btn btn-danger btn-square"
                                    id="confirmRejectButton"
                                >

                                    <i class="bi bi-x-lg me-1"></i>

                                    Reject Request

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </main>





    <!--end::App Main-->
    <!--begin::Footer-->
    @include('components.footer')
    <!--end::Footer-->
</div>
<!--end::App Wrapper-->
<!--begin::Script-->
<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script
    src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"
></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    crossorigin="anonymous"
></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
    crossorigin="anonymous"
></script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="../js/adminlte.js"></script>
<!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->

<!--end::OverlayScrollbars Configure--><!--begin::Color Mode Toggle (#6010)-->
<script>
    (() => {
        'use strict';

        const STORAGE_KEY = 'lte-theme';

        const getStoredTheme = () => localStorage.getItem(STORAGE_KEY);
        const setStoredTheme = (theme) => localStorage.setItem(STORAGE_KEY, theme);

        const prefersDark = () => globalThis.matchMedia('(prefers-color-scheme: dark)').matches;

        const getPreferredTheme = () => {
            const stored = getStoredTheme();
            if (stored) return stored;
            return prefersDark() ? 'dark' : 'light';
        };

        const setTheme = (theme) => {
            const resolved = theme === 'auto' ? (prefersDark() ? 'dark' : 'light') : theme;
            document.documentElement.setAttribute('data-bs-theme', resolved);
        };

        setTheme(getPreferredTheme());

        const showActiveTheme = (theme) => {
            // Highlight the active dropdown option
            document.querySelectorAll('[data-bs-theme-value]').forEach((el) => {
                el.classList.remove('active');
                el.setAttribute('aria-pressed', 'false');
                const check = el.querySelector('.bi-check-lg');
                if (check) check.classList.add('d-none');
            });
            const active = document.querySelector(`[data-bs-theme-value="${theme}"]`);
            if (active) {
                active.classList.add('active');
                active.setAttribute('aria-pressed', 'true');
                const check = active.querySelector('.bi-check-lg');
                if (check) check.classList.remove('d-none');
            }
            // Sync the topbar trigger icon
            document.querySelectorAll('[data-lte-theme-icon]').forEach((icon) => {
                icon.classList.toggle('d-none', icon.dataset.lteThemeIcon !== theme);
            });
        };

        globalThis.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            const stored = getStoredTheme();
            if (!stored || stored === 'auto') setTheme(getPreferredTheme());
        });

        document.addEventListener('DOMContentLoaded', () => {
            showActiveTheme(getPreferredTheme());
            document.querySelectorAll('[data-bs-theme-value]').forEach((toggle) => {
                toggle.addEventListener('click', () => {
                    const theme = toggle.getAttribute('data-bs-theme-value');
                    setStoredTheme(theme);
                    setTheme(theme);
                    showActiveTheme(theme);
                });
            });
        });
    })();
</script>
<!--end::Color Mode Toggle-->
<!--end::Script-->
</body>
<!--end::Body-->
</html>





