@extends('layouts.admin')

@section('content')

    @php
        use App\Enums\PerPage;

        $perPageValues = PerPage::values();
        $perPageLabels = [...$perPageValues, 'All'];
    @endphp


    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6 col-12">

                    <h3 class="mb-0">
                        Payroll
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
                            Payroll
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

            <div class="card shadow-sm payroll-card">

                <div class="card-body">

                    {{-- =================================================
                        TABLE WRAPPER
                    ================================================== --}}

                    <div class="payroll-table-wrapper">

                        <table
                            id="payrollTable"
                            class="table table-bordered table-hover align-middle"
                        >

                            {{-- =================================================
                                TABLE HEADER
                            ================================================== --}}

                            <thead>

                            <tr>

                                <th>#</th>

                                <th>Employee</th>

                                <th>Matricule</th>

                                <th>Gender</th>

                                <th>Salary</th>

                                <th>Category</th>

                                <th>Echelon</th>

                                <th>Actions</th>

                            </tr>

                            </thead>


                            {{-- =================================================
                                TABLE BODY
                            ================================================== --}}

                            <tbody>

                            @foreach($payrolls as $employee)

                                <tr>

                                    {{-- =================================================
                                        1. NUMBER
                                    ================================================== --}}

                                    <td class="text-center">

                                        {{ $loop->iteration }}

                                    </td>


                                    {{-- =================================================
                                        2. EMPLOYEE
                                    ================================================== --}}

                                    <td>

                                        <div class="d-flex align-items-center">

                                            {{-- PHOTO --}}

                                            @if($employee->photo)

                                                <img
                                                    src="{{ asset('storage/' . $employee->photo) }}"
                                                    alt="{{ $employee->first_name }}"
                                                    class="payroll-avatar me-2"
                                                >

                                            @else

                                                <div
                                                    class="payroll-avatar payroll-avatar-default me-2"
                                                >

                                                    <i class="bi bi-person-fill"></i>

                                                </div>

                                            @endif


                                            {{-- FULL NAME --}}

                                            <div class="employee-info">

                                                <div class="fw-semibold employee-name">

                                                    {{ $employee->first_name ?? '-' }}

                                                    @if($employee->middle_name)

                                                        {{ $employee->middle_name }}

                                                    @endif

                                                    {{ $employee->last_name ?? '' }}

                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        3. MATRICULE
                                    ================================================== --}}

                                    <td>

                                        <span class="fw-semibold">

                                            {{ $employee->employee_id ?? '-' }}

                                        </span>

                                    </td>


                                    {{-- =================================================
                                        4. GENDER
                                    ================================================== --}}

                                    <td>

                                        {{ $employee->gender?->value ?? '-' }}

                                    </td>


                                    {{-- =================================================
                                        5. SALARY + CURRENCY
                                    ================================================== --}}

                                    <td>

                                        @if($employee->salary)

                                            <div class="salary-wrapper">

                                                <span class="salary-value">

                                                    {{ number_format(
                                                        (float) $employee->salary->base_salary,
                                                        2
                                                    ) }}


                                                        {{ $employee->salary->currency }}


                                            </div>

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        6. CATEGORY
                                    ================================================== --}}

                                    <td>

                                        {{ $employee->salary?->category ?? '-' }}

                                    </td>


                                    {{-- =================================================
                                        7. ECHELON
                                    ================================================== --}}

                                    <td
                                        data-order="{{ $employee->salary?->echelon ?? '' }}"
                                    >

                                        {{ $employee->salary?->echelon ?? '-' }}

                                    </td>


                                    {{-- =================================================
                                        8. ACTIONS
                                    ================================================== --}}

                                    <td>

                                        <div class="payroll-actions">

                                            {{-- VIEW EMPLOYEE --}}

                                            <a
                                                href="{{ route('employees.profile', $employee->id) }}"
                                                class="btn btn-sm btn-info action-btn"
                                                title="View Employee"
                                                aria-label="View Employee"
                                            >

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- EDIT SALARY --}}

                                            <a
                                                href="{{ route('employees.edit', $employee) }}"
                                                class="btn btn-sm btn-warning action-btn"
                                                title="Edit Employee Salary"
                                                aria-label="Edit Employee Salary"
                                            >

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- PAY EMPLOYEE --}}

                                            <a
                                                href="#"
                                                class="btn btn-sm btn-success action-btn"
                                                title="Pay Employee"
                                                aria-label="Pay Employee"
                                            >

                                                <i class="bi bi-cash-stack"></i>

                                            </a>

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
        CSS
    ========================================================== --}}

    <style>

        /* =========================================================
           CARD
        ========================================================== */

        .payroll-card {

            border-radius: 0 !important;

            border: 1px solid #dee2e6;

        }


        /* =========================================================
           TABLE WRAPPER
        ========================================================== */

        .payroll-table-wrapper {

            width: 100%;

            overflow-x: auto;

            overflow-y: hidden;

            -webkit-overflow-scrolling: touch;

        }


        /* =========================================================
           TABLE
        ========================================================== */

        #payrollTable {

            width: 100% !important;

            min-width: 1000px;

            margin: 0 !important;

            font-size: 14px;

            border-collapse: collapse;

        }


        #payrollTable thead th {

            white-space: nowrap;

            vertical-align: middle;

            font-weight: 600;

            background: #f8f9fa;

            color: #212529;

            padding: 11px 10px;

        }


        #payrollTable tbody td {

            vertical-align: middle;

            padding: 10px;

            white-space: nowrap;

        }


        #payrollTable tbody tr {

            height: 60px;

        }


        /* =========================================================
           EMPLOYEE PHOTO
        ========================================================== */

        .payroll-avatar {

            width: 42px;

            height: 42px;

            min-width: 42px;

            object-fit: cover;

            border-radius: 0;

            border: 1px solid #dee2e6;

        }


        .payroll-avatar-default {

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f1f1f1;

            color: #777;

            font-size: 20px;

        }


        .employee-name {

            max-width: 220px;

            overflow: hidden;

            text-overflow: ellipsis;

        }


        /* =========================================================
           SALARY
        ========================================================== */

        .salary-wrapper {

            display: inline-flex;

            align-items: center;

            gap: 8px;

        }


        .salary-value {

            font-weight: 600;

            color: #212529;

        }


        /* =========================================================
           PAYROLL BADGE
        ========================================================== */

        .payroll-badge {

            background: #FF6600 !important;

            color: #fff;

            border-radius: 0 !important;

            padding: 6px 9px;

            font-weight: 500;

        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .payroll-actions {

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


        /* =========================================================
           SEARCH
        ========================================================== */

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

            transition:
                border-color .15s ease-in-out,
                box-shadow .15s ease-in-out;

        }


        .datatable-search input:focus {

            border-color: #FF6600;

            box-shadow:
                0 0 0 0.15rem
                rgba(255, 102, 0, .15);

        }


        /* =========================================================
           LENGTH
        ========================================================== */

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


        /* =========================================================
           EXPORT BUTTONS
        ========================================================== */

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


        /* =========================================================
           TABLE AREA
        ========================================================== */

        .datatable-table {

            width: 100%;

        }


        /* =========================================================
           BOTTOM
        ========================================================== */

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
           TABLET
        ========================================================== */

        @media (max-width: 1100px) {

            .datatable-top {

                flex-wrap: wrap;

            }


            .datatable-length {

                margin-left: 0;

            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

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

                grid-template-columns: 1fr;

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


            #payrollTable {

                min-width: 1000px;

                font-size: 13px;

            }


            #payrollTable tbody td {

                padding: 8px;

            }


            .payroll-card .card-body {

                padding: 10px;

            }

        }


        /* =========================================================
           VERY SMALL MOBILE
        ========================================================== */

        @media (max-width: 480px) {

            .datatable-search input {

                width: 100%;

            }


            .datatable-buttons {

                overflow-x: auto;

            }

        }

    </style>


    {{-- =========================================================
        DATATABLE
    ========================================================== --}}

    @push('scripts')

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                $('#payrollTable').DataTable({

                    responsive: false,

                    autoWidth: false,


                    /* =================================================
                       PAGINATION
                    ================================================== */

                    pageLength: {{ PerPage::FIVE->value }},

                    lengthMenu: [

                        @json($perPageValues),

                        @json($perPageLabels)

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

                        search: 'Search:',

                        searchPlaceholder:
                            'Search employee...',

                        lengthMenu:
                            'Show _MENU_ employees',

                        info:
                            'Showing _START_ to _END_ of _TOTAL_ employees',

                        infoEmpty:
                            'No employees available',

                        infoFiltered:
                            '(filtered from _MAX_ total employees)',

                        zeroRecords:
                            'No matching employees found',

                        emptyTable:
                            'No employees found',

                        paginate: {

                            first: 'First',

                            last: 'Last',

                            next: 'Next',

                            previous: 'Previous'

                        }

                    },


                    /* =================================================
                       LAYOUT
                    ================================================== */

                    dom:

                        '<"datatable-top"' +

                        '<"datatable-search"f>' +

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

                            extend: 'copy',

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

                            extend: 'excel',

                            text:
                                '<i class="bi bi-file-earmark-excel me-1"></i> Excel',

                            className:
                                'btn btn-success',

                            title:
                                'Payroll List',

                            exportOptions: {

                                columns:
                                    ':not(:last-child)'

                            }

                        },


                        {

                            extend: 'pdf',

                            text:
                                '<i class="bi bi-file-earmark-pdf me-1"></i> PDF',

                            className:
                                'btn btn-danger',

                            title:
                                'Payroll List',

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

                            extend: 'print',

                            text:
                                '<i class="bi bi-printer me-1"></i> Print',

                            className:
                                'btn btn-primary',

                            title:
                                'Payroll List',

                            exportOptions: {

                                columns:
                                    ':not(:last-child)'

                            }

                        }

                    ],


                    /* =================================================
                       COLUMN DEFINITIONS
                    ================================================== */

                    columnDefs: [

                        {

                            targets: 0,

                            searchable: false,

                            orderable: false,

                            width: '50px'

                        },


                        {

                            targets: 3,

                            searchable: true,

                            orderable: true,

                            width: '90px'

                        },


                        {

                            targets: 6,

                            searchable: true,

                            orderable: true,

                            width: '90px'

                        },


                        {

                            targets: 7,

                            searchable: false,

                            orderable: false,

                            width: '115px'

                        }

                    ]

                });

            });

        </script>

    @endpush

@endsection
