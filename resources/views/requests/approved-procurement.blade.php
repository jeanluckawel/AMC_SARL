
@extends('layouts.admin')

@section('content')

    <main class="app-main">

        {{-- ======================================================
            PAGE HEADER
        ======================================================= --}}

        <div class="app-content-header">

            <div class="container-fluid">

                <div class="row align-items-center">

                    <div class="col-sm-6">

                        <div class="d-flex align-items-center">

                            <div class="page-icon bg-success-subtle text-success me-3">

                                <i class="bi bi-check-circle"></i>

                            </div>

                            <div>

                                <h3 class="mb-1">
                                    Approved Requests
                                </h3>

                                <p class="text-muted mb-0">
                                    Requests that have been fully approved.
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="col-sm-6">

                        <ol class="breadcrumb float-sm-end mb-0">

                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    Home
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                Requests
                            </li>

                            <li class="breadcrumb-item active">
                                Approved
                            </li>

                        </ol>

                    </div>

                </div>

            </div>

        </div>


        {{-- ======================================================
            CONTENT
        ======================================================= --}}

        <div class="app-content">

            <div class="container-fluid">

                {{-- Success message --}}

                @if(session('success'))

                    <div class="alert alert-success alert-dismissible fade show">

                        <i class="bi bi-check-circle me-2"></i>

                        {{ session('success') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                        ></button>

                    </div>

                @endif


                {{-- Card --}}

                <div class="card request-card shadow-sm">

                    <div class="card-header bg-white border-bottom">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="mb-1">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Approved Requests
                                </h5>

                                <small class="text-muted">
                                    {{ $requests->count() }} approved request(s)
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table
                                id="approvedTable"
                                class="table table-hover align-middle mb-0"
                                style="min-width: 1100px;"
                            >

                                <thead class="table-light">

                                <tr>

                                    <th class="text-center" width="60">
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

                                    <th class="text-center">
                                        Items
                                    </th>

                                    <th class="text-end">
                                        Total Amount
                                    </th>

                                    <th class="text-center">
                                        Approved Date
                                    </th>

                                    <th class="text-center">
                                        Actions
                                    </th>

                                </tr>

                                </thead>

                                <tbody>

                                @forelse($requests as $request)

                                    <tr>

                                        <td class="text-center fw-semibold">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>

                                            <span class="fw-semibold">
                                                {{ $request->reference }}
                                            </span>

                                        </td>

                                        <td>

                                            <div class="fw-semibold">
                                                {{ $request->title }}
                                            </div>

                                            @if($request->description)

                                                <small class="text-muted">
                                                    {{ Str::limit($request->description, 60) }}
                                                </small>

                                            @endif

                                        </td>

                                        <td>
                                            {{ $request->requester?->name ?? 'N/A' }}
                                        </td>

                                        <td class="text-center">

                                            <span class="badge text-bg-secondary">
                                                {{ $request->items->count() }}
                                            </span>

                                        </td>

                                        <td class="text-end fw-semibold">

                                            {{ number_format(
                                                (float) $request->total_amount,
                                                2,
                                                '.',
                                                ','
                                            ) }}

                                        </td>

                                        <td class="text-center">

                                            @if($request->approved_at)

                                                <div>
                                                    {{ $request->approved_at->format('d/m/Y') }}
                                                </div>

                                                <small class="text-muted">
                                                    {{ $request->approved_at->format('H:i') }}
                                                </small>

                                            @else

                                                <span class="text-muted">
                                                    —
                                                </span>

                                            @endif

                                        </td>

                                        <td class="text-center">

                                            <a
                                                href="{{ route('requests.show', $request) }}"
                                                class="btn btn-sm btn-info action-btn"
                                                title="View Request"
                                            >

                                                <i class="bi bi-eye"></i>

                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="8"
                                            class="text-center py-5"
                                        >

                                            <div class="empty-state">

                                                <i class="bi bi-check-circle display-5 text-muted"></i>

                                                <h5 class="mt-3">
                                                    No Approved Requests
                                                </h5>

                                                <p class="text-muted mb-0">
                                                    There are currently no approved requests.
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

    </main>

@endsection


{{-- ======================================================
    STYLES
======================================================= --}}

@push('styles')

    <style>

        .request-card {
            border-radius: 0;
            border: 1px solid #dee2e6;
        }

        .page-icon {
            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;

            font-size: 1.4rem;
        }

        #approvedTable thead th {
            white-space: nowrap;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }

        #approvedTable tbody td {
            font-size: 0.9rem;
        }

        .action-btn {
            width: 34px;
            height: 34px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 4px;
        }

        .empty-state {
            padding: 20px;
        }

    </style>

@endpush


{{-- ======================================================
    SCRIPTS
======================================================= --}}

@push('scripts')

    <script>

        $(document).ready(function () {

            $('#approvedTable').DataTable({

                pageLength: 5,

                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'All']
                ],

                order: [
                    [6, 'desc']
                ],

                columnDefs: [
                    {
                        orderable: false,
                        targets: [7]
                    }
                ],

                language: {

                    search: 'Search:',

                    lengthMenu: 'Show _MENU_ entries',

                    info: 'Showing _START_ to _END_ of _TOTAL_ requests',

                    emptyTable: 'No approved requests available',

                    zeroRecords: 'No matching requests found',

                    paginate: {
                        previous: 'Previous',
                        next: 'Next'
                    }

                },

                dom:
                    '<"row px-3 py-3"' +
                    '<"col-md-6"B>' +
                    '<"col-md-6"f>' +
                    '>' +
                    '<"table-responsive"t>' +
                    '<"row px-3 py-3"' +
                    '<"col-md-6"i>' +
                    '<"col-md-6"p>' +
                    '>',

                buttons: [
                    'copy',
                    'excel',
                    'pdf',
                    'print'
                ]

            });

        });

    </script>

@endpush

