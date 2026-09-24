@extends('layouts.admin')

@section('title', 'Edit Employee - HR Management')

@section('content')

    <style>

        /* =========================================================
           GENERAL (identique à create)
        ========================================================== */

        .employee-card {
            border: 0;
            border-radius: 0 !important;
        }

        .employee-card-wrapper {
            margin: 24px;
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
                        Edit Employee — {{ $employee->first_name }} {{ $employee->last_name }}
                    </h3>
                </div>
                <div class="col-md-6 col-12">
                    <ol class="breadcrumb float-md-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Employees
                            <i class="bi bi-chevron-right"></i>
                            Edit
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

            {{-- VALIDATION SUMMARY --}}

            @if($errors->any())
                <div class="alert alert-danger validation-summary" role="alert">
                    <div class="fw-bold mb-2">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Please correct the following errors:
                    </div>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- STEPPER --}}

            <div class="employee-stepper">

                <div class="employee-step active" data-step="1">
                    <div class="employee-step-number">1</div>
                    <div class="employee-step-label">Personal</div>
                </div>

                <div class="employee-step" data-step="2">
                    <div class="employee-step-number">2</div>
                    <div class="employee-step-label">Address</div>
                </div>

                <div class="employee-step" data-step="3">
                    <div class="employee-step-number">3</div>
                    <div class="employee-step-label">Photo</div>
                </div>

                <div class="employee-step" data-step="4">
                    <div class="employee-step-number">4</div>
                    <div class="employee-step-label">Company</div>
                </div>

                <div class="employee-step" data-step="5">
                    <div class="employee-step-number">5</div>
                    <div class="employee-step-label">Family</div>
                </div>

                <div class="employee-step" data-step="6">
                    <div class="employee-step-number">6</div>
                    <div class="employee-step-label">Emergency</div>
                </div>

                <div class="employee-step" data-step="7">
                    <div class="employee-step-number">7</div>
                    <div class="employee-step-label">Salary</div>
                </div>

            </div>


            {{-- =====================================================
                FORM
            ====================================================== --}}

            @php
                $emergency = $employee->emergencyContacts->first();

                // On récupère les parents par leur relationship pour préremplir
                $father = $employee->parents->firstWhere('relationship', 'Father');
                $mother = $employee->parents->firstWhere('relationship', 'Mother');
                $fatherInLaw = $employee->parents->firstWhere('relationship', 'Father-in-law');
                $motherInLaw = $employee->parents->firstWhere('relationship', 'Mother-in-law');
            @endphp

            <form
                action="{{ route('employees.update', $employee) }}"
                method="POST"
                enctype="multipart/form-data"
                id="employeeForm"
                autocomplete="off"
            >

                @csrf
                @method('PUT')


                {{-- =================================================
                    STEP 1 : PERSONAL
                ================================================== --}}

                <div class="employee-form-step active" data-step="1">

                    <div class="step-title">
                        <h5><i class="bi bi-person me-2"></i> Personal Information</h5>
                        <p>Update the employee's personal information.</p>
                    </div>

                    <div class="row g-3">

                        <div class="col-12 col-md-4">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="first_name"
                                class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name', $employee->first_name) }}"
                                required
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                                autocomplete="off"
                            >
                            @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input
                                type="text"
                                name="middle_name"
                                class="form-control @error('middle_name') is-invalid @enderror"
                                value="{{ old('middle_name', $employee->middle_name) }}"
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                                autocomplete="off"
                            >
                            @error('middle_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="last_name"
                                class="form-control @error('last_name') is-invalid @enderror"
                                value="{{ old('last_name', $employee->last_name) }}"
                                required
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                                autocomplete="off"
                            >
                            @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                <option value="">Select gender</option>
                                @foreach(\App\Enums\Gender::cases() as $gender)
                                    <option
                                        value="{{ $gender->value }}"
                                        @selected(old('gender', $employee->gender?->value) === $gender->value)
                                    >
                                        {{ $gender->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                            <input
                                type="date"
                                name="date_of_birth"
                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                value="{{ old('date_of_birth', $employee->date_of_birth?->format('Y-m-d')) }}"
                                required
                            >
                            @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">ID / Card Number <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="number_card"
                                class="form-control @error('number_card') is-invalid @enderror"
                                value="{{ old('number_card', $employee->number_card) }}"
                                required
                                minlength="10"
                            >
                            @error('number_card')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Country <span class="text-danger">*</span></label>
                            <select name="country" class="form-select @error('country') is-invalid @enderror" required>
                                <option value="">Select country</option>
                                @foreach([
                                    'Democratic Republic of the Congo',
                                    'Zambia',
                                    'South Africa',
                                    'Angola',
                                    'Republic of the Congo',
                                ] as $countryOption)
                                    <option
                                        value="{{ $countryOption }}"
                                        @selected(old('country', $employee->country) === $countryOption)
                                    >
                                        {{ $countryOption }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Marital Status <span class="text-danger">*</span></label>
                            <select name="marital_status" class="form-select @error('marital_status') is-invalid @enderror" required>
                                <option value="">Select marital status</option>
                                @foreach(\App\Enums\MaritalStatus::cases() as $status)
                                    <option
                                        value="{{ $status->value }}"
                                        @selected(old('marital_status', $employee->marital_status?->value) === $status->value)
                                    >
                                        {{ $status->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('marital_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>


                {{-- =================================================
                    STEP 2 : ADDRESS
                ================================================== --}}

                <div class="employee-form-step" data-step="2">

                    <div class="step-title">
                        <h5><i class="bi bi-geo-alt me-2"></i> Address & Contact</h5>
                        <p>Update employee contact information.</p>
                    </div>

                    <div class="row g-3">

                        <div class="col-12 col-md-4">
                            <label class="form-label">Work Phone</label>
                            <input
                                type="tel"
                                name="employee_work_phone"
                                class="form-control"
                                value="{{ old('employee_work_phone', $employee->employee_work_phone) }}"
                            >
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Personal Phone</label>
                            <input
                                type="tel"
                                name="employee_phone"
                                class="form-control"
                                value="{{ old('employee_phone', $employee->employee_phone) }}"
                            >
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Email Address</label>
                            <input
                                type="email"
                                name="employee_email"
                                class="form-control"
                                value="{{ old('employee_email', $employee->employee_email) }}"
                            >
                        </div>

                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="employee_address" class="form-control" rows="4"
                            >{{ old('employee_address', $employee->employee_address) }}</textarea>
                        </div>

                    </div>
                </div>


                {{-- =================================================
                    STEP 3 : PHOTO
                ================================================== --}}

                <div class="employee-form-step" data-step="3">

                    <div class="step-title">
                        <h5><i class="bi bi-camera me-2"></i> Employee Photo</h5>
                        <p>Upload a new photo to replace the current one (optional).</p>
                    </div>

                    <div class="row g-4">

                        <div class="col-12 col-md-6">
                            <label class="form-label">Employee Photo</label>
                            <input
                                type="file"
                                name="photo"
                                id="photoInput"
                                class="form-control @error('photo') is-invalid @enderror"
                                accept="image/jpeg,image/png"
                            >
                            <small class="text-muted">JPG, JPEG or PNG. Maximum 2 MB. Leave empty to keep the current photo.</small>
                            @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center">

                                <div id="photoPlaceholder" class="photo-placeholder" style="{{ $employee->photo ? 'display:none;' : '' }}">
                                    <i class="bi bi-person fs-1"></i>
                                </div>

                                <img
                                    id="photoPreview"
                                    class="photo-preview ms-3"
                                    alt="Employee photo preview"
                                    src="{{ $employee->photo ? asset('storage/' . $employee->photo) : '' }}"
                                    style="{{ $employee->photo ? '' : 'display:none;' }}"
                                >

                            </div>
                        </div>

                    </div>
                </div>


                {{-- =================================================
                    STEP 4 : COMPANY
                ================================================== --}}

                <div class="employee-form-step" data-step="4">

                    <div class="step-title">
                        <h5><i class="bi bi-building me-2"></i> Company Information</h5>
                        <p>Update the department, section and job title.</p>
                    </div>

                    <div class="row g-3">

                        <div class="col-12 col-md-4">
                            <label class="form-label">Department <span class="text-danger">*</span></label>
                            <select name="department_id" id="department" class="form-select @error('department_id') is-invalid @enderror" required>
                                <option value="">Select department</option>
                                @foreach($departments as $department)
                                    <option
                                        value="{{ $department->id }}"
                                        @selected(old('department_id', $employee->department_id) == $department->id)
                                    >
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Section <span class="text-danger">*</span></label>
                            <select name="section_id" id="section" class="form-select @error('section_id') is-invalid @enderror" required>
                                <option value="">Select section</option>
                            </select>
                            @error('section_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Job Title <span class="text-danger">*</span></label>
                            <select name="job_title_id" id="job_title" class="form-select @error('job_title_id') is-invalid @enderror" required>
                                <option value="">Select job title</option>
                            </select>
                            @error('job_title_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Contract Type <span class="text-danger">*</span></label>
                            <select name="contract_type" id="contract_type" class="form-select @error('contract_type') is-invalid @enderror" required>
                                <option value="">Select contract type</option>
                                @foreach(\App\Enums\ContractType::cases() as $contract)
                                    <option
                                        value="{{ $contract->value }}"
                                        @selected(old('contract_type', $employee->contract_type?->value) === $contract->value)
                                    >
                                        {{ $contract->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('contract_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @php
                            $needsEndDateInitially = in_array(
                                old('contract_type', $employee->contract_type?->value),
                                ['CDD'],
                                true
                            );
                        @endphp

                        <div class="col-12 col-md-4 {{ $needsEndDateInitially ? '' : 'd-none' }}" id="endContractWrapper">
                            <label class="form-label">End Contract Date <span class="text-danger">*</span></label>
                            <input
                                type="date"
                                name="end_contract_date"
                                id="end_contract_date"
                                class="form-control @error('end_contract_date') is-invalid @enderror"
                                value="{{ old('end_contract_date', $employee->end_contract_date?->format('Y-m-d')) }}"
                            >
                            @error('end_contract_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Work Location <span class="text-danger">*</span></label>
                            <select name="work_location" class="form-select @error('work_location') is-invalid @enderror" required>
                                <option value="">Select location</option>
                                @foreach(\App\Enums\WorkLocation::cases() as $location)
                                    <option
                                        value="{{ $location->value }}"
                                        @selected(old('work_location', $employee->work_location?->value) === $location->value)
                                    >
                                        {{ $location->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('work_location')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Supervisor</label>
                            <input
                                type="text"
                                name="supervisor"
                                class="form-control"
                                value="{{ old('supervisor', $employee->supervisor) }}"
                            >
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Employee Type <span class="text-danger">*</span></label>
                            <select name="employee_type" class="form-select @error('employee_type') is-invalid @enderror" required>
                                <option value="">Select employee type</option>
                                @foreach(\App\Enums\EmployeeType::cases() as $type)
                                    <option
                                        value="{{ $type->value }}"
                                        @selected(old('employee_type', $employee->employee_type?->value) === $type->value)
                                    >
                                        {{ $type->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Hire Date <span class="text-danger">*</span></label>
                            <input
                                type="date"
                                name="hire_date"
                                class="form-control @error('hire_date') is-invalid @enderror"
                                value="{{ old('hire_date', $employee->hire_date?->format('Y-m-d')) }}"
                                required
                            >
                            @error('hire_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>


                {{-- =================================================
                    STEP 5 : FAMILY
                ================================================== --}}

                <div class="employee-form-step" data-step="5">

                    <div class="step-title">
                        <h5><i class="bi bi-people me-2"></i> Family Information</h5>
                        <p>Update spouse and parent information.</p>
                    </div>

                    <div class="row g-3">

                        <div class="col-12">
                            <h6 class="mb-1"><i class="bi bi-person-heart me-2"></i> Spouse Information</h6>
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Status</label>
                            <select name="spouse_status" class="form-select">
                                <option value="">Select status</option>
                                @foreach(['Married', 'Single', 'Divorced', 'Widowed'] as $spouseOption)
                                    <option
                                        value="{{ $spouseOption }}"
                                        @selected(old('spouse_status', $employee->spouse_status) === $spouseOption)
                                    >
                                        {{ $spouseOption }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Full Name</label>
                            <input
                                type="text"
                                name="spouse_full_name"
                                class="form-control"
                                value="{{ old('spouse_full_name', $employee->spouse_full_name) }}"
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                            >
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Phone</label>
                            <input
                                type="tel"
                                name="spouse_phone"
                                class="form-control"
                                value="{{ old('spouse_phone', $employee->spouse_phone) }}"
                            >
                        </div>

                        <div class="col-12 mt-4">
                            <h6 class="mb-1"><i class="bi bi-people-fill me-2"></i> Parents & In-Laws</h6>
                            <small class="text-muted">Update the full name, phone number and status of each parent.</small>
                        </div>

                        {{-- FATHER --}}
                        <div class="col-12 col-md-5">
                            <label class="form-label">Father Full Name</label>
                            <input type="hidden" name="parents[father][relationship]" value="Father">
                            <input
                                type="text"
                                name="parents[father][full_name]"
                                class="form-control"
                                value="{{ old('parents.father.full_name', $father->full_name ?? '') }}"
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                            >
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">Telephone</label>
                            <input
                                type="tel"
                                name="parents[father][phone]"
                                class="form-control"
                                value="{{ old('parents.father.phone', $father->phone ?? '') }}"
                            >
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label">Status</label>
                            <div class="form-check mt-2">
                                <input
                                    type="checkbox"
                                    name="parents[father][deceased]"
                                    value="1"
                                    class="form-check-input"
                                    id="fatherDeceased"
                                    @checked(old('parents.father.deceased', $father->deceased ?? false))
                                >
                                <label class="form-check-label" for="fatherDeceased">Deceased</label>
                            </div>
                        </div>

                        {{-- MOTHER --}}
                        <div class="col-12 col-md-5">
                            <label class="form-label">Mother Full Name</label>
                            <input type="hidden" name="parents[mother][relationship]" value="Mother">
                            <input
                                type="text"
                                name="parents[mother][full_name]"
                                class="form-control"
                                value="{{ old('parents.mother.full_name', $mother->full_name ?? '') }}"
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                            >
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">Telephone</label>
                            <input
                                type="tel"
                                name="parents[mother][phone]"
                                class="form-control"
                                value="{{ old('parents.mother.phone', $mother->phone ?? '') }}"
                            >
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label">Status</label>
                            <div class="form-check mt-2">
                                <input
                                    type="checkbox"
                                    name="parents[mother][deceased]"
                                    value="1"
                                    class="form-check-input"
                                    id="motherDeceased"
                                    @checked(old('parents.mother.deceased', $mother->deceased ?? false))
                                >
                                <label class="form-check-label" for="motherDeceased">Deceased</label>
                            </div>
                        </div>

                        {{-- FATHER IN LAW --}}
                        <div class="col-12 col-md-5">
                            <label class="form-label">Father-in-law Full Name</label>
                            <input type="hidden" name="parents[father_in_law][relationship]" value="Father-in-law">
                            <input
                                type="text"
                                name="parents[father_in_law][full_name]"
                                class="form-control"
                                value="{{ old('parents.father_in_law.full_name', $fatherInLaw->full_name ?? '') }}"
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                            >
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">Telephone</label>
                            <input
                                type="tel"
                                name="parents[father_in_law][phone]"
                                class="form-control"
                                value="{{ old('parents.father_in_law.phone', $fatherInLaw->phone ?? '') }}"
                            >
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label">Status</label>
                            <div class="form-check mt-2">
                                <input
                                    type="checkbox"
                                    name="parents[father_in_law][deceased]"
                                    value="1"
                                    class="form-check-input"
                                    id="fatherInLawDeceased"
                                    @checked(old('parents.father_in_law.deceased', $fatherInLaw->deceased ?? false))
                                >
                                <label class="form-check-label" for="fatherInLawDeceased">Deceased</label>
                            </div>
                        </div>

                        {{-- MOTHER IN LAW --}}
                        <div class="col-12 col-md-5">
                            <label class="form-label">Mother-in-law Full Name</label>
                            <input type="hidden" name="parents[mother_in_law][relationship]" value="Mother-in-law">
                            <input
                                type="text"
                                name="parents[mother_in_law][full_name]"
                                class="form-control"
                                value="{{ old('parents.mother_in_law.full_name', $motherInLaw->full_name ?? '') }}"
                                pattern="[A-Za-zÀ-ÿ\s]{2,}"
                            >
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">Telephone</label>
                            <input
                                type="tel"
                                name="parents[mother_in_law][phone]"
                                class="form-control"
                                value="{{ old('parents.mother_in_law.phone', $motherInLaw->phone ?? '') }}"
                            >
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label">Status</label>
                            <div class="form-check mt-2">
                                <input
                                    type="checkbox"
                                    name="parents[mother_in_law][deceased]"
                                    value="1"
                                    class="form-check-input"
                                    id="motherInLawDeceased"
                                    @checked(old('parents.mother_in_law.deceased', $motherInLaw->deceased ?? false))
                                >
                                <label class="form-check-label" for="motherInLawDeceased">Deceased</label>
                            </div>
                        </div>

                    </div>
                </div>


                {{-- =================================================
                    STEP 6 : EMERGENCY
                ================================================== --}}

                <div class="employee-form-step" data-step="6">

                    <div class="step-title">
                        <h5><i class="bi bi-telephone-forward me-2"></i> Emergency Contact</h5>
                        <p>Update the employee's emergency contact information.</p>
                    </div>

                    <div class="row g-3">

                        <div class="col-12 col-md-4">
                            <label class="form-label">Relationship</label>
                            <select name="emergency_relationship" class="form-select">
                                <option value="">Select relationship</option>
                                @foreach(\App\Enums\EmergencyRelationship::cases() as $relationship)
                                    <option
                                        value="{{ $relationship->value }}"
                                        @selected(old('emergency_relationship', $emergency->relationship ?? '') === $relationship->value)
                                    >
                                        {{ $relationship->label() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Full Name</label>
                            <input
                                type="text"
                                name="emergency_full_name"
                                class="form-control"
                                value="{{ old('emergency_full_name', $emergency->full_name ?? '') }}"
                            >
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Phone</label>
                            <input
                                type="tel"
                                name="emergency_phone"
                                class="form-control"
                                value="{{ old('emergency_phone', $emergency->phone ?? '') }}"
                            >
                        </div>

                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="emergency_address" class="form-control" rows="3"
                            >{{ old('emergency_address', $emergency->address ?? '') }}</textarea>
                        </div>

                    </div>
                </div>


                {{-- =================================================
                    STEP 7 : SALARY
                ================================================== --}}

                <div class="employee-form-step" data-step="7">

                    <div class="step-title">
                        <h5><i class="bi bi-cash-stack me-2"></i> Salary Information</h5>
                        <p>Update employee salary information.</p>
                    </div>

                    <div class="row g-3">

                        <div class="col-12 col-md-4">
                            <label class="form-label">Base Salary</label>
                            <input
                                type="number"
                                name="salary_base_salary"
                                id="salary_base_salary"
                                class="form-control"
                                value="{{ old('salary_base_salary', $employee->salary->base_salary ?? '') }}"
                                min="0"
                                step="0.01"
                            >
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Salary Category</label>
                            <select name="salary_category" id="categorySelect" class="form-select">
                                <option value="">Select category</option>
                                @foreach(\App\Enums\SalaryCategory::cases() as $category)
                                    <option
                                        value="{{ $category->value }}"
                                        @selected(old('salary_category', $employee->salary->category ?? '') === $category->value)
                                    >
                                        {{ $category->label() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Echelon</label>
                            <input
                                type="text"
                                name="salary_echelon"
                                id="echelonSelect"
                                class="form-control"
                                value="{{ old('salary_echelon', $employee->salary->echelon ?? '') }}"
                            >
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Currency</label>
                            <select name="salary_currency" class="form-select">
                                <option value="">Select currency</option>
                                @foreach(\App\Enums\SalaryCurrency::cases() as $currency)
                                    <option
                                        value="{{ $currency->value }}"
                                        @selected(old('salary_currency', $employee->salary->currency ?? '') === $currency->value)
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

                <div class="d-flex justify-content-between mt-4 pt-3 border-top">

                    <div>
                        <button type="button" class="btn btn-secondary" id="cancelBtn">
                            <i class="bi bi-x-lg me-1"></i> Cancel
                        </button>
                    </div>

                    <div>

                        <button type="button" class="btn btn-secondary me-2" id="previousBtn" style="display:none;">
                            <i class="bi bi-arrow-left me-1"></i> Previous
                        </button>

                        <button type="button" class="btn btn-orange" id="nextBtn">
                            Next <i class="bi bi-arrow-right ms-1"></i>
                        </button>

                        <button type="submit" class="btn btn-success" id="saveBtn" style="display:none;">
                            <span class="spinner-border spinner-border-sm d-none" id="saveSpinner" role="status" aria-hidden="true"></span>
                            <span id="saveText">
                                <i class="bi bi-check-lg me-1"></i> Save Changes
                            </span>
                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>


    {{-- =========================================================
         JAVASCRIPT (identique à create, avec préremplissage employee)
    ========================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('employeeForm');

            const steps = document.querySelectorAll('.employee-form-step');
            const stepIndicators = document.querySelectorAll('.employee-step');

            const nextBtn = document.getElementById('nextBtn');
            const previousBtn = document.getElementById('previousBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const saveBtn = document.getElementById('saveBtn');
            const saveSpinner = document.getElementById('saveSpinner');
            const saveText = document.getElementById('saveText');

            let currentStep = 0;


            /* =========================================================
               DEPARTMENT / SECTION / JOB TITLE
            ========================================================== */

            const department = document.getElementById('department');
            const section = document.getElementById('section');
            const jobTitle = document.getElementById('job_title');

            const sections = @json($sections);
            const jobTitles = @json($jobTitles);

            // Valeurs actuelles de l'employé (ou celles resoumises en cas d'erreur)
            const oldDepartmentId = @json(old('department_id', $employee->department_id));
            const oldSectionId = @json(old('section_id', $employee->section_id));
            const oldJobTitleId = @json(old('job_title_id', $employee->job_title_id));


            function loadSections(departmentId, selectedSectionId = null) {

                section.innerHTML = '<option value="">Select section</option>';

                jobTitle.innerHTML = '<option value="">Select section first</option>';
                jobTitle.disabled = true;

                if (!departmentId) {
                    section.innerHTML = '<option value="">Select department first</option>';
                    return;
                }

                const filteredSections = sections.filter(function (item) {
                    return String(item.department_id) === String(departmentId);
                });

                filteredSections.forEach(function (item) {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.name;

                    if (selectedSectionId && String(selectedSectionId) === String(item.id)) {
                        option.selected = true;
                    }

                    section.appendChild(option);
                });

                section.disabled = filteredSections.length === 0;
            }


            function loadJobTitles(sectionId, selectedJobTitleId = null) {

                jobTitle.innerHTML = '<option value="">Select job title</option>';

                if (!sectionId) {
                    jobTitle.innerHTML = '<option value="">Select section first</option>';
                    jobTitle.disabled = true;
                    return;
                }

                const filteredJobTitles = jobTitles.filter(function (item) {
                    return String(item.section_id) === String(sectionId);
                });

                filteredJobTitles.forEach(function (item) {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.name;

                    if (selectedJobTitleId && String(selectedJobTitleId) === String(item.id)) {
                        option.selected = true;
                    }

                    jobTitle.appendChild(option);
                });

                jobTitle.disabled = filteredJobTitles.length === 0;
            }


            if (department && section && jobTitle) {

                department.addEventListener('change', function () {
                    loadSections(this.value);
                });

                section.addEventListener('change', function () {
                    loadJobTitles(this.value);
                });

                // Préremplissage initial avec les données de l'employé
                if (oldDepartmentId) {
                    department.value = oldDepartmentId;
                    loadSections(oldDepartmentId, oldSectionId);

                    if (oldSectionId) {
                        loadJobTitles(oldSectionId, oldJobTitleId);
                    }
                }
            }


            /* =========================================================
               SHOW STEP
            ========================================================== */

            function showStep(step) {

                if (step < 0) step = 0;
                if (step >= steps.length) step = steps.length - 1;

                steps.forEach(function (item, index) {
                    item.classList.toggle('active', index === step);
                });

                stepIndicators.forEach(function (item, index) {
                    item.classList.toggle('active', index === step);
                    item.classList.toggle('completed', index < step);
                });

                currentStep = step;

                if (previousBtn) previousBtn.style.display = currentStep === 0 ? 'none' : 'inline-block';
                if (nextBtn) nextBtn.style.display = currentStep === steps.length - 1 ? 'none' : 'inline-block';
                if (saveBtn) saveBtn.style.display = currentStep === steps.length - 1 ? 'inline-block' : 'none';

                window.scrollTo({ top: 0, behavior: 'smooth' });
            }


            /* =========================================================
               VALIDATE STEP
            ========================================================== */

            function validateStep(step) {

                if (!step) return true;

                const fields = step.querySelectorAll('input, select, textarea');
                let valid = true;

                fields.forEach(function (field) {

                    if (field.disabled) return;

                    if (!field.checkValidity()) {
                        field.classList.add('is-invalid');
                        valid = false;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                if (!valid) {
                    const firstInvalid = step.querySelector('.is-invalid');
                    if (firstInvalid) firstInvalid.focus();
                }

                return valid;
            }


            if (nextBtn) {
                nextBtn.addEventListener('click', function () {
                    const step = steps[currentStep];
                    if (!validateStep(step)) return;
                    if (currentStep < steps.length - 1) showStep(currentStep + 1);
                });
            }

            if (previousBtn) {
                previousBtn.addEventListener('click', function () {
                    if (currentStep > 0) showStep(currentStep - 1);
                });
            }

            stepIndicators.forEach(function (indicator, index) {
                indicator.addEventListener('click', function () {
                    if (index <= currentStep) showStep(index);
                });
            });

            document.querySelectorAll('input, select, textarea').forEach(function (field) {
                field.addEventListener('input', function () {
                    if (this.checkValidity()) this.classList.remove('is-invalid');
                });
                field.addEventListener('change', function () {
                    if (this.checkValidity()) this.classList.remove('is-invalid');
                });
            });


            /* =========================================================
               PHOTO PREVIEW
            ========================================================== */

            const photoInput = document.getElementById('photoInput');
            const photoPreview = document.getElementById('photoPreview');
            const photoPlaceholder = document.getElementById('photoPlaceholder');

            if (photoInput && photoPreview) {

                photoInput.addEventListener('change', function () {

                    const file = this.files[0];

                    if (!file) {
                        // On garde la photo actuelle affichée si l'utilisateur annule
                        return;
                    }

                    if (!file.type.startsWith('image/')) {
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();

                    reader.onload = function (event) {
                        photoPreview.src = event.target.result;
                        photoPreview.style.display = 'block';
                        if (photoPlaceholder) photoPlaceholder.style.display = 'none';
                    };

                    reader.readAsDataURL(file);
                });
            }


            /* =========================================================
               CONTRACT TYPE
            ========================================================== */

            const contractType = document.getElementById('contract_type');
            const endContractWrapper = document.getElementById('endContractWrapper');
            const endContractDate = document.getElementById('end_contract_date');

            function updateContractType() {

                if (!contractType) return;

                const needsEndDate = contractType.value === 'CDD';

                if (needsEndDate) {
                    if (endContractWrapper) endContractWrapper.classList.remove('d-none');
                    if (endContractDate) endContractDate.required = true;
                } else {
                    if (endContractWrapper) endContractWrapper.classList.add('d-none');
                    if (endContractDate) {
                        endContractDate.required = false;
                        endContractDate.value = '';
                    }
                }
            }

            if (contractType) {
                contractType.addEventListener('change', updateContractType);
                // Pas d'appel initial ici : le d-none est déjà géré côté serveur
                // pour éviter d'effacer la valeur existante au chargement.
            }


            /* =========================================================
               AUTOCOMPLETE OFF
            ========================================================== */

            if (form) {
                form.setAttribute('autocomplete', 'off');
                form.querySelectorAll('input, select, textarea').forEach(function (field) {
                    field.setAttribute('autocomplete', 'off');
                });
            }


            /* =========================================================
               CANCEL
            ========================================================== */

            if (cancelBtn) {
                cancelBtn.addEventListener('click', function () {
                    window.history.back();
                });
            }


            /* =========================================================
               FORM SUBMIT
            ========================================================== */

            if (form) {
                form.addEventListener('submit', function (event) {

                    let firstInvalidStep = -1;

                    steps.forEach(function (step, index) {
                        if (!validateStep(step)) {
                            if (firstInvalidStep === -1) firstInvalidStep = index;
                        }
                    });

                    if (firstInvalidStep !== -1) {
                        event.preventDefault();
                        showStep(firstInvalidStep);
                        return;
                    }

                    if (saveBtn) saveBtn.disabled = true;
                    if (saveSpinner) saveSpinner.classList.remove('d-none');
                    if (saveText) saveText.innerHTML = 'Saving...';
                });
            }


            showStep(0);
        });
    </script>

@endsection
