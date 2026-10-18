@extends('layouts.admin')

@section('title', __('menu.employee_child_create_title') . ' - AMC SARL')

@section('content')

    @php
        $oldChildren = old('children', [[]]);

        if (!is_array($oldChildren) || count($oldChildren) === 0) {
            $oldChildren = [[]];
        }

        $documentTypes = [
            'birth_certificate' => 'employee_child_document_birth_certificate',
            'passport' => 'employee_child_document_passport',
            'national_id' => 'employee_child_document_national_id',
            'other' => 'employee_child_document_other',
        ];
    @endphp

    <style>
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

        .form-label {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
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

        .child-item {
            border: 1px solid #dee2e6 !important;
            border-radius: 0 !important;
            margin-bottom: 24px;
        }

        .child-item-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 14px 18px;
        }

        .child-item-body {
            padding: 20px;
        }

        .child-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            margin-right: 10px;
            background: #FF6600;
            color: #fff;
            font-weight: 600;
        }

        .child-document-section {
            border-top: 1px solid #dee2e6;
            margin-top: 20px;
            padding-top: 20px;
        }

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

        .btn-add-child {
            border: 1px dashed #FF6600;
            color: #FF6600;
            background: #fff;
            border-radius: 0 !important;
            padding: 11px 16px;
        }

        .btn-add-child:hover {
            background: #fff4ed;
            color: #e65c00;
        }

        .validation-summary {
            border-radius: 0 !important;
        }

        .document-hint {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: #6c757d;
        }

        @media (max-width: 768px) {
            .employee-card-wrapper {
                margin: 10px !important;
            }

            .child-item-body {
                padding: 15px;
            }

            .child-item-header {
                padding: 12px;
            }
        }
    </style>

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">

                <div class="col-md-6 col-12">
                    <h3 class="mb-0">
                        {{ __('menu.employee_child_create_title') }}
                    </h3>
                </div>

                <div class="col-md-6 col-12">
                    <ol class="breadcrumb float-md-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                {{ __('menu.employee_home') }}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('employees.index') }}">
                                {{ __('menu.employee_employees') }}
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            {{ __('menu.employee_child_create_title') }}
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="card employee-card employee-card-wrapper shadow-sm">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger validation-summary" role="alert">
                    <div class="fw-bold mb-2">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ __('menu.employee_validation_title') }}
                    </div>

                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="step-title">
                <h5>
                    <i class="bi bi-person-badge me-2"></i>
                    {{ __('menu.employee_child_parent_employee') }}
                </h5>

                <p>
                    {{ trim(
                        ($employee->first_name ?? '') . ' ' .
                        ($employee->middle_name ?? '') . ' ' .
                        ($employee->last_name ?? '')
                    ) }}

                    @if (!empty($employee->employee_id))
                        <span class="ms-2">
                            — {{ $employee->employee_id }}
                        </span>
                    @endif
                </p>
            </div>

            <form
                action="{{ route('employees.children.store', $employee->id) }}"
                method="POST"
                enctype="multipart/form-data"
                id="childrenForm"
                autocomplete="off"
            >
                @csrf

                <div class="step-title">
                    <h5>
                        <i class="bi bi-people me-2"></i>
                        {{ __('menu.employee_child_information') }}
                    </h5>

                    <p>
                        {{ __('menu.employee_child_create_desc') }}
                    </p>
                </div>

                <div id="childrenContainer">

                    @foreach ($oldChildren as $index => $child)

                        <div class="child-item" data-child-index="{{ $index }}">

                            <div class="child-item-header d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="child-number">
                                        {{ $loop->iteration }}
                                    </span>

                                    <strong class="child-title">
                                        {{ __('menu.employee_child_information') }}
                                        {{ $loop->iteration }}
                                    </strong>
                                </div>

                                <button
                                    type="button"
                                    class="btn btn-outline-danger btn-sm remove-child"
                                >
                                    <i class="bi bi-trash me-1"></i>
                                    {{ __('menu.employee_child_remove') }}
                                </button>
                            </div>

                            <div class="child-item-body">

                                <div class="row g-3">

                                    <div class="col-12 col-md-4">
                                        <label class="form-label">
                                            {{ __('menu.employee_first_name') }}
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="children[{{ $index }}][first_name]"
                                            class="form-control @error("children.$index.first_name") is-invalid @enderror"
                                            value="{{ $child['first_name'] ?? '' }}"
                                            placeholder="{{ __('menu.employee_first_name_placeholder') }}"
                                            maxlength="255"
                                            required
                                            autocomplete="off"
                                        >

                                        @error("children.$index.first_name")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label class="form-label">
                                            {{ __('menu.employee_middle_name') }}
                                        </label>

                                        <input
                                            type="text"
                                            name="children[{{ $index }}][middle_name]"
                                            class="form-control @error("children.$index.middle_name") is-invalid @enderror"
                                            value="{{ $child['middle_name'] ?? '' }}"
                                            placeholder="{{ __('menu.employee_middle_name_placeholder') }}"
                                            maxlength="255"
                                            autocomplete="off"
                                        >

                                        @error("children.$index.middle_name")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label class="form-label">
                                            {{ __('menu.employee_last_name') }}
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="children[{{ $index }}][last_name]"
                                            class="form-control @error("children.$index.last_name") is-invalid @enderror"
                                            value="{{ $child['last_name'] ?? '' }}"
                                            placeholder="{{ __('menu.employee_last_name_placeholder') }}"
                                            maxlength="255"
                                            required
                                            autocomplete="off"
                                        >

                                        @error("children.$index.last_name")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">
                                            {{ __('menu.employee_gender') }}
                                        </label>

                                        <select
                                            name="children[{{ $index }}][gender]"
                                            class="form-select @error("children.$index.gender") is-invalid @enderror"
                                        >
                                            <option value="">
                                                {{ __('menu.employee_select_gender') }}
                                            </option>

                                            @foreach (\App\Enums\Gender::cases() as $gender)
                                                <option
                                                    value="{{ $gender->value }}"
                                                    @selected(($child['gender'] ?? '') === $gender->value)
                                                >
                                                    {{ $gender->label() }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error("children.$index.gender")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">
                                            {{ __('menu.employee_date_of_birth') }}
                                        </label>

                                        <input
                                            type="date"
                                            name="children[{{ $index }}][date_of_birth]"
                                            class="form-control @error("children.$index.date_of_birth") is-invalid @enderror"
                                            value="{{ $child['date_of_birth'] ?? '' }}"
                                            max="{{ now()->format('Y-m-d') }}"
                                        >

                                        @error("children.$index.date_of_birth")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="child-document-section">

                                    <h6 class="mb-1">
                                        <i class="bi bi-file-earmark-text me-2"></i>
                                        {{ __('menu.employee_child_document_title') }}
                                    </h6>

                                    <p class="text-muted small mb-3">
                                        {{ __('menu.employee_child_document_desc') }}
                                    </p>

                                    <div class="row g-3">

                                        <div class="col-12 col-md-6">
                                            <label class="form-label">
                                                {{ __('menu.employee_child_document_type') }}
                                            </label>

                                            <select
                                                name="children[{{ $index }}][document_type]"
                                                class="form-select @error("children.$index.document_type") is-invalid @enderror"
                                            >
                                                <option value="">
                                                    {{ __('menu.employee_child_select_document_type') }}
                                                </option>

                                                @foreach ($documentTypes as $value => $label)
                                                    <option
                                                        value="{{ $value }}"
                                                        @selected(($child['document_type'] ?? '') === $value)
                                                    >
                                                        {{ __('menu.' . $label) }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error("children.$index.document_type")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label class="form-label">
                                                {{ __('menu.employee_child_document_file') }}
                                            </label>

                                            <input
                                                type="file"
                                                name="children[{{ $index }}][document]"
                                                class="form-control @error("children.$index.document") is-invalid @enderror"
                                                accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png"
                                            >

                                            <small class="document-hint">
                                                {{ __('menu.employee_child_document_hint') }}
                                            </small>

                                            @error("children.$index.document")
                                            <div class="text-danger small mt-1">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    @endforeach

                </div>

                <div class="mb-4">
                    <button
                        type="button"
                        class="btn btn-add-child"
                        id="addChildBtn"
                    >
                        <i class="bi bi-plus-circle me-2"></i>
                        {{ __('menu.employee_child_add_another') }}
                    </button>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">

                    <a
                        href="{{ route('employees.index') }}"
                        class="btn btn-secondary"
                    >
                        <i class="bi bi-x-lg me-1"></i>
                        {{ __('menu.employee_cancel') }}
                    </a>

                    <button
                        type="submit"
                        class="btn btn-orange"
                        id="saveChildrenBtn"
                    >
                        <span
                            class="spinner-border spinner-border-sm d-none me-1"
                            id="saveSpinner"
                            role="status"
                            aria-hidden="true"
                        ></span>

                        <span id="saveText">
                            <i class="bi bi-check-lg me-1"></i>
                            {{ __('menu.employee_child_save') }}
                        </span>
                    </button>

                </div>

            </form>

        </div>
    </div>

    <template id="childTemplate">
        <div class="child-item" data-child-index="__INDEX__">

            <div class="child-item-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <span class="child-number"></span>

                    <strong class="child-title">
                        {{ __('menu.employee_child_information') }}
                    </strong>
                </div>

                <button
                    type="button"
                    class="btn btn-outline-danger btn-sm remove-child"
                >
                    <i class="bi bi-trash me-1"></i>
                    {{ __('menu.employee_child_remove') }}
                </button>
            </div>

            <div class="child-item-body">

                <div class="row g-3">

                    <div class="col-12 col-md-4">
                        <label class="form-label">
                            {{ __('menu.employee_first_name') }}
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="children[__INDEX__][first_name]"
                            class="form-control"
                            placeholder="{{ __('menu.employee_first_name_placeholder') }}"
                            maxlength="255"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">
                            {{ __('menu.employee_middle_name') }}
                        </label>

                        <input
                            type="text"
                            name="children[__INDEX__][middle_name]"
                            class="form-control"
                            placeholder="{{ __('menu.employee_middle_name_placeholder') }}"
                            maxlength="255"
                            autocomplete="off"
                        >
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">
                            {{ __('menu.employee_last_name') }}
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="children[__INDEX__][last_name]"
                            class="form-control"
                            placeholder="{{ __('menu.employee_last_name_placeholder') }}"
                            maxlength="255"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">
                            {{ __('menu.employee_gender') }}
                        </label>

                        <select
                            name="children[__INDEX__][gender]"
                            class="form-select"
                        >
                            <option value="">
                                {{ __('menu.employee_select_gender') }}
                            </option>

                            @foreach (\App\Enums\Gender::cases() as $gender)
                                <option value="{{ $gender->value }}">
                                    {{ $gender->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">
                            {{ __('menu.employee_date_of_birth') }}
                        </label>

                        <input
                            type="date"
                            name="children[__INDEX__][date_of_birth]"
                            class="form-control"
                            max="{{ now()->format('Y-m-d') }}"
                        >
                    </div>

                </div>

                <div class="child-document-section">

                    <h6 class="mb-1">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        {{ __('menu.employee_child_document_title') }}
                    </h6>

                    <p class="text-muted small mb-3">
                        {{ __('menu.employee_child_document_desc') }}
                    </p>

                    <div class="row g-3">

                        <div class="col-12 col-md-6">
                            <label class="form-label">
                                {{ __('menu.employee_child_document_type') }}
                            </label>

                            <select
                                name="children[__INDEX__][document_type]"
                                class="form-select"
                            >
                                <option value="">
                                    {{ __('menu.employee_child_select_document_type') }}
                                </option>

                                @foreach ($documentTypes as $value => $label)
                                    <option value="{{ $value }}">
                                        {{ __('menu.' . $label) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">
                                {{ __('menu.employee_child_document_file') }}
                            </label>

                            <input
                                type="file"
                                name="children[__INDEX__][document]"
                                class="form-control"
                                accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png"
                            >

                            <small class="document-hint">
                                {{ __('menu.employee_child_document_hint') }}
                            </small>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </template>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('childrenForm');
            const container = document.getElementById('childrenContainer');
            const template = document.getElementById('childTemplate');
            const addButton = document.getElementById('addChildBtn');
            const saveButton = document.getElementById('saveChildrenBtn');
            const saveSpinner = document.getElementById('saveSpinner');
            const saveText = document.getElementById('saveText');

            let nextIndex = Math.max(
                -1,
                ...Array.from(container.querySelectorAll('[data-child-index]'))
                    .map(card => Number(card.dataset.childIndex))
            ) + 1;

            let submitting = false;

            function updateChildren() {
                const cards = container.querySelectorAll('.child-item');

                cards.forEach(function (card, index) {
                    const number = index + 1;
                    const numberElement = card.querySelector('.child-number');
                    const titleElement = card.querySelector('.child-title');
                    const removeButton = card.querySelector('.remove-child');

                    if (numberElement) {
                        numberElement.textContent = number;
                    }

                    if (titleElement) {
                        titleElement.textContent =
                            @json(__('menu.employee_child_information')) + ' ' + number;
                    }

                    if (removeButton) {
                        removeButton.style.display =
                            cards.length > 1 ? '' : 'none';
                    }
                });
            }

            addButton.addEventListener('click', function () {
                const fragment = template.content.cloneNode(true);
                const card = fragment.querySelector('.child-item');

                card.dataset.childIndex = nextIndex;

                card.querySelectorAll('[name]').forEach(function (field) {
                    field.name = field.name.replaceAll('__INDEX__', nextIndex);
                });

                container.appendChild(fragment);

                nextIndex++;

                updateChildren();
            });

            container.addEventListener('click', function (event) {
                const button = event.target.closest('.remove-child');

                if (!button) {
                    return;
                }

                const cards = container.querySelectorAll('.child-item');

                if (cards.length <= 1) {
                    return;
                }

                button.closest('.child-item').remove();

                updateChildren();
            });

            container.addEventListener('input', function (event) {
                if (event.target.matches('input, select, textarea')) {
                    event.target.classList.remove('is-invalid');
                }
            });

            container.addEventListener('change', function (event) {
                if (event.target.matches('input, select, textarea')) {
                    event.target.classList.remove('is-invalid');
                }
            });

            form.addEventListener('submit', function (event) {
                if (submitting) {
                    event.preventDefault();
                    return;
                }

                let firstInvalid = null;

                container.querySelectorAll(
                    'input[required], select[required], textarea[required]'
                ).forEach(function (field) {
                    if (!field.checkValidity()) {
                        field.classList.add('is-invalid');

                        if (!firstInvalid) {
                            firstInvalid = field;
                        }
                    }
                });

                if (firstInvalid) {
                    event.preventDefault();
                    firstInvalid.focus();
                    firstInvalid.reportValidity();
                    return;
                }

                submitting = true;
                saveButton.disabled = true;
                addButton.disabled = true;

                saveSpinner.classList.remove('d-none');

                saveText.textContent =
                @json(__('menu.employee_child_saving'));
            });

            updateChildren();
        });
    </script>

@endsection
