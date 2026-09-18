
@extends('layouts.admin')

@section('content')

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">

                    <h3 class="mb-0">
                        Edit Role
                    </h3>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-end">

                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                Home
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('roles.index') }}">
                                Roles
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

            <div class="card shadow-sm">

                <div class="card-header">

                    <h5 class="mb-0">
                        Edit permissions:
                        <strong>{{ $role->name }}</strong>
                    </h5>

                </div>


                <form
                    method="POST"
                    action="{{ route('roles.update', $role) }}"
                >

                    @csrf

                    @method('PUT')


                    <div class="card-body">

                        @php
                            $permissionGroups = $permissions->groupBy(
                                fn ($permission) =>
                                    explode('.', $permission->name)[0]
                            );
                        @endphp


                        <div class="row">

                            @foreach($permissionGroups as $group => $groupPermissions)

                                <div class="col-md-6 col-lg-4 mb-4">

                                    <div class="permission-group">

                                        <div class="permission-group-header">

                                            <strong>
                                                {{ ucfirst(str_replace('_', ' ', $group)) }}
                                            </strong>

                                        </div>


                                        <div class="permission-group-body">

                                            @foreach($groupPermissions as $permission)

                                                <div class="form-check mb-2">

                                                    <input
                                                        type="checkbox"
                                                        class="form-check-input"
                                                        name="permissions[]"
                                                        value="{{ $permission->id }}"
                                                        id="permission-{{ $permission->id }}"

                                                        {{ in_array(
                                                            $permission->id,
                                                            $rolePermissionIds
                                                        ) ? 'checked' : '' }}
                                                    >

                                                    <label
                                                        class="form-check-label"
                                                        for="permission-{{ $permission->id }}"
                                                    >
                                                        {{ $permission->name }}
                                                    </label>

                                                </div>

                                            @endforeach

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    {{-- =================================================
                        FOOTER
                    ================================================== --}}

                    <div class="card-footer">

                        <div class="d-flex justify-content-between">

                            <a
                                href="{{ route('roles.index') }}"
                                class="btn btn-secondary"
                            >
                                <i class="bi bi-arrow-left me-1"></i>
                                Cancel
                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i class="bi bi-check-lg me-1"></i>
                                Save Permissions
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
        CSS
    ========================================================== --}}

    <style>

        .permission-group {
            border: 1px solid #dee2e6;
            background: #fff;
            height: 100%;
        }

        .permission-group-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 10px 12px;
            text-transform: uppercase;
            font-size: 13px;
        }

        .permission-group-body {
            padding: 12px;
        }

        .form-check-label {
            cursor: pointer;
            font-size: 14px;
        }

        .form-check-input {
            cursor: pointer;
        }

    </style>

@endsection

