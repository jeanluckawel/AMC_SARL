@extends('layouts.admin')

@section('content')

    @php
        use App\Enums\PerPage;
    @endphp


    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6 col-12">

                    <h3 class="mb-0">
                        Department Budget
                    </h3>

                </div>


                <div class="col-md-6 col-12">

                    <ol class="breadcrumb float-md-end mb-0">

                        <li class="breadcrumb-item">

                            <a href="{{ url('/') }}">
                                Home
                            </a>

                        </li>

                        <li class="breadcrumb-item">
                            Finance
                        </li>

                        <li class="breadcrumb-item active">
                            Department Budget
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
                SUCCESS MESSAGE
            ================================================== --}}

            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    <i class="bi bi-check-circle me-1"></i>

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            @endif


            {{-- =================================================
                ERROR MESSAGE
            ================================================== --}}

            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="bi bi-exclamation-triangle me-1"></i>

                    {{ session('error') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            @endif


            {{-- =================================================
                CARD
            ================================================== --}}

            <div class="card shadow-sm request-card">


                {{-- =================================================
                    CARD HEADER
                ================================================== --}}

                <div class="card-header bg-white">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="mb-0">
                                Department Budget
                            </h5>

                            <small class="text-muted">
                                Manage department budgets
                            </small>

                        </div>


                        <div class="text-end">

                            <small class="text-muted d-block">
                                Budget Total
                            </small>

                            <div class="fw-semibold fs-5">

                                <span class="badge status-badge status-approved">

                                    {{ number_format(
                                        (float) $amountBuget,
                                        2,
                                        '.',
                                        ','
                                    ) }} $

                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    CARD BODY
                ================================================== --}}

                <div class="card-body">


                    {{-- =================================================
                        TABLE WRAPPER
                    ================================================== --}}

                    <div class="request-table-wrapper">


                        <table
                            id="departmentBudgetTable"
                            class="table table-bordered table-hover align-middle"
                        >


                            {{-- =================================================
                                TABLE HEADER
                            ================================================== --}}

                            <thead>

                            <tr>

                                <th>
                                    #
                                </th>

                                <th>
                                    Department
                                </th>

                                <th>
                                    Code
                                </th>

                                <th>
                                    Budget
                                </th>

                                <th>
                                    Used
                                </th>

                                <th>
                                    Available
                                </th>

                                <th>
                                    End Date
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Actions
                                </th>

                            </tr>

                            </thead>


                            {{-- =================================================
                                TABLE BODY

                                IMPORTANT:
                                Every <tr> MUST contain exactly 9 <td>.
                            ================================================== --}}

                            <tbody>

                            @foreach($departments as $department)

                                @php

                                    $budget = $department->budgets
                                        ->sortByDesc('end_date')
                                        ->first();

                                @endphp


                                <tr>


                                    {{-- =================================================
                                        1. NUMBER
                                    ================================================== --}}

                                    <td class="text-center">

                                        {{ $loop->iteration }}

                                    </td>


                                    {{-- =================================================
                                        2. DEPARTMENT
                                    ================================================== --}}

                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div class="request-avatar me-2">

                                                <i class="bi bi-building"></i>

                                            </div>

                                            <div class="fw-semibold">

                                                {{ $department->name }}

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        3. CODE
                                    ================================================== --}}

                                    <td>

                                        <div class="fw-semibold">

                                            {{ $department->code }}

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        4. BUDGET
                                    ================================================== --}}

                                    <td>

                                        @if($budget)

                                            <div class="fw-semibold">

                                                {{ number_format(
                                                    (float) $budget->amount,
                                                    2,
                                                    '.',
                                                    ','
                                                ) }}

                                            </div>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        5. USED
                                    ================================================== --}}

                                    <td>

                                        @if($budget)

                                            <div class="fw-semibold">

                                                {{ number_format(
                                                    (float) $budget->used_amount,
                                                    2,
                                                    '.',
                                                    ','
                                                ) }}

                                            </div>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        6. AVAILABLE
                                    ================================================== --}}

                                    <td>

                                        @if($budget)

                                            <div class="fw-semibold">

                                                {{ number_format(
                                                    (float) $budget->available_amount,
                                                    2,
                                                    '.',
                                                    ','
                                                ) }}

                                            </div>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        7. END DATE
                                    ================================================== --}}

                                    <td
                                        @if($budget)
                                            data-order="{{ $budget->end_date?->format('Y-m-d') }}"
                                        @endif
                                    >

                                        @if($budget)

                                            {{ $budget->end_date?->format('d/m/Y') ?? '-' }}

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        8. STATUS
                                    ================================================== --}}

                                    <td>

                                        @if(!$budget)

                                            <span class="badge status-badge status-no-budget">
                                                No Budget
                                            </span>

                                        @elseif($budget->is_expired)

                                            <span class="badge status-badge status-rejected">
                                                Expired
                                            </span>

                                        @elseif($budget->available_amount <= 0)

                                            <span class="badge status-badge status-finance">
                                                Exhausted
                                            </span>

                                        @else

                                            <span class="badge status-badge status-approved">
                                                Active
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        9. ACTIONS
                                    ================================================== --}}

                                    <td>

                                        <div class="request-actions">


                                            @if($budget)

                                                {{-- VIEW --}}

                                                <a
                                                    href="#"
                                                    class="btn btn-sm btn-info action-btn"
                                                    title="View Budget"
                                                >

                                                    <i class="bi bi-eye"></i>

                                                </a>


                                                {{-- EDIT --}}


                                                <a
                                                    href="{{ route(
                                                            'finance.department-budgets.edit',
                                                            $budget->id
                                                            ) }}"
                                                    class="btn btn-sm btn-primary action-btn"
                                                    title="Edit Budget"
                                                >
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                            @else

                                                {{-- CREATE BUDGET --}}

                                                <a
                                                    href="{{ route(
                                                            'finance.department-budgets.create',
                                                            $department->id
                                                        ) }}"
                                                    class="btn btn-sm btn-success action-btn"
                                                    title="Create Budget"
                                                >
                                                    <i class="bi bi-plus-lg"></i>
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
        STYLE
    ========================================================== --}}

    <style>

        .request-card {

            border-radius: 0 !important;

            border: 1px solid #dee2e6;

        }


        .request-table-wrapper {

            width: 100%;

            overflow-x: auto;

            overflow-y: hidden;

            -webkit-overflow-scrolling: touch;

        }


        #departmentBudgetTable {

            width: 100% !important;

            min-width: 1150px;

            margin: 0 !important;

            font-size: 14px;

            border-collapse: collapse;

        }


        #departmentBudgetTable thead th {

            white-space: nowrap;

            vertical-align: middle;

            font-weight: 600;

            background: #f8f9fa;

            color: #212529;

            padding: 11px 10px;

        }


        #departmentBudgetTable tbody td {

            vertical-align: middle;

            padding: 10px;

        }


        #departmentBudgetTable tbody tr {

            min-height: 60px;

        }


        .request-avatar {

            width: 38px;

            height: 38px;

            min-width: 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f1f1f1;

            color: #777;

            border: 1px solid #dee2e6;

            border-radius: 0;

            font-size: 18px;

        }


        .status-badge {

            border-radius: 0 !important;

            padding: 6px 9px;

            font-weight: 500;

            white-space: nowrap;

        }


        .status-finance {

            background: #ffc107 !important;

            color: #212529;

        }


        .status-approved {

            background: #198754 !important;

            color: #fff;

        }


        .status-rejected {

            background: #dc3545 !important;

            color: #fff;

        }


        .status-no-budget {

            background: #6c757d !important;

            color: #fff;

        }


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


        /* =========================================================
           DATATABLE TOP
        ========================================================== */

        .datatable-top {

            width: 100%;

            display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 15px;

        }


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

        }


        .datatable-search input {

            width: 260px;

            height: 38px;

            margin-left: 8px;

            padding: 6px 10px;

            border: 1px solid #ced4da;

            border-radius: 0 !important;

            outline: none;

        }


        .datatable-search input:focus {

            border-color: #FF6600;

            box-shadow:
                0 0 0 0.15rem
                rgba(255, 102, 0, .15);

        }


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

        }


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


        .datatable-table {

            width: 100%;

        }


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

        }


        .datatable-pagination {

            display: flex;

            align-items: center;

            justify-content: flex-end;

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 1100px) {

            .datatable-top {

                flex-wrap: wrap;

            }


            .datatable-length {

                margin-left: 0;

            }

        }


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

                display: none;

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


            #departmentBudgetTable {

                min-width: 1150px;

                font-size: 13px;

            }


            #departmentBudgetTable tbody td {

                padding: 8px;

            }


            .request-card .card-body {

                padding: 10px;

            }

        }


        @media (max-width: 480px) {

            .datatable-top {

                grid-template-columns: 1fr;

            }


            .datatable-add {

                display: none;

            }


            .datatable-search input {

                width: 100%;

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


                    $('#departmentBudgetTable').DataTable({


                        /* =================================================
                           TABLE
                        ================================================== */

                        responsive: false,

                        autoWidth: false,


                        /* =================================================
                           PAGINATION
                        ================================================== */

                        pageLength:
                            {{ PerPage::FIVE->value }},


                        lengthMenu: [

                            @json(PerPage::values()),

                            @json([
                                ...PerPage::values(),
                                'All'
                            ])

                        ],


                        /* =================================================
                           DEFAULT ORDER
                        ================================================== */

                        order: [

                            [1, 'asc']

                        ],


                        /* =================================================
                           LANGUAGE
                        ================================================== */

                        language: {

                            search:
                                'Search:',

                            searchPlaceholder:
                                'Search department...',

                            lengthMenu:
                                'Show _MENU_ departments',

                            info:
                                'Showing _START_ to _END_ of _TOTAL_ departments',

                            infoEmpty:
                                'No departments available',

                            infoFiltered:
                                '(filtered from _MAX_ total departments)',

                            zeroRecords:
                                'No matching departments found',

                            emptyTable:
                                'No departments found',

                            paginate: {

                                first:
                                    'First',

                                last:
                                    'Last',

                                next:
                                    'Next',

                                previous:
                                    'Previous'

                            }

                        },


                        /* =================================================
                           DATATABLE LAYOUT
                        ================================================== */

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


                        /* =================================================
                           EXPORT BUTTONS
                        ================================================== */

                        buttons: [

                            {

                                extend:
                                    'copy',

                                text:
                                    '<i class="bi bi-copy me-1"></i> Copy',

                                className:
                                    'btn btn-secondary',

                                exportOptions: {

                                    columns:
                                        ':not(:last-child)'

                                }

                            },


                            {

                                extend:
                                    'excel',

                                text:
                                    '<i class="bi bi-file-earmark-excel me-1"></i> Excel',

                                className:
                                    'btn btn-success',

                                title:
                                    'Department Budget List',

                                exportOptions: {

                                    columns:
                                        ':not(:last-child)'

                                }

                            },


                            {

                                extend:
                                    'pdf',

                                text:
                                    '<i class="bi bi-file-earmark-pdf me-1"></i> PDF',

                                className:
                                    'btn btn-danger',

                                title:
                                    'Department Budget List',

                                orientation:
                                    'landscape',

                                pageSize:
                                    'A4',

                                exportOptions: {

                                    columns:
                                        ':not(:last-child)'

                                }

                            },


                            {

                                extend:
                                    'print',

                                text:
                                    '<i class="bi bi-printer me-1"></i> Print',

                                className:
                                    'btn btn-primary',

                                title:
                                    'Department Budget List',

                                exportOptions: {

                                    columns:
                                        ':not(:last-child)'

                                }

                            }

                        ],


                        /* =================================================
                           COLUMNS
                        ================================================== */

                        columnDefs: [

                            {

                                targets:
                                    0,

                                searchable:
                                    false,

                                orderable:
                                    false,

                                width:
                                    '50px'

                            },


                            {

                                targets:
                                    1,

                                searchable:
                                    true,

                                orderable:
                                    true

                            },


                            {

                                targets:
                                    2,

                                searchable:
                                    true,

                                orderable:
                                    true

                            },


                            {

                                targets:
                                    3,

                                searchable:
                                    true,

                                orderable:
                                    true,

                                width:
                                    '130px'

                            },


                            {

                                targets:
                                    4,

                                searchable:
                                    true,

                                orderable:
                                    true,

                                width:
                                    '130px'

                            },


                            {

                                targets:
                                    5,

                                searchable:
                                    true,

                                orderable:
                                    true,

                                width:
                                    '130px'

                            },


                            {

                                targets:
                                    6,

                                searchable:
                                    false,

                                orderable:
                                    true,

                                width:
                                    '110px'

                            },


                            {

                                targets:
                                    7,

                                searchable:
                                    true,

                                orderable:
                                    true,

                                width:
                                    '130px'

                            },


                            {

                                targets:
                                    8,

                                searchable:
                                    false,

                                orderable:
                                    false,

                                width:
                                    '90px'

                            }

                        ]

                    });

                }

            );

        </script>

    @endpush

@endsection
