@extends('layouts.admin')

@section('content')

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6">
                    <h3 class="mb-0">
                        Change Password
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
                            Change Password
                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </div>


    <div class="app-content">

        <div class="container-fluid">

            <div class="card user-card shadow-sm">

                <div class="card-header">

                    <h5 class="mb-0">
                        Change Password
                    </h5>

                </div>

                <div class="card-body">

                    <div class="alert alert-info">

                        User:
                        <strong>{{ $user->name }}</strong>
                        <br>
                        Email:
                        <strong>{{ $user->email }}</strong>

                    </div>


                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <form
                        action="{{ route('users.update-password', $user) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label
                                    for="password"
                                    class="form-label"
                                >
                                    New Password
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Minimum 8 characters"
                                    required
                                >

                            </div>


                            <div class="col-md-6 mb-3">

                                <label
                                    for="password_confirmation"
                                    class="form-label"
                                >
                                    Confirm New Password
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

                        </div>


                        <div class="d-flex gap-2 mt-4">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-key me-1"></i>
                                Update Password

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


    <style>

        .user-card {
            border-radius: 0 !important;
            border: 1px solid #dee2e6;
        }

        .form-control,
        .btn {
            border-radius: 0 !important;
        }

        .form-control:focus {
            border-color: #ff6600;
            box-shadow: 0 0 0 0.15rem rgba(255, 102, 0, .15);
        }

    </style>

@endsection
