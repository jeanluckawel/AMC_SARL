
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
                        aria-label="Close"
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
                        aria-label="Close"
                    ></button>

                </div>

            @endif


            {{-- =================================================
                 REQUEST CARD
            ================================================== --}}

            <div class="card shadow-sm request-card">


                {{-- =================================================
                     CARD HEADER
                ================================================== --}}

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


                {{-- =================================================
                     CARD BODY
                ================================================== --}}

                <div class="card-body">

                    <div class="request-table-wrapper">


                        {{-- =================================================
                             TABLE
                        ================================================== --}}

                        <table
                            id="procurementTable"
                            class="table table-bordered table-hover align-middle"
                            style="width:100%"
                        >


                            {{-- =================================================
                                 THEAD
                            ================================================== --}}

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


                            {{-- =================================================
                                 TBODY

                                 IMPORTANT:
                                 Ne jamais mettre ici une ligne avec
                                 colspan="8".

                                 Si $requests est vide, le tbody reste vide.
                                 DataTables affichera automatiquement
                                 language.emptyTable.
                            ================================================== --}}

                            <tbody>

                            @foreach($requests as $request)

                                <tr>


                                    {{-- =========================================
                                         1. NUMBER
                                    ========================================== --}}

                                    <td class="text-center">

                                        {{ $loop->iteration }}

                                    </td>


                                    {{-- =========================================
                                         2. REFERENCE
                                    ========================================== --}}

                                    <td>

                                        <span class="fw-semibold request-reference">

                                            {{ $request->reference ?? '—' }}

                                        </span>

                                    </td>


                                    {{-- =========================================
                                         3. TITLE
                                    ========================================== --}}

                                    <td>

                                        <div class="fw-semibold">

                                            {{ $request->title ?? '—' }}

                                        </div>


                                        @if(!empty($request->description))

                                            <small class="text-muted">

                                                {{ Str::limit(
                                                    $request->description,
                                                    80
                                                ) }}

                                            </small>

                                        @endif

                                    </td>


                                    {{-- =========================================
                                         4. REQUESTER
                                    ========================================== --}}

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


                                    {{-- =========================================
                                         5. ITEMS
                                    ========================================== --}}

                                    <td class="text-center">

                                        <span class="badge items-badge">

                                            {{ $request->items?->count() ?? 0 }}

                                        </span>

                                    </td>


                                    {{-- =========================================
                                         6. STATUS
                                    ========================================== --}}

                                    <td>

                                        @if(
                                            $request->status ===
                                            RequestStatus::PENDING_PROCUREMENT
                                        )

                                            <span
                                                class="badge status-badge status-procurement"
                                            >

                                                <i class="bi bi-hourglass-split me-1"></i>

                                                Pending Procurement

                                            </span>

                                        @else

                                            <span class="badge status-badge">

                                                {{ $request->status?->label()
                                                    ?? $request->status?->value
                                                    ?? 'Unknown'
                                                }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- =========================================
                                         7. CREATED DATE
                                    ========================================== --}}

                                    <td
                                        data-order="{{ $request->created_at?->timestamp ?? 0 }}"
                                    >

                                        @if($request->created_at)

                                            <div class="fw-semibold">

                                                {{ $request->created_at->format('d/m/Y') }}

                                            </div>

                                            <small class="text-muted">

                                                {{ $request->created_at->format('H:i') }}

                                            </small>

                                        @else

                                            <span class="text-muted">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =========================================
                                         8. ACTIONS
                                    ========================================== --}}

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
                                                aria-label="View Request"
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
                                                aria-label="Validate Request"
                                            >

                                                <i class="bi bi-check-lg"></i>

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
         STYLE
    ========================================================== --}}

    <style>


        /* =====================================================
           CARD
        ====================================================== */

        .request-card {

            border-radius: 0 !important;

            border: 1px solid #dee2e6;

        }


        .request-card .card-header {

            border-bottom: 1px solid #dee2e6;

            padding: 14px 16px;

        }


        /* =====================================================
           TABLE WRAPPER
        ====================================================== */

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


        #procurementTable tbody tr {

            min-height: 60px;

        }


        /* =====================================================
           REFERENCE
        ====================================================== */

        .request-reference {

            white-space: nowrap;

        }


        /* =====================================================
           AVATAR
        ====================================================== */

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

            font-size: 17px;

        }


        /* =====================================================
           STATUS
        ====================================================== */

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


        /* =====================================================
           ITEMS
        ====================================================== */

        .items-badge {

            background: #6c757d !important;

            color: #fff;

            border-radius: 0 !important;

            min-width: 28px;

            padding: 5px 7px;

        }


        /* =====================================================
           PENDING COUNT
        ====================================================== */

        .pending-count {

            background: #0dcaf0 !important;

            color: #212529;

            border-radius: 0 !important;

            padding: 7px 10px;

        }


        /* =====================================================
           ACTIONS
        ====================================================== */

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


        /* =====================================================
           DATATABLE TOP
        ====================================================== */

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


        /* =====================================================
           DATATABLE ADD
        ====================================================== */

        .datatable-add {

            display: none;

        }


        /* =====================================================
           DATATABLE LENGTH
        ====================================================== */

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


        /* =====================================================
           DATATABLE BUTTONS
        ====================================================== */

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


        /* =====================================================
           DATATABLE TABLE / BOTTOM
        ====================================================== */

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


        /* =====================================================
           DATATABLE EMPTY STATE
        ====================================================== */

        #procurementTable_wrapper .dataTables_empty {

            padding: 50px 20px !important;

            text-align: center !important;

            color: #6c757d;

            font-size: 14px;

        }


        /* =====================================================
           DATATABLE DEFAULT OVERRIDES
        ====================================================== */

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


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 1100px) {

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


    {{-- =========================================================
         JAVASCRIPT
    ========================================================== --}}

    @push('scripts')

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                function () {


                    /*
                     * Vérifier jQuery.
                     */
                    if (typeof window.jQuery === 'undefined') {

                        console.error(
                            'jQuery is not loaded.'
                        );

                        return;

                    }


                    /*
                     * Vérifier DataTables.
                     */
                    if (typeof $.fn.DataTable === 'undefined') {

                        console.error(
                            'DataTables is not loaded.'
                        );

                        return;

                    }


                    /*
                     * Vérifier que le tableau existe.
                     */
                    const table =
                        document.getElementById(
                            'procurementTable'
                        );


                    if (!table) {

                        return;

                    }


                    /*
                     * Éviter une double initialisation.
                     */
                    if (
                        $.fn.DataTable.isDataTable(
                            '#procurementTable'
                        )
                    ) {

                        $('#procurementTable')
                            .DataTable()
                            .destroy();

                    }


                    /*
                     * Initialisation DataTables.
                     */
                    $('#procurementTable').DataTable({

                        responsive: false,

                        autoWidth: false,


                        /*
                         * Nombre de lignes par défaut.
                         */
                        pageLength:
                            {{ PerPage::FIVE->value }},


                        /*
                         * Options de pagination.
                         */
                        lengthMenu: [

                            @json(PerPage::values()),

                            @json([
                                ...PerPage::values(),
                                'All'
                            ])

                        ],


                        /*
                         * Tri par Created Date.
                         *
                         * Colonne 6 :
                         * Created Date
                         */
                        order: [

                            [6, 'desc']

                        ],


                        /*
                         * Configuration des colonnes.
                         *
                         * 0 = #
                         * 1 = Reference
                         * 2 = Title
                         * 3 = Requester
                         * 4 = Items
                         * 5 = Status
                         * 6 = Created Date
                         * 7 = Actions
                         */
                        columnDefs: [

                            {
                                targets: 0,

                                searchable: false,

                                orderable: false,

                                width: '50px'
                            },


                            {
                                targets: 7,

                                searchable: false,

                                orderable: false,

                                width: '100px'
                            }

                        ],


                        /*
                         * Layout.
                         */
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


                        /*
                         * Boutons d'export.
                         */
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
                                    'Procurement Pending Requests',

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
                                    'Procurement Pending Requests',

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
                                    'Procurement Pending Requests',

                                exportOptions: {

                                    columns:
                                        ':not(:last-child)'

                                }

                            }

                        ],


                        /*
                         * Messages.
                         */
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


                            /*
                             * Utilisé lorsque le tbody
                             * est complètement vide.
                             */
                            emptyTable:
                                'No pending requests found',


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

                        }

                    });

                }

            );

        </script>

    @endpush

@endsection
