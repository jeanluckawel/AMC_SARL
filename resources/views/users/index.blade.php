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
                        Users
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
                            Users
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

            <div class="card shadow-sm user-card">

                <div class="card-body">

                    {{-- =================================================
                        TABLE WRAPPER
                    ================================================== --}}
                    <div class="user-table-wrapper">

                        <table
                            id="usersTable"
                            class="table table-bordered table-hover align-middle"
                        >

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>


                            <tbody>

                            @forelse($users as $user)

                                <tr>

                                    {{-- NUMBER --}}
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- USER --}}
                                    <td>

                                        <div class="d-flex align-items-center">

                                            {{-- AVATAR --}}
                                            <div class="user-avatar user-avatar-default me-2">
                                                <i class="bi bi-person-fill"></i>
                                            </div>


                                            {{-- USER INFO --}}
                                            <div class="user-info">

                                                <div class="fw-semibold user-name">
                                                    {{ $user->name }}
                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- EMAIL --}}
                                    <td>
                                        {{ $user->email }}
                                    </td>


                                    {{-- ROLE --}}
                                    <td>

                                        @forelse($user->roles as $role)

                                            <span class="badge user-role-badge">
                                                {{ $role->name }}
                                            </span>

                                        @empty

                                            <span class="text-muted">
                                                No role
                                            </span>

                                        @endforelse

                                    </td>


                                    {{-- CREATED DATE --}}
                                    <td
                                        data-order="{{ $user->created_at?->format('Y-m-d H:i:s') }}"
                                    >
                                        {{ $user->created_at?->format('d/m/Y') ?? '-' }}
                                    </td>


                                    {{-- ACTIONS --}}
                                    <td>

                                        <div class="user-actions">

                                            {{-- VIEW --}}
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-info action-btn"
                                                title="View User"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a>


                                            {{-- EDIT --}}
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-warning action-btn"
                                                title="Edit User"
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
                                                    title="Delete User"
                                                    onclick="confirmDelete(this)"
                                                >
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- EMPTY --}}
                                <tr>

                                    <td
                                        colspan="6"
                                        class="text-center py-5"
                                    >

                                        <div class="empty-users">

                                            <i class="bi bi-people fs-1 text-muted"></i>

                                            <div class="mt-2 fw-semibold">
                                                No users found
                                            </div>

                                            <small class="text-muted">
                                                Start by adding your first user.
                                            </small>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

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

        .user-card {
            border-radius: 0 !important;
            border: 1px solid #dee2e6;
        }


        /* =========================================================
           TABLE WRAPPER
        ========================================================== */

        .user-table-wrapper {
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }


        /* =========================================================
           TABLE
        ========================================================== */

        #usersTable {
            width: 100% !important;
            min-width: 900px;
            margin: 0 !important;
            font-size: 14px;
            border-collapse: collapse;
        }


        #usersTable thead th {
            white-space: nowrap;
            vertical-align: middle;
            font-weight: 600;
            background: #f8f9fa;
            color: #212529;
            padding: 11px 10px;
        }


        #usersTable tbody td {
            vertical-align: middle;
            padding: 10px;
            white-space: nowrap;
        }


        #usersTable tbody tr {
            height: 60px;
        }


        /* =========================================================
           USER AVATAR
        ========================================================== */

        .user-avatar {
            width: 42px;
            height: 42px;
            min-width: 42px;
            object-fit: cover;
            border-radius: 0;
            border: 1px solid #dee2e6;
        }


        .user-avatar-default {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f1f1;
            color: #777;
            font-size: 20px;
        }


        .user-name {
            max-width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        /* =========================================================
           ROLE BADGE
        ========================================================== */

        .user-role-badge {
            background: #FF6600 !important;
            color: #fff;
            border-radius: 0 !important;
            padding: 6px 9px;
            font-weight: 500;
            margin-right: 3px;
        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .user-actions {
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
            box-shadow: 0 0 0 0.15rem rgba(255, 102, 0, .15);
        }


        /* =========================================================
           ADD USER
        ========================================================== */

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
           EMPTY
        ========================================================== */

        .empty-users {
            padding: 20px;
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

            /* Header */

            .app-content-header .row {
                row-gap: 8px;
            }


            .app-content-header .breadcrumb {
                float: none !important;
                justify-content: flex-start;
            }


            /* Datatable top */

            .datatable-top {
                display: grid;
                grid-template-columns: 1fr auto;
                gap: 10px;
                align-items: center;
            }


            /* Search */

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


            /* Add button */

            .datatable-add {
                width: auto;
            }


            .datatable-add .btn {
                width: auto;
                padding-left: 10px;
                padding-right: 10px;
            }


            /* Length */

            .datatable-length {
                width: 100%;
                margin-left: 0;
            }


            /* Export buttons */

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


            /* Bottom */

            .datatable-bottom {
                flex-direction: column;
                align-items: flex-start;
            }


            .datatable-pagination {
                width: 100%;
                justify-content: flex-start;
                overflow-x: auto;
            }


            /* Table */

            #usersTable {
                min-width: 900px;
                font-size: 13px;
            }


            #usersTable tbody td {
                padding: 8px;
            }


            /* Card */

            .user-card .card-body {
                padding: 10px;
            }

        }


        /* =========================================================
           VERY SMALL MOBILE
        ========================================================== */

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

                $('#usersTable').DataTable({

                    responsive: false,

                    autoWidth: false,


                    /* =====================================================
                       PAGINATION
                    ===================================================== */

                    pageLength: {{ PerPage::FIVE->value }},

                    lengthMenu: [

                        @json($perPageValues),

                        @json($perPageLabels)

                    ],


                    /* =====================================================
                       DEFAULT ORDER
                    ===================================================== */

                    order: [
                        [1, 'asc']
                    ],


                    /* =====================================================
                       LANGUAGE
                    ===================================================== */

                    language: {

                        search: 'Search:',

                        searchPlaceholder: 'Search user...',

                        lengthMenu: 'Show _MENU_ users',

                        info:
                            'Showing _START_ to _END_ of _TOTAL_ users',

                        infoEmpty:
                            'No users available',

                        infoFiltered:
                            '(filtered from _MAX_ total users)',

                        zeroRecords:
                            'No matching users found',

                        emptyTable:
                            'No users found',

                        paginate: {

                            first: 'First',

                            last: 'Last',

                            next: 'Next',

                            previous: 'Previous'

                        }

                    },


                    /* =====================================================
                       LAYOUT
                    ===================================================== */

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


                    /* =====================================================
                       EXPORT BUTTONS
                    ===================================================== */

                    buttons: [

                        {
                            extend: 'copy',

                            text:
                                '<i class="bi bi-copy me-1"></i> Copy',

                            className:
                                'btn btn-secondary'
                        },


                        {
                            extend: 'excel',

                            text:
                                '<i class="bi bi-file-earmark-excel me-1"></i> Excel',

                            className:
                                'btn btn-success',

                            title:
                                'User List',

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
                                'User List',

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
                                'User List',

                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        }

                    ],


                    /* =====================================================
                       COLUMNS
                    ===================================================== */

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

                            orderable: true,

                            width: '110px'
                        },


                        {
                            targets: 5,

                            searchable: false,

                            orderable: false,

                            width: '120px'
                        }

                    ]

                });


                /* =========================================================
                   ADD USER BUTTON
                ========================================================= */

                const addUserContainer =
                    document.querySelector('.datatable-add');


                if (addUserContainer) {

                    addUserContainer.innerHTML = `

                        <a
                            {{--href="{{ route('users.create') }}"--}}
                            class="btn btn-primary"
                            title="Add User"
                        >

                            <i class="bi bi-person-plus me-1"></i>

                            Add User

                        </a>

                    `;

                }

            });


            /* =============================================================
               DELETE CONFIRMATION
            ============================================================= */

            function confirmDelete(button)
            {

                const confirmed = confirm(
                    'Are you sure you want to delete this user?'
                );


                if (confirmed) {

                    button
                        .closest('form')
                        .submit();

                }

            }

        </script>

    @endpush


@endsection
