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



        @php
            use App\Enums\RequestStatus;
        @endphp

        <main class="app-main">

            {{-- =========================================================
                HEADER
            ========================================================== --}}

            <div class="app-content-header">

                <div class="container-fluid">

                    <div class="row align-items-center">

                        <div class="col-md-7">

                            <div class="page-heading">

                                <div class="page-icon">
                                    <i class="bi bi-person-badge"></i>
                                </div>

                                <div>

                                    <h3 class="mb-1">
                                        Process Request
                                    </h3>

                                    <div class="text-muted small">
                                        Review and validate CEO request
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="col-md-5">

                            <ol class="breadcrumb float-md-end mb-0">

                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        Home
                                    </a>
                                </li>

                                <li class="breadcrumb-item">

                                    <a href="{{ route('ceo.pending') }}">
                                        CEO
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

                                        <i class="bi bi-person-badge me-2"></i>

                                        Process Request

                                    </h4>

                                    <div class="text-muted small">
                                        Review and validate CEO request
                                    </div>

                                </div>


                                <div>

                                <span class="badge bg-purple">

                                    <i class="bi bi-hourglass-split me-1"></i>

                                    Pending CEO

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
                                        TOTAL AMOUNT
                                    ================================================== --}}

                                    <tr>

                                        <td>
                                            Total Amount
                                        </td>

                                        <td>

                                            <strong class="text-success fs-5">

                                                ${{ number_format(
                                                (float) ($requestModel->total_amount ?? 0),
                                                2,
                                                '.',
                                                ','
                                            ) }}

                                            </strong>

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
                                        ATTACHMENTS
                                    ================================================== --}}

                                    @if($requestModel->attachments?->count())

                                        <tr>

                                            <td>
                                                Attachments
                                            </td>

                                            <td>

                                                <div class="d-flex flex-wrap gap-2">

                                                    @foreach($requestModel->attachments as $attachment)

                                                        <a
                                                            href="{{ $attachment->url ?? '#' }}"
                                                            target="_blank"
                                                            class="btn btn-sm btn-light border"
                                                        >

                                                            <i class="bi bi-paperclip me-1"></i>

                                                            {{ $attachment->name ?? 'Attachment' }}

                                                        </a>

                                                    @endforeach

                                                </div>

                                            </td>

                                        </tr>

                                    @endif


                                    {{-- =================================================
                                        STATUS
                                    ================================================== --}}

                                    <tr>

                                        <td>
                                            Status
                                        </td>

                                        <td>

                                        <span class="badge bg-purple">

                                            <i class="bi bi-hourglass-split me-1"></i>

                                            {{ $requestModel->status?->label()
                                                ?? $requestModel->status?->value
                                                ?? 'Pending CEO'
                                            }}

                                        </span>

                                        </td>

                                    </tr>


                                    {{-- =================================================
                                        CEO VALIDATION
                                    ================================================== --}}

                                    <tr>

                                        <td>
                                            Validation
                                        </td>

                                        <td>

                                            <div class="alert alert-info mb-0 py-2">

                                                <i class="bi bi-person-check me-1"></i>

                                                <strong>
                                                    CEO Review
                                                </strong>

                                                <span class="ms-2">
                                                This request is waiting for the CEO's decision.
                                            </span>

                                            </div>

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
                                    href="{{ route('ceo.pending') }}"
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


                                    {{-- APPROVE --}}

                                    <form
                                        action="{{ route(
                                        'ceo.requests.approve',
                                        $requestModel
                                    ) }}"
                                        method="POST"
                                        id="ceoForm"
                                        class="d-inline"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-success btn-square"
                                            id="approveButton"
                                        >

                                            <i class="bi bi-check-lg me-1"></i>

                                            Approve

                                        </button>

                                    </form>

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
                                'ceo.requests.reject',
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


            {{-- =========================================================
                CSS
            ========================================================== --}}

            <style>

                .department-card {
                    border-radius: 0 !important;
                }

                .page-heading {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                }

                .page-icon {
                    width: 42px;
                    height: 42px;

                    display: flex;
                    align-items: center;
                    justify-content: center;

                    background: #6f42c1;
                    color: #fff;

                    font-size: 19px;

                    border-radius: 0 !important;
                }

                .bg-purple {
                    background-color: #6f42c1 !important;
                    color: #fff !important;
                }

                .department-table-wrapper {
                    width: 100%;
                    overflow: visible;
                }

                .department-table-wrapper > table {
                    width: 100%;
                    table-layout: fixed;
                }

                .department-table-wrapper > table th,
                .department-table-wrapper > table td {
                    vertical-align: middle;
                }

                .department-table-wrapper > table > thead > tr > th:first-child,
                .department-table-wrapper > table > tbody > tr > td:first-child {
                    width: 150px;
                }

                .department-table-wrapper > table > tbody > tr > td {
                    word-break: break-word;
                }

                .department-table-wrapper table table {
                    width: 100%;
                    table-layout: fixed;
                }

                .department-table-wrapper table table th,
                .department-table-wrapper table table td {
                    padding: 8px;
                    font-size: 13px;
                }

                .department-table-wrapper table table th:nth-child(1),
                .department-table-wrapper table table td:nth-child(1) {
                    width: 35%;
                }

                .department-table-wrapper table table th:nth-child(2),
                .department-table-wrapper table table td:nth-child(2) {
                    width: 10%;
                }

                .department-table-wrapper table table th:nth-child(3),
                .department-table-wrapper table table td:nth-child(3) {
                    width: 12%;
                }

                .department-table-wrapper table table th:nth-child(4),
                .department-table-wrapper table table td:nth-child(4) {
                    width: 21%;
                }

                .department-table-wrapper table table th:nth-child(5),
                .department-table-wrapper table table td:nth-child(5) {
                    width: 22%;
                }

                .department-avatar {
                    width: 40px;
                    height: 40px;
                    min-width: 40px;

                    display: flex;
                    align-items: center;
                    justify-content: center;

                    background: #f1f3f5;
                    color: #6c757d;

                    border: 1px solid #dee2e6;

                    border-radius: 0 !important;
                }

                .btn-square {
                    border-radius: 0 !important;
                }

                .reject-request-summary {
                    padding: 12px;

                    background: #f8f9fa;

                    border: 1px solid #dee2e6;
                }

                .modal-content {
                    border-radius: 0 !important;
                }

                .modal textarea {
                    resize: vertical;
                }


                /* =========================
                   MOBILE
                ========================== */

                @media (max-width: 767.98px) {

                    .page-heading {
                        margin-bottom: 10px;
                    }

                    .app-content-header .breadcrumb {
                        float: none !important;
                        margin-top: 8px !important;
                    }

                    .department-table-wrapper > table > thead > tr > th:first-child,
                    .department-table-wrapper > table > tbody > tr > td:first-child {
                        width: 105px;
                    }

                    .department-table-wrapper table table th,
                    .department-table-wrapper table table td {
                        font-size: 11px;
                        padding: 6px 4px;
                    }

                    .d-flex.justify-content-between.align-items-center.mt-3 {
                        flex-direction: column;
                        align-items: stretch !important;
                        gap: 10px;
                    }

                    .d-flex.justify-content-between.align-items-center.mt-3 > a {
                        width: 100%;
                    }

                    .d-flex.justify-content-between.align-items-center.mt-3 > div {
                        width: 100%;
                    }

                    .d-flex.justify-content-between.align-items-center.mt-3 > div form,
                    .d-flex.justify-content-between.align-items-center.mt-3 > div button {
                        width: 100%;
                    }

                }

            </style>

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





