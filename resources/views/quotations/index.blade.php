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
                        Quotations
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
                            Quotations
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

            <div class="card shadow-sm quotation-card">

                <div class="card-body">

                    {{-- =================================================
                        TABLE WRAPPER
                    ================================================== --}}

                    <div class="quotation-table-wrapper">

                        <table
                            id="quotationsTable"
                            class="table table-bordered table-hover align-middle"
                        >

                            {{-- =================================================
                                TABLE HEADER
                            ================================================== --}}

                            <thead>

                            <tr>

                                <th>#</th>

                                <th>Quotation</th>

                                <th>Client</th>

                                <th>Valid Until</th>

                                <th>Amount</th>

                                <th>Status</th>

                                <th>Created By</th>

                                <th>Created Date</th>

                                <th>Actions</th>

                            </tr>

                            </thead>


                            {{-- =================================================
                                TABLE BODY
                            ================================================== --}}

                            <tbody>

                            @foreach($quotations as $quotation)

                                <tr>

                                    {{-- =================================================
                                        1. NUMBER
                                    ================================================== --}}

                                    <td class="text-center">

                                        {{ $loop->iteration }}

                                    </td>


                                    {{-- =================================================
                                        2. QUOTATION NUMBER
                                    ================================================== --}}

                                    <td>

                                        <span class="fw-semibold">

                                            {{ $quotation->quotario_number ?? '-' }}

                                        </span>

                                    </td>


                                    {{-- =================================================
                                        3. CLIENT
                                    ================================================== --}}

                                    <td>

                                        <div class="quotation-client">

                                            <div class="fw-semibold">

                                                {{ $quotation->client?->name ?? '-' }}

                                            </div>

                                            @if($quotation->client?->email)

                                                <small class="text-muted">

                                                    {{ $quotation->client->email }}

                                                </small>

                                            @endif

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        4. VALID UNTIL
                                    ================================================== --}}

                                    <td
                                        data-order="{{ $quotation->valid_until?->format('Y-m-d') }}"
                                    >

                                        {{ $quotation->valid_until?->format('d/m/Y') ?? '-' }}

                                    </td>


                                    {{-- =================================================
                                        5. AMOUNT
                                    ================================================== --}}

                                    <td>

                                        <span class="fw-semibold">

                                            {{ number_format($quotation->total_amount ?? 0, 2, '.', ',') }}

                                        </span>

                                    </td>


                                    {{-- =================================================
                                        6. STATUS
                                    ================================================== --}}

                                    <td>

                                        @if($quotation->status)

                                            <span class="badge quotation-badge quotation-badge-validated">

                                                Validated

                                            </span>

                                        @else

                                            <span class="badge quotation-badge quotation-badge-pending">

                                                Pending

                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        7. CREATED BY
                                    ================================================== --}}

                                    <td>

                                        {{ $quotation->user?->name ?? '-' }}

                                    </td>


                                    {{-- =================================================
                                        8. CREATED DATE
                                    ================================================== --}}

                                    <td
                                        data-order="{{ $quotation->created_at?->format('Y-m-d H:i:s') }}"
                                    >

                                        {{ $quotation->created_at?->format('d/m/Y') ?? '-' }}

                                    </td>


                                    {{-- =================================================
                                        9. ACTIONS
                                    ================================================== --}}

                                    <td>

                                        <div class="quotation-actions">

                                            {{-- =================================================
                                                SEE
                                            ================================================== --}}

                                            <a
                                                href="{{ route('quotations.show', $quotation->id) }}"
                                                class="btn btn-sm btn-info action-btn"
                                                title="See Quotation"
                                            >

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- =================================================
                                                ADD PO
                                            ================================================== --}}
                                            @if ($quotation->status != 1)
                                                <a
                                                    href="{{ route('purchase-orders.create', $quotation->id) }}"
                                                    class="btn btn-sm btn-primary action-btn"
                                                    title="Add Purchase Order"
                                                >
                                                    <i class="bi bi-file-earmark-plus"></i>
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
        CSS
    ========================================================== --}}

    <style>

        /* =========================================================
           CARD
        ========================================================== */

        .quotation-card {

            border-radius: 0 !important;

            border: 1px solid #dee2e6;

        }


        /* =========================================================
           TABLE WRAPPER
        ========================================================== */

        .quotation-table-wrapper {

            width: 100%;

            overflow-x: auto;

            overflow-y: hidden;

            -webkit-overflow-scrolling: touch;

        }


        /* =========================================================
           TABLE
        ========================================================== */

        #quotationsTable {

            width: 100% !important;

            min-width: 1050px;

            margin: 0 !important;

            font-size: 14px;

            border-collapse: collapse;

        }


        #quotationsTable thead th {

            white-space: nowrap;

            vertical-align: middle;

            font-weight: 600;

            background: #f8f9fa;

            color: #212529;

            padding: 11px 10px;

        }


        #quotationsTable tbody td {

            vertical-align: middle;

            padding: 10px;

            white-space: nowrap;

        }


        #quotationsTable tbody tr {

            height: 60px;

        }


        /* =========================================================
           CLIENT
        ========================================================== */

        .quotation-client {

            line-height: 1.3;

        }


        .quotation-client .text-muted {

            font-size: 12px;

        }


        /* =========================================================
           STATUS BADGES
        ========================================================== */

        .quotation-badge {

            color: #fff;

            border-radius: 0 !important;

            padding: 6px 9px;

            font-weight: 500;

        }


        .quotation-badge-pending {

            background: #6c757d !important;

        }


        .quotation-badge-validated {

            background: #198754 !important;

        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .quotation-actions {

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


        .action-btn:disabled {

            opacity: .55;

            cursor: not-allowed;

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
           ADD QUOTATION
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


            #quotationsTable {

                min-width: 1050px;

                font-size: 13px;

            }


            #quotationsTable tbody td {

                padding: 8px;

            }


            .quotation-card .card-body {

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


                /* =====================================================
                   INITIALIZE DATATABLE
                ===================================================== */

                $('#quotationsTable').DataTable({

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
                            'Search quotation...',

                        lengthMenu:
                            'Show _MENU_ quotations',

                        info:
                            'Showing _START_ to _END_ of _TOTAL_ quotations',

                        infoEmpty:
                            'No quotations available',

                        infoFiltered:
                            '(filtered from _MAX_ total quotations)',

                        zeroRecords:
                            'No matching quotations found',

                        emptyTable:
                            'No quotations found',

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
                                'Quotation List',

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
                                'Quotation List',

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
                                'Quotation List',

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

                        /* ---------------------------------------------
                           NUMBER
                        ---------------------------------------------- */

                        {

                            targets: 0,

                            searchable: false,

                            orderable: false,

                            width: '50px'

                        },


                        /* ---------------------------------------------
                           VALID UNTIL
                        ---------------------------------------------- */

                        {

                            targets: 3,

                            searchable: false,

                            orderable: true,

                            width: '110px'

                        },


                        /* ---------------------------------------------
                           STATUS
                        ---------------------------------------------- */

                        {

                            targets: 5,

                            searchable: true,

                            orderable: true,

                            width: '110px'

                        },


                        /* ---------------------------------------------
                           CREATED DATE
                        ---------------------------------------------- */

                        {

                            targets: 7,

                            searchable: false,

                            orderable: true,

                            width: '110px'

                        },


                        /* ---------------------------------------------
                           ACTIONS
                        ---------------------------------------------- */

                        {

                            targets: 8,

                            searchable: false,

                            orderable: false,

                            width: '90px'

                        }

                    ]

                });


                /* =====================================================
                   ADD QUOTATION BUTTON
                ===================================================== */

                const addQuotationContainer =
                    document.querySelector(
                        '.datatable-add'
                    );


                if (addQuotationContainer) {

                    addQuotationContainer.innerHTML = `

                        <a
                            href="{{ route('quotations.create') }}"
                            class="btn btn-primary"
                            title="Add Quotation"
                        >

                            <i class="bi bi-plus-lg me-1"></i>

                            Add Quotation

                        </a>

                    `;

                }

            });

        </script>

    @endpush

@endsection
