@extends('layouts.admin')

@section('title', 'Create Request')

@section('content')

    {{-- =========================================================
        CSS — LIGHT + DARK MODE
    ========================================================== --}}

    <style>

        /* =====================================================
           THEME VARIABLES — LIGHT MODE
        ====================================================== */

        :root {

            --request-bg: #ffffff;
            --request-card-bg: #ffffff;
            --request-section-bg: #ffffff;
            --request-section-header: #f8f9fa;
            --request-item-bg: #ffffff;

            --request-text: #212529;
            --request-muted: #6c757d;

            --request-border: #dee2e6;
            --request-input-bg: #ffffff;
            --request-input-text: #212529;
            --request-placeholder: #6c757d;

            --request-primary: #0d6efd;
            --request-primary-hover: #0b5ed7;

            --request-danger: #dc3545;

            --request-header-bg: #0d6efd;
            --request-header-text: #ffffff;

            --request-add-bg: #ffffff;
            --request-add-text: #0d6efd;

            --request-alert-bg: #f8d7da;
            --request-alert-text: #842029;
            --request-alert-border: #f5c2c7;
        }


        /* =====================================================
           DARK MODE
        ====================================================== */

        [data-bs-theme="dark"] {

            --request-bg: #212529;
            --request-card-bg: #212529;
            --request-section-bg: #212529;
            --request-section-header: #2b3035;
            --request-item-bg: #252a2f;

            --request-text: #f8f9fa;
            --request-muted: #adb5bd;

            --request-border: #495057;
            --request-input-bg: #2b3035;
            --request-input-text: #f8f9fa;
            --request-placeholder: #adb5bd;

            --request-primary: #0d6efd;
            --request-primary-hover: #3d8bfd;

            --request-danger: #dc3545;

            --request-header-bg: #0d6efd;
            --request-header-text: #ffffff;

            --request-add-bg: #252a2f;
            --request-add-text: #6ea8fe;

            --request-alert-bg: #2c1b1e;
            --request-alert-text: #ea868f;
            --request-alert-border: #842029;
        }


        /* =====================================================
           MAIN CARD
        ====================================================== */

        .request-card {

            border: 0 !important;
            border-radius: 0 !important;

            background-color: var(--request-card-bg) !important;
            color: var(--request-text);

        }


        /* =====================================================
           CARD HEADER
        ====================================================== */

        .request-header {

            background-color: var(--request-header-bg) !important;
            color: var(--request-header-text) !important;

            border-radius: 0 !important;
            border: 0 !important;

        }


        .request-header .card-title {

            font-weight: 600;

        }


        /* =====================================================
           FORM CONTROLS
        ====================================================== */

        .form-control,
        .form-select,
        .input-group-text,
        .btn {

            border-radius: 0 !important;

        }


        .form-control,
        .form-select {

            min-height: 44px;

            background-color: var(--request-input-bg);
            color: var(--request-input-text);

            border-color: var(--request-border);

        }


        .form-control:focus,
        .form-select:focus {

            background-color: var(--request-input-bg);
            color: var(--request-input-text);

            border-color: var(--request-primary);

            box-shadow: 0 0 0 .15rem rgba(13, 110, 253, .15);

        }


        .form-control::placeholder {

            color: var(--request-placeholder);
            opacity: .8;

        }


        /* =====================================================
           LABELS
        ====================================================== */

        .form-label {

            font-weight: 600;
            margin-bottom: 6px;

            color: var(--request-text);

        }


        /* =====================================================
           INVALID
        ====================================================== */

        .is-invalid {

            border-color: var(--request-danger) !important;

        }


        /* =====================================================
           REQUEST SECTION
        ====================================================== */

        .request-section {

            border: 1px solid var(--request-border);

            margin-bottom: 25px;

            background-color: var(--request-section-bg);

        }


        /* =====================================================
           REQUEST SECTION HEADER
        ====================================================== */

        .request-section-header {

            background-color: var(--request-section-header);

            border-bottom: 1px solid var(--request-border);

            padding: 15px 18px;

        }


        .request-section-header h5 {

            margin: 0;

            font-weight: 600;

            color: var(--request-text);

        }


        .request-section-header p {

            margin: 4px 0 0;

            color: var(--request-muted);

            font-size: 14px;

        }


        /* =====================================================
           REQUEST SECTION BODY
        ====================================================== */

        .request-section-body {

            padding: 20px;

            background-color: var(--request-section-bg);

        }


        /* =====================================================
           ITEM CARD
        ====================================================== */

        .item-card {

            border: 1px solid var(--request-border);

            background-color: var(--request-item-bg);

            color: var(--request-text);

            padding: 18px;

            margin-bottom: 15px;

            position: relative;

        }


        /* =====================================================
           ITEM CARD HEADER
        ====================================================== */

        .item-card-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 15px;

            padding-bottom: 10px;

            border-bottom: 1px solid var(--request-border);

        }


        .item-number {

            font-weight: 600;

            color: var(--request-primary);

        }


        /* =====================================================
           REMOVE BUTTON
        ====================================================== */

        .remove-item-btn {

            border-radius: 0 !important;

        }


        /* =====================================================
           ADD ITEM BUTTON
        ====================================================== */

        .btn-add-item {

            border: 1px dashed var(--request-primary);

            color: var(--request-add-text);

            background-color: var(--request-add-bg);

            border-radius: 0 !important;

        }


        .btn-add-item:hover {

            background-color: var(--request-primary);

            color: #ffffff;

        }


        /* =====================================================
           ALERT
        ====================================================== */

        .request-info {

            border-radius: 0 !important;

        }


        .alert-danger.request-info {

            background-color: var(--request-alert-bg);

            color: var(--request-alert-text);

            border-color: var(--request-alert-border);

        }


        /* =====================================================
           PRIMARY BUTTON
        ====================================================== */

        .btn-primary-custom {

            background-color: var(--request-primary);

            border-color: var(--request-primary);

            color: #ffffff;

            border-radius: 0 !important;

        }


        .btn-primary-custom:hover {

            background-color: var(--request-primary-hover);

            border-color: var(--request-primary-hover);

            color: #ffffff;

        }


        /* =====================================================
           SECONDARY BUTTON
        ====================================================== */

        .btn-secondary {

            border-radius: 0 !important;

        }


        /* =====================================================
           CARD BODY
        ====================================================== */

        .request-card .card-body {

            background-color: var(--request-card-bg);

            color: var(--request-text);

        }


        /* =====================================================
           BORDER TOP
        ====================================================== */

        .request-card .border-top {

            border-color: var(--request-border) !important;

        }


        /* =====================================================
           BREADCRUMB
        ====================================================== */

        [data-bs-theme="dark"] .breadcrumb-item {

            color: var(--request-muted);

        }


        [data-bs-theme="dark"] .breadcrumb-item a {

            color: #6ea8fe;

        }


        /* =====================================================
           NUMBER INPUT ARROWS
        ====================================================== */

        [data-bs-theme="dark"] input[type="number"] {

            color-scheme: dark;

        }


        /* =====================================================
           DATE / SELECT / AUTOFILL
        ====================================================== */

        [data-bs-theme="dark"] .form-control:-webkit-autofill,
        [data-bs-theme="dark"] .form-control:-webkit-autofill:hover,
        [data-bs-theme="dark"] .form-control:-webkit-autofill:focus {

            -webkit-text-fill-color: var(--request-input-text);

            -webkit-box-shadow: 0 0 0 1000px var(--request-input-bg) inset;

            transition: background-color 5000s ease-in-out 0s;

        }


        /* =====================================================
           MOBILE
        ====================================================== */

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

            itemNamePlaceholder:
            @json(__('menu.item_name_placeholder_js')),

            quantity: @json(__('menu.quantity')),

            unit: @json(__('menu.unit')),

            unitPlaceholder:
            @json(__('menu.unit_placeholder')),

            submitting:
            @json(__('menu.submitting')),

            addAtLeastOneItem:
            @json(__('menu.add_at_least_one_item')),

        };


        document.addEventListener('DOMContentLoaded', function () {


            const form =
                document.getElementById('requestForm');


            const itemsContainer =
                document.getElementById('itemsContainer');


            const addItemBtn =
                document.getElementById('addItemBtn');


            const saveBtn =
                document.getElementById('saveBtn');


            const saveSpinner =
                document.getElementById('saveSpinner');


            const saveText =
                document.getElementById('saveText');


            let itemIndex =
                itemsContainer.querySelectorAll('.item-card').length;


            /* =====================================================
               ADD ITEM
            ====================================================== */

            addItemBtn.addEventListener('click', function () {


                const index = itemIndex++;


                const itemCard =
                    document.createElement('div');


                itemCard.className =
                    'item-card';


                itemCard.dataset.itemIndex =
                    index;


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


                const nameInput =
                    itemCard.querySelector(
                        'input[name*="[name]"]'
                    );


                if (nameInput) {

                    nameInput.focus();

                }

            });


            /* =====================================================
               REMOVE ITEM
            ====================================================== */

            itemsContainer.addEventListener(
                'click',
                function (event) {


                    const button =
                        event.target.closest(
                            '.remove-item-btn'
                        );


                    if (!button) {

                        return;

                    }


                    const itemCard =
                        button.closest('.item-card');


                    if (!itemCard) {

                        return;

                    }


                    const itemCards =
                        itemsContainer.querySelectorAll(
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

                }
            );


            /* =====================================================
               UPDATE ITEM NUMBERS
            ====================================================== */

            function updateItemNumbers() {


                const cards =
                    itemsContainer.querySelectorAll(
                        '.item-card'
                    );


                cards.forEach(function (card, index) {


                    const number =
                        card.querySelector(
                            '.item-number-value'
                        );


                    if (number) {

                        number.textContent =
                            index + 1;

                    }

                });

            }


            /* =====================================================
               REINDEX ITEMS
            ====================================================== */

            function reindexItems() {


                const cards =
                    itemsContainer.querySelectorAll(
                        '.item-card'
                    );


                cards.forEach(function (card, index) {


                    card.dataset.itemIndex =
                        index;


                    const nameInput =
                        card.querySelector(
                            'input[name*="[name]"]'
                        );


                    const quantityInput =
                        card.querySelector(
                            'input[name*="[quantity]"]'
                        );


                    const unitInput =
                        card.querySelector(
                            'input[name*="[unit]"]'
                        );


                    if (nameInput) {

                        nameInput.name =
                            `items[${index}][name]`;

                    }


                    if (quantityInput) {

                        quantityInput.name =
                            `items[${index}][quantity]`;

                    }


                    if (unitInput) {

                        unitInput.name =
                            `items[${index}][unit]`;

                    }

                });

            }


            /* =====================================================
               UPDATE REMOVE BUTTONS
            ====================================================== */

            function updateRemoveButtons() {


                const cards =
                    itemsContainer.querySelectorAll(
                        '.item-card'
                    );


                cards.forEach(function (card) {


                    const button =
                        card.querySelector(
                            '.remove-item-btn'
                        );


                    if (!button) {

                        return;

                    }


                    button.disabled =
                        cards.length === 1;

                });

            }


            /* =====================================================
               SUBMIT
            ====================================================== */

            form.addEventListener(
                'submit',
                function (event) {


                    /*
                     * Browser validation
                     */

                    if (!form.checkValidity()) {


                        event.preventDefault();


                        const invalidField =
                            form.querySelector(':invalid');


                        if (invalidField) {

                            invalidField.focus();

                            invalidField.reportValidity();

                        }


                        return;

                    }


                    /*
                     * At least one item
                     */

                    const itemCards =
                        itemsContainer.querySelectorAll(
                            '.item-card'
                        );


                    if (itemCards.length === 0) {


                        event.preventDefault();


                        alert(
                            translations.addAtLeastOneItem
                        );


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


                    saveSpinner.classList.remove(
                        'd-none'
                    );


                    saveText.innerHTML =
                        translations.submitting;

                }
            );


            /* =====================================================
               INITIALIZATION
            ====================================================== */

            updateItemNumbers();

            updateRemoveButtons();

            reindexItems();

        });

    </script>

@endsection
