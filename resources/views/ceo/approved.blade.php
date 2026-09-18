@extends('layouts.admin')

@section('content')

    @php
        use App\Enums\PerPage;
        use App\Enums\RequestStep as RequestStepEnum;
        use App\Enums\RequestDecision as RequestDecisionEnum;
    @endphp

    {{-- =============================================================
        HEADER
    ============================================================= --}}

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6 col-12">

                    <h3 class="mb-0">
                        CEO Approved Requests
                    </h3>

                </div>

                <div class="col-md-6 col-12">

                    <ol class="breadcrumb float-md-end mb-0">

                        <li class="breadcrumb-item">

                            <a href="{{ route('dashboard') }}">
                                Home
                            </a>

                        </li>

                        <li class="breadcrumb-item">
                            CEO
                        </li>

                        <li class="breadcrumb-item active">
                            Approved
                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </div>


    {{-- =============================================================
        CONTENT
    ============================================================= --}}

    <div class="app-content">

        <div class="container-fluid">


            {{-- =====================================================
                SUCCESS MESSAGE
            ====================================================== --}}

            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    <i class="bi bi-check-circle me-1"></i>

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                    ></button>

                </div>

            @endif


            {{-- =====================================================
                ERROR MESSAGE
            ====================================================== --}}

            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="bi bi-exclamation-triangle me-1"></i>

                    {{ session('error') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                    ></button>

                </div>

            @endif


            {{-- =====================================================
                CARD
            ====================================================== --}}

            <div class="card shadow-sm request-card">


                {{-- =================================================
                    CARD HEADER
                ================================================== --}}

                <div class="card-header bg-white">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="mb-0">
                                CEO Approved Requests
                            </h5>

                            <small class="text-muted">
                                Requests definitively approved by CEO
                            </small>

                        </div>

                        <span class="badge approved-count">

                            {{ $requests->count() }}

                            {{ $requests->count() === 1 ? 'Request' : 'Requests' }}

                        </span>

                    </div>

                </div>


                {{-- =================================================
                    CARD BODY
                ================================================== --}}

                <div class="card-body">

                    <div class="request-table-wrapper">

                        <table
                            id="ceoApprovedTable"
                            class="table table-bordered table-hover align-middle"
                        >

                            <thead>

                            <tr>

                                <th>#</th>

                                <th>Reference</th>

                                <th>Title</th>

                                <th>Requester</th>

                                <th>Items</th>

                                <th>Total Amount</th>

                                <th>CEO Approved Date</th>

                                <th class="text-center">
                                    Actions
                                </th>

                            </tr>

                            </thead>


                            <tbody>

                            @foreach($requests as $request)

                                @php

                                    $ceoStep = $request->steps
                                        ->where(
                                            'step',
                                            RequestStepEnum::CEO->value
                                        )
                                        ->where(
                                            'decision',
                                            RequestDecisionEnum::APPROVED->value
                                        )
                                        ->sortByDesc('processed_at')
                                        ->first();

                                @endphp

                                <tr>

                                    {{-- =================================================
                                        #
                                    ================================================== --}}

                                    <td class="text-center">

                                        {{ $loop->iteration }}

                                    </td>


                                    {{-- =================================================
                                        REFERENCE
                                    ================================================== --}}

                                    <td>

                                        <span class="fw-semibold request-reference">

                                            {{ $request->reference ?? '—' }}

                                        </span>

                                    </td>


                                    {{-- =================================================
                                        TITLE
                                    ================================================== --}}

                                    <td>

                                        <div
                                            class="fw-semibold text-truncate"
                                            title="{{ $request->title ?? '' }}"
                                        >

                                            {{ $request->title ?? '—' }}

                                        </div>

                                        @if(!empty($request->description))

                                            <small
                                                class="text-muted text-truncate d-block"
                                                title="{{ $request->description }}"
                                            >

                                                {{ Str::limit(
                                                    $request->description,
                                                    60
                                                ) }}

                                            </small>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        REQUESTER
                                    ================================================== --}}

                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div class="request-avatar me-2">

                                                <i class="bi bi-person-fill"></i>

                                            </div>

                                            <div
                                                class="fw-semibold text-truncate"
                                                title="{{ $request->requester?->name ?? 'Unknown' }}"
                                            >

                                                {{ $request->requester?->name ?? 'Unknown' }}

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        ITEMS
                                    ================================================== --}}

                                    <td class="text-center">

                                        <span class="badge items-badge">

                                            {{ $request->items?->count() ?? 0 }}

                                        </span>

                                    </td>


                                    {{-- =================================================
                                        TOTAL AMOUNT
                                    ================================================== --}}

                                    <td
                                        class="text-end"
                                        data-order="{{ (float) ($request->total_amount ?? 0) }}"
                                    >

                                        <span class="fw-semibold">

                                            {{ number_format(
                                                (float) ($request->total_amount ?? 0),
                                                2,
                                                '.',
                                                ','
                                            ) }}

                                        </span>

                                    </td>


                                    {{-- =================================================
                                        CEO APPROVED DATE
                                    ================================================== --}}

                                    <td
                                        data-order="{{ $ceoStep?->processed_at?->timestamp ?? 0 }}"
                                    >

                                        @if($ceoStep?->processed_at)

                                            <div class="fw-semibold">

                                                {{ $ceoStep->processed_at->format('d/m/Y') }}

                                            </div>

                                            <small class="text-muted">

                                                {{ $ceoStep->processed_at->format('H:i') }}

                                            </small>

                                        @else

                                            <span class="text-muted">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        ACTIONS
                                    ================================================== --}}

                                    <td class="text-center">

                                        <div class="request-actions">

                                            <a
                                                href="{{ route('requests.show', $request) }}"
                                                class="btn btn-sm btn-info action-btn"
                                                title="View Request"
                                                aria-label="View Request"
                                            >

                                                <i class="bi bi-eye"></i>

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


    {{-- =============================================================
        STYLE
    ============================================================= --}}

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
            overflow: hidden;
        }

        #ceoApprovedTable {
            width: 100% !important;
            table-layout: fixed;
            margin: 0 !important;
            font-size: 14px;
            border-collapse: collapse;
        }

        #ceoApprovedTable thead th {
            white-space: nowrap;
            vertical-align: middle;
            font-weight: 600;
            background: #f8f9fa;
            color: #212529;
            padding: 11px 8px;
        }

        #ceoApprovedTable tbody td {
            vertical-align: middle;
            padding: 10px 8px;
            overflow: hidden;
        }

        /* COLUMN WIDTHS */

        #ceoApprovedTable th:nth-child(1),
        #ceoApprovedTable td:nth-child(1) {
            width: 45px;
        }

        #ceoApprovedTable th:nth-child(2),
        #ceoApprovedTable td:nth-child(2) {
            width: 130px;
        }

        #ceoApprovedTable th:nth-child(3),
        #ceoApprovedTable td:nth-child(3) {
            width: 22%;
        }

        #ceoApprovedTable th:nth-child(4),
        #ceoApprovedTable td:nth-child(4) {
            width: 17%;
        }

        #ceoApprovedTable th:nth-child(5),
        #ceoApprovedTable td:nth-child(5) {
            width: 65px;
        }

        #ceoApprovedTable th:nth-child(6),
        #ceoApprovedTable td:nth-child(6) {
            width: 125px;
        }

        #ceoApprovedTable th:nth-child(7),
        #ceoApprovedTable td:nth-child(7) {
            width: 145px;
        }

        #ceoApprovedTable th:nth-child(8),
        #ceoApprovedTable td:nth-child(8) {
            width: 80px;
        }

        /* REFERENCE */

        .request-reference {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* REQUESTER */

        .request-avatar {
            width: 34px;
            height: 34px;
            min-width: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f1f1;
            color: #777;
            border: 1px solid #dee2e6;
            border-radius: 0;
            font-size: 16px;
        }

        /* ITEMS */

        .items-badge {
            background: #6c757d !important;
            color: #fff;
            border-radius: 0 !important;
            min-width: 28px;
            padding: 5px 7px;
        }

        /* APPROVED COUNT */

        .approved-count {
            background: #198754 !important;
            color: #fff;
            border-radius: 0 !important;
            padding: 7px 10px;
        }

        /* ACTIONS */

        .request-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 4px;
        }

        .action-btn {
            width: 34px;
            height: 34px;
            padding: 0;
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

        /* DATATABLE TOP */

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
            display: none;
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

        /* BUTTONS */

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

        /* TABLE / BOTTOM */

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

        /* DATATABLE DEFAULT */

        .dataTables_wrapper .dataTables_filter {
            float: none;
            text-align: left;
        }

        .dataTables_wrapper .dataTables_length {
            float: none;
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

        /* EMPTY */

        #ceoApprovedTable_wrapper .dataTables_empty {
            padding: 50px 20px !important;
            text-align: center !important;
            color: #6c757d;
        }

        /* RESPONSIVE */

        @media (max-width: 1100px) {

            #ceoApprovedTable {
                font-size: 13px;
            }

            #ceoApprovedTable thead th,
            #ceoApprovedTable tbody td {
                padding-left: 6px;
                padding-right: 6px;
            }

            .request-avatar {
                width: 30px;
                height: 30px;
                min-width: 30px;
                font-size: 14px;
            }

            .datatable-top {
                flex-wrap: wrap;
            }

            .datatable-search {
                width: 100%;
            }

            .datatable-search input {
                width: 100%;
                max-width: 350px;
            }

            .datatable-length {
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {

            .request-card .card-body {
                padding: 10px;
            }

            #ceoApprovedTable {
                font-size: 12px;
            }

            #ceoApprovedTable thead th,
            #ceoApprovedTable tbody td {
                padding: 7px 5px;
            }

            .request-avatar {
                display: none;
            }

            .app-content-header .row {
                row-gap: 8px;
            }

            .app-content-header .breadcrumb {
                float: none !important;
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
                grid-column: 1 / -1;
            }

            .datatable-search label {
                width: 100%;
            }

            .datatable-search input {
                width: 100%;
                max-width: none;
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
        }

        @media (max-width: 480px) {

            .datatable-top {
                grid-template-columns: 1fr;
            }

            .datatable-search {
                width: 100%;
            }

            .datatable-search input {
                width: 100%;
                margin-left: 0;
                margin-top: 5px;
            }

            .datatable-buttons {
                flex-wrap: nowrap;
            }
        }

    </style>


    {{-- =============================================================
        DATATABLE SCRIPT
    ============================================================= --}}

    @push('scripts')

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                function () {

                    if (
                        typeof window.jQuery === 'undefined' ||
                        typeof $.fn.DataTable === 'undefined'
                    ) {

                        console.error(
                            'jQuery or DataTables is not loaded.'
                        );

                        return;

                    }

                    const table = document.getElementById(
                        'ceoApprovedTable'
                    );

                    if (!table) {
                        return;
                    }

                    if (
                        $.fn.DataTable.isDataTable(
                            '#ceoApprovedTable'
                        )
                    ) {

                        $('#ceoApprovedTable')
                            .DataTable()
                            .destroy();

                    }

                    $('#ceoApprovedTable').DataTable({

                        responsive: false,

                        autoWidth: false,

                        pageLength:
                            {{ PerPage::FIVE->value }},

                        lengthMenu: [

                            @json(PerPage::values()),

                            @json([
                                ...PerPage::values(),
                                'All'
                            ])

                        ],

                        order: [
                            [6, 'desc']
                        ],

                        columnDefs: [

                            {
                                targets: 0,
                                searchable: false,
                                orderable: false,
                                width: '45px'
                            },

                            {
                                targets: 7,
                                searchable: false,
                                orderable: false,
                                width: '80px'
                            }

                        ],

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
                                    'CEO Approved Requests',
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
                                    'CEO Approved Requests',
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
                                    'CEO Approved Requests',
                                exportOptions: {
                                    columns: ':not(:last-child)'
                                }
                            }

                        ],

                        language: {

                            search:
                                'Search:',

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
                                'No CEO approved requests found',

                            paginate: {

                                first: 'First',
                                last: 'Last',
                                next: 'Next',
                                previous: 'Previous'

                            }

                        }

                    });

                }

            );

        </script>

    @endpush

@endsection
