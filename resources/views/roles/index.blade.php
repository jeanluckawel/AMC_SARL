@extends('layouts.admin')

@section('content')

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">
                    <h3 class="mb-0">Roles</h3>
                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-end">

                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                Home
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Roles
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

            <div class="card shadow-sm role-card">

                <div class="card-body">

                    <div class="role-table-wrapper">

                        <table
                            id="rolesTable"
                            class="table table-bordered table-hover align-middle"
                            style="width:100%"
                        >

                            <thead>

                            <tr>

                                <th>#</th>

                                <th>Role</th>

                                <th>Permissions</th>

                                <th>Total Permissions</th>

                                <th>Actions</th>

                            </tr>

                            </thead>


                            <tbody>

                            @foreach($roles as $role)

                                <tr>

                                    {{-- # --}}
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- ROLE --}}
                                    <td>

                                        <div class="role-wrapper">



                                            <div class="role-info">

                                                <div class="role-name">
                                                    {{ $role->name }}
                                                </div>


                                            </div>

                                        </div>

                                    </td>





                                    {{-- PERMISSIONS --}}
                                    <td>

                                        @forelse($role->permissions->sortBy('name') as $permission)

                                            <span class="permission-badge">
                                                    {{ $permission->name }}
                                                </span>

                                        @empty

                                            <span class="text-muted">
                                                    No permissions
                                                </span>

                                        @endforelse

                                    </td>


                                    {{-- TOTAL --}}
                                    <td>

                                            <span class="permission-total">
                                                {{ $role->permissions->count() }}
                                            </span>

                                    </td>


                                    {{-- ACTIONS --}}
                                    <td>

                                        <div class="action-buttons">

                                            {{-- VIEW --}}
                                            <a
{{--                                                href="{{ route('roles.show', $role->id) }}"--}}
                                                class="btn btn-sm btn-info action-btn"
                                                title="View Role"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a>


                                            {{-- EDIT --}}
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-warning action-btn"
                                                title="Edit Role"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </a>


                                            {{-- DELETE --}}
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger action-btn"
                                                title="Delete Role"
                                                onclick="confirmDelete({{ $role->id }}, '{{ addslashes($role->name) }}')"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                            <form
                                                id="delete-role-{{ $role->id }}"
                                                action="#"
                                                method="POST"
                                                style="display:none;"
                                            >
                                                @csrf
                                                @method('DELETE')
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
        CSS
    ========================================================== --}}
    <style>

        /* =========================================================
           CARD
        ========================================================== */

        .role-card {
            border-radius: 0 !important;
            border: 1px solid #dee2e6;
        }


        /* =========================================================
           TABLE WRAPPER
        ========================================================== */

        .role-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }


        #rolesTable {
            min-width: 1150px;
            font-size: 14px;
        }


        #rolesTable th {
            background: #f8f9fa;
            padding: 11px 10px;
            white-space: nowrap;
            vertical-align: middle;
        }


        #rolesTable tbody td {
            padding: 10px;
            height: 60px;
            vertical-align: middle;
        }


        /* =========================================================
           ROLE
        ========================================================== */

        .role-wrapper {
            display: flex;
            align-items: center;
            min-width: 170px;
        }


        .role-avatar {
            width: 42px;
            height: 42px;
            min-width: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #f1f1f1;
            border: 1px solid #dee2e6;

            font-size: 18px;
            color: #555;
        }


        .role-info {
            margin-left: 10px;
        }


        .role-name {
            font-weight: 600;
            color: #212529;
        }


        /* =========================================================
           GUARD
        ========================================================== */

        .guard-badge {
            display: inline-block;

            background: #6c757d;
            color: #fff;

            padding: 5px 9px;

            font-size: 12px;
            font-weight: 500;

            border-radius: 0;
        }


        /* =========================================================
           PERMISSIONS
        ========================================================== */

        .permission-badge {
            display: inline-block;

            background: #FF6600;
            color: #fff;

            padding: 5px 8px;
            margin: 2px 3px 2px 0;

            font-size: 11px;
            font-weight: 500;

            border-radius: 0;

            white-space: nowrap;
        }


        .permission-total {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 34px;
            height: 30px;

            background: #FF6600;
            color: #fff;

            padding: 0 8px;

            font-size: 13px;
            font-weight: 600;

            border-radius: 0;
        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 5px;
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
            display: flex;
            align-items: center;

            gap: 10px;

            margin-bottom: 15px;
        }


        .datatable-search {
            flex: 1;
        }


        .datatable-search .dataTables_filter {
            margin: 0;
        }


        .datatable-search .dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }


        .datatable-search .dataTables_filter input {
            margin-left: 0 !important;
            height: 38px;
            min-width: 220px;

            border: 1px solid #ced4da;
            border-radius: 0;

            padding: 6px 10px;
        }


        .datatable-search .dataTables_filter input:focus {
            outline: none;
            box-shadow: none;
            border-color: #999;
        }


        /* =========================================================
           ADD BUTTON
        ========================================================== */

        .datatable-add {
            display: flex;
            align-items: center;
        }


        .datatable-add .btn {
            height: 38px;
            border-radius: 0 !important;
        }


        /* =========================================================
           LENGTH
        ========================================================== */

        .datatable-length {
            display: flex;
            align-items: center;
        }


        .datatable-length .dataTables_length {
            margin: 0;
        }


        .datatable-length select {
            height: 38px;
            border: 1px solid #ced4da;
            border-radius: 0;
            margin: 0 5px;
            padding: 4px 25px 4px 8px;
        }


        /* =========================================================
           BUTTONS
        ========================================================== */

        .datatable-buttons {
            display: flex;
            align-items: center;
        }


        .datatable-buttons .dt-buttons {
            display: flex;
            gap: 4px;
        }


        .datatable-buttons button {
            height: 38px;

            border-radius: 0 !important;

            border: 1px solid #ced4da;

            background: #fff;

            padding: 5px 10px;
        }


        .datatable-buttons button:hover {
            background: #f8f9fa;
        }


        /* =========================================================
           DATATABLE BOTTOM
        ========================================================== */

        .datatable-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-top: 15px;
        }


        .datatable-info {
            color: #6c757d;
            font-size: 13px;
        }


        .datatable-pagination .dataTables_paginate {
            margin: 0;
        }


        .datatable-pagination .paginate_button {
            border-radius: 0 !important;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1100px) {

            .datatable-top {
                flex-wrap: wrap;
            }

            .datatable-search {
                width: 100%;
                flex: 100%;
            }

            .datatable-search .dataTables_filter input {
                width: 100%;
            }

        }


        @media (max-width: 768px) {

            .role-table-wrapper {
                overflow-x: auto;
            }


            .datatable-top {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 8px;
            }


            .datatable-search {
                grid-column: 1 / -1;
            }


            .datatable-add {
                justify-content: flex-start;
            }


            .datatable-length {
                justify-content: flex-end;
            }


            .datatable-buttons {
                grid-column: 1 / -1;
            }


            .datatable-buttons .dt-buttons {
                width: 100%;
                overflow-x: auto;
            }


            .datatable-buttons button {
                white-space: nowrap;
            }


            .datatable-bottom {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

        }


        @media (max-width: 480px) {

            .datatable-top {
                grid-template-columns: 1fr;
            }


            .datatable-search,
            .datatable-add,
            .datatable-length,
            .datatable-buttons {
                grid-column: auto;
            }


            .datatable-length {
                justify-content: flex-start;
            }


            .datatable-add .btn {
                width: 100%;
            }


            .datatable-buttons .dt-buttons {
                width: 100%;
            }

        }

    </style>


    {{-- =========================================================
        JAVASCRIPT
    ========================================================== --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const table = $('#rolesTable').DataTable({

                pageLength: {{ \App\Enums\PerPage::FIVE->value }},

                lengthMenu: [
                    @json($perPageValues),
                    @json($perPageLabels)
                ],

                order: [
                    [1, 'asc']
                ],

                responsive: false,

                autoWidth: false,

                language: {

                    search: 'Search:',

                    searchPlaceholder: 'Search role...',

                    lengthMenu: 'Show _MENU_ roles',

                    info: 'Showing _START_ to _END_ of _TOTAL_ roles',

                    infoEmpty: 'Showing 0 to 0 of 0 roles',

                    infoFiltered: '(filtered from _MAX_ total roles)',

                    zeroRecords: 'No matching roles found',

                    emptyTable: 'No roles available',

                    paginate: {
                        first: 'First',
                        last: 'Last',
                        next: 'Next',
                        previous: 'Previous'
                    }

                },

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

                buttons: [

                    {
                        extend: 'copy',
                        text: '<i class="bi bi-copy"></i> Copy',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },

                    {
                        extend: 'excel',
                        text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },

                    {
                        extend: 'pdf',
                        text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },

                    {
                        extend: 'print',
                        text: '<i class="bi bi-printer"></i> Print',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    }

                ]

            });


            // =====================================================
            // ADD ROLE BUTTON
            // =====================================================

            $('.datatable-add').html(`
                <a
                    {{--href="{{ route('roles.create') }}"--}}
                    class="btn btn-primary btn-sm"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Add Role
                </a>
            `);

        });


        // =========================================================
        // DELETE CONFIRMATION
        // =========================================================

        function confirmDelete(roleId, roleName)
        {
            if (confirm(
                'Are you sure you want to delete the role "' +
                roleName +
                '"?'
            )) {

                document
                    .getElementById('delete-role-' + roleId)
                    .submit();

            }
        }

    </script>

@endsection
