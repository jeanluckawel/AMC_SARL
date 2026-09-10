@extends('layouts.admin')

@section('title', 'Departments - HR Management')

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

            <div class="row">

                <div class="col-sm-6">

                    <h3 class="mb-0">
                        Departments
                    </h3>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-end">

                        <li class="breadcrumb-item">

                            <a href="{{ url('/') }}">
                                Home
                            </a>

                        </li>

                        <li class="breadcrumb-item active">
                            Departments
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

            <div class="card shadow-sm department-card">

                <div class="card-body">


                    {{-- =================================================
                        TABLE
                    ================================================== --}}

                    <div class="department-table-wrapper">

                        <table
                            id="departmentsTable"
                            class="table table-bordered table-hover align-middle"
                        >

                            <thead>

                            <tr>

                                <th>
                                    #
                                </th>

                                <th>
                                    Department
                                </th>

                                <th>
                                    Section
                                </th>

                                <th>
                                    Job Title
                                </th>

                                <th>
                                    Actions
                                </th>

                            </tr>

                            </thead>


                            <tbody>

                            {{-- IMPORTANT:
                                 Do NOT use @forelse + @empty here.
                                 DataTables expects every <tr> to have 5 <td>.
                            --}}

                            @foreach($departments as $department)

                                <tr>

                                    {{-- ==========================================
                                        NUMBER
                                    =========================================== --}}

                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- ==========================================
                                        DEPARTMENT
                                    =========================================== --}}

                                    <td>

                                        <div class="fw-semibold department-name">
                                            {{ $department->name }}
                                        </div>

                                    </td>


                                    {{-- ==========================================
                                        SECTIONS
                                    =========================================== --}}

                                    <td>

                                        @forelse($department->sections as $section)

                                            <div class="section-item">

                                                <div class="section-name">
                                                    {{ $section->name }}
                                                </div>

                                            </div>

                                        @empty

                                            <span class="text-muted">
                                            No section
                                        </span>

                                        @endforelse

                                    </td>


                                    {{-- ==========================================
                                        JOB TITLES
                                    =========================================== --}}

                                    <td>

                                        @forelse($department->sections as $section)

                                            @forelse($section->jobTitles as $jobTitle)

                                                <div class="job-title-item">

                                                    <div class="job-title-name">
                                                        {{ $jobTitle->name }}
                                                    </div>

                                                </div>

                                            @empty

                                                <div class="text-muted job-title-empty">
                                                    No job title
                                                </div>

                                            @endforelse

                                        @empty

                                            <span class="text-muted">
                                            No job title
                                        </span>

                                        @endforelse

                                    </td>


                                    {{-- ==========================================
                                        ACTIONS
                                    =========================================== --}}

                                    <td>

                                        <div class="department-actions">

                                            {{-- VIEW --}}

                                            <a
                                                href="#"
                                                class="btn btn-sm btn-info action-btn"
                                                title="View Department"
                                            >

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- EDIT --}}

                                            <a
                                                href="#"
                                                class="btn btn-sm btn-warning action-btn"
                                                title="Edit Department"
                                            >

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- DELETE --}}

                                            <form
                                                action="#"
                                                method="POST"
                                                class="d-inline"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-danger action-btn"
                                                    title="Delete Department"
                                                    onclick="confirmDelete(this)"
                                                >

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

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
        CREATE DEPARTMENT MODAL
    ========================================================== --}}

    <div
        class="modal fade"
        id="createDepartmentModal"
        tabindex="-1"
        aria-labelledby="createDepartmentModalLabel"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                <div class="modal-header">

                    <div>

                        <h5
                            class="modal-title"
                            id="createDepartmentModalLabel"
                        >

                            <i class="bi bi-plus-circle me-2"></i>

                            Add Department

                        </h5>

                        <small class="text-muted">
                            Create a new company department
                        </small>

                    </div>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>

                </div>


                <form
                    action="{{ route('departments.store') }}"
                    method="POST"
                    autocomplete="off"
                >

                    @csrf


                    <div class="modal-body">


                        {{-- =================================================
                            DEPARTMENT NAME
                        ================================================== --}}

                        <div class="mb-3">

                            <label
                                for="department_name"
                                class="form-label"
                            >

                                Department Name

                                <span class="text-danger">
                                *
                            </span>

                            </label>


                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="department_name"
                                name="name"
                                placeholder="Enter department name"
                                value="{{ old('name') }}"
                                minlength="3"
                                maxlength="255"
                                required
                                autocomplete="off"
                            >


                            @error('name')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                            @enderror

                        </div>

                    </div>


                    {{-- =================================================
                        MODAL FOOTER
                    ================================================== --}}

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
                            class="btn btn-primary btn-square"
                        >

                            <i class="bi bi-check-lg me-1"></i>

                            Save Department

                        </button>

                    </div>

                </form>

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

        .department-card {

            border-radius: 0 !important;

            border: 1px solid #dee2e6;

        }


        /* =========================================================
           GLOBAL BUTTON / INPUT
        ========================================================== */

        .btn,
        .form-control,
        .form-select,
        .badge,
        .modal-content {

            border-radius: 0 !important;

        }


        .btn-square {

            border-radius: 0 !important;

        }


        /* =========================================================
           TABLE WRAPPER
        ========================================================== */

        .department-table-wrapper {

            width: 100%;

            overflow-x: auto;

            overflow-y: hidden;

            -webkit-overflow-scrolling: touch;

        }


        /* =========================================================
           TABLE
        ========================================================== */

        #departmentsTable {

            width: 100% !important;

            min-width: 1000px;

            margin: 0 !important;

            font-size: 14px;

            border-collapse: collapse;

        }


        #departmentsTable thead th {

            white-space: nowrap;

            vertical-align: middle;

            font-weight: 600;

            background: #f8f9fa;

            color: #212529;

            padding: 11px 10px;

        }


        #departmentsTable tbody td {

            vertical-align: middle;

            padding: 10px;

        }


        #departmentsTable tbody tr {

            min-height: 60px;

        }


        /* =========================================================
           DEPARTMENT AVATAR
        ========================================================== */

        .department-avatar {

            width: 42px;

            height: 42px;

            min-width: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f1f1f1;

            color: #6c757d;

            border: 1px solid #dee2e6;

            font-size: 19px;

        }


        /* =========================================================
           DEPARTMENT NAME
        ========================================================== */

        .department-name {

            max-width: 260px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        /* =========================================================
           SECTION
        ========================================================== */

        .section-item {

            padding: 5px 0;

            border-bottom: 1px solid #f1f1f1;

        }


        .section-item:last-child {

            border-bottom: none;

        }


        .section-name {

            font-weight: 600;

            color: #212529;

        }


        .section-code {

            color: #6c757d;

            font-size: 11px;

        }


        /* =========================================================
           JOB TITLE
        ========================================================== */

        .job-title-item {

            padding: 5px 0;

            border-bottom: 1px solid #f1f1f1;

        }


        .job-title-item:last-child {

            border-bottom: none;

        }


        .job-title-name {

            font-weight: 500;

            color: #343a40;

        }


        .job-title-code {

            color: #6c757d;

            font-size: 11px;

        }


        .job-title-empty {

            padding: 5px 0;

        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .department-actions {

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

            justify-content: space-between;

            gap: 15px;

            margin-bottom: 15px;

        }


        /* =========================================================
           SEARCH
        ========================================================== */

        .datatable-search {

            flex: 1;

            display: flex;

            align-items: center;

            justify-content: flex-start;

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

            border-color: #86b7fe;

            box-shadow:
                0 0 0 0.15rem rgba(13, 110, 253, .15);

        }


        /* =========================================================
           DATATABLE LENGTH
        ========================================================== */

        .datatable-length {

            display: flex;

            align-items: center;

        }


        .datatable-length label {

            margin: 0;

            display: flex;

            align-items: center;

            gap: 8px;

            font-weight: 500;

            white-space: nowrap;

        }


        .datatable-length select {

            min-width: 75px;

            height: 38px;

            padding: 5px 30px 5px 10px;

            border: 1px solid #ced4da;

            border-radius: 0 !important;

            background-color: #fff;

        }


        .datatable-length select:focus {

            border-color: #86b7fe;

            box-shadow:
                0 0 0 0.15rem rgba(13, 110, 253, .15);

            outline: none;

        }


        /* =========================================================
           DATATABLE BUTTONS
        ========================================================== */

        .datatable-buttons {

            display: flex;

            align-items: center;

            justify-content: flex-end;

            flex-wrap: wrap;

            gap: 4px;

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
           DATATABLE TABLE AREA
        ========================================================== */

        .datatable-table {

            width: 100%;

        }


        /* =========================================================
           DATATABLE BOTTOM
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
           EMPTY
        ========================================================== */

        .empty-departments {

            padding: 20px;

        }


        /* =========================================================
           MODAL
        ========================================================== */

        .modal-header {

            border-bottom: 0;

        }


        .modal-footer {

            border-top: 1px solid #dee2e6;

        }


        .form-label {

            font-weight: 600;

            margin-bottom: 6px;

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 768px) {

            .datatable-top {

                flex-direction: column;

                align-items: stretch;

                gap: 10px;

            }


            .datatable-search {

                width: 100%;

            }


            .datatable-search label {

                width: 100%;

            }


            .datatable-search input {

                width: 100%;

                flex: 1;

            }


            .datatable-length {

                width: 100%;

            }


            .datatable-length label {

                width: 100%;

                justify-content: flex-start;

            }


            .datatable-buttons {

                width: 100%;

                justify-content: flex-start;

                overflow-x: auto;

                padding-bottom: 2px;

            }


            .datatable-buttons .dt-button {

                white-space: nowrap;

            }


            .datatable-bottom {

                flex-direction: column;

                align-items: flex-start;

            }


            .datatable-pagination {

                width: 100%;

                justify-content: flex-start;

            }


            #departmentsTable {

                min-width: 1000px;

                font-size: 13px;

            }


            #departmentsTable tbody td {

                padding: 8px;

            }

        }

    </style>


    {{-- =========================================================
        DATATABLE
    ========================================================== --}}

    @push('scripts')

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                $('#departmentsTable').DataTable({

                    /*
                    |--------------------------------------------------------------------------
                    | TABLE
                    |--------------------------------------------------------------------------
                    */

                    responsive: false,

                    autoWidth: false,


                    /*
                    |--------------------------------------------------------------------------
                    | PAGINATION
                    |--------------------------------------------------------------------------
                    */

                    pageLength: {{ PerPage::FIVE->value }},

                    lengthMenu: [

                        @json($perPageValues),

                        @json($perPageLabels)

                    ],


                    /*
                    |--------------------------------------------------------------------------
                    | DEFAULT ORDER
                    |--------------------------------------------------------------------------
                    */

                    order: [

                        [1, 'asc']

                    ],


                    /*
                    |--------------------------------------------------------------------------
                    | LANGUAGE
                    |--------------------------------------------------------------------------
                    */

                    language: {

                        search: 'Search:',

                        searchPlaceholder: '',

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

                            first: 'First',

                            last: 'Last',

                            next: 'Next',

                            previous: 'Previous'

                        }

                    },


                    /*
                    |--------------------------------------------------------------------------
                    | DATATABLE LAYOUT
                    |--------------------------------------------------------------------------
                    */

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


                    /*
                    |--------------------------------------------------------------------------
                    | EXPORT BUTTONS
                    |--------------------------------------------------------------------------
                    */

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
                                'Department List',

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
                                'Department List',

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
                                'Department List',

                            exportOptions: {

                                columns: ':not(:last-child)'

                            }

                        }

                    ],


                    /*
                    |--------------------------------------------------------------------------
                    | COLUMNS
                    |--------------------------------------------------------------------------
                    */

                    columnDefs: [

                        {

                            targets: 0,

                            searchable: false,

                            orderable: false,

                            width: '50px'

                        },


                        {

                            targets: 4,

                            searchable: false,

                            orderable: false,

                            width: '110px'

                        }

                    ]

                });

            });


            /*
            |--------------------------------------------------------------------------
            | DELETE CONFIRMATION
            |--------------------------------------------------------------------------
            */

            function confirmDelete(button)
            {

                const confirmed = confirm(
                    'Are you sure you want to delete this department?'
                );


                if (confirmed) {

                    button
                        .closest('form')
                        .submit();

                }

            }

        </script>

    @endpush


    {{-- =========================================================
        REOPEN MODAL AFTER VALIDATION ERROR
    ========================================================== --}}

    @if($errors->has('name'))

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                const modalElement =
                    document.getElementById('createDepartmentModal');


                if (modalElement) {

                    const modal =
                        new bootstrap.Modal(modalElement);

                    modal.show();

                }

            });

        </script>

    @endif


@endsection
