@extends('layouts.admin')

@section('content')

    @php
        use App\Enums\PerPage;
        use App\Enums\RequestStatus;
    @endphp


    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6 col-12">

                    <h3 class="mb-0">
                        Requests
                    </h3>

                </div>


                <div class="col-md-6 col-12">

                    <ol class="breadcrumb float-md-end mb-0">

                        <li class="breadcrumb-item">

                            <a href="{{ url('/') }}">
                                Home
                            </a>

                        </li>

                        <li class="breadcrumb-item active">
                            Requests
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

            <div class="card shadow-sm request-card">

                <div class="card-body">

                    <div class="request-table-wrapper">

                        <table
                            id="requestsTable"
                            class="table table-bordered table-hover align-middle"
                        >

                            {{-- =================================================
                                TABLE HEADER
                            ================================================== --}}

                            <thead>

                            <tr>

                                <th>#</th>

                                <th>Reference</th>

                                <th>Title</th>

                                <th>Requester</th>

                                <th>Items</th>

                                <th>Status</th>

                                <th>Created Date</th>

                                <th>Actions</th>

                            </tr>

                            </thead>


                            {{-- =================================================
                                TABLE BODY
                            ================================================== --}}

                            <tbody>

                            @foreach($requests as $request)

                                @php

                                    $status = $request->status instanceof RequestStatus
                                        ? $request->status->value
                                        : $request->status;

                                @endphp


                                <tr>

                                    {{-- =================================================
                                        1. #
                                    ================================================== --}}

                                    <td class="text-center">

                                        {{ $loop->iteration }}

                                    </td>


                                    {{-- =================================================
                                        2. REFERENCE
                                    ================================================== --}}

                                    <td>

                                        <div class="fw-semibold request-reference">

                                            {{ $request->reference }}

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        3. TITLE
                                    ================================================== --}}

                                    <td>

                                        <div class="fw-semibold request-title">

                                            {{ $request->title }}

                                        </div>


                                        @if($request->description)

                                            <small class="request-description">

                                                {{ \Illuminate\Support\Str::limit(
                                                    $request->description,
                                                    80
                                                ) }}

                                            </small>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        4. REQUESTER
                                    ================================================== --}}

                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div class="request-avatar me-2">

                                                <i class="bi bi-person-fill"></i>

                                            </div>


                                            <div class="fw-semibold">

                                                {{ $request->requester?->name ?? 'Unknown' }}

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        5. ITEMS
                                    ================================================== --}}

                                    <td>

                                        <div class="request-items">

                                            @forelse($request->items as $item)

                                                <div class="request-item-row">

                                                    <span class="fw-semibold">

                                                        {{ $item->name }}

                                                    </span>


                                                    <span class="request-muted">

                                                        ×

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


                                                    @if($item->unit)

                                                        <small class="request-muted">

                                                            {{ $item->unit }}

                                                        </small>

                                                    @endif

                                                </div>

                                            @empty

                                                <span class="request-muted">

                                                    No items

                                                </span>

                                            @endforelse

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        6. STATUS
                                    ================================================== --}}

                                    <td>

                                        @switch($status)

                                            @case('pending_procurement')

                                                <span
                                                    class="badge status-badge status-procurement"
                                                >

                                                    Pending Procurement

                                                </span>

                                                @break


                                            @case('pending_finance')

                                                <span
                                                    class="badge status-badge status-finance"
                                                >

                                                    Pending Finance

                                                </span>

                                                @break


                                            @case('pending_ceo')

                                                <span
                                                    class="badge status-badge status-ceo"
                                                >

                                                    Pending CEO

                                                </span>

                                                @break


                                            @case('approved')

                                                <span
                                                    class="badge status-badge status-approved"
                                                >

                                                    Approved

                                                </span>

                                                @break


                                            @case('rejected')

                                                <span
                                                    class="badge status-badge status-rejected"
                                                >

                                                    Rejected

                                                </span>

                                                @break


                                            @default

                                                <span
                                                    class="badge status-badge status-default"
                                                >

                                                    {{ $status ?? '-' }}

                                                </span>

                                        @endswitch

                                    </td>


                                    {{-- =================================================
                                        7. CREATED DATE
                                    ================================================== --}}

                                    <td
                                        data-order="{{ $request->created_at?->format('Y-m-d H:i:s') }}"
                                    >

                                        {{ $request->created_at?->format('d/m/Y') ?? '-' }}

                                    </td>


                                    {{-- =================================================
                                        8. ACTIONS
                                    ================================================== --}}

                                    <td>

                                        <div class="request-actions">


                                            {{-- VIEW --}}

                                            <a
                                                href="{{ route('requests.show', $request) }}"
                                                class="btn btn-sm btn-info action-btn"
                                                title="View Request"
                                            >

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- =================================================
                                                PROCUREMENT
                                            ================================================== --}}

                                            @if(
                                                auth()->user()->hasRole('Procurement') &&
                                                $status === 'pending_procurement'
                                            )

                                                <a
                                                    href="{{ route('requests.show', $request) }}"
                                                    class="btn btn-sm btn-success action-btn"
                                                    title="Process Request"
                                                >

                                                    <i class="bi bi-check-lg"></i>

                                                </a>

                                            @endif


                                            {{-- =================================================
                                                FINANCE
                                            ================================================== --}}

                                            @if(
                                                auth()->user()->hasRole('Finance') &&
                                                $status === 'pending_finance'
                                            )

                                                <a
                                                    href="{{ route('requests.show', $request) }}"
                                                    class="btn btn-sm btn-success action-btn"
                                                    title="Process Request"
                                                >

                                                    <i class="bi bi-check-lg"></i>

                                                </a>

                                            @endif


                                            {{-- =================================================
                                                CEO
                                            ================================================== --}}

                                            @if(
                                                auth()->user()->hasRole('CEO') &&
                                                $status === 'pending_ceo'
                                            )

                                                <a
                                                    href="{{ route('requests.show', $request) }}"
                                                    class="btn btn-sm btn-success action-btn"
                                                    title="Approve Request"
                                                >

                                                    <i class="bi bi-check-lg"></i>

                                                </a>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        CSS — LIGHT + DARK MODE
    ========================================================== --}}

    <style>

        /* =====================================================
           LIGHT THEME
        ====================================================== */

        :root {

            --request-bg: #ffffff;

            --request-card-bg: #ffffff;

            --request-table-bg: #ffffff;

            --request-header-bg: #f8f9fa;

            --request-hover-bg: #f8f9fa;

            --request-text: #212529;

            --request-muted: #6c757d;

            --request-border: #dee2e6;

            --request-input-bg: #ffffff;

            --request-input-text: #212529;

            --request-input-border: #ced4da;

            --request-avatar-bg: #f1f1f1;

            --request-avatar-text: #777;

            --request-item-border: #f1f1f1;

            --request-link: #0d6efd;

        }


        /* =====================================================
           DARK THEME
        ====================================================== */

        [data-bs-theme="dark"] {

            --request-bg: #212529;

            --request-card-bg: #212529;

            --request-table-bg: #212529;

            --request-header-bg: #2b3035;

            --request-hover-bg: #2c3035;

            --request-text: #f8f9fa;

            --request-muted: #adb5bd;

            --request-border: #495057;

            --request-input-bg: #2b3035;

            --request-input-text: #f8f9fa;

            --request-input-border: #495057;

            --request-avatar-bg: #343a40;

            --request-avatar-text: #adb5bd;

            --request-item-border: #3f4449;

            --request-link: #6ea8fe;

        }


        /* =====================================================
           CARD
        ====================================================== */

        .request-card {

            border-radius: 0 !important;

            border: 1px solid var(--request-border) !important;

            background-color: var(--request-card-bg) !important;

            color: var(--request-text);

        }


        .request-card .card-body {

            background-color: var(--request-card-bg) !important;

            color: var(--request-text);

        }


        /* =====================================================
           TABLE WRAPPER
        ====================================================== */

        .request-table-wrapper {

            width: 100%;

            overflow-x: auto;

            overflow-y: hidden;

            -webkit-overflow-scrolling: touch;

        }


        /* =====================================================
           TABLE
        ====================================================== */

        #requestsTable {

            width: 100% !important;

            min-width: 1150px;

            margin: 0 !important;

            font-size: 14px;

            border-collapse: collapse;

            background-color: var(--request-table-bg) !important;

            color: var(--request-text) !important;

        }


        /* =====================================================
           TABLE HEADER
        ====================================================== */

        #requestsTable thead th {

            white-space: nowrap;

            vertical-align: middle;

            font-weight: 600;

            background-color: var(--request-header-bg) !important;

            color: var(--request-text) !important;

            border-color: var(--request-border) !important;

            padding: 11px 10px;

        }


        /* =====================================================
           TABLE BODY
        ====================================================== */

        #requestsTable tbody td {

            vertical-align: middle;

            padding: 10px;

            background-color: var(--request-table-bg) !important;

            color: var(--request-text) !important;

            border-color: var(--request-border) !important;

        }


        #requestsTable tbody tr {

            min-height: 60px;

        }


        #requestsTable tbody tr:hover td {

            background-color: var(--request-hover-bg) !important;

            color: var(--request-text) !important;

        }


        /* =====================================================
           DATATABLES SORTING
        ====================================================== */

        [data-bs-theme="dark"] #requestsTable thead th {

            color: var(--request-text) !important;

        }


        [data-bs-theme="dark"]
        #requestsTable thead th.sorting:before,
        [data-bs-theme="dark"]
        #requestsTable thead th.sorting:after,
        [data-bs-theme="dark"]
        #requestsTable thead th.sorting_asc:before,
        [data-bs-theme="dark"]
        #requestsTable thead th.sorting_asc:after,
        [data-bs-theme="dark"]
        #requestsTable thead th.sorting_desc:before,
        [data-bs-theme="dark"]
        #requestsTable thead th.sorting_desc:after {

            color: var(--request-muted) !important;

        }


        /* =====================================================
           REFERENCE
        ====================================================== */

        .request-reference {

            white-space: nowrap;

            color: var(--request-text);

        }


        /* =====================================================
           TITLE
        ====================================================== */

        .request-title {

            max-width: 260px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            color: var(--request-text);

        }


        /* =====================================================
           DESCRIPTION
        ====================================================== */

        .request-description {

            display: block;

            max-width: 260px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            color: var(--request-muted) !important;

        }


        /* =====================================================
           MUTED TEXT
        ====================================================== */

        .request-muted {

            color: var(--request-muted) !important;

        }


        /* =====================================================
           AVATAR
        ====================================================== */

        .request-avatar {

            width: 38px;

            height: 38px;

            min-width: 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            background-color: var(--request-avatar-bg);

            color: var(--request-avatar-text);

            border: 1px solid var(--request-border);

            border-radius: 0;

            font-size: 18px;

        }


        /* =====================================================
           ITEMS
        ====================================================== */

        .request-items {

            min-width: 200px;

            max-width: 300px;

        }


        .request-item-row {

            display: flex;

            align-items: center;

            gap: 5px;

            line-height: 1.5;

            white-space: nowrap;

            color: var(--request-text);

        }


        .request-item-row + .request-item-row {

            border-top: 1px solid var(--request-item-border);

            padding-top: 3px;

            margin-top: 3px;

        }


        /* =====================================================
           STATUS BADGES
        ====================================================== */

        .status-badge {

            border-radius: 0 !important;

            padding: 6px 9px;

            font-weight: 500;

            white-space: nowrap;

        }


        .status-finance {

            background: #ffc107 !important;

            color: #212529 !important;

        }


        .status-procurement {

            background: #0dcaf0 !important;

            color: #212529 !important;

        }


        .status-ceo {

            background: #6f42c1 !important;

            color: #fff !important;

        }


        .status-approved {

            background: #198754 !important;

            color: #fff !important;

        }


        .status-rejected {

            background: #dc3545 !important;

            color: #fff !important;

        }


        .status-default {

            background: #6c757d !important;

            color: #fff !important;

        }


        /* =====================================================
           ACTIONS
        ====================================================== */

        .request-actions {

            display: flex;

            align-items: center;

            gap: 4px;

        }


        .action-btn {

            width: 32px;

            height: 32px;

            padding: 0;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            border-radius: 0 !important;

        }


        /* =====================================================
           DATATABLE TOP
        ====================================================== */

        .datatable-top {

            width: 100%;

            display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 15px;

        }


        /* =====================================================
           SEARCH
        ====================================================== */

        .datatable-search {

            display: flex;

            align-items: center;

            flex: 0 1 auto;

        }


        .datatable-search label {

            margin: 0;

            display: flex;

            align-items: center;

            font-weight: 500;

            white-space: nowrap;

            color: var(--request-text);

        }


        .datatable-search input {

            width: 260px;

            height: 38px;

            margin-left: 8px;

            padding: 6px 10px;

            border: 1px solid var(--request-input-border);

            border-radius: 0 !important;

            outline: none;

            background-color: var(--request-input-bg) !important;

            color: var(--request-input-text) !important;

        }


        .datatable-search input::placeholder {

            color: var(--request-muted);

            opacity: .85;

        }


        .datatable-search input:focus {

            border-color: #FF6600;

            box-shadow: 0 0 0 0.15rem rgba(255, 102, 0, .15);

            background-color: var(--request-input-bg) !important;

            color: var(--request-input-text) !important;

        }


        /* =====================================================
           ADD BUTTON
        ====================================================== */

        .datatable-add {

            display: flex;

            align-items: center;

            flex-shrink: 0;

        }


        .datatable-add .btn {

            height: 38px;

            border-radius: 0 !important;

            white-space: nowrap;

        }


        /* =====================================================
           LENGTH
        ====================================================== */

        .datatable-length {

            display: flex;

            align-items: center;

            margin-left: auto;

            flex-shrink: 0;

        }


        .dataTables_length select,
        .dt-length select {

            height: 36px;

            border-radius: 0 !important;

            background-color: var(--request-input-bg) !important;

            color: var(--request-input-text) !important;

            border-color: var(--request-input-border) !important;

        }


        /* =====================================================
           BUTTONS
        ====================================================== */

        .datatable-buttons {

            display: flex;

            align-items: center;

            justify-content: flex-end;

            flex-wrap: wrap;

            gap: 4px;

            flex-shrink: 0;

        }


        .datatable-buttons .dt-button {

            margin: 0 !important;

            min-height: 38px;

            padding: 6px 12px;

            border-radius: 0 !important;

            border: none !important;

            box-shadow: none !important;

        }


        .datatable-buttons .dt-button:hover {

            opacity: .9;

        }


        /* =====================================================
           DATATABLE TABLE
        ====================================================== */

        .datatable-table {

            width: 100%;

        }


        /* =====================================================
           DATATABLE BOTTOM
        ====================================================== */

        .datatable-bottom {

            width: 100%;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-top: 15px;

        }


        .datatable-info {

            display: flex;

            align-items: center;

            color: var(--request-muted);

        }


        .datatable-pagination {

            display: flex;

            align-items: center;

            justify-content: flex-end;

        }


        /* =====================================================
           DATATABLE PAGINATION — DARK
        ====================================================== */

        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_paginate .paginate_button {

            color: var(--request-text) !important;

            background: transparent !important;

            border-color: var(--request-border) !important;

        }


        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_paginate .paginate_button:hover {

            color: #ffffff !important;

            background: #343a40 !important;

            border-color: #495057 !important;

        }


        [data-bs-theme="dark"] .dataTables_wrapper .dataTables_paginate .paginate_button.current {

            color: #ffffff !important;

            background: #0d6efd !important;

            border-color: #0d6efd !important;

        }


        /* =====================================================
           DATATABLE INFO / LABELS
        ====================================================== */

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {

            color: var(--request-text);

        }


        /* =====================================================
           DATATABLE EMPTY
        ====================================================== */

        [data-bs-theme="dark"] .dataTables_empty {

            background-color: var(--request-table-bg) !important;

            color: var(--request-muted) !important;

        }


        /* =====================================================
           BREADCRUMB
        ====================================================== */

        [data-bs-theme="dark"] .breadcrumb-item {

            color: var(--request-muted);

        }


        [data-bs-theme="dark"] .breadcrumb-item a {

            color: var(--request-link);

        }


        /* =====================================================
           RESPONSIVE — TABLET
        ====================================================== */

        @media (max-width: 1100px) {

            .datatable-top {

                flex-wrap: wrap;

            }


            .datatable-length {

                margin-left: 0;

            }

        }


        /* =====================================================
           RESPONSIVE — MOBILE
        ====================================================== */

        @media (max-width: 768px) {

            .app-content-header .row {

                row-gap: 8px;

            }


            .app-content-header .breadcrumb {

                float: none !important;

                justify-content: flex-start;

            }


            .datatable-top {

                display: grid;

                grid-template-columns: 1fr auto;

                gap: 10px;

                align-items: center;

            }


            .datatable-search {

                width: 100%;

                min-width: 0;

            }


            .datatable-search label {

                width: 100%;

            }


            .datatable-search input {

                width: 100%;

                min-width: 0;

                margin-left: 8px;

            }


            .datatable-add {

                width: auto;

            }


            .datatable-add .btn {

                width: auto;

                padding-left: 10px;

                padding-right: 10px;

            }


            .datatable-length {

                width: 100%;

                margin-left: 0;

            }


            .datatable-buttons {

                width: 100%;

                justify-content: flex-start;

                overflow-x: auto;

                flex-wrap: nowrap;

                padding-bottom: 2px;

            }


            .datatable-buttons .dt-button {

                white-space: nowrap;

                flex-shrink: 0;

            }


            .datatable-bottom {

                flex-direction: column;

                align-items: flex-start;

            }


            .datatable-pagination {

                width: 100%;

                justify-content: flex-start;

                overflow-x: auto;

            }


            #requestsTable {

                min-width: 1150px;

                font-size: 13px;

            }


            #requestsTable tbody td {

                padding: 8px;

            }


            .request-card .card-body {

                padding: 10px;

            }


            .request-items {

                min-width: 180px;

            }

        }


        /* =====================================================
           RESPONSIVE — SMALL MOBILE
        ====================================================== */

        @media (max-width: 480px) {

            .datatable-top {

                grid-template-columns: 1fr;

            }


            .datatable-add {

                width: 100%;

            }


            .datatable-add .btn {

                width: 100%;

            }


            .datatable-search input {

                width: 100%;

            }

        }

    </style>


    {{-- =========================================================
        DATATABLE SCRIPT
    ========================================================== --}}

    @push('scripts')

        <script>

            document.addEventListener('DOMContentLoaded', function () {


                /* =================================================
                   INITIALIZE DATATABLE
                ================================================== */

                $('#requestsTable').DataTable({

                    responsive: false,

                    autoWidth: false,


                    /* =============================================
                       PAGINATION
                    ============================================== */

                    pageLength: {{ PerPage::FIVE->value }},

                    lengthMenu: [

                        @json(PerPage::values()),

                        @json([
                            ...PerPage::values(),
                            'All'
                        ])

                    ],


                    /* =============================================
                       DEFAULT ORDER
                    ============================================== */

                    order: [

                        [6, 'desc']

                    ],


                    /* =============================================
                       LANGUAGE
                    ============================================== */

                    language: {

                        search: 'Search:',

                        searchPlaceholder:
                            'Search request...',

                        lengthMenu:
                            'Show _MENU_ requests',

                        info:
                            'Showing _START_ to _END_ of _TOTAL_ requests',

                        infoEmpty:
                            'No requests available',

                        infoFiltered:
                            '(filtered from _MAX_ total requests)',

                        zeroRecords:
                            'No matching requests found',

                        emptyTable:
                            'No requests found',

                        paginate: {

                            first: 'First',

                            last: 'Last',

                            next: 'Next',

                            previous: 'Previous'

                        }

                    },


                    /* =============================================
                       DATATABLE DOM
                    ============================================== */

                    dom:

                        '<"datatable-top"' +

                        '<"datatable-search"f>' +

                        '<"datatable-add">' +

                        '<"datatable-length"l>' +

                        '<"datatable-buttons"B>' +

                        '>' +

                        '<"datatable-table"tr>' +

                        '<"datatable-bottom"' +

                        '<"datatable-info"i>' +

                        '<"datatable-pagination"p>' +

                        '>',


                    /* =============================================
                       EXPORT BUTTONS
                    ============================================== */

                    buttons: [

                        {

                            extend: 'copy',

                            text:
                                '<i class="bi bi-copy me-1"></i> Copy',

                            className:
                                'btn btn-secondary',

                            exportOptions: {

                                columns: ':not(:last-child)'

                            }

                        },


                        {

                            extend: 'excel',

                            text:
                                '<i class="bi bi-file-earmark-excel me-1"></i> Excel',

                            className:
                                'btn btn-success',

                            title:
                                'Request List',

                            exportOptions: {

                                columns: ':not(:last-child)'

                            }

                        },


                        {

                            extend: 'pdf',

                            text:
                                '<i class="bi bi-file-earmark-pdf me-1"></i> PDF',

                            className:
                                'btn btn-danger',

                            title:
                                'Request List',

                            orientation:
                                'landscape',

                            pageSize:
                                'A4',

                            exportOptions: {

                                columns: ':not(:last-child)'

                            }

                        },


                        {

                            extend: 'print',

                            text:
                                '<i class="bi bi-printer me-1"></i> Print',

                            className:
                                'btn btn-primary',

                            title:
                                'Request List',

                            exportOptions: {

                                columns: ':not(:last-child)'

                            }

                        }

                    ],


                    /* =============================================
                       COLUMN DEFINITIONS
                    ============================================== */

                    columnDefs: [

                        /* # */

                        {

                            targets: 0,

                            searchable: false,

                            orderable: false,

                            width: '50px'

                        },


                        /* REFERENCE */

                        {

                            targets: 1,

                            searchable: true,

                            orderable: true

                        },


                        /* TITLE */

                        {

                            targets: 2,

                            searchable: true,

                            orderable: true

                        },


                        /* REQUESTER */

                        {

                            targets: 3,

                            searchable: true,

                            orderable: true

                        },


                        /* ITEMS */

                        {

                            targets: 4,

                            searchable: true,

                            orderable: false,

                            width: '220px'

                        },


                        /* STATUS */

                        {

                            targets: 5,

                            searchable: true,

                            orderable: true,

                            width: '180px'

                        },


                        /* CREATED DATE */

                        {

                            targets: 6,

                            searchable: false,

                            orderable: true,

                            width: '110px'

                        },


                        /* ACTIONS */

                        {

                            targets: 7,

                            searchable: false,

                            orderable: false,

                            width: '90px'

                        }

                    ]

                });


                /* =================================================
                   ADD NEW REQUEST BUTTON
                ================================================== */

                const addRequestContainer =
                    document.querySelector('.datatable-add');


                if (addRequestContainer) {

                    addRequestContainer.innerHTML = `

                        <a
                            href="{{ route('requests.create') }}"
                            class="btn btn-primary"
                            title="Create Request"
                        >

                            <i class="bi bi-plus-lg me-1"></i>

                            New Request

                        </a>

                    `;

                }

            });

        </script>

    @endpush

@endsection
