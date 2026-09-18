@extends('layouts.admin')

@section('content')

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6">

                    <h3 class="mb-0">
                        Add User
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
                            <a href="{{ route('users.index') }}">
                                Users
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Add User
                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
        CONTENT
    ====================================================== --}}

    <div class="app-content">

        <div class="container-fluid">

            <div class="card user-card shadow-sm">

                <div class="card-header">

                    <h5 class="mb-0">
                        Create New User
                    </h5>

                </div>


                <div class="card-body">

                    {{-- VALIDATION ERRORS --}}

                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- SUCCESS MESSAGE --}}

                    @if (session('success'))

                        <div class="alert alert-success">

                            {{ session('success') }}

                        </div>

                    @endif


                    <form
                        action="{{ route('users.store') }}"
                        method="POST"
                    >

                        @csrf


                        <div class="row">

                            {{-- =================================================
                                EMPLOYEE
                            ================================================== --}}

                            <div class="col-md-6 mb-3">

                                <label
                                    for="employee_id"
                                    class="form-label"
                                >
                                    Employee
                                </label>

                                <select
                                    id="employee_id"
                                    name="employee_id"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Select Employee
                                    </option>

                                    @foreach($employees as $employee)

                                        <option
                                            value="{{ $employee->employee_id }}"
                                            @selected(
                                                old('employee_id') ==
                                                $employee->employee_id
                                            )
                                        >

                                            {{ $employee->employee_id }}
                                            -
                                            {{ $employee->first_name }}
                                            {{ $employee->last_name }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('employee_id')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>


                            {{-- =================================================
                                EMAIL
                            ================================================== --}}

                            <div class="col-md-6 mb-3">

                                <label
                                    for="email"
                                    class="form-label"
                                >
                                    Email
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email') }}"
                                    placeholder="Enter email address"
                                    required
                                >

                                @error('email')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>


                            {{-- =================================================
                                PASSWORD
                            ================================================== --}}

                            <div class="col-md-6 mb-3">

                                <label
                                    for="password"
                                    class="form-label"
                                >
                                    Password
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Minimum 8 characters"
                                    required
                                >

                                @error('password')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>


                            {{-- =================================================
                                CONFIRM PASSWORD
                            ================================================== --}}

                            <div class="col-md-6 mb-3">

                                <label
                                    for="password_confirmation"
                                    class="form-label"
                                >
                                    Confirm Password
                                </label>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Confirm password"
                                    required
                                >

                            </div>


                            {{-- =================================================
                                ROLE
                            ================================================== --}}

                            <div class="col-md-6 mb-3">

                                <label
                                    for="role"
                                    class="form-label"
                                >
                                    Role
                                </label>

                                <select
                                    id="role"
                                    name="role"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Select Role
                                    </option>

                                    @foreach($roles as $role)

                                        <option
                                            value="{{ $role->name }}"
                                            @selected(
                                                old('role') === $role->name
                                            )
                                        >

                                            {{ $role->name }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('role')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>

                        </div>


                        {{-- =================================================
                            ACTIONS
                        ================================================== --}}

                        <div class="d-flex gap-2 mt-4">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-check-circle me-1"></i>

                                Create User

                            </button>


                            <a
                                href="{{ route('users.index') }}"
                                class="btn btn-secondary"
                            >

                                <i class="bi bi-arrow-left me-1"></i>

                                Cancel

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
        STYLE
    ====================================================== --}}

    <style>

        .user-card {
            border-radius: 0 !important;
            border: 1px solid #dee2e6;
        }

        .form-control,
        .form-select,
        .btn {
            border-radius: 0 !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #ff6600;
            box-shadow: 0 0 0 0.15rem rgba(255, 102, 0, .15);
        }

    </style>

@endsection
