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

            {{-- =========================================================
                 HEADER
            ========================================================== --}}

            <div class="app-content-header">

                <div class="container-fluid">

                    <div class="row align-items-center">

                        <div class="col-md-7 col-12">

                            <div class="page-heading">

                                <div class="page-icon">
                                    <i class="bi bi-clipboard-check"></i>
                                </div>

                                <div>

                                    <h3 class="mb-1">
                                        Process Request
                                    </h3>

                                    <div class="text-muted small">
                                        Review and validate procurement details
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="col-md-5 col-12">

                            <ol class="breadcrumb float-md-end mb-0">

                                <li class="breadcrumb-item">

                                    <a href="{{ url('/') }}">
                                        Home
                                    </a>

                                </li>

                                <li class="breadcrumb-item">

                                    <a href="{{ route('procurement.pending') }}">
                                        Procurement
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
                 CONTENT
            ========================================================== --}}

            <div class="app-content">

                <div class="container-fluid">


                    {{-- =================================================
                         VALIDATION ERRORS
                    ================================================== --}}

                    @if($errors->any())

                        <div class="alert alert-danger alert-dismissible fade show">

                            <div class="fw-semibold mb-1">

                                <i class="bi bi-exclamation-triangle me-1"></i>

                                Please correct the following errors:

                            </div>

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                            ></button>

                        </div>

                    @endif


                    {{-- =================================================
                         REQUEST INFORMATION
                    ================================================== --}}

                    <div class="card shadow-sm request-card mb-3">

                        <div class="card-body">

                            <div class="row align-items-center">


                                {{-- REFERENCE --}}

                                <div class="col-lg-3 col-md-6 col-12 mb-3 mb-lg-0">

                                    <div class="info-label">
                                        Reference
                                    </div>

                                    <div class="reference-box">

                                    <span class="reference-icon">
                                        <i class="bi bi-hash"></i>
                                    </span>

                                        <span class="fw-semibold">
                                        {{ $requestModel->reference ?? '-' }}
                                    </span>

                                    </div>

                                </div>


                                {{-- TITLE --}}

                                <div class="col-lg-4 col-md-6 col-12 mb-3 mb-lg-0">

                                    <div class="info-label">
                                        Request
                                    </div>

                                    <div class="fw-semibold request-title">

                                        {{ $requestModel->title ?? '-' }}

                                    </div>

                                </div>


                                {{-- REQUESTER --}}

                                <div class="col-lg-3 col-md-6 col-12 mb-3 mb-md-0">

                                    <div class="info-label">
                                        Requester
                                    </div>

                                    <div class="d-flex align-items-center">

                                        <div class="request-avatar me-2">

                                            <i class="bi bi-person-fill"></i>

                                        </div>

                                        <div>

                                            <div class="fw-semibold">
                                                {{ $requestModel->requester?->name ?? 'Unknown' }}
                                            </div>

                                            <div class="small text-muted">
                                                Requester
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                {{-- STATUS --}}

                                <div class="col-lg-2 col-md-6 col-12">

                                    <div class="info-label">
                                        Status
                                    </div>

                                    <span class="badge status-badge status-procurement">

                                    <i class="bi bi-hourglass-split me-1"></i>

                                    Pending Procurement

                                </span>

                                </div>

                            </div>


                            {{-- DESCRIPTION --}}

                            @if($requestModel->description)

                                <div class="request-description-box mt-3">

                                    <div class="info-label mb-1">
                                        Description
                                    </div>

                                    <div class="description-text">
                                        {{ $requestModel->description }}
                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                         PROCUREMENT FORM
                    ================================================== --}}

                    <form
                        action="{{ route(
                        'procurement.requests.approve',
                        $requestModel
                    ) }}"
                        method="POST"
                        id="procurementForm"
                    >

                        @csrf


                        <div class="card shadow-sm request-card">

                            {{-- CARD HEADER --}}


                            <div class="card-body">


                                {{-- =================================================
                                     PROCUREMENT TABLE
                                ================================================== --}}

                                <div class="request-table-wrapper">

                                    <table
                                        id="procurementItemsTable"
                                        class="table table-bordered table-hover align-middle"
                                    >

                                        <thead>

                                        <tr>

                                            <th class="col-number">
                                                #
                                            </th>

                                            <th class="col-item">
                                                Item
                                            </th>

                                            <th class="col-quantity">
                                                Quantity
                                            </th>

                                            <th class="col-unit">
                                                Unit
                                            </th>

                                            <th class="col-price">
                                                Unit Price
                                            </th>

                                            <th class="col-supplier">
                                                Supplier
                                            </th>

                                        </tr>

                                        </thead>


                                        <tbody>

                                        @forelse(
                                            $requestModel->items
                                            as $item
                                        )

                                            <tr>


                                                {{-- NUMBER --}}

                                                <td class="text-center">

                                                <span class="item-number">
                                                    {{ $loop->iteration }}
                                                </span>

                                                </td>


                                                {{-- ITEM --}}

                                                <td>

                                                    <div class="item-name">

                                                        {{ $item->name }}

                                                    </div>

                                                    @if($item->description)

                                                        <div class="item-description">

                                                            {{ $item->description }}

                                                        </div>

                                                    @endif

                                                </td>


                                                {{-- QUANTITY --}}

                                                <td class="text-center">

                                                <span class="quantity-value">

                                                    {{ rtrim(
                                                        rtrim(
                                                            number_format(
                                                                $item->quantity,
                                                                2,
                                                                '.',
                                                                ''
                                                            ),
                                                            '0'
                                                        ),
                                                        '.'
                                                    ) }}

                                                </span>

                                                </td>


                                                {{-- UNIT --}}

                                                <td class="text-center">

                                                    @if($item->unit)

                                                        <span class="unit-badge">
                                                        {{ $item->unit }}
                                                    </span>

                                                    @else

                                                        <span class="text-muted">
                                                        -
                                                    </span>

                                                    @endif

                                                </td>


                                                {{-- UNIT PRICE --}}

                                                <td>

                                                    <div class="input-group input-group-sm price-input-group">

                                                        <input
                                                            type="number"
                                                            name="items[{{ $item->id }}][unit_price]"
                                                            class="form-control unit-price"
                                                            data-item-id="{{ $item->id }}"
                                                            data-quantity="{{ $item->quantity }}"
                                                            value="{{ old(
                                                            "items.{$item->id}.unit_price",
                                                            $item->unit_price
                                                        ) }}"
                                                            min="0"
                                                            step="0.01"
                                                            placeholder="0.00"
                                                            required
                                                        >

                                                    </div>

                                                </td>


                                                {{-- SUPPLIER --}}

                                                <td>

                                                    <input
                                                        type="text"
                                                        name="items[{{ $item->id }}][supplier]"
                                                        class="form-control form-control-sm"
                                                        value="{{ old(
                                                        "items.{$item->id}.supplier",
                                                        $item->supplier
                                                    ) }}"
                                                        maxlength="255"
                                                        placeholder="Enter supplier"
                                                        required
                                                    >

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>

                                                <td
                                                    colspan="6"
                                                    class="text-center py-5 text-muted"
                                                >

                                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                                                    No items found.

                                                </td>

                                            </tr>

                                        @endforelse

                                        </tbody>

                                    </table>

                                </div>


                                {{-- =================================================
                                     INFORMATION NOTE
                                ================================================== --}}




                                {{-- =================================================
                                     ACTIONS
                                ================================================== --}}

                                <div class="process-footer mt-4">

                                    {{-- BACK --}}

                                    <a
                                        href="{{ route('procurement.pending') }}"
                                        class="btn btn-secondary process-action-btn"
                                    >

                                        <i class="bi bi-arrow-left me-1"></i>

                                        Back

                                    </a>


                                    <div class="request-actions">


                                        {{-- REJECT --}}

                                        <button
                                            type="button"
                                            class="btn btn-danger process-action-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#rejectModal"
                                        >

                                            <i class="bi bi-x-lg me-1"></i>

                                            Reject

                                        </button>


                                        {{-- APPROVE --}}

                                        <button
                                            type="submit"
                                            class="btn btn-success process-action-btn"
                                            id="approveButton"
                                        >

                                            <i class="bi bi-check-lg me-1"></i>

                                            Approve

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>


            {{-- =========================================================
                 REJECT MODAL
            ========================================================== --}}

            <div
                class="modal fade"
                id="rejectModal"
                tabindex="-1"
                aria-hidden="true"
            >

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">


                        <form
                            action="{{ route(
                            'procurement.requests.reject',
                            $requestModel
                        ) }}"
                            method="POST"
                        >

                            @csrf


                            <div class="modal-header">

                                <div>

                                    <h5 class="modal-title mb-1">

                                        <i class="bi bi-x-circle text-danger me-2"></i>

                                        Reject Request

                                    </h5>

                                    <div class="small text-muted">
                                        This action cannot be undone.
                                    </div>

                                </div>


                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                ></button>

                            </div>


                            <div class="modal-body">


                                <div class="reject-request-summary mb-3">

                                    <div class="fw-semibold">
                                        {{ $requestModel->reference }}
                                    </div>

                                    <div class="text-muted small">
                                        {{ $requestModel->title }}
                                    </div>

                                </div>


                                <div>

                                    <label
                                        for="reject-comment"
                                        class="form-label fw-semibold"
                                    >

                                        Rejection Comment

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


                                    <div class="form-text">
                                        The rejection comment is required.
                                    </div>

                                </div>

                            </div>


                            <div class="modal-footer">

                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >

                                    Cancel

                                </button>


                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                >

                                    <i class="bi bi-x-lg me-1"></i>

                                    Reject Request

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                 STYLE
            ========================================================== --}}

            <style>

                /* =========================================================
                   GENERAL
                ========================================================== */

                .request-card {
                    border-radius: 0 !important;
                    border: 1px solid #dee2e6;
                    overflow: hidden;
                }


                /* =========================================================
                   PAGE HEADER
                ========================================================== */

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

                    background: #f8f9fa;
                    border: 1px solid #dee2e6;

                    color: #495057;
                    font-size: 20px;
                }


                .app-content-header h3 {
                    font-weight: 600;
                }


                .breadcrumb {
                    font-size: 14px;
                }


                .breadcrumb a {
                    text-decoration: none;
                }


                /* =========================================================
                   REQUEST INFORMATION
                ========================================================== */

                .info-label {
                    font-size: 12px;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: .04em;
                    color: #6c757d;
                    margin-bottom: 5px;
                }


                .reference-box {
                    display: flex;
                    align-items: center;
                    gap: 7px;
                }


                .reference-icon {
                    width: 27px;
                    height: 27px;

                    display: inline-flex;
                    align-items: center;
                    justify-content: center;

                    background: #f8f9fa;
                    border: 1px solid #dee2e6;

                    color: #6c757d;
                }


                .request-reference {
                    white-space: nowrap;
                }


                .request-title {
                    line-height: 1.4;
                }


                .request-avatar {
                    width: 38px;
                    height: 38px;
                    min-width: 38px;

                    display: flex;
                    align-items: center;
                    justify-content: center;

                    background: #f1f3f5;
                    color: #6c757d;

                    border: 1px solid #dee2e6;

                    border-radius: 0;

                    font-size: 18px;
                }


                .request-description-box {
                    padding-top: 14px;
                    border-top: 1px solid #edf0f2;
                }


                .description-text {
                    color: #495057;
                    line-height: 1.6;
                }


                /* =========================================================
                   STATUS
                ========================================================== */

                .status-badge {
                    border-radius: 0 !important;
                    padding: 7px 10px;
                    font-weight: 500;
                    white-space: nowrap;
                }


                .status-procurement {
                    background: #0dcaf0 !important;
                    color: #212529;
                }


                /* =========================================================
                   PROCUREMENT CARD HEADER
                ========================================================== */

                .procurement-card-header {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;

                    gap: 15px;

                    background: #f8f9fa;

                    border-bottom: 1px solid #dee2e6;

                    padding: 15px 18px;
                }


                .procurement-card-header h5 {
                    font-size: 16px;
                    font-weight: 600;
                }


                .items-count {
                    display: inline-flex;
                    align-items: center;

                    padding: 6px 10px;

                    background: #ffffff;

                    border: 1px solid #dee2e6;

                    font-size: 13px;
                    font-weight: 500;

                    white-space: nowrap;
                }


                /* =========================================================
                   TABLE
                ========================================================== */

                .request-table-wrapper {
                    width: 100%;

                    overflow-x: auto;
                    overflow-y: hidden;

                    -webkit-overflow-scrolling: touch;
                }


                #procurementItemsTable {
                    width: 100% !important;

                    min-width: 900px;

                    margin: 0 !important;

                    font-size: 14px;

                    border-collapse: collapse;
                }


                #procurementItemsTable thead th {

                    white-space: nowrap;

                    vertical-align: middle;

                    font-weight: 600;

                    background: #f8f9fa;

                    color: #212529;

                    padding: 12px 10px;

                    border-color: #dee2e6;
                }


                #procurementItemsTable tbody td {

                    vertical-align: middle;

                    padding: 11px 10px;

                    border-color: #dee2e6;
                }


                #procurementItemsTable tbody tr:hover {
                    background: #fafafa;
                }


                .col-number {
                    width: 50px;
                    text-align: center;
                }


                .col-item {
                    min-width: 280px;
                }


                .col-quantity {
                    width: 110px;
                    text-align: center;
                }


                .col-unit {
                    width: 100px;
                    text-align: center;
                }


                .col-price {
                    width: 190px;
                }


                .col-supplier {
                    min-width: 250px;
                }


                /* =========================================================
                   ITEM
                ========================================================== */

                .item-number {

                    width: 28px;
                    height: 28px;

                    display: inline-flex;

                    align-items: center;
                    justify-content: center;

                    background: #f8f9fa;

                    border: 1px solid #dee2e6;

                    font-size: 13px;
                    font-weight: 600;

                }


                .item-name {
                    font-weight: 600;
                    color: #212529;
                }


                .item-description {

                    margin-top: 3px;

                    color: #6c757d;

                    font-size: 12px;

                    line-height: 1.4;

                }


                .quantity-value {
                    font-weight: 600;
                }


                .unit-badge {

                    display: inline-block;

                    padding: 4px 8px;

                    background: #f8f9fa;

                    border: 1px solid #dee2e6;

                    font-size: 12px;

                    color: #495057;

                }


                /* =========================================================
                   FORM INPUTS
                ========================================================== */

                #procurementItemsTable input,
                #procurementItemsTable textarea {

                    border-radius: 0 !important;

                }


                #procurementItemsTable input:focus,
                #procurementItemsTable textarea:focus {

                    border-color: #FF6600;

                    box-shadow:
                        0 0 0 0.15rem
                        rgba(255, 102, 0, .15);

                }


                .price-input-group .form-control {
                    min-width: 150px;
                }


                /* =========================================================
                   INFORMATION NOTE
                ========================================================== */

                .procurement-info {

                    display: flex;

                    align-items: flex-start;

                    gap: 10px;

                    padding: 12px 14px;

                    background: #f8f9fa;

                    border: 1px solid #dee2e6;

                }


                .procurement-info-icon {

                    color: #0d6efd;

                    font-size: 18px;

                    line-height: 1;

                }


                /* =========================================================
                   ACTIONS
                ========================================================== */

                .process-footer {

                    display: flex;

                    align-items: center;

                    justify-content: space-between;

                    gap: 15px;

                    padding-top: 15px;

                    border-top: 1px solid #edf0f2;

                }


                .request-actions {

                    display: flex;

                    align-items: center;

                    gap: 6px;

                }


                .process-action-btn {

                    min-width: 105px;

                    height: 38px;

                    border-radius: 0 !important;

                    font-weight: 500;

                }


                /* =========================================================
                   MODAL
                ========================================================== */

                #rejectModal .modal-content,
                #rejectModal .form-control,
                #rejectModal .btn {

                    border-radius: 0 !important;

                }


                #rejectModal .modal-header {

                    border-bottom: 1px solid #dee2e6;

                }


                .reject-request-summary {

                    padding: 12px 14px;

                    background: #f8f9fa;

                    border: 1px solid #dee2e6;

                }


                /* =========================================================
                   RESPONSIVE
                ========================================================== */

                @media (max-width: 768px) {

                    .app-content-header .row {
                        row-gap: 12px;
                    }


                    .app-content-header .breadcrumb {

                        float: none !important;

                        justify-content: flex-start;

                        margin-top: 4px;

                    }


                    .page-heading {
                        align-items: flex-start;
                    }


                    .request-card .card-body {
                        padding: 12px;
                    }


                    .procurement-card-header {

                        align-items: flex-start;

                        flex-direction: column;

                    }


                    .items-count {
                        width: 100%;
                        justify-content: center;
                    }


                    #procurementItemsTable {

                        min-width: 900px;

                        font-size: 13px;

                    }


                    #procurementItemsTable tbody td {
                        padding: 9px 8px;
                    }


                    .process-footer {

                        align-items: stretch;

                        flex-direction: column-reverse;

                    }


                    .request-actions {

                        width: 100%;

                        justify-content: flex-end;

                    }


                    .process-action-btn {

                        min-width: 95px;

                    }

                }

            </style>


            {{-- =========================================================
                 JAVASCRIPT
            ========================================================== --}}

            @push('scripts')

                <script>

                    document.addEventListener(
                        'DOMContentLoaded',
                        function () {


                            /*
                             * =====================================================
                             * PREVENT DOUBLE SUBMISSION - APPROVE
                             * =====================================================
                             */

                            const form =
                                document.getElementById(
                                    'procurementForm'
                                );


                            const approveButton =
                                document.getElementById(
                                    'approveButton'
                                );


                            if (
                                form &&
                                approveButton
                            ) {

                                form.addEventListener(
                                    'submit',
                                    function () {

                                        approveButton.disabled =
                                            true;


                                        approveButton.innerHTML = `
                                        <span
                                            class="spinner-border spinner-border-sm me-1"
                                            role="status"
                                            aria-hidden="true"
                                        ></span>

                                        Processing...
                                    `;

                                    }
                                );

                            }


                            /*
                             * =====================================================
                             * PREVENT DOUBLE SUBMISSION - REJECT
                             * =====================================================
                             */

                            const rejectForm =
                                document.querySelector(
                                    '#rejectModal form'
                                );


                            if (rejectForm) {

                                rejectForm.addEventListener(
                                    'submit',
                                    function () {

                                        const button =
                                            rejectForm.querySelector(
                                                'button[type="submit"]'
                                            );


                                        if (button) {

                                            button.disabled =
                                                true;


                                            button.innerHTML = `
                                            <span
                                                class="spinner-border spinner-border-sm me-1"
                                                role="status"
                                                aria-hidden="true"
                                            ></span>

                                            Processing...
                                        `;

                                        }

                                    }
                                );

                            }

                        }

                    );

                </script>

            @endpush

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





