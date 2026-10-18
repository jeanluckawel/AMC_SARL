@extends('layouts.admin')

@section('content')

    @php
        use App\Enums\PerPage;

        $perPageValues = PerPage::values();
        $perPageLabels = [...$perPageValues, 'All'];
    @endphp




    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">

                <div class="col-md-6 col-12">
                    <h3 class="mb-0">Employees</h3>
                </div>

                <div class="col-md-6 col-12">
                    <ol class="breadcrumb float-md-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Employees</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>



    <div class="app-content">
        <div class="container-fluid">

            <div class="card shadow-sm employee-card">
                <div class="card-body">

                    <div class="employee-table-wrapper">

                        <table id="employeesTable" class="table table-bordered table-hover align-middle">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Matricule</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Department</th>
                                <th>Job Title</th>
                                <th>Contract</th>
                                <th>Hire Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>



                            <tbody>

                            @foreach($employees as $employee)

                                @php
                                    $fullName = trim(
                                        $employee->first_name . ' ' .
                                        $employee->middle_name . ' ' .
                                        $employee->last_name
                                    );
                                @endphp

                                <tr>


                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>



                                    <td>
                                        <div class="d-flex align-items-center">

                                            @if($employee->photo)
                                                <img
                                                    src="{{ asset('storage/' . $employee->photo) }}"
                                                    alt="{{ $employee->first_name }}"
                                                    class="employee-avatar me-2"
                                                >
                                            @else
                                                <div class="employee-avatar employee-avatar-default me-2">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                            @endif

                                            <div class="employee-info">
                                                <div class="fw-semibold employee-name">
                                                    {{ $employee->first_name }}
                                                    @if($employee->middle_name)
                                                        {{ $employee->middle_name }}
                                                    @endif
                                                    {{ $employee->last_name }}
                                                </div>
                                            </div>

                                        </div>
                                    </td>



                                    <td>
                                        <span class="fw-semibold">
                                            {{ $employee->employee_id ?? '-' }}
                                        </span>
                                    </td>



                                    <td>
                                        {{ $employee->gender?->value ?? '-' }}
                                    </td>



                                    <td>
                                        {{ $employee->employee_phone ?? '-' }}
                                    </td>



                                    <td>
                                        {{ $employee->department?->name ?? '-' }}
                                    </td>



                                    <td>
                                        {{ $employee->jobTitle?->name ?? '-' }}
                                    </td>



                                    <td>
                                        @if($employee->contract_type)
                                            <span class="badge employee-badge">
                                                {{ $employee->contract_type->value }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>



                                    <td data-order="{{ $employee->created_at?->format('Y-m-d H:i:s') }}">
                                        {{ $employee->created_at?->format('d/m/Y') ?? '-' }}
                                    </td>



                                    <td>
                                        <div class="employee-actions">


                                            <a
                                                href="{{ route('employees.profile', $employee->id) }}"
                                                class="btn btn-sm btn-info action-btn"
                                                title="View Employee"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a>


                                            <a
                                                href="{{ route('employees.edit', $employee) }}"
                                                class="btn btn-sm btn-warning action-btn"
                                                title="Edit Employee"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </a>


                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger action-btn"
                                                title="Delete Employee"
                                                aria-label="Delete Employee"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteEmployeeModal"
                                                data-action="{{ route('employees.destroy', $employee) }}"
                                                data-name="{{ $fullName }}"
                                                data-matricule="{{ $employee->employee_id }}"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

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



    <div
        class="modal fade"
        id="deleteEmployeeModal"
        tabindex="-1"
        aria-labelledby="deleteEmployeeModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:0;">

                <form id="deleteEmployeeForm" method="POST" action="">
                    @csrf
                    @method('DELETE')

                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title text-danger" id="deleteEmployeeModalLabel">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            Confirm deletion
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>

                    <div class="modal-body">
                        <p class="mb-1">Are you sure you want to delete this employee?</p>
                        <p class="mb-0 fw-bold">
                            <span id="deleteEmployeeName"></span>
                            <small class="text-muted fw-normal" id="deleteEmployeeMatricule"></small>
                        </p>
                    </div>

                    <div class="modal-footer border-0 pt-0">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            style="border-radius:0;"
                            data-bs-dismiss="modal"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="btn btn-danger"
                            style="border-radius:0;"
                            id="deleteEmployeeConfirm"
                        >
                            <span
                                class="spinner-border spinner-border-sm d-none"
                                id="deleteEmployeeSpinner"
                                aria-hidden="true"
                            ></span>
                            <span id="deleteEmployeeText">
                                <i class="bi bi-trash me-1"></i> Yes, delete
                            </span>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>



    <style>



        .employee-card {
            border-radius: 0 !important;
            border: 1px solid #dee2e6;
        }




        .employee-table-wrapper {
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }




        #employeesTable {
            width: 100% !important;
            min-width: 1050px;
            margin: 0 !important;
            font-size: 14px;
            border-collapse: collapse;
        }

        #employeesTable thead th {
            white-space: nowrap;
            vertical-align: middle;
            font-weight: 600;
            background: #f8f9fa;
            color: #212529;
            padding: 11px 10px;
        }

        #employeesTable tbody td {
            vertical-align: middle;
            padding: 10px;
            white-space: nowrap;
        }

        #employeesTable tbody tr {
            height: 60px;
        }




        .employee-avatar {
            width: 42px;
            height: 42px;
            min-width: 42px;
            object-fit: cover;
            border-radius: 0;
            border: 1px solid #dee2e6;
        }

        .employee-avatar-default {
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



        .employee-badge {
            background: #FF6600 !important;
            color: #fff;
            border-radius: 0 !important;
            padding: 6px 9px;
            font-weight: 500;
        }




        .employee-actions {
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
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .datatable-search input:focus {
            border-color: #FF6600;
            box-shadow: 0 0 0 0.15rem rgba(255, 102, 0, .15);
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

            #employeesTable {
                min-width: 1050px;
                font-size: 13px;
            }

            #employeesTable tbody td {
                padding: 8px;
            }

            .employee-card .card-body {
                padding: 10px;
            }

        }



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


    @push('scripts')

        <script>

            document.addEventListener('DOMContentLoaded', function () {




                $('#employeesTable').DataTable({

                    responsive: false,

                    autoWidth: false,



                    pageLength: {{ PerPage::FIVE->value }},

                    lengthMenu: [
                        @json($perPageValues),
                        @json($perPageLabels)
                    ],



                    order: [
                        [1, 'asc']
                    ],



                    language: {

                        search: 'Search:',

                        searchPlaceholder: 'Search employee...',

                        lengthMenu: 'Show _MENU_ employees',

                        info: 'Showing _START_ to _END_ of _TOTAL_ employees',

                        infoEmpty: 'No employees available',

                        infoFiltered: '(filtered from _MAX_ total employees)',

                        zeroRecords: 'No matching employees found',


                        emptyTable: 'No employees found',

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
                            text: '<i class="bi bi-copy me-1"></i> Copy',
                            className: 'btn btn-secondary',
                            exportOptions: { columns: ':not(:last-child)' }
                        },

                        {
                            extend: 'excel',
                            text: '<i class="bi bi-file-earmark-excel me-1"></i> Excel',
                            className: 'btn btn-success',
                            title: 'Employee List',
                            exportOptions: { columns: ':not(:last-child)' }
                        },

                        {
                            extend: 'pdf',
                            text: '<i class="bi bi-file-earmark-pdf me-1"></i> PDF',
                            className: 'btn btn-danger',
                            title: 'Employee List',
                            orientation: 'landscape',
                            pageSize: 'A4',
                            exportOptions: { columns: ':not(:last-child)' }
                        },

                        {
                            extend: 'print',
                            text: '<i class="bi bi-printer me-1"></i> Print',
                            className: 'btn btn-primary',
                            title: 'Employee List',
                            exportOptions: { columns: ':not(:last-child)' }
                        }

                    ],



                    columnDefs: [


                        {
                            targets: 0,
                            searchable: false,
                            orderable: false,
                            width: '50px'
                        },


                        {
                            targets: 8,
                            searchable: false,
                            orderable: true,
                            width: '110px'
                        },


                        {
                            targets: 9,
                            searchable: false,
                            orderable: false,
                            width: '100px'
                        }

                    ]

                });


                const addEmployeeContainer = document.querySelector('.datatable-add');

                if (addEmployeeContainer) {

                    addEmployeeContainer.innerHTML = `
                        <a
                            href="{{ route('employees.create') }}"
                            class="btn btn-primary"
                            title="Add Employee"
                        >
                            <i class="bi bi-person-plus me-1"></i>
                            Add Employee
                        </a>
                    `;

                }


                const deleteModal   = document.getElementById('deleteEmployeeModal');
                const deleteForm    = document.getElementById('deleteEmployeeForm');
                const deleteName    = document.getElementById('deleteEmployeeName');
                const deleteMat     = document.getElementById('deleteEmployeeMatricule');
                const deleteConfirm = document.getElementById('deleteEmployeeConfirm');
                const deleteSpinner = document.getElementById('deleteEmployeeSpinner');
                const deleteText    = document.getElementById('deleteEmployeeText');

                if (deleteModal && deleteForm) {

                    deleteModal.addEventListener('show.bs.modal', function (event) {

                        const button = event.relatedTarget;

                        if (!button) {
                            return;
                        }

                        deleteForm.action = button.dataset.action;

                        deleteName.textContent = button.dataset.name;

                        deleteMat.textContent = button.dataset.matricule
                            ? '(' + button.dataset.matricule + ')'
                            : '';


                        deleteConfirm.disabled = false;
                        deleteSpinner.classList.add('d-none');
                        deleteText.innerHTML = '<i class="bi bi-trash me-1"></i> Yes, delete';

                    });


                    deleteForm.addEventListener('submit', function () {

                        deleteConfirm.disabled = true;
                        deleteSpinner.classList.remove('d-none');
                        deleteText.textContent = 'Deleting...';

                    });

                }

            });

        </script>

    @endpush

@endsection
