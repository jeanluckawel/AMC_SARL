@extends('layouts.admin')

@section('content')

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6 col-12">

                    <h3 class="mb-0">
                        Edit User
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

                            <a href="{{ route('users.index') }}">
                                Users
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
        PAGE CONTENT
    ========================================================== --}}

    <div class="app-content">

        <div class="container-fluid">

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


            @if($errors->any())

                <div class="alert alert-danger">

                    <i class="bi bi-exclamation-triangle me-1"></i>

                    Please correct the errors below.

                    <ul class="mb-0 mt-2">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="card shadow-sm user-card">

                <div class="card-header bg-white">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="mb-0">
                                User Roles
                            </h5>

                            <small class="text-muted">
                                Manage roles assigned to this user
                            </small>

                        </div>


                        <a
                            href="{{ route('users.index') }}"
                            class="btn btn-secondary btn-sm back-btn"
                        >

                            <i class="bi bi-arrow-left me-1"></i>

                            Back

                        </a>

                    </div>

                </div>


                <div class="card-body">

                    {{-- =================================================
                        USER INFORMATION
                    ================================================== --}}

                    <div class="user-information mb-4">

                        <div class="user-avatar user-avatar-default">

                            <i class="bi bi-person-fill"></i>

                        </div>


                        <div>

                            <div class="fw-semibold user-name">

                                {{ $user->name }}

                            </div>

                            <div class="text-muted">

                                {{ $user->email }}

                            </div>

                        </div>

                    </div>


                    <form
                        action="{{ route('users.update', $user) }}"
                        method="POST"
                    >

                        @csrf

                        @method('PUT')


                        {{-- =================================================
                            ROLES
                        ================================================== --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Roles
                            </label>

                            <div class="text-muted small mb-3">
                                Select the roles you want to assign to this user.
                            </div>


                            <div class="role-list">

                                @forelse($roles as $role)

                                    <label class="role-item">

                                        <input
                                            type="checkbox"
                                            name="roles[]"
                                            value="{{ $role->id }}"
                                            class="form-check-input role-checkbox"

                                            @checked(
                                                in_array(
                                                    $role->id,
                                                    $userRoleIds
                                                )
                                            )
                                        >


                                        <div class="role-content">

                                            <div class="role-name">

                                                {{ $role->name }}

                                            </div>

                                        </div>

                                    </label>

                                @empty

                                    <div class="text-muted">
                                        No roles available.
                                    </div>

                                @endforelse

                            </div>

                        </div>


                        {{-- =================================================
                            ACTIONS
                        ================================================== --}}

                        <div class="form-actions">

                            <a
                                href="{{ route('users.index') }}"
                                class="btn btn-secondary"
                            >

                                <i class="bi bi-x-lg me-1"></i>

                                Cancel

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-check-lg me-1"></i>

                                Save Changes

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <style>

        /* =========================================================
           CARD
        ========================================================== */

        .user-card {

            border-radius: 0 !important;

            border: 1px solid #dee2e6;

        }


        .user-card .card-header {

            border-bottom: 1px solid #dee2e6;

            padding: 14px 16px;

        }


        /* =========================================================
           USER INFORMATION
        ========================================================== */

        .user-information {

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 15px;

            border: 1px solid #dee2e6;

            background: #f8f9fa;

        }


        .user-avatar {

            width: 42px;

            height: 42px;

            min-width: 42px;

            border-radius: 0;

            border: 1px solid #dee2e6;

        }


        .user-avatar-default {

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f1f1f1;

            color: #777;

            font-size: 20px;

        }


        .user-name {

            font-size: 15px;

        }


        /* =========================================================
           ROLES
        ========================================================== */

        .role-list {

            display: grid;

            grid-template-columns:
                repeat(auto-fill, minmax(220px, 1fr));

            gap: 10px;

        }


        .role-item {

            display: flex;

            align-items: center;

            gap: 10px;

            padding: 12px 14px;

            border: 1px solid #dee2e6;

            background: #fff;

            cursor: pointer;

            transition:
                border-color .15s ease-in-out,
                background-color .15s ease-in-out;

        }


        .role-item:hover {

            border-color: #FF6600;

            background: #fffaf7;

        }


        .role-checkbox {

            width: 18px;

            height: 18px;

            margin: 0;

            cursor: pointer;

        }


        .role-checkbox:checked {

            background-color: #FF6600;

            border-color: #FF6600;

        }


        .role-content {

            flex: 1;

        }


        .role-name {

            font-weight: 500;

        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .form-actions {

            display: flex;

            justify-content: flex-end;

            gap: 8px;

            padding-top: 15px;

            border-top: 1px solid #dee2e6;

        }


        .form-actions .btn,
        .back-btn {

            border-radius: 0 !important;

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

            }


            .user-card .card-body {

                padding: 10px;

            }


            .role-list {

                grid-template-columns: 1fr;

            }


            .form-actions {

                flex-direction: column-reverse;

            }


            .form-actions .btn {

                width: 100%;

            }


            .back-btn {

                width: 100%;

            }

        }

    </style>

@endsection

