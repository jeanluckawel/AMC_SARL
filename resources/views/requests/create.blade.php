@extends('layouts.admin')

@section('title', 'Create Request')

@section('content')

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


    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6 col-12">

                    <h3 class="mb-0">
                        Create a New Request
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

                            <a href="{{ route('requests.index') }}">
                                Requests
                            </a>

                        </li>

                        <li class="breadcrumb-item active">
                            Create
                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </div>

    <div class="card request-card request-card-wrapper m-4 shadow-sm">


        <div class="card-header request-header">

            <h5 class="card-title mb-0">

                <i class="bi bi-file-earmark-plus me-2"></i>

                New Request

            </h5>

        </div>


        <div class="card-body">



            @if($errors->any())

                <div
                    class="alert alert-danger request-info"
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



            <form
                action="{{ route('requests.store') }}"
                method="POST"
                id="requestForm"
                autocomplete="off"
            >

                @csrf



                <div class="request-section">





                    <div class="request-section-body">

                        <div class="row g-3">


                            {{-- =====================================
                                 REQUEST TITLE
                            ====================================== --}}

                            <div class="col-12 col-md-6">

                                <label class="form-label">

                                    Request Title

                                    <span class="text-danger">*</span>

                                </label>

                                <input
                                    type="text"
                                    name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title') }}"
                                    placeholder="Example: Request for construction materials"
                                    maxlength="255"
                                    required
                                >

                                @error('title')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>


                            {{-- =====================================
                                 DESCRIPTION
                            ====================================== --}}

                            <div class="col-12 col-md-6">

                                <label class="form-label">

                                    Description / Remark

                                </label>

                                <textarea
                                    name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="1"
                                    placeholder="Describe the reason for this request..."
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




                                    <div class="item-card-header">


                                        <span class="item-number">

                                            <i class="bi bi-box me-1"></i>

                                            Item

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

                                            Remove

                                        </button>


                                    </div>


                                    <div class="row g-3">




                                        <div class="col-12 col-md-6">

                                            <label class="form-label">

                                                Item Name

                                                <span class="text-danger">*</span>

                                            </label>

                                            <input
                                                type="text"
                                                name="items[{{ $index }}][name]"
                                                class="form-control @error('items.' . $index . '.name') is-invalid @enderror"
                                                value="{{ $item['name'] ?? '' }}"
                                                placeholder="Keyboard"
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

                                                Quantity

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



                                        <div class="col-12 col-md-3">

                                            <label class="form-label">

                                                Unit

                                            </label>

                                            <input
                                                type="text"
                                                name="items[{{ $index }}][unit]"
                                                class="form-control"
                                                value="{{ $item['unit'] ?? '' }}"
                                                placeholder="pcs, kg, m³..."
                                                maxlength="100"
                                            >

                                        </div>


                                    </div>


                                </div>


                            @endforeach


                        </div>


                        {{-- =========================================
                             ADD ITEM
                        ========================================== --}}

                        <button
                            type="button"
                            class="btn btn-add-item"
                            id="addItemBtn"
                        >

                            <i class="bi bi-plus-lg me-1"></i>

                            Add Another Item

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

                        Cancel

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

                            Submit Request

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
                        Item
                        <span class="item-number-value"></span>
                    </span>

                    <button
                        type="button"
                        class="btn btn-sm btn-outline-danger remove-item-btn"
                    >
                        <i class="bi bi-trash me-1"></i>
                        Remove
                    </button>

                </div>

                <div class="row g-3">

                    <div class="col-12 col-md-6">

                        <label class="form-label">
                            Item Name
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="items[${index}][name]"
                            class="form-control"
                            placeholder="Example: Cement"
                            maxlength="255"
                            required
                        >

                    </div>

                    <div class="col-12 col-md-3">

                        <label class="form-label">
                            Quantity
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
                            Unit
                        </label>

                        <input
                            type="text"
                            name="items[${index}][unit]"
                            class="form-control"
                            placeholder="pcs, kg, m³..."
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

                const itemCards = itemsContainer.querySelectorAll('.item-card');

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

                const cards = itemsContainer.querySelectorAll('.item-card');

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

                const cards = itemsContainer.querySelectorAll('.item-card');

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

                const cards = itemsContainer.querySelectorAll('.item-card');

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

                    alert(
                        'Please add at least one item to the request.'
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

                saveSpinner.classList.remove('d-none');

                saveText.innerHTML = 'Submitting...';
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
