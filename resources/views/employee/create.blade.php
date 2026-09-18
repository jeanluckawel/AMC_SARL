@extends('layouts.admin')

@section('title', 'Create Employee - HR Management')

@section('content')

    <style>

        /* =========================================================
           GENERAL
        ========================================================== */

        .employee-card {
            border: 0;
            border-radius: 0 !important;
        }

        .employee-card-wrapper {
            margin: 24px;
        }

        .employee-header {
            background-color: #FF6600;
            color: #fff;
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

        textarea.form-control {
            min-height: 100px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }


        /* =========================================================
           STEPPER
        ========================================================== */

        .employee-stepper {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 35px;
            padding: 0 20px;
        }

        .employee-stepper::before {
            content: "";
            position: absolute;
            top: 20px;
            left: 7%;
            right: 7%;
            height: 2px;
            background: #dee2e6;
            z-index: 0;
        }

        .employee-step {
            position: relative;
            z-index: 1;
            text-align: center;
            flex: 1;
            cursor: pointer;
        }

        .employee-step-number {
            width: 40px;
            height: 40px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #dee2e6;
            color: #495057;
            font-weight: 600;
            border-radius: 0;
            transition: .2s;
        }

        .employee-step-label {
            margin-top: 8px;
            font-size: 13px;
            color: #6c757d;
        }

        .employee-step.active .employee-step-number {
            background: #FF6600;
            color: #fff;
        }

        .employee-step.active .employee-step-label {
            color: #FF6600;
            font-weight: 600;
        }

        .employee-step.completed .employee-step-number {
            background: #198754;
            color: #fff;
        }


        /* =========================================================
           FORM STEPS
        ========================================================== */

        .employee-form-step {
            display: none;
        }

        .employee-form-step.active {
            display: block;
        }

        .step-title {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 12px;
            margin-bottom: 25px;
        }

        .step-title h5 {
            margin-bottom: 4px;
            font-weight: 600;
        }

        .step-title p {
            margin-bottom: 0;
            color: #6c757d;
        }


        /* =========================================================
           PHOTO
        ========================================================== */

        .photo-preview {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 2px solid #FF6600;
            display: none;
            border-radius: 0;
        }

        .photo-placeholder {
            width: 150px;
            height: 150px;
            border: 2px dashed #ced4da;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            background: #f8f9fa;
            border-radius: 0;
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

            .employee-card-wrapper {
                margin: 10px !important;
            }

            .employee-stepper {
                padding: 0;
            }

            .employee-stepper::before {
                display: none;
            }

            .employee-step-label {
                display: none;
            }

            .employee-step-number {
                width: 38px;
                height: 38px;
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
                        Create a New Employee
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

                            Employees

                            <i class="bi bi-chevron-right"></i>

                            Create

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
         MAIN CARD
    ========================================================== --}}

    <div class="card employee-card employee-card-wrapper shadow-sm">

        <div class="card-body">


            {{-- =====================================================
                 VALIDATION SUMMARY
            ====================================================== --}}

            @if($errors->any())

                <div
                    class="alert alert-danger validation-summary"
                    role="alert"
                >

                    <div class="fw-bold mb-2">

                        <i class="bi bi-exclamation-triangle-fill me-2"></i>

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



            {{-- =====================================================
                 STEPPER
            ====================================================== --}}

            <div class="employee-stepper">


                {{-- STEP 1 --}}

                <div
                    class="employee-step active"
                    data-step="1"
                >

                    <div class="employee-step-number">
                        1
                    </div>

                    <div class="employee-step-label">
                        Personal
                    </div>

                </div>


                {{-- STEP 2 --}}

                <div
                    class="employee-step"
                    data-step="2"
                >

                    <div class="employee-step-number">
                        2
                    </div>

                    <div class="employee-step-label">
                        Address
                    </div>

                </div>


                {{-- STEP 3 --}}

                <div
                    class="employee-step"
                    data-step="3"
                >

                    <div class="employee-step-number">
                        3
                    </div>

                    <div class="employee-step-label">
                        Photo
                    </div>

                </div>


                {{-- STEP 4 --}}

                <div
                    class="employee-step"
                    data-step="4"
                >

                    <div class="employee-step-number">
                        4
                    </div>

                    <div class="employee-step-label">
                        Company
                    </div>

                </div>


                {{-- STEP 5 --}}

                <div
                    class="employee-step"
                    data-step="5"
                >

                    <div class="employee-step-number">
                        5
                    </div>

                    <div class="employee-step-label">
                        Family
                    </div>

                </div>


                {{-- STEP 6 --}}

                <div
                    class="employee-step"
                    data-step="6"
                >

                    <div class="employee-step-number">
                        6
                    </div>

                    <div class="employee-step-label">
                        Emergency
                    </div>

                </div>


                {{-- STEP 7 --}}

                <div
                    class="employee-step"
                    data-step="7"
                >

                    <div class="employee-step-number">
                        7
                    </div>

                    <div class="employee-step-label">
                        Salary
                    </div>

                </div>

            </div>



            {{-- =====================================================
                 FORM
            ====================================================== --}}

            <form
                action="{{ route('employees.store') }}"
                method="POST"
                enctype="multipart/form-data"
                id="employeeForm"
                autocomplete="off"
            >

                @csrf



                {{-- =================================================
                     STEP 1 : PERSONAL
                ================================================== --}}

                <div
                    class="employee-form-step active"
                    data-step="1"
                >

                    <div class="step-title">

                        <h5>

                            <i class="bi bi-person me-2"></i>

                            Personal Information

                        </h5>

                        <p>
                            Enter the employee's personal information.
                        </p>

                    </div>


                    <div class="row g-3">


                        {{-- FIRST NAME --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">

                                First Name

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="first_name"
                                class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name') }}"
                                placeholder="John"
                                required
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                                autocomplete="off"
                            >

                            @error('first_name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- MIDDLE NAME --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Middle Name
                            </label>

                            <input
                                type="text"
                                name="middle_name"
                                class="form-control @error('middle_name') is-invalid @enderror"
                                value="{{ old('middle_name') }}"
                                placeholder="Michael"
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                                autocomplete="off"
                            >

                            @error('middle_name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- LAST NAME --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">

                                Last Name

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="last_name"
                                class="form-control @error('last_name') is-invalid @enderror"
                                value="{{ old('last_name') }}"
                                placeholder="Doe"
                                required
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                                autocomplete="off"
                            >

                            @error('last_name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- GENDER --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">

                                Gender

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="gender"
                                class="form-select @error('gender') is-invalid @enderror"
                                required
                                autocomplete="off"
                            >

                                <option value="">
                                    Select gender
                                </option>

                                @foreach(\App\Enums\Gender::cases() as $gender)

                                    <option
                                        value="{{ $gender->value }}"
                                        @selected(
                                            old('gender') === $gender->value
                                        )
                                    >
                                        {{ $gender->label() }}
                                    </option>

                                @endforeach

                            </select>

                            @error('gender')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- DATE OF BIRTH --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">

                                Date of Birth

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="date"
                                name="date_of_birth"
                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                value="{{ old('date_of_birth') }}"
                                required
                                autocomplete="off"
                            >

                            @error('date_of_birth')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- ID CARD --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">

                                ID / Card Number

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="number_card"
                                class="form-control @error('number_card') is-invalid @enderror"
                                value="{{ old('number_card') }}"
                                placeholder="NN338638245"
                                required
                                minlength="10"
                                autocomplete="off"
                            >

                            @error('number_card')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- COUNTRY --}}

                        <div class="col-12 col-md-6">

                            <label class="form-label">

                                Country

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="country"
                                class="form-select @error('country') is-invalid @enderror"
                                required
                                autocomplete="off"
                            >

                                <option value="">
                                    Select country
                                </option>

                                <option
                                    value="Democratic Republic of the Congo"
                                    @selected(
                                        old('country') === 'Democratic Republic of the Congo'
                                    )
                                >
                                    Democratic Republic of the Congo
                                </option>

                                <option
                                    value="Zambia"
                                    @selected(
                                        old('country') === 'Zambia'
                                    )
                                >
                                    Zambia
                                </option>

                                <option
                                    value="South Africa"
                                    @selected(
                                        old('country') === 'South Africa'
                                    )
                                >
                                    South Africa
                                </option>

                                <option
                                    value="Angola"
                                    @selected(
                                        old('country') === 'Angola'
                                    )
                                >
                                    Angola
                                </option>

                                <option
                                    value="Republic of the Congo"
                                    @selected(
                                        old('country') === 'Republic of the Congo'
                                    )
                                >
                                    Republic of the Congo
                                </option>

                            </select>

                            @error('country')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- MARITAL STATUS --}}

                        <div class="col-12 col-md-6">

                            <label class="form-label">

                                Marital Status

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="marital_status"
                                class="form-select @error('marital_status') is-invalid @enderror"
                                required
                                autocomplete="off"
                            >

                                <option value="">
                                    Select marital status
                                </option>

                                @foreach(
                                    \App\Enums\MaritalStatus::cases()
                                    as $status
                                )

                                    <option
                                        value="{{ $status->value }}"
                                        @selected(
                                            old('marital_status')
                                            === $status->value
                                        )
                                    >
                                        {{ $status->label() }}
                                    </option>

                                @endforeach

                            </select>

                            @error('marital_status')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     STEP 2 : ADDRESS
                ================================================== --}}

                <div
                    class="employee-form-step"
                    data-step="2"
                >

                    <div class="step-title">

                        <h5>

                            <i class="bi bi-geo-alt me-2"></i>

                            Address & Contact

                        </h5>

                        <p>
                            Enter employee contact information.
                        </p>

                    </div>


                    <div class="row g-3">


                        {{-- WORK PHONE --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Work Phone
                            </label>

                            <input
                                type="tel"
                                name="employee_work_phone"
                                class="form-control"
                                value="{{ old('employee_work_phone') }}"
                                placeholder="+243 XXX XXX XXX"
                                autocomplete="off"
                            >

                        </div>



                        {{-- PERSONAL PHONE --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Personal Phone
                            </label>

                            <input
                                type="tel"
                                name="employee_phone"
                                class="form-control"
                                value="{{ old('employee_phone') }}"
                                placeholder="+243 XXX XXX XXX"
                                autocomplete="off"
                            >

                        </div>



                        {{-- EMAIL --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="employee_email"
                                class="form-control"
                                value="{{ old('employee_email') }}"
                                placeholder="employee@example.com"
                                autocomplete="off"
                            >

                        </div>



                        {{-- ADDRESS --}}

                        <div class="col-12">

                            <label class="form-label">
                                Address
                            </label>

                            <textarea
                                name="employee_address"
                                class="form-control"
                                rows="4"
                                placeholder="Enter employee address"
                                autocomplete="off"
                            >{{ old('employee_address') }}</textarea>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     STEP 3 : PHOTO
                ================================================== --}}

                <div
                    class="employee-form-step"
                    data-step="3"
                >

                    <div class="step-title">

                        <h5>

                            <i class="bi bi-camera me-2"></i>

                            Employee Photo

                        </h5>

                        <p>
                            Upload an optional employee photo.
                        </p>

                    </div>


                    <div class="row g-4">


                        <div class="col-12 col-md-6">

                            <label class="form-label">
                                Employee Photo
                            </label>

                            <input
                                type="file"
                                name="photo"
                                id="photoInput"
                                class="form-control @error('photo') is-invalid @enderror"
                                accept="image/jpeg,image/png"
                                autocomplete="off"
                            >

                            <small class="text-muted">

                                JPG, JPEG or PNG.
                                Maximum 2 MB.

                            </small>

                            @error('photo')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        <div class="col-12 col-md-6">

                            <div class="d-flex align-items-center">

                                <div
                                    id="photoPlaceholder"
                                    class="photo-placeholder"
                                >

                                    <i class="bi bi-person fs-1"></i>

                                </div>


                                <img
                                    id="photoPreview"
                                    class="photo-preview ms-3"
                                    alt="Employee photo preview"
                                >

                            </div>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     STEP 4 : COMPANY
                ================================================== --}}

                <div
                    class="employee-form-step"
                    data-step="4"
                >

                    <div class="step-title">

                        <h5>

                            <i class="bi bi-building me-2"></i>

                            Company Information

                        </h5>

                        <p>
                            Assign the employee to a department, section and job title.
                        </p>

                    </div>


                    <div class="row g-3">


                        {{-- DEPARTMENT --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">

                                Department

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="department_id"
                                id="department"
                                class="form-select @error('department_id') is-invalid @enderror"
                                required
                                autocomplete="off"
                            >

                                <option value="">
                                    Select department
                                </option>

                                @foreach($departments as $department)

                                    <option
                                        value="{{ $department->id }}"
                                        @selected(
                                            old('department_id') == $department->id
                                        )
                                    >
                                        {{ $department->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('department_id')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- SECTION --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">

                                Section

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="section_id"
                                id="section"
                                class="form-select @error('section_id') is-invalid @enderror"
                                required
                                disabled
                                autocomplete="off"
                            >

                                <option value="">
                                    Select department first
                                </option>

                            </select>

                            @error('section_id')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- JOB TITLE --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">

                                Job Title

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="job_title_id"
                                id="job_title"
                                class="form-select @error('job_title_id') is-invalid @enderror"
                                required
                                disabled
                                autocomplete="off"
                            >

                                <option value="">
                                    Select section first
                                </option>

                            </select>

                            @error('job_title_id')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- CONTRACT TYPE --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">

                                Contract Type

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="contract_type"
                                id="contract_type"
                                class="form-select @error('contract_type') is-invalid @enderror"
                                required
                                autocomplete="off"
                            >

                                <option value="">
                                    Select contract type
                                </option>

                                @foreach(
                                    \App\Enums\ContractType::cases()
                                    as $contract
                                )

                                    <option
                                        value="{{ $contract->value }}"
                                        @selected(
                                            old('contract_type')
                                            === $contract->value
                                        )
                                    >
                                        {{ $contract->label() }}
                                    </option>

                                @endforeach

                            </select>

                            @error('contract_type')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- END CONTRACT DATE --}}

                        <div
                            class="col-12 col-md-4 d-none"
                            id="endContractWrapper"
                        >

                            <label class="form-label">

                                End Contract Date

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="date"
                                name="end_contract_date"
                                id="end_contract_date"
                                class="form-control @error('end_contract_date') is-invalid @enderror"
                                value="{{ old('end_contract_date') }}"
                                autocomplete="off"
                            >

                            @error('end_contract_date')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- WORK LOCATION --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">

                                Work Location

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="work_location"
                                class="form-select @error('work_location') is-invalid @enderror"
                                required
                                autocomplete="off"
                            >

                                <option value="">
                                    Select location
                                </option>

                                @foreach(
                                    \App\Enums\WorkLocation::cases()
                                    as $location
                                )

                                    <option
                                        value="{{ $location->value }}"
                                        @selected(
                                            old('work_location')
                                            === $location->value
                                        )
                                    >
                                        {{ $location->label() }}
                                    </option>

                                @endforeach

                            </select>

                            @error('work_location')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- SUPERVISOR --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Supervisor
                            </label>

                            <input
                                type="text"
                                name="supervisor"
                                class="form-control"
                                value="{{ old('supervisor') }}"
                                placeholder="Supervisor name"
                                autocomplete="off"
                            >

                        </div>



                        {{-- EMPLOYEE TYPE --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">

                                Employee Type

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="employee_type"
                                class="form-select @error('employee_type') is-invalid @enderror"
                                required
                                autocomplete="off"
                            >

                                <option value="">
                                    Select employee type
                                </option>

                                @foreach(
                                    \App\Enums\EmployeeType::cases()
                                    as $type
                                )

                                    <option
                                        value="{{ $type->value }}"
                                        @selected(
                                            old('employee_type')
                                            === $type->value
                                        )
                                    >
                                        {{ $type->label() }}
                                    </option>

                                @endforeach

                            </select>

                            @error('employee_type')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>



                        {{-- HIRE DATE --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">

                                Hire Date

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="date"
                                name="hire_date"
                                class="form-control @error('hire_date') is-invalid @enderror"
                                value="{{ old('hire_date') }}"
                                required
                                autocomplete="off"
                            >

                            @error('hire_date')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     STEP 5 : FAMILY
                ================================================== --}}

                <div
                    class="employee-form-step"
                    data-step="5"
                >

                    <div class="step-title">

                        <h5>

                            <i class="bi bi-people me-2"></i>

                            Family Information

                        </h5>

                        <p>
                            Enter spouse and parent information.
                        </p>

                    </div>


                    <div class="row g-3">


                        {{-- SPOUSE --}}

                        <div class="col-12">

                            <h6 class="mb-1">

                                <i class="bi bi-person-heart me-2"></i>

                                Spouse Information

                            </h6>

                        </div>


                        {{-- SPOUSE STATUS --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="spouse_status"
                                class="form-select"
                                autocomplete="off"
                            >

                                <option value="">
                                    Select status
                                </option>

                                <option
                                    value="Married"
                                    @selected(
                                        old('spouse_status') === 'Married'
                                    )
                                >
                                    Married
                                </option>

                                <option
                                    value="Single"
                                    @selected(
                                        old('spouse_status') === 'Single'
                                    )
                                >
                                    Single
                                </option>

                                <option
                                    value="Divorced"
                                    @selected(
                                        old('spouse_status') === 'Divorced'
                                    )
                                >
                                    Divorced
                                </option>

                                <option
                                    value="Widowed"
                                    @selected(
                                        old('spouse_status') === 'Widowed'
                                    )
                                >
                                    Widowed
                                </option>

                            </select>

                        </div>



                        {{-- SPOUSE NAME --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="spouse_full_name"
                                class="form-control"
                                value="{{ old('spouse_full_name') }}"
                                placeholder="Spouse full name"
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                                autocomplete="off"
                            >

                        </div>



                        {{-- SPOUSE PHONE --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Phone
                            </label>

                            <input
                                type="tel"
                                name="spouse_phone"
                                class="form-control"
                                value="{{ old('spouse_phone') }}"
                                placeholder="+243 XXX XXX XXX"
                                autocomplete="off"
                            >

                        </div>



                        {{-- PARENTS --}}

                        <div class="col-12 mt-4">

                            <h6 class="mb-1">

                                <i class="bi bi-people-fill me-2"></i>

                                Parents & In-Laws

                            </h6>

                            <small class="text-muted">

                                Enter the full name, telephone number and status
                                of each parent.

                            </small>

                        </div>



                        {{-- FATHER --}}

                        <div class="col-12 col-md-5">

                            <label class="form-label">
                                Father Full Name
                            </label>

                            <input
                                type="hidden"
                                name="parents[father][relationship]"
                                value="Father"
                            >

                            <input
                                type="text"
                                name="parents[father][full_name]"
                                class="form-control"
                                value="{{ old('parents.father.full_name') }}"
                                placeholder="Father full name"
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                                autocomplete="off"
                            >

                        </div>


                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Telephone
                            </label>

                            <input
                                type="tel"
                                name="parents[father][phone]"
                                class="form-control"
                                value="{{ old('parents.father.phone') }}"
                                placeholder="+243 XXX XXX XXX"
                                autocomplete="off"
                            >

                        </div>


                        <div class="col-12 col-md-3">

                            <label class="form-label">
                                Status
                            </label>

                            <div class="form-check mt-2">

                                <input
                                    type="checkbox"
                                    name="parents[father][deceased]"
                                    value="1"
                                    class="form-check-input"
                                    id="fatherDeceased"
                                    @checked(
                                        old('parents.father.deceased')
                                    )
                                >

                                <label
                                    class="form-check-label"
                                    for="fatherDeceased"
                                >
                                    Deceased
                                </label>

                            </div>

                        </div>



                        {{-- MOTHER --}}

                        <div class="col-12 col-md-5">

                            <label class="form-label">
                                Mother Full Name
                            </label>

                            <input
                                type="hidden"
                                name="parents[mother][relationship]"
                                value="Mother"
                            >

                            <input
                                type="text"
                                name="parents[mother][full_name]"
                                class="form-control"
                                value="{{ old('parents.mother.full_name') }}"
                                placeholder="Mother full name"
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                                autocomplete="off"
                            >

                        </div>


                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Telephone
                            </label>

                            <input
                                type="tel"
                                name="parents[mother][phone]"
                                class="form-control"
                                value="{{ old('parents.mother.phone') }}"
                                placeholder="+243 XXX XXX XXX"
                                autocomplete="off"
                            >

                        </div>


                        <div class="col-12 col-md-3">

                            <label class="form-label">
                                Status
                            </label>

                            <div class="form-check mt-2">

                                <input
                                    type="checkbox"
                                    name="parents[mother][deceased]"
                                    value="1"
                                    class="form-check-input"
                                    id="motherDeceased"
                                    @checked(
                                        old('parents.mother.deceased')
                                    )
                                >

                                <label
                                    class="form-check-label"
                                    for="motherDeceased"
                                >
                                    Deceased
                                </label>

                            </div>

                        </div>



                        {{-- FATHER IN LAW --}}

                        <div class="col-12 col-md-5">

                            <label class="form-label">
                                Father-in-law Full Name
                            </label>

                            <input
                                type="hidden"
                                name="parents[father_in_law][relationship]"
                                value="Father-in-law"
                            >

                            <input
                                type="text"
                                name="parents[father_in_law][full_name]"
                                class="form-control"
                                value="{{ old('parents.father_in_law.full_name') }}"
                                placeholder="Father-in-law full name"
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                                autocomplete="off"
                            >

                        </div>


                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Telephone
                            </label>

                            <input
                                type="tel"
                                name="parents[father_in_law][phone]"
                                class="form-control"
                                value="{{ old('parents.father_in_law.phone') }}"
                                placeholder="+243 XXX XXX XXX"
                                autocomplete="off"
                            >

                        </div>


                        <div class="col-12 col-md-3">

                            <label class="form-label">
                                Status
                            </label>

                            <div class="form-check mt-2">

                                <input
                                    type="checkbox"
                                    name="parents[father_in_law][deceased]"
                                    value="1"
                                    class="form-check-input"
                                    id="fatherInLawDeceased"
                                    @checked(
                                        old('parents.father_in_law.deceased')
                                    )
                                >

                                <label
                                    class="form-check-label"
                                    for="fatherInLawDeceased"
                                >
                                    Deceased
                                </label>

                            </div>

                        </div>



                        {{-- MOTHER IN LAW --}}

                        <div class="col-12 col-md-5">

                            <label class="form-label">
                                Mother-in-law Full Name
                            </label>

                            <input
                                type="hidden"
                                name="parents[mother_in_law][relationship]"
                                value="Mother-in-law"
                            >

                            <input
                                type="text"
                                name="parents[mother_in_law][full_name]"
                                class="form-control"
                                value="{{ old('parents.mother_in_law.full_name') }}"
                                placeholder="Mother-in-law full name"
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                                autocomplete="off"
                            >

                        </div>


                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Telephone
                            </label>

                            <input
                                type="tel"
                                name="parents[mother_in_law][phone]"
                                class="form-control"
                                value="{{ old('parents.mother_in_law.phone') }}"
                                placeholder="+243 XXX XXX XXX"
                                autocomplete="off"
                            >

                        </div>


                        <div class="col-12 col-md-3">

                            <label class="form-label">
                                Status
                            </label>

                            <div class="form-check mt-2">

                                <input
                                    type="checkbox"
                                    name="parents[mother_in_law][deceased]"
                                    value="1"
                                    class="form-check-input"
                                    id="motherInLawDeceased"
                                    @checked(
                                        old('parents.mother_in_law.deceased')
                                    )
                                >

                                <label
                                    class="form-check-label"
                                    for="motherInLawDeceased"
                                >
                                    Deceased
                                </label>

                            </div>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     STEP 6 : EMERGENCY
                ================================================== --}}

                <div
                    class="employee-form-step"
                    data-step="6"
                >

                    <div class="step-title">

                        <h5>

                            <i class="bi bi-telephone-forward me-2"></i>

                            Emergency Contact

                        </h5>

                        <p>
                            Enter the employee's emergency contact information.
                        </p>

                    </div>


                    <div class="row g-3">


                        {{-- RELATIONSHIP --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Relationship
                            </label>

                            <select
                                name="emergency_relationship"
                                class="form-select"
                                autocomplete="off"
                            >

                                <option value="">
                                    Select relationship
                                </option>

                                @foreach(
                                    \App\Enums\EmergencyRelationship::cases()
                                    as $relationship
                                )

                                    <option
                                        value="{{ $relationship->value }}"
                                        @selected(
                                            old('emergency_relationship')
                                            === $relationship->value
                                        )
                                    >
                                        {{ $relationship->label() }}
                                    </option>

                                @endforeach

                            </select>

                        </div>



                        {{-- FULL NAME --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="emergency_full_name"
                                class="form-control"
                                value="{{ old('emergency_full_name') }}"
                                placeholder="Emergency contact name"
                                autocomplete="off"
                            >

                        </div>



                        {{-- PHONE --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Phone
                            </label>

                            <input
                                type="tel"
                                name="emergency_phone"
                                class="form-control"
                                value="{{ old('emergency_phone') }}"
                                placeholder="+243 XXX XXX XXX"
                                autocomplete="off"
                            >

                        </div>



                        {{-- ADDRESS --}}

                        <div class="col-12">

                            <label class="form-label">
                                Address
                            </label>

                            <textarea
                                name="emergency_address"
                                class="form-control"
                                rows="3"
                                placeholder="Emergency contact address"
                                autocomplete="off"
                            >{{ old('emergency_address') }}</textarea>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     STEP 7 : SALARY
                ================================================== --}}

                <div
                    class="employee-form-step"
                    data-step="7"
                >

                    <div class="step-title">

                        <h5>

                            <i class="bi bi-cash-stack me-2"></i>

                            Salary Information

                        </h5>

                        <p>
                            Enter employee salary information.
                        </p>

                    </div>


                    <div class="row g-3">


                        {{-- BASE SALARY --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Base Salary
                            </label>

                            <input
                                type="number"
                                name="salary_base_salary"
                                id="salary_base_salary"
                                class="form-control"
                                value="{{ old('salary_base_salary') }}"
                                min="0"
                                step="0.01"
                                placeholder="0.00"
                                autocomplete="off"
                            >

                        </div>



                        {{-- CATEGORY --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Salary Category
                            </label>

                            <select
                                name="salary_category"
                                id="categorySelect"
                                class="form-select"
                                autocomplete="off"
                            >

                                <option value="">
                                    Select category
                                </option>

                                @foreach(
                                    \App\Enums\SalaryCategory::cases()
                                    as $category
                                )

                                    <option
                                        value="{{ $category->value }}"
                                        @selected(
                                            old('salary_category')
                                            === $category->value
                                        )
                                    >
                                        {{ $category->label() }}
                                    </option>

                                @endforeach

                            </select>

                        </div>



                        {{-- ECHELON --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Echelon
                            </label>

                            <input
                                type="text"
                                name="salary_echelon"
                                id="echelonSelect"
                                class="form-control"
                                value="{{ old('salary_echelon') }}"
                                placeholder="Echelon"
                                autocomplete="off"
                            >

                        </div>



                        {{-- CURRENCY --}}

                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Currency
                            </label>

                            <select
                                name="salary_currency"
                                class="form-select"
                                autocomplete="off"
                            >

                                <option value="">
                                    Select currency
                                </option>

                                @foreach(
                                    \App\Enums\SalaryCurrency::cases()
                                    as $currency
                                )

                                    <option
                                        value="{{ $currency->value }}"
                                        @selected(
                                            old('salary_currency')
                                            === $currency->value
                                        )
                                    >
                                        {{ $currency->label() }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     NAVIGATION BUTTONS
                ================================================== --}}

                <div
                    class="d-flex justify-content-between mt-4 pt-3 border-top"
                >


                    {{-- CANCEL --}}

                    <div>

                        <button
                            type="button"
                            class="btn btn-secondary"
                            id="cancelBtn"
                        >

                            <i class="bi bi-x-lg me-1"></i>

                            Cancel

                        </button>

                    </div>



                    {{-- NAVIGATION --}}

                    <div>


                        {{-- PREVIOUS --}}

                        <button
                            type="button"
                            class="btn btn-secondary me-2"
                            id="previousBtn"
                            style="display:none;"
                        >

                            <i class="bi bi-arrow-left me-1"></i>

                            Previous

                        </button>



                        {{-- NEXT --}}

                        <button
                            type="button"
                            class="btn btn-orange"
                            id="nextBtn"
                        >

                            Next

                            <i class="bi bi-arrow-right ms-1"></i>

                        </button>



                        {{-- SAVE --}}

                        <button
                            type="submit"
                            class="btn btn-success"
                            id="saveBtn"
                            style="display:none;"
                        >

                        <span
                            class="spinner-border spinner-border-sm d-none"
                            id="saveSpinner"
                            role="status"
                            aria-hidden="true"
                        ></span>


                            <span id="saveText">

                            <i class="bi bi-check-lg me-1"></i>

                            Save

                        </span>

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>



    {{-- =========================================================
         JAVASCRIPT
    ========================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {


            /* =========================================================
               FORM
            ========================================================== */

            const form =
                document.getElementById('employeeForm');


            /* =========================================================
               STEPS
            ========================================================== */

            const steps =
                document.querySelectorAll('.employee-form-step');

            const stepIndicators =
                document.querySelectorAll('.employee-step');


            const nextBtn =
                document.getElementById('nextBtn');

            const previousBtn =
                document.getElementById('previousBtn');

            const cancelBtn =
                document.getElementById('cancelBtn');

            const saveBtn =
                document.getElementById('saveBtn');

            const saveSpinner =
                document.getElementById('saveSpinner');

            const saveText =
                document.getElementById('saveText');


            let currentStep = 0;



            /* =========================================================
               DEPARTMENT / SECTION / JOB TITLE
               NO AJAX
            ========================================================== */

            const department =
                document.getElementById('department');

            const section =
                document.getElementById('section');

            const jobTitle =
                document.getElementById('job_title');


            /*
             * Laravel sends all data to the page.
             * No AJAX is used.
             */

            const sections =
                @json($sections);

            const jobTitles =
                @json($jobTitles);


            /* =========================================================
               OLD VALUES
            ========================================================== */

            const oldDepartmentId =
                @json(old('department_id'));

            const oldSectionId =
                @json(old('section_id'));

            const oldJobTitleId =
                @json(old('job_title_id'));



            /* =========================================================
               LOAD SECTIONS
            ========================================================== */

            function loadSections(
                departmentId,
                selectedSectionId = null
            ) {

                section.innerHTML =
                    '<option value="">Select section</option>';

                section.disabled = true;


                jobTitle.innerHTML =
                    '<option value="">Select section first</option>';

                jobTitle.disabled = true;


                if (!departmentId) {

                    section.innerHTML =
                        '<option value="">Select department first</option>';

                    return;
                }


                const filteredSections =
                    sections.filter(function (item) {

                        return String(item.department_id) ===
                            String(departmentId);

                    });


                filteredSections.forEach(function (item) {

                    const option =
                        document.createElement('option');


                    option.value =
                        item.id;


                    option.textContent =
                        item.name;


                    if (
                        selectedSectionId &&
                        String(selectedSectionId) ===
                        String(item.id)
                    ) {

                        option.selected = true;

                    }


                    section.appendChild(option);

                });


                if (filteredSections.length > 0) {

                    section.disabled = false;

                } else {

                    section.innerHTML =
                        '<option value="">No section available</option>';

                }

            }



            /* =========================================================
               LOAD JOB TITLES
            ========================================================== */

            function loadJobTitles(
                sectionId,
                selectedJobTitleId = null
            ) {

                jobTitle.innerHTML =
                    '<option value="">Select job title</option>';

                jobTitle.disabled = true;


                if (!sectionId) {

                    jobTitle.innerHTML =
                        '<option value="">Select section first</option>';

                    return;
                }


                const filteredJobTitles =
                    jobTitles.filter(function (item) {

                        return String(item.section_id) ===
                            String(sectionId);

                    });


                filteredJobTitles.forEach(function (item) {

                    const option =
                        document.createElement('option');


                    option.value =
                        item.id;


                    option.textContent =
                        item.name;


                    if (
                        selectedJobTitleId &&
                        String(selectedJobTitleId) ===
                        String(item.id)
                    ) {

                        option.selected = true;

                    }


                    jobTitle.appendChild(option);

                });


                if (filteredJobTitles.length > 0) {

                    jobTitle.disabled = false;

                } else {

                    jobTitle.innerHTML =
                        '<option value="">No job title available</option>';

                }

            }



            /* =========================================================
               DEPARTMENT CHANGE
            ========================================================== */

            if (
                department &&
                section &&
                jobTitle
            ) {

                department.addEventListener(
                    'change',
                    function () {

                        loadSections(
                            this.value
                        );

                    }
                );


                /* =====================================================
                   SECTION CHANGE
                ====================================================== */

                section.addEventListener(
                    'change',
                    function () {

                        loadJobTitles(
                            this.value
                        );

                    }
                );


                /* =====================================================
                   RESTORE OLD VALUES
                ====================================================== */

                if (oldDepartmentId) {

                    department.value =
                        oldDepartmentId;


                    loadSections(
                        oldDepartmentId,
                        oldSectionId
                    );


                    if (oldSectionId) {

                        loadJobTitles(
                            oldSectionId,
                            oldJobTitleId
                        );

                    }

                }

            }



            /* =========================================================
               SHOW STEP
            ========================================================== */

            function showStep(step) {

                if (step < 0) {

                    step = 0;

                }


                if (step >= steps.length) {

                    step =
                        steps.length - 1;

                }


                steps.forEach(function (item, index) {

                    item.classList.toggle(
                        'active',
                        index === step
                    );

                });


                stepIndicators.forEach(function (item, index) {

                    item.classList.toggle(
                        'active',
                        index === step
                    );


                    item.classList.toggle(
                        'completed',
                        index < step
                    );

                });


                currentStep =
                    step;


                /* Previous */

                if (previousBtn) {

                    previousBtn.style.display =
                        currentStep === 0
                            ? 'none'
                            : 'inline-block';

                }


                /* Next */

                if (nextBtn) {

                    nextBtn.style.display =
                        currentStep === steps.length - 1
                            ? 'none'
                            : 'inline-block';

                }


                /* Save */

                if (saveBtn) {

                    saveBtn.style.display =
                        currentStep === steps.length - 1
                            ? 'inline-block'
                            : 'none';

                }


                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

            }



            /* =========================================================
               VALIDATE STEP
            ========================================================== */

            function validateStep(step) {

                if (!step) {

                    return true;

                }


                const fields =
                    step.querySelectorAll(
                        'input, select, textarea'
                    );


                let valid = true;


                fields.forEach(function (field) {

                    if (field.disabled) {

                        return;

                    }


                    if (!field.checkValidity()) {

                        field.classList.add(
                            'is-invalid'
                        );

                        valid = false;

                    } else {

                        field.classList.remove(
                            'is-invalid'
                        );

                    }

                });


                if (!valid) {

                    const firstInvalid =
                        step.querySelector(
                            '.is-invalid'
                        );


                    if (firstInvalid) {

                        firstInvalid.focus();

                    }

                }


                return valid;

            }



            /* =========================================================
               NEXT BUTTON
            ========================================================== */

            if (nextBtn) {

                nextBtn.addEventListener(
                    'click',
                    function () {

                        const step =
                            steps[currentStep];


                        if (!validateStep(step)) {

                            return;

                        }


                        if (
                            currentStep <
                            steps.length - 1
                        ) {

                            showStep(
                                currentStep + 1
                            );

                        }

                    }
                );

            }



            /* =========================================================
               PREVIOUS BUTTON
            ========================================================== */

            if (previousBtn) {

                previousBtn.addEventListener(
                    'click',
                    function () {

                        if (currentStep > 0) {

                            showStep(
                                currentStep - 1
                            );

                        }

                    }
                );

            }



            /* =========================================================
               STEP INDICATORS
            ========================================================== */

            stepIndicators.forEach(
                function (indicator, index) {

                    indicator.addEventListener(
                        'click',
                        function () {

                            /*
                             * Only allow going backward
                             * or staying on current step.
                             */

                            if (index <= currentStep) {

                                showStep(index);

                            }

                        }
                    );

                }
            );



            /* =========================================================
               REMOVE INVALID CLASS
            ========================================================== */

            document
                .querySelectorAll(
                    'input, select, textarea'
                )
                .forEach(function (field) {


                    field.addEventListener(
                        'input',
                        function () {

                            if (this.checkValidity()) {

                                this.classList.remove(
                                    'is-invalid'
                                );

                            }

                        }
                    );


                    field.addEventListener(
                        'change',
                        function () {

                            if (this.checkValidity()) {

                                this.classList.remove(
                                    'is-invalid'
                                );

                            }

                        }
                    );

                });



            /* =========================================================
               PHOTO PREVIEW
            ========================================================== */

            const photoInput =
                document.getElementById('photoInput');

            const photoPreview =
                document.getElementById('photoPreview');

            const photoPlaceholder =
                document.getElementById('photoPlaceholder');


            if (
                photoInput &&
                photoPreview
            ) {

                photoInput.addEventListener(
                    'change',
                    function () {

                        const file =
                            this.files[0];


                        if (!file) {

                            photoPreview.style.display =
                                'none';


                            if (photoPlaceholder) {

                                photoPlaceholder.style.display =
                                    'flex';

                            }

                            return;

                        }


                        if (
                            !file.type.startsWith('image/')
                        ) {

                            this.value = '';

                            return;

                        }


                        const reader =
                            new FileReader();


                        reader.onload =
                            function (event) {

                                photoPreview.src =
                                    event.target.result;


                                photoPreview.style.display =
                                    'block';


                                if (photoPlaceholder) {

                                    photoPlaceholder.style.display =
                                        'none';

                                }

                            };


                        reader.readAsDataURL(file);

                    }
                );

            }



            /* =========================================================
               CONTRACT TYPE
            ========================================================== */

            const contractType =
                document.getElementById('contract_type');

            const endContractWrapper =
                document.getElementById('endContractWrapper');

            const endContractDate =
                document.getElementById('end_contract_date');


            function updateContractType() {

                if (!contractType) {

                    return;

                }


                const value =
                    contractType.value;


                /*
                 * IMPORTANT:
                 * Adapt these values if your ContractType
                 * enum uses different values.
                 */

                const needsEndDate =
                    value === 'fixed_term' ||
                    value === 'temporary' ||
                    value === 'CDD';


                if (needsEndDate) {

                    if (endContractWrapper) {

                        endContractWrapper.classList.remove(
                            'd-none'
                        );

                    }


                    if (endContractDate) {

                        endContractDate.required =
                            true;

                    }

                } else {

                    if (endContractWrapper) {

                        endContractWrapper.classList.add(
                            'd-none'
                        );

                    }


                    if (endContractDate) {

                        endContractDate.required =
                            false;

                        endContractDate.value =
                            '';

                    }

                }

            }


            if (contractType) {

                contractType.addEventListener(
                    'change',
                    updateContractType
                );


                updateContractType();

            }



            /* =========================================================
               SALARY CATEGORY -> ECHELON
            ========================================================== */

            const categorySelect =
                document.getElementById('categorySelect');

            const echelonSelect =
                document.getElementById('echelonSelect');


            /*
             * This is only an example mapping.
             * Change it according to your salary rules.
             */

            const echelons = {

                A: [
                    'A1',
                    'A2',
                    'A3'
                ],

                B: [
                    'B1',
                    'B2',
                    'B3'
                ],

                C: [
                    'C1',
                    'C2',
                    'C3'
                ],

                D: [
                    'D1',
                    'D2',
                    'D3'
                ]

            };


            function updateEchelon() {

                if (
                    !categorySelect ||
                    !echelonSelect
                ) {

                    return;

                }


                const category =
                    categorySelect.value;


                if (!category) {

                    echelonSelect.value = '';

                    return;

                }


                const values =
                    echelons[category] || [];


                /*
                 * Your echelon field is currently
                 * an INPUT, not a SELECT.
                 *
                 * If there are several echelons,
                 * leave it available for manual entry.
                 */

                if (values.length === 1) {

                    echelonSelect.value =
                        values[0];

                }

            }


            if (categorySelect) {

                categorySelect.addEventListener(
                    'change',
                    updateEchelon
                );


                updateEchelon();

            }



            /* =========================================================
               AUTOCOMPLETE OFF
            ========================================================== */

            if (form) {

                form.setAttribute(
                    'autocomplete',
                    'off'
                );


                form.querySelectorAll(
                    'input, select, textarea'
                ).forEach(function (field) {

                    field.setAttribute(
                        'autocomplete',
                        'off'
                    );

                });

            }



            /* =========================================================
               CANCEL
            ========================================================== */

            if (cancelBtn) {

                cancelBtn.addEventListener(
                    'click',
                    function () {

                        window.history.back();

                    }
                );

            }



            /* =========================================================
               FORM SUBMIT
            ========================================================== */

            if (form) {

                form.addEventListener(
                    'submit',
                    function (event) {

                        let firstInvalidStep =
                            -1;


                        /*
                         * Validate every step.
                         */

                        steps.forEach(
                            function (step, index) {

                                if (!validateStep(step)) {

                                    if (
                                        firstInvalidStep === -1
                                    ) {

                                        firstInvalidStep =
                                            index;

                                    }

                                }

                            }
                        );


                        /*
                         * Validation failed.
                         */

                        if (
                            firstInvalidStep !== -1
                        ) {

                            event.preventDefault();


                            showStep(
                                firstInvalidStep
                            );


                            return;

                        }


                        /*
                         * Prevent double submission.
                         */

                        if (saveBtn) {

                            saveBtn.disabled =
                                true;

                        }


                        /*
                         * Show spinner.
                         */

                        if (saveSpinner) {

                            saveSpinner.classList.remove(
                                'd-none'
                            );

                        }


                        /*
                         * Change save text.
                         */

                        if (saveText) {

                            saveText.innerHTML =
                                'Saving...';

                        }

                    }
                );

            }



            /* =========================================================
               INITIAL STEP
            ========================================================== */

            showStep(0);

        });
    </script>

@endsection
