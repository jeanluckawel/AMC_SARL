@extends('layouts.admin')

@section('title', 'Edit Department Budget - Finance')

@section('content')

    <style>

        /* =========================================================
           GENERAL
        ========================================================== */

        .budget-card {
            border: 0;
            border-radius: 0 !important;
        }

        .form-control,
        .form-select,
        .input-group-text,
        .btn {
            border-radius: 0 !important;
        }

        .form-control,
        .form-select {
            min-height: 44px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }


        /* =========================================================
           DEPARTMENT DISPLAY
        ========================================================== */

        .department-display {
            min-height: 44px;
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 8px 12px;
        }

        .department-display i {
            color: #FF6600;
        }


        /* =========================================================
           READONLY
        ========================================================== */

        .readonly-display {
            background-color: #f8f9fa !important;
            cursor: not-allowed;
        }

        .available-display {
            background-color: #f8f9fa !important;
            font-weight: 600;
        }


        /* =========================================================
           BUTTON
        ========================================================== */

        .btn-orange {
            background-color: #FF6600;
            border-color: #FF6600;
            color: #fff;
            border-radius: 0 !important;
        }

        .btn-orange:hover {
            background-color: #e65c00;
            border-color: #e65c00;
            color: #fff;
        }


        /* =========================================================
           ERROR
        ========================================================== */

        .validation-summary {
            border-radius: 0 !important;
        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 768px) {

            .budget-card-wrapper {
                margin: 10px !important;
            }

            .budget-card .card-body {
                padding: 15px;
            }

        }

    </style>


    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6 col-12">

                    <h3 class="mb-0">
                        Edit Department Budget
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
                            Finance
                        </li>

                        <li class="breadcrumb-item">

                            <a
                                href="{{ route(
                                    'finance.department-budgets'
                                ) }}"
                            >
                                Department Budget
                            </a>

                        </li>

                        <li class="breadcrumb-item active">
                            Edit
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

            <div
                class="card budget-card budget-card-wrapper m-4 shadow-sm"
            >

                <div class="card-body">


                    {{-- =================================================
                         VALIDATION SUMMARY
                    ================================================== --}}

                    @if($errors->any())

                        <div
                            class="alert alert-danger validation-summary"
                            role="alert"
                        >

                            <div class="fw-bold mb-2">

                                <i
                                    class="bi bi-exclamation-triangle-fill me-2"
                                ></i>

                                Please correct the following errors:

                            </div>

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- =================================================
                         SESSION ERROR
                    ================================================== --}}

                    @if(session('error'))

                        <div
                            class="alert alert-danger alert-dismissible fade show"
                            role="alert"
                        >

                            <i
                                class="bi bi-exclamation-triangle me-1"
                            ></i>

                            {{ session('error') }}

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                            ></button>

                        </div>

                    @endif


                    {{-- =================================================
                         FORM
                    ================================================== --}}

                    <form
                        action="{{ route(
                            'finance.department-budgets.update',
                            $departmentBudget->id
                        ) }}"
                        method="POST"
                        id="departmentBudgetForm"
                        autocomplete="off"
                    >

                        @csrf

                        @method('PUT')


                        <div class="row g-3">


                            {{-- =================================================
                                 DEPARTMENT
                            ================================================== --}}

                            <div class="col-12">

                                <label class="form-label">
                                    Department
                                </label>

                                <div class="department-display">

                                    <i class="bi bi-building me-2"></i>

                                    <strong>
                                        {{ $departmentBudget->department->name }}
                                    </strong>

                                    @if($departmentBudget->department->code)

                                        <span class="text-muted ms-2">
                                            (
                                            {{ $departmentBudget->department->code }}
                                            )
                                        </span>

                                    @endif

                                </div>

                            </div>


                            {{-- =================================================
                                 BUDGET AMOUNT
                            ================================================== --}}

                            <div class="col-12 col-md-6">

                                <label
                                    for="amount"
                                    class="form-label"
                                >

                                    Budget Amount

                                    <span class="text-danger">*</span>

                                </label>

                                <div class="input-group">

                                    <input
                                        type="number"
                                        name="amount"
                                        id="amount"
                                        class="form-control @error('amount') is-invalid @enderror"
                                        value="{{ old(
                                            'amount',
                                            $departmentBudget->amount
                                        ) }}"
                                        min="0.01"
                                        step="0.01"
                                        placeholder="0.00"
                                        required
                                    >

                                    <span class="input-group-text">
                                        $
                                    </span>

                                </div>

                                @error('amount')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                                @enderror

                                <small
                                    class="text-danger d-none"
                                    id="amountError"
                                >
                                    The new budget amount cannot be lower
                                    than the current available amount.
                                </small>

                            </div>


                            {{-- =================================================
                                 USED AMOUNT
                            ================================================== --}}

                            <div class="col-12 col-md-6">

                                <label
                                    for="used_amount"
                                    class="form-label"
                                >
                                    Used Amount
                                </label>

                                <div class="input-group">

                                    <input
                                        type="text"
                                        id="used_amount"
                                        class="form-control readonly-display"
                                        value="{{ number_format(
                                            (float) $departmentBudget->used_amount,
                                            2,
                                            '.',
                                            ''
                                        ) }}"
                                        readonly
                                    >

                                    <span class="input-group-text">
                                        $
                                    </span>

                                </div>

                                <small class="text-muted">
                                    This amount is updated automatically.
                                </small>

                            </div>


                            {{-- =================================================
                                 AVAILABLE AMOUNT
                            ================================================== --}}

                            <div class="col-12 col-md-6">

                                <label
                                    for="available_amount"
                                    class="form-label"
                                >
                                    Available Amount
                                </label>

                                <div class="input-group">

                                    <input
                                        type="text"
                                        id="available_amount"
                                        class="form-control available-display"
                                        value="0.00"
                                        readonly
                                    >

                                    <span class="input-group-text">
                                        $
                                    </span>

                                </div>

                                <small class="text-muted">
                                    Current available amount.
                                </small>

                            </div>


                            {{-- =================================================
                                 END DATE
                            ================================================== --}}

                            <div class="col-12 col-md-6">

                                <label
                                    for="end_date"
                                    class="form-label"
                                >

                                    Budget End Date

                                    <span class="text-danger">*</span>

                                </label>

                                <input
                                    type="date"
                                    name="end_date"
                                    id="end_date"
                                    class="form-control @error('end_date') is-invalid @enderror"
                                    value="{{ old(
                                        'end_date',
                                        $departmentBudget->end_date
                                            ? $departmentBudget->end_date->format('Y-m-d')
                                            : ''
                                    ) }}"
                                    min="{{ now()->format('Y-m-d') }}"
                                    required
                                >

                                @error('end_date')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror

                                <small class="text-muted">
                                    The budget will expire after this date.
                                </small>

                            </div>

                        </div>


                        {{-- =================================================
                             BUTTONS
                        ================================================== --}}

                        <div
                            class="d-flex justify-content-between mt-4 pt-3 border-top"
                        >

                            {{-- CANCEL --}}

                            <div>

                                <a
                                    href="{{ route(
                                        'finance.department-budgets'
                                    ) }}"
                                    class="btn btn-secondary"
                                >

                                    <i class="bi bi-x-lg me-1"></i>

                                    Cancel

                                </a>

                            </div>


                            {{-- UPDATE --}}

                            <div>

                                <button
                                    type="submit"
                                    class="btn btn-orange"
                                    id="updateBtn"
                                >

                                    <span
                                        class="spinner-border spinner-border-sm d-none"
                                        id="updateSpinner"
                                        role="status"
                                        aria-hidden="true"
                                    ></span>

                                    <span id="updateText">

                                        <i
                                            class="bi bi-check-lg me-1"
                                        ></i>

                                        Update Budget

                                    </span>

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         JAVASCRIPT
    ========================================================== --}}

    @push('scripts')

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                function () {

                    const form =
                        document.getElementById(
                            'departmentBudgetForm'
                        );

                    const amountInput =
                        document.getElementById(
                            'amount'
                        );

                    const usedAmountInput =
                        document.getElementById(
                            'used_amount'
                        );

                    const availableInput =
                        document.getElementById(
                            'available_amount'
                        );

                    const amountError =
                        document.getElementById(
                            'amountError'
                        );

                    const updateBtn =
                        document.getElementById(
                            'updateBtn'
                        );

                    const updateSpinner =
                        document.getElementById(
                            'updateSpinner'
                        );

                    const updateText =
                        document.getElementById(
                            'updateText'
                        );


                    /* =====================================================
                       CURRENT AVAILABLE AMOUNT
                    ====================================================== */

                    const currentAmount =
                        parseFloat(
                            amountInput.value
                        ) || 0;

                    const usedAmount =
                        parseFloat(
                            usedAmountInput.value
                        ) || 0;


                    const currentAvailable =
                        Math.max(
                            0,
                            currentAmount - usedAmount
                        );


                    /* =====================================================
                       DISPLAY AVAILABLE AMOUNT
                    ====================================================== */

                    availableInput.value =
                        currentAvailable.toFixed(2);


                    /* =====================================================
                       CHECK NEW AMOUNT
                    ====================================================== */

                    function checkAmount() {

                        const newAmount =
                            parseFloat(
                                amountInput.value
                            );


                        /*
                         * Empty input
                         */

                        if (
                            amountInput.value === ''
                        ) {

                            updateBtn.classList.add(
                                'd-none'
                            );

                            amountInput.classList.remove(
                                'is-invalid'
                            );

                            amountError.classList.add(
                                'd-none'
                            );

                            return;
                        }


                        /*
                         * Main condition:
                         *
                         * New Budget Amount
                         * must be >=
                         * Current Available Amount
                         */

                        if (
                            isNaN(newAmount) ||
                            newAmount < currentAvailable
                        ) {

                            updateBtn.classList.add(
                                'd-none'
                            );

                            amountInput.classList.add(
                                'is-invalid'
                            );

                            amountError.classList.remove(
                                'd-none'
                            );

                        } else {

                            updateBtn.classList.remove(
                                'd-none'
                            );

                            amountInput.classList.remove(
                                'is-invalid'
                            );

                            amountError.classList.add(
                                'd-none'
                            );

                        }

                    }


                    /* =====================================================
                       CHECK WHILE TYPING
                    ====================================================== */

                    amountInput.addEventListener(
                        'input',
                        checkAmount
                    );


                    /* =====================================================
                       INITIAL CHECK
                    ====================================================== */

                    checkAmount();


                    /* =====================================================
                       FORM SUBMIT
                    ====================================================== */

                    form.addEventListener(
                        'submit',
                        function (event) {

                            const newAmount =
                                parseFloat(
                                    amountInput.value
                                );


                            /*
                             * Final security check
                             */

                            if (
                                isNaN(newAmount) ||
                                newAmount < currentAvailable
                            ) {

                                event.preventDefault();

                                updateBtn.classList.add(
                                    'd-none'
                                );

                                return;
                            }


                            /*
                             * Prevent double submission
                             */

                            updateBtn.disabled = true;


                            /*
                             * Show spinner
                             */

                            updateSpinner.classList.remove(
                                'd-none'
                            );


                            updateText.innerHTML =
                                'Updating...';

                        }
                    );

                }
            );

        </script>

    @endpush

@endsection
