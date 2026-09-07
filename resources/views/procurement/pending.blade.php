
@extends('layouts.admin')

@section('content')

    @php
        use App\Enums\PerPage;
        use App\Enums\RequestStatus;
    @endphp


    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6 col-12">

                    <h3 class="mb-0">
                        Pending Validation
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
                            Procurement
                        </li>

                        <li class="breadcrumb-item active">
                            Pending Validation
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
                 REQUEST CARD
            ================================================== --}}

            <div class="card shadow-sm request-card">

                <div class="card-header bg-white">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="mb-0">
                                Requests Pending Procurement
                            </h5>

                            <small class="text-muted">
                                Requests waiting for Procurement validation
                            </small>

                        </div>


                        <span class="badge pending-count">

                        {{ $requests->count() }}

                            {{ $requests->count() === 1 ? 'Request' : 'Requests' }}

                    </span>

                    </div>

                </div>


                <div class="card-body">

                    <div class="request-table-wrapper">

                        <table
                            id="procurementTable"
                            class="table table-bordered table-hover align-middle"
                        >

                            <thead>

                            <tr>

                                <th>
                                    #
                                </th>

                                <th>
                                    Reference
                                </th>

                                <th>
                                    Title
                                </th>

                                <th>
                                    Requester
                                </th>

                                <th>
                                    Items
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Created Date
                                </th>

                                <th class="text-center">
                                    Actions
                                </th>

                            </tr>

                            </thead>


                            <tbody>

                            @forelse($requests as $request)

                                <tr>


                                    {{-- NUMBER --}}

                                    <td class="text-center">

                                        {{ $loop->iteration }}

                                    </td>


                                    {{-- REFERENCE --}}

                                    <td>

                                        <span class="fw-semibold request-reference">

                                            {{ $request->reference }}

                                        </span>

                                    </td>


                                    {{-- TITLE --}}

                                    <td>

                                        <div class="fw-semibold">

                                            {{ $request->title }}

                                        </div>

                                        @if($request->description)

                                            <small class="text-muted">

                                                {{ Str::limit(
                                                    $request->description,
                                                    80
                                                ) }}

                                            </small>

                                        @endif

                                    </td>


                                    {{-- REQUESTER --}}

                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div class="request-avatar me-2">

                                                <i class="bi bi-person-fill"></i>

                                            </div>

                                            <div>

                                                <div class="fw-semibold">

                                                    {{ $request->requester?->name ?? 'Unknown' }}

                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- ITEMS --}}

                                    <td class="text-center">

                                        <span class="badge items-badge">

                                            {{ $request->items->count() }}

                                        </span>

                                    </td>


                                    {{-- STATUS --}}

                                    <td>

                                        @if(
                                            $request->status ===
                                            RequestStatus::PENDING_PROCUREMENT
                                        )

                                            <span class="badge status-badge status-procurement">

                                                <i class="bi bi-hourglass-split me-1"></i>

                                                Pending Procurement

                                            </span>

                                        @else

                                            <span class="badge status-badge">

                                                {{ $request->status->label() ?? $request->status->value }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- CREATED DATE --}}

                                    <td>

                                        <div class="fw-semibold">

                                            {{ $request->created_at?->format('d/m/Y') }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $request->created_at?->format('H:i') }}

                                        </small>

                                    </td>


                                    {{-- ACTIONS --}}

                                    <td class="text-center">

                                        <div class="request-actions">


                                            {{-- VIEW --}}

                                            <a
                                                href="{{ route(
                                                    'requests.show',
                                                    $request
                                                ) }}"
                                                class="btn btn-sm btn-info action-btn"
                                                title="View Request"
                                            >

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- VALIDATE --}}

                                            <a
                                                href="{{ route(
                                                    'procurement.requests.process',
                                                    $request
                                                ) }}"
                                                class="btn btn-sm btn-success action-btn"
                                                title="Validate Request"
                                            >

                                                <i class="bi bi-check-lg"></i>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="8"
                                        class="text-center py-5"
                                    >

                                        <div class="empty-state">

                                            <div class="empty-icon">

                                                <i class="bi bi-check2-circle"></i>

                                            </div>

                                            <h5 class="mb-1">
                                                No Pending Requests
                                            </h5>

                                            <p class="text-muted mb-0">

                                                There are currently no requests
                                                waiting for Procurement validation.

                                            </p>

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
         STYLE
    ========================================================== --}}

    <style>

        .request-card {
            border-radius: 0 !important;
            border: 1px solid #dee2e6;
        }


        .request-card .card-header {
            border-bottom: 1px solid #dee2e6;
            padding: 14px 16px;
        }


        .request-table-wrapper {
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }


        #procurementTable {
            width: 100% !important;
            min-width: 1150px;
            margin: 0 !important;
            font-size: 14px;
            border-collapse: collapse;
        }


        #procurementTable thead th {
            white-space: nowrap;
            vertical-align: middle;
            font-weight: 600;
            background: #f8f9fa;
            color: #212529;
            padding: 11px 10px;
        }


        #procurementTable tbody td {
            vertical-align: middle;
            padding: 10px;
        }


        .request-reference {
            white-space: nowrap;
        }


        .request-avatar {
            width: 36px;
            height: 36px;
            min-width: 36px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #f1f1f1;
            color: #777;

            border: 1px solid #dee2e6;
            border-radius: 0;

            font-size: 17px;
        }


        .status-badge {
            border-radius: 0 !important;
            padding: 6px 9px;
            font-weight: 500;
            white-space: nowrap;
        }


        .status-procurement {
            background: #0dcaf0 !important;
            color: #212529;
        }


        .items-badge {
            background: #6c757d !important;
            color: #fff;
            border-radius: 0 !important;
            min-width: 28px;
            padding: 5px 7px;
        }


        .pending-count {
            background: #0dcaf0 !important;
            color: #212529;
            border-radius: 0 !important;
            padding: 7px 10px;
        }


        .request-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 4px;
        }


        .action-btn {
            width: 34px;
            height: 34px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 0 !important;
        }


        .action-btn:focus,
        .action-btn:active {
            box-shadow:
                0 0 0 0.15rem
                rgba(255, 102, 0, .15) !important;
        }


        .empty-state {
            padding: 25px;
        }


        .empty-icon {
            width: 55px;
            height: 55px;

            margin: 0 auto 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #dee2e6;
            background: #f8f9fa;

            font-size: 25px;
            color: #6c757d;
        }


        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border-radius: 0 !important;
        }


        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: #FF6600;
            box-shadow:
                0 0 0 0.15rem
                rgba(255, 102, 0, .15);
        }


        .dt-buttons .btn {
            border-radius: 0 !important;
        }


        @media (max-width: 768px) {

            .request-card .card-body {
                padding: 10px;
            }


            #procurementTable {
                min-width: 1150px;
                font-size: 13px;
            }


            #procurementTable tbody td {
                padding: 8px;
            }


            .app-content-header .row {
                row-gap: 8px;
            }


            .app-content-header .breadcrumb {
                float: none !important;
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

                    if (
                        typeof $ !== 'undefined' &&
                        $.fn.DataTable
                    ) {

                        $('#procurementTable').DataTable({

                            pageLength:
                                {{ PerPage::FIVE->value }},

                            lengthMenu: [
                                [5, 10, 25, 50, -1],
                                [5, 10, 25, 50, 'All']
                            ],

                            responsive: false,

                            autoWidth: false,

                            order: [
                                [6, 'desc']
                            ],

                            columnDefs: [
                                {
                                    orderable: false,
                                    searchable: false,
                                    targets: [0, 7]
                                }
                            ],

                            dom:
                                '<"row mb-2"' +
                                '<"col-md-6"B>' +
                                '<"col-md-6"f>' +
                                '>' +
                                'rt' +
                                '<"row mt-2"' +
                                '<"col-md-6"l>' +
                                '<"col-md-6"p>' +
                                '>',

                            buttons: [
                                'copy',
                                'excel',
                                'pdf',
                                'print'
                            ],

                            language: {

                                search: 'Search:',

                                lengthMenu:
                                    'Show _MENU_ entries',

                                info:
                                    'Showing _START_ to _END_ of _TOTAL_ requests',

                                infoEmpty:
                                    'No requests available',

                                zeroRecords:
                                    'No matching requests found',

                                paginate: {
                                    previous: 'Previous',
                                    next: 'Next'
                                }

                            }

                        });

                    }

                }

            );

        </script>

    @endpush

@endsection
