@extends('layouts.admin')

@section('title', 'Create Request')

@section('content')

    {{-- =========================================================
        CSS
    ========================================================== --}}

    <style>

        .request-card {
            border: 0;
            border-radius: 0 !important;
        }

        .request-header {
            background-color: #0d6efd;
            color: #fff;
            border-radius: 0 !important;
        }

        .request-header .card-title {
            font-weight: 600;
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

        .request-section {
            border: 1px solid #dee2e6;
            margin-bottom: 25px;
        }

        .request-section-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 18px;
        }

        .request-section-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .request-section-header p {
            margin: 4px 0 0;
            color: #6c757d;
            font-size: 14px;
        }

        .request-section-body {
            padding: 20px;
        }

        .item-card {
            border: 1px solid #dee2e6;
            background: #fff;
            padding: 18px;
            margin-bottom: 15px;
            position: relative;
        }

        .item-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        .item-number {
            font-weight: 600;
            color: #0d6efd;
        }

        .remove-item-btn {
            border-radius: 0 !important;
        }

        .btn-add-item {
            border: 1px dashed #0d6efd;
            color: #0d6efd;
            background: #fff;
            border-radius: 0 !important;
        }

        .btn-add-item:hover {
            background: #0d6efd;
            color: #fff;
        }

        .request-info {
            border-radius: 0 !important;
        }

        .btn-primary-custom {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
            border-radius: 0 !important;
        }

        .btn-primary-custom:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
            color: #fff;
        }

        @media (max-width: 768px) {

            .request-card-wrapper {
                margin: 10px !important;
            }

            .request-section-body {
                padding: 15px;
            }

            .item-card {
                padding: 12px;
            }

            .item-card-header {
                align-items: flex-start;
                gap: 10px;
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
                        {{ __('menu.create_request') }}
                    </h3>

                </div>

                <div class="col-md-6 col-12">

                    <ol class="breadcrumb float-md-end mb-0">

                        <li class="breadcrumb-item">

                            <a href="{{ url('/') }}">
                                {{ __('menu.dashboard') }}
                            </a>

                        </li>

                        <li class="breadcrumb-item">

                            <a href="{{ route('requests.index') }}">
                                {{ __('menu.requests') }}
                            </a>

                        </li>

                        <li class="breadcrumb-item active">
                            {{ __('menu.create') }}
                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        REQUEST CARD
    ========================================================== --}}

    <div class="card request-card request-card-wrapper m-4 shadow-sm">

        {{-- =====================================================
            CARD HEADER
        ====================================================== --}}

        <div class="card-header request-header">

            <h5 class="card-title mb-0">

                <i class="bi bi-file-earmark-plus me-2"></i>

                {{ __('menu.new_request_title') }}

            </h5>

        </div>


        {{-- =====================================================
            CARD BODY
        ====================================================== --}}

        <div class="card-body">


            {{-- =================================================
                VALIDATION ERRORS
            ================================================== --}}

            @if($errors->any())

                <div
                    class="alert alert-danger request-info"
                    role="alert"
                >

                    <div class="fw-bold mb-2">

                        <i class="bi bi-exclamation-triangle-fill me-2"></i>

                        {{ __('menu.please_correct_errors') }}

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
                FORM
            ================================================== --}}

            <form
                action="{{ route('requests.store') }}"
                method="POST"
                id="requestForm"
                autocomplete="off"
            >

                @csrf


                {{-- =================================================
                    REQUEST INFORMATION
                ================================================== --}}

                <div class="request-section">

                    <div class="request-section-body">

                        <div class="row g-3">


                            {{-- REQUEST TITLE --}}
                            <div class="col-12 col-md-6">

                                <label class="form-label">

                                    {{ __('menu.request_title') }}

                                    <span class="text-danger">*</span>

                                </label>

                                <input
                                    type="text"
                                    name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title') }}"
                                    placeholder="{{ __('menu.request_title_placeholder') }}"
                                    maxlength="255"
                                    required
                                >

                                @error('title')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>


                            {{-- DESCRIPTION --}}
                            <div class="col-12 col-md-6">

                                <label class="form-label">

                                    {{ __('menu.description_remark') }}

                                </label>

                                <textarea
                                    name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="1"
                                    placeholder="{{ __('menu.description_placeholder') }}"
                                >{{ old('description') }}</textarea>

                                @error('description')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    REQUEST ITEMS
                ================================================== --}}

                <div class="request-section">

                    <div class="request-section-body">

                        <div id="itemsContainer">

                            @php

                                $oldItems = old('items', [
                                    [
                                        'name' => '',
                                        'quantity' => 1,
                                        'unit' => '',
                                    ]
                                ]);

                            @endphp


                            @foreach($oldItems as $index => $item)

                                <div
                                    class="item-card"
                                    data-item-index="{{ $index }}"
                                >

                                    {{-- ITEM HEADER --}}
                                    <div class="item-card-header">

                                        <span class="item-number">

                                            <i class="bi bi-box me-1"></i>

                                            {{ __('menu.item') }}

                                            <span class="item-number-value">
                                                {{ $index + 1 }}
                                            </span>

                                        </span>


                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger remove-item-btn"
                                            @if(count($oldItems) === 1)
                                                disabled
                                            @endif
                                        >

                                            <i class="bi bi-trash me-1"></i>

                                            {{ __('menu.remove') }}

                                        </button>

                                    </div>


                                    {{-- ITEM FIELDS --}}
                                    <div class="row g-3">


                                        {{-- ITEM NAME --}}
                                        <div class="col-12 col-md-6">

                                            <label class="form-label">

                                                {{ __('menu.item_name') }}

                                                <span class="text-danger">*</span>

                                            </label>

                                            <input
                                                type="text"
                                                name="items[{{ $index }}][name]"
                                                class="form-control @error('items.' . $index . '.name') is-invalid @enderror"
                                                value="{{ $item['name'] ?? '' }}"
                                                placeholder="{{ __('menu.item_name_placeholder') }}"
                                                maxlength="255"
                                                required
                                            >

                                            @error('items.' . $index . '.name')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                            @enderror

                                        </div>


                                        {{-- QUANTITY --}}
                                        <div class="col-12 col-md-3">

                                            <label class="form-label">

                                                {{ __('menu.quantity') }}

                                                <span class="text-danger">*</span>

                                            </label>

                                            <input
                                                type="number"
                                                name="items[{{ $index }}][quantity]"
                                                class="form-control @error('items.' . $index . '.quantity') is-invalid @enderror"
                                                value="{{ $item['quantity'] ?? 1 }}"
                                                min="0.01"
                                                step="0.01"
                                                required
                                            >

                                            @error('items.' . $index . '.quantity')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                            @enderror

                                        </div>


                                        {{-- UNIT --}}
                                        <div class="col-12 col-md-3">

                                            <label class="form-label">

                                                {{ __('menu.unit') }}

                                            </label>

                                            <input
                                                type="text"
                                                name="items[{{ $index }}][unit]"
                                                class="form-control"
                                                value="{{ $item['unit'] ?? '' }}"
                                                placeholder="{{ __('menu.unit_placeholder') }}"
                                                maxlength="100"
                                            >

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>


                        {{-- ADD ITEM --}}
                        <button
                            type="button"
                            class="btn btn-add-item"
                            id="addItemBtn"
                        >

                            <i class="bi bi-plus-lg me-1"></i>

                            {{ __('menu.add_another_item') }}

                        </button>

                    </div>

                </div>


                {{-- =================================================
                    FORM ACTIONS
                ================================================== --}}

                <div
                    class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top"
                >

                    {{-- CANCEL --}}
                    <a
                        href="{{ route('requests.index') }}"
                        class="btn btn-secondary"
                    >

                        <i class="bi bi-x-lg me-1"></i>

                        {{ __('menu.cancel') }}

                    </a>


                    {{-- SUBMIT --}}
                    <button
                        type="submit"
                        class="btn btn-primary-custom"
                        id="saveBtn"
                    >

                        <span
                            class="spinner-border spinner-border-sm d-none"
                            id="saveSpinner"
                            role="status"
                            aria-hidden="true"
                        ></span>

                        <span id="saveText">

                            <i class="bi bi-send me-1"></i>

                            {{ __('menu.submit_request') }}

                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
        JAVASCRIPT
    ========================================================== --}}

    <script>

        /*
         * Textes traduits injectés depuis Laravel pour le JS.
         */
        const translations = {
            item: @json(__('menu.item')),
            remove: @json(__('menu.remove')),
            itemName: @json(__('menu.item_name')),
            itemNamePlaceholder: @json(__('menu.item_name_placeholder_js')),
            quantity: @json(__('menu.quantity')),
            unit: @json(__('menu.unit')),
            unitPlaceholder: @json(__('menu.unit_placeholder')),
            submitting: @json(__('menu.submitting')),
            addAtLeastOneItem: @json(__('menu.add_at_least_one_item')),
        };


        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('requestForm');
            const itemsContainer = document.getElementById('itemsContainer');
            const addItemBtn = document.getElementById('addItemBtn');
            const saveBtn = document.getElementById('saveBtn');
            const saveSpinner = document.getElementById('saveSpinner');
            const saveText = document.getElementById('saveText');

            let itemIndex = itemsContainer.querySelectorAll('.item-card').length;


            /* =====================================================
               ADD ITEM
            ====================================================== */

            addItemBtn.addEventListener('click', function () {

                const index = itemIndex++;

                const itemCard = document.createElement('div');

                itemCard.className = 'item-card';
                itemCard.dataset.itemIndex = index;

                itemCard.innerHTML = `

                    <div class="item-card-header">

                        <span class="item-number">

                            <i class="bi bi-box me-1"></i>

                            ${translations.item}

                            <span class="item-number-value"></span>

                        </span>


                        <button
                            type="button"
                            class="btn btn-sm btn-outline-danger remove-item-btn"
                        >

                            <i class="bi bi-trash me-1"></i>

                            ${translations.remove}

                        </button>

                    </div>


                    <div class="row g-3">


                        <div class="col-12 col-md-6">

                            <label class="form-label">

                                ${translations.itemName}

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="items[${index}][name]"
                                class="form-control"
                                placeholder="${translations.itemNamePlaceholder}"
                                maxlength="255"
                                required
                            >

                        </div>


                        <div class="col-12 col-md-3">

                            <label class="form-label">

                                ${translations.quantity}

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="number"
                                name="items[${index}][quantity]"
                                class="form-control"
                                value="1"
                                min="0.01"
                                step="0.01"
                                required
                            >

                        </div>


                        <div class="col-12 col-md-3">

                            <label class="form-label">

                                ${translations.unit}

                            </label>

                            <input
                                type="text"
                                name="items[${index}][unit]"
                                class="form-control"
                                placeholder="${translations.unitPlaceholder}"
                                maxlength="100"
                            >

                        </div>


                    </div>
                `;


                itemsContainer.appendChild(itemCard);

                updateItemNumbers();
                updateRemoveButtons();
                reindexItems();


                const nameInput = itemCard.querySelector(
                    'input[name*="[name]"]'
                );

                if (nameInput) {
                    nameInput.focus();
                }

            });


            /* =====================================================
               REMOVE ITEM
            ====================================================== */

            itemsContainer.addEventListener('click', function (event) {

                const button = event.target.closest('.remove-item-btn');

                if (!button) {
                    return;
                }


                const itemCard = button.closest('.item-card');

                if (!itemCard) {
                    return;
                }


                const itemCards = itemsContainer.querySelectorAll(
                    '.item-card'
                );


                /*
                 * At least one item is required.
                 */
                if (itemCards.length <= 1) {
                    return;
                }


                itemCard.remove();

                updateItemNumbers();
                updateRemoveButtons();
                reindexItems();

            });


            /* =====================================================
               UPDATE ITEM NUMBERS
            ====================================================== */

            function updateItemNumbers() {

                const cards = itemsContainer.querySelectorAll(
                    '.item-card'
                );


                cards.forEach(function (card, index) {

                    const number = card.querySelector(
                        '.item-number-value'
                    );


                    if (number) {
                        number.textContent = index + 1;
                    }

                });

            }


            /* =====================================================
               REINDEX ITEMS
            ====================================================== */

            function reindexItems() {

                const cards = itemsContainer.querySelectorAll(
                    '.item-card'
                );


                cards.forEach(function (card, index) {

                    card.dataset.itemIndex = index;


                    const nameInput = card.querySelector(
                        'input[name*="[name]"]'
                    );

                    const quantityInput = card.querySelector(
                        'input[name*="[quantity]"]'
                    );

                    const unitInput = card.querySelector(
                        'input[name*="[unit]"]'
                    );


                    if (nameInput) {
                        nameInput.name = `items[${index}][name]`;
                    }

                    if (quantityInput) {
                        quantityInput.name = `items[${index}][quantity]`;
                    }

                    if (unitInput) {
                        unitInput.name = `items[${index}][unit]`;
                    }

                });

            }


            /* =====================================================
               UPDATE REMOVE BUTTONS
            ====================================================== */

            function updateRemoveButtons() {

                const cards = itemsContainer.querySelectorAll(
                    '.item-card'
                );


                cards.forEach(function (card) {

                    const button = card.querySelector(
                        '.remove-item-btn'
                    );


                    if (!button) {
                        return;
                    }


                    button.disabled = cards.length === 1;

                });

            }


            /* =====================================================
               SUBMIT
            ====================================================== */

            form.addEventListener('submit', function (event) {


                /*
                 * Browser validation
                 */
                if (!form.checkValidity()) {

                    event.preventDefault();

                    const invalidField = form.querySelector(':invalid');


                    if (invalidField) {

                        invalidField.focus();
                        invalidField.reportValidity();

                    }

                    return;
                }


                /*
                 * At least one item
                 */
                const itemCards = itemsContainer.querySelectorAll(
                    '.item-card'
                );


                if (itemCards.length === 0) {

                    event.preventDefault();

                    alert(translations.addAtLeastOneItem);

                    return;
                }


                /*
                 * Make sure indexes are clean
                 * before submitting.
                 */
                reindexItems();


                /*
                 * Prevent double submit
                 */
                saveBtn.disabled = true;

                saveSpinner.classList.remove('d-none');

                saveText.innerHTML = translations.submitting;

            });


            /* =====================================================
               INITIALIZATION
            ====================================================== */

            updateItemNumbers();
            updateRemoveButtons();
            reindexItems();

        });

    </script>

@endsection
