@extends('layouts.admin')

@section('title', 'Purchase Orders')

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
                        Purchase Orders
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
                            Purchase Orders
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

            <div class="card shadow-sm purchase-order-card">

                <div class="card-body">


                    {{-- =================================================
                        TABLE WRAPPER
                    ================================================== --}}

                    <div class="purchase-order-table-wrapper">

                        <table
                            id="purchaseOrdersTable"
                            class="table table-bordered table-hover align-middle"
                        >

                            {{-- =================================================
                                TABLE HEADER
                            ================================================== --}}

                            <thead>

                            <tr>

                                <th>#</th>

                                <th>PO Number</th>

                                <th>Quotation</th>

                                <th>Client</th>

                                <th>PO Date</th>

                                <th>File</th>

                                <th>Uploaded By</th>

                                <th>Uploaded At</th>

                                <th>Actions</th>

                            </tr>

                            </thead>


                            {{-- =================================================
                                TABLE BODY
                            ================================================== --}}

                            <tbody>

                            @foreach($purchaseOrders as $purchaseOrder)

                                <tr>


                                    {{-- =================================================
                                        1. NUMBER
                                    ================================================== --}}

                                    <td class="text-center">

                                        {{ $loop->iteration }}

                                    </td>


                                    {{-- =================================================
                                        2. PO NUMBER
                                    ================================================== --}}

                                    <td>

                                        <span class="fw-semibold">

                                            {{ $purchaseOrder->po_number }}

                                        </span>

                                    </td>


                                    {{-- =================================================
                                        3. QUOTATION
                                    ================================================== --}}

                                    <td>

                                        @if($purchaseOrder->quotation)

                                            <span class="fw-semibold">

                                                {{ $purchaseOrder->quotation->quotario_number }}

                                            </span>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        4. CLIENT
                                    ================================================== --}}

                                    <td>

                                        @if($purchaseOrder->quotation?->client)

                                            {{ $purchaseOrder->quotation->client->name }}

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        5. PO DATE
                                    ================================================== --}}

                                    <td
                                        data-order="{{ $purchaseOrder->po_date?->format('Y-m-d') }}"
                                    >

                                        {{ $purchaseOrder->po_date?->format('d/m/Y') ?? '-' }}

                                    </td>


                                    {{-- =================================================
                                        6. FILE
                                    ================================================== --}}

                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div class="purchase-order-file-icon me-2">

                                                @php
                                                    $extension = strtolower(
                                                        pathinfo(
                                                            $purchaseOrder->file_name,
                                                            PATHINFO_EXTENSION
                                                        )
                                                    );
                                                @endphp


                                                @if($extension === 'pdf')

                                                    <i class="bi bi-file-earmark-pdf"></i>

                                                @elseif(in_array($extension, ['doc', 'docx']))

                                                    <i class="bi bi-file-earmark-word"></i>

                                                @elseif(in_array($extension, ['xls', 'xlsx']))

                                                    <i class="bi bi-file-earmark-excel"></i>

                                                @elseif(in_array($extension, ['jpg', 'jpeg', 'png']))

                                                    <i class="bi bi-file-earmark-image"></i>

                                                @else

                                                    <i class="bi bi-file-earmark"></i>

                                                @endif

                                            </div>


                                            <div class="purchase-order-file-name">

                                                {{ $purchaseOrder->file_name }}

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        7. UPLOADED BY
                                    ================================================== --}}

                                    <td>

                                        {{ $purchaseOrder->uploader?->name ?? '-' }}

                                    </td>


                                    {{-- =================================================
                                        8. UPLOADED AT
                                    ================================================== --}}

                                    <td
                                        data-order="{{ $purchaseOrder->created_at?->format('Y-m-d H:i:s') }}"
                                    >

                                        {{ $purchaseOrder->created_at?->format('d/m/Y H:i') ?? '-' }}

                                    </td>


                                    {{-- =================================================
                                        9. ACTIONS
                                    ================================================== --}}

                                    <td>

                                        <div class="purchase-order-actions">

                                            {{-- DOWNLOAD --}}

                                            <a
                                                href="{{ route('purchase-orders.download', $purchaseOrder->id) }}"
                                                class="btn btn-sm btn-success action-btn"
                                                title="Download Purchase Order"
                                            >

                                                <i class="bi bi-download"></i>

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

        .purchase-order-card {

            border-radius: 0 !important;

            border: 1px solid #dee2e6;

        }


        /* =========================================================
           TABLE WRAPPER
        ========================================================== */

        .purchase-order-table-wrapper {

            width: 100%;

            overflow-x: auto;

            overflow-y: hidden;

            -webkit-overflow-scrolling: touch;

        }


        /* =========================================================
           TABLE
        ========================================================== */

        #purchaseOrdersTable {

            width: 100% !important;

            min-width: 1050px;

            margin: 0 !important;

            font-size: 14px;

            border-collapse: collapse;

        }


        #purchaseOrdersTable thead th {

            white-space: nowrap;

            vertical-align: middle;

            font-weight: 600;

            background: #f8f9fa;

            color: #212529;

            padding: 11px 10px;

        }


        #purchaseOrdersTable tbody td {

            vertical-align: middle;

            padding: 10px;

            white-space: nowrap;

        }


        #purchaseOrdersTable tbody tr {

            height: 60px;

        }


        /* =========================================================
           FILE ICON
        ========================================================== */

        .purchase-order-file-icon {

            width: 36px;

            height: 36px;

            min-width: 36px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f1f1f1;

            border: 1px solid #dee2e6;

            border-radius: 0 !important;

            font-size: 18px;

            color: #666;

        }


        /* =========================================================
           FILE NAME
        ========================================================== */

        .purchase-order-file-name {

            max-width: 250px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .purchase-order-actions {

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
           ADD PURCHASE ORDER
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


            #purchaseOrdersTable {

                min-width: 1050px;

                font-size: 13px;

            }


            #purchaseOrdersTable tbody td {

                padding: 8px;

            }


            .purchase-order-card .card-body {

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

                $('#purchaseOrdersTable').DataTable({

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
                            'Search purchase order...',

                        lengthMenu:
                            'Show _MENU_ purchase orders',

                        info:
                            'Showing _START_ to _END_ of _TOTAL_ purchase orders',

                        infoEmpty:
                            'No purchase orders available',

                        infoFiltered:
                            '(filtered from _MAX_ total purchase orders)',

                        zeroRecords:
                            'No matching purchase orders found',

                        emptyTable:
                            'No purchase orders found',

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
                                'Purchase Order List',

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
                                'Purchase Order List',

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
                                'Purchase Order List',

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
                           PO DATE
                        ---------------------------------------------- */

                        {

                            targets: 4,

                            searchable: false,

                            orderable: true,

                            width: '110px'

                        },


                        /* ---------------------------------------------
                           UPLOADED AT
                        ---------------------------------------------- */

                        {

                            targets: 7,

                            searchable: false,

                            orderable: true,

                            width: '130px'

                        },


                        /* ---------------------------------------------
                           ACTIONS
                        ---------------------------------------------- */

                        {

                            targets: 8,

                            searchable: false,

                            orderable: false,

                            width: '80px'

                        }

                    ]

                });


                /* =====================================================
                   ADD PURCHASE ORDER BUTTON
                ===================================================== */

                const addPurchaseOrderContainer =

                    document.querySelector(
                        '.datatable-add'
                    );


                if (addPurchaseOrderContainer) {

                    addPurchaseOrderContainer.innerHTML = `

                        <a
                            {{--href="{{ route('purchase-orders.create') }}"--}}
                            class="btn btn-primary"
                            title="Add Purchase Order"
                        >

                            <i class="bi bi-file-earmark-plus me-1"></i>

                            Add Purchase Order

                        </a>

                    `;

                }

            });

        </script>

    @endpush

@endsection
