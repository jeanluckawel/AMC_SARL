@extends('layouts.admin')

@section('content')

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6">

                    <h3 class="mb-0">
                        Disburse Request
                    </h3>

                </div>

                <div class="col-md-6">

                    <ol class="breadcrumb float-md-end mb-0">

                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                Home
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            Requests
                        </li>

                        <li class="breadcrumb-item">
                            Approved
                        </li>

                        <li class="breadcrumb-item active">
                            Disburse
                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </div>


    <div class="app-content">

        <div class="container-fluid">

            {{-- SUCCESS --}}
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


            {{-- ERROR --}}
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


            {{-- VALIDATION ERRORS --}}
            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="card shadow-sm request-card">

                {{-- HEADER --}}
                <div class="card-header bg-white">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="mb-0">
                                Request Disbursement
                            </h5>

                            <small class="text-muted">
                                Upload the supporting document to deduct
                                the request amount from the department budget.
                            </small>

                        </div>

                        <span class="badge bg-success">
                            Approved
                        </span>

                    </div>

                </div>


                {{-- BODY --}}
                <div class="card-body">

                    <div class="row g-4">

                        {{-- REQUEST INFORMATION --}}
                        <div class="col-lg-6">

                            <div class="info-box">

                                <h6 class="section-title">
                                    Request Information
                                </h6>


                                <div class="info-row">

                                    <span class="info-label">
                                        Reference
                                    </span>

                                    <strong>
                                        {{ $request->reference ?? '—' }}
                                    </strong>

                                </div>


                                <div class="info-row">

                                    <span class="info-label">
                                        Title
                                    </span>

                                    <strong>
                                        {{ $request->title ?? '—' }}
                                    </strong>

                                </div>


                                <div class="info-row">

                                    <span class="info-label">
                                        Requester
                                    </span>

                                    <strong>
                                        {{ $request->requester?->name ?? 'Unknown' }}
                                    </strong>

                                </div>


                                <div class="info-row">

                                    <span class="info-label">
                                        Request Amount
                                    </span>

                                    <strong class="amount-text">

                                        {{ number_format(
                                            (float) $request->total_amount,
                                            2,
                                            '.',
                                            ','
                                        ) }}

                                    </strong>

                                </div>

                            </div>

                        </div>


                        {{-- BUDGET INFORMATION --}}
                        <div class="col-lg-6">

                            <div class="info-box">

                                <h6 class="section-title">
                                    Department Budget
                                </h6>


                                @if($departmentBudget)

                                    <div class="info-row">

                                        <span class="info-label">
                                            Budget
                                        </span>

                                        <strong>

                                            {{ number_format(
                                                (float) $departmentBudget->amount,
                                                2,
                                                '.',
                                                ','
                                            ) }}

                                        </strong>

                                    </div>


                                    <div class="info-row">

                                        <span class="info-label">
                                            Used
                                        </span>

                                        <strong class="text-warning">

                                            {{ number_format(
                                                (float) $departmentBudget->used_amount,
                                                2,
                                                '.',
                                                ','
                                            ) }}

                                        </strong>

                                    </div>


                                    <div class="info-row">

                                        <span class="info-label">
                                            Available
                                        </span>

                                        <strong class="text-success">

                                            {{ number_format(
                                                $availableAmount,
                                                2,
                                                '.',
                                                ','
                                            ) }}

                                        </strong>

                                    </div>


                                    <div class="info-row">

                                        <span class="info-label">
                                            End Date
                                        </span>

                                        <strong>
                                            {{ $departmentBudget->end_date?->format('d/m/Y') }}
                                        </strong>

                                    </div>

                                @else

                                    <div class="alert alert-danger mb-0">

                                        <i class="bi bi-exclamation-triangle me-1"></i>

                                        This department does not have
                                        an active budget.

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>


                    <hr class="my-4">


                    {{-- UPLOAD FORM --}}
                    <form
                        action="{{ route('requests.disburse.store', $request) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf


                        <div class="mb-4">

                            <label
                                for="document"
                                class="form-label fw-semibold"
                            >
                                Supporting Document
                                <span class="text-danger">*</span>
                            </label>


                            <input
                                type="file"
                                name="document"
                                id="document"
                                class="form-control"
                                accept=".pdf,.jpg,.jpeg,.png"
                                required
                            >


                            <div class="form-text">
                                Accepted formats: PDF, JPG, JPEG, PNG.
                                Maximum size: 10 MB.
                            </div>


                            @error('document')

                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- AUTOMATIC AMOUNT --}}
                        <div class="alert alert-info">

                            <div class="d-flex align-items-center">

                                <i class="bi bi-info-circle fs-4 me-2"></i>

                                <div>

                                    <strong>
                                        Automatic deduction
                                    </strong>

                                    <div>
                                        Uploading this document will deduct
                                        <strong>
                                            {{ number_format(
                                                (float) $request->total_amount,
                                                2,
                                                '.',
                                                ','
                                            ) }}
                                        </strong>
                                        from the department budget.
                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- BUTTONS --}}
                        <div class="d-flex justify-content-end gap-2">

                            <a
                                href="{{ route('requests.approved') }}"
                                class="btn btn-secondary"
                            >
                                <i class="bi bi-arrow-left me-1"></i>
                                Cancel
                            </a>


                            <button
                                type="submit"
                                class="btn btn-success"
                                @disabled(!$departmentBudget ||
                                    $availableAmount < (float) $request->total_amount)
                            >

                                <i class="bi bi-cash-stack me-1"></i>

                                Upload & Disburse

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <style>

        .request-card {
            border-radius: 0 !important;
            border: 1px solid #dee2e6;
        }

        .request-card .card-header {
            padding: 15px 16px;
            border-bottom: 1px solid #dee2e6;
        }

        .info-box {
            border: 1px solid #dee2e6;
            padding: 18px;
            height: 100%;
            background: #fff;
        }

        .section-title {
            padding-bottom: 12px;
            margin-bottom: 0;
            border-bottom: 1px solid #dee2e6;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 11px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #6c757d;
        }

        .amount-text {
            font-size: 18px;
        }

        .form-control {
            border-radius: 0 !important;
        }

        .btn {
            border-radius: 0 !important;
        }

        @media (max-width: 768px) {

            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

        }

    </style>

@endsection

