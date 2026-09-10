@extends('layouts.admin')

@section('title', 'Create Quotation')

@section('content')

    <style>
        /* GENERAL */
        .quotation-card {
            border: 0;
            border-radius: 0 !important;
        }

        .quotation-header {
            background-color: #0d6efd;
            color: #fff;
            border-radius: 0 !important;
        }

        .quotation-header .card-title {
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

        /* FORM SECTIONS */
        .quotation-section {
            border: 1px solid #dee2e6;
            margin-bottom: 25px;
        }

        .quotation-section-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 18px;
        }

        .quotation-section-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .quotation-section-header p {
            margin: 4px 0 0;
            color: #6c757d;
            font-size: 14px;
        }

        .quotation-section-body {
            padding: 20px;
        }

        /* ITEMS */
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

        /* PRIMARY BUTTON */
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

        /* LIVE PREVIEW */
        .preview-wrapper {
            position: sticky;
            top: 15px;
        }

        .preview-header {
            background: #212529;
            color: #fff;
            padding: 12px 15px;
            font-weight: 600;
            border: 1px solid #212529;
        }

        .quotation-preview {
            background: #fff;
            border: 1px solid #dee2e6;
            box-shadow: 0 3px 15px rgba(0,0,0,.08);
            font-family: Arial, Helvetica, sans-serif;
            color: #111;
            font-size: 9px;
            padding: 18px;
        }

        .preview-top {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            min-height: 105px;
        }

        .preview-brand {
            font-size: 27px;
            font-weight: 800;
            font-style: italic;
            color: #555;
            letter-spacing: -2px;
        }

        .preview-company {
            font-size: 6px;
            font-weight: 700;
            color: #555;
            letter-spacing: 0;
            margin-left: 4px;
        }

        .preview-meta {
            margin-top: 8px;
            font-size: 8px;
            line-height: 1.45;
        }

        .preview-meta .blue {
            color: #0879c9;
        }

        .preview-address {
            font-size: 8px;
            line-height: 1.45;
            text-align: justify;
            text-justify: inter-word;
        }

        .preview-rule {
            height: 2px;
            background: #f47721;
            margin: 5px 15px 10px;
        }

        .preview-title-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            border: 1px solid #222;
            min-height: 30px;
        }

        .preview-title {
            background: #4f8136;
            color: #000;
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .preview-date {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            text-align: center;
        }

        .preview-client-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5px;
            font-size: 8px;
        }

        .preview-quote-no {
            font-weight: 700;
            margin-top: 5px;
            text-align: right;
            font-size: 8px;
        }

        .preview-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 5px;
            font-size: 7px;
        }

        .preview-table th,
        .preview-table td {
            border: 1px solid #222;
            padding: 5px 3px;
            vertical-align: middle;
        }

        .preview-table th {
            background: #d9d9d9;
            text-align: center;
            font-weight: 800;
        }

        .preview-table th:nth-child(1) {
            width: 7%;
        }

        .preview-table th:nth-child(2) {
            width: 38%;
        }

        .preview-table th:nth-child(3) {
            width: 10%;
        }

        .preview-table th:nth-child(4) {
            width: 10%;
        }

        .preview-table th:nth-child(5) {
            width: 15%;
        }

        .preview-table th:nth-child(6) {
            width: 20%;
        }

        .preview-table td {
            text-align: center;
        }

        .preview-table td:nth-child(2) {
            text-align: left;
            word-break: break-word;
        }

        .preview-table td:nth-child(5),
        .preview-table td:nth-child(6) {
            text-align: right;
        }

        .preview-empty {
            text-align: center !important;
            color: #777;
            padding: 15px !important;
        }

        /* PREVIEW TOTALS */
        .preview-subtotal {
            margin-top: 12px;
            display: grid;
            grid-template-columns: 1fr 125px;
            align-items: stretch;
        }

        .preview-sub-label {
            background: #d9d9d9;
            border: 1px solid #222;
            border-right: 0;
            font-weight: 800;
            text-align: center;
            padding: 5px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .preview-money {
            border: 1px solid #222;
            font-size: 8px;
        }

        .preview-money-row {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
        }

        .preview-money-row > div {
            border-bottom: 1px solid #222;
            padding: 4px;
        }

        .preview-money-row:last-child > div {
            border-bottom: 0;
        }

        .preview-money-row .label {
            font-weight: 800;
            text-align: center;
        }

        .preview-money-row .value {
            text-align: right;
            font-weight: 800;
            padding-right: 6px;
        }

        /* PREVIEW LOWER */
        .preview-lower {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-top: 18px;
        }

        .preview-terms {
            text-align: center;
            font-size: 7.5px;
            font-weight: 700;
            line-height: 1.6;
            padding-top: 3px;
        }

        .preview-signature {
            text-align: center;
            font-size: 8px;
            font-weight: 700;
        }

        .preview-sigbox {
            height: 55px;
            margin-top: 5px;
            position: relative;
        }

        .preview-stamp {
            position: absolute;
            left: 5px;
            top: 3px;
            width: 45px;
            height: 45px;
            border: 2px solid #c22;
            border-radius: 50%;
            color: #c22;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 5px;
            font-weight: 800;
            transform: rotate(-12deg);
        }

        .preview-sign {
            position: absolute;
            right: 10px;
            top: 15px;
            font-family: cursive;
            font-size: 18px;
            color: #263b77;
            transform: rotate(-7deg);
        }

        /* NOTE AT BOTTOM */
        .preview-note {
            margin-top: 18px;
            border-top: 1px solid #f47721;
            padding-top: 7px;
            text-align: center;
            color: #8b0000;
            font-size: 6.5px;
            font-weight: 700;
            line-height: 1.4;
        }

        .preview-footer {
            margin-top: 5px;
            border-top: 1px solid #f47721;
            padding-top: 5px;
            font-size: 6.5px;
        }

        .preview-footer b {
            display: inline-block;
            width: 35px;
        }

        /* MOBILE */
        @media (max-width: 1199px) {
            .preview-wrapper {
                position: static;
            }
        }

        @media (max-width: 768px) {

            .quotation-card-wrapper {
                margin: 10px !important;
            }

            .quotation-section-body {
                padding: 15px;
            }

            .item-card {
                padding: 12px;
            }

            .item-card-header {
                align-items: flex-start;
                gap: 10px;
            }

            .preview-top {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .preview-address {
                text-align: justify;
            }

            .preview-subtotal {
                grid-template-columns: 1fr;
            }

            .preview-sub-label {
                border-right: 1px solid #222;
                border-bottom: 0;
            }
        }
    </style>

    {{-- PAGE HEADER --}}
    <div class="app-content-header">
        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6 col-12">
                    <h3 class="mb-0">
                        Create a New Quotation
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
                            <a href="{{ route('quotations.index') }}">
                                Quotations
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

    {{-- MAIN CARD --}}
    <div class="card quotation-card quotation-card-wrapper m-4 shadow-sm">

        <div class="card-header quotation-header">

            <h5 class="card-title mb-0">

                <i class="bi bi-file-earmark-plus me-2"></i>

                New Quotation

            </h5>

        </div>

        <div class="card-body">

            @if($errors->any())

                <div class="alert alert-danger" role="alert">

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

            <div class="row g-4">

                {{-- LEFT : FORM — 50% --}}
                <div class="col-12 col-xl-6">

                    <form
                        action="{{ route('quotations.store') }}"
                        method="POST"
                        id="quotationForm"
                        autocomplete="off"
                    >

                        @csrf

                        {{-- QUOTATION INFORMATION --}}
                        <div class="quotation-section">

                            <div class="quotation-section-header">

                                <h5>
                                    <i class="bi bi-file-earmark-text me-2"></i>
                                    Quotation Information
                                </h5>

                                <p>
                                    Enter the main information for this quotation.
                                </p>

                            </div>

                            <div class="quotation-section-body">

                                <div class="row g-3">

                                    {{-- CLIENT --}}
                                    <div class="col-12 col-md-6">

                                        <label class="form-label">

                                            Client
                                            <span class="text-danger">*</span>

                                        </label>

                                        <select
                                            name="client_id"
                                            id="client_id"
                                            class="form-select @error('client_id') is-invalid @enderror"
                                            required
                                        >

                                            <option value="">
                                                Select Client
                                            </option>

                                            @foreach($clients as $client)

                                                <option
                                                    value="{{ $client->id }}"
                                                    data-name="{{ $client->name ?? '' }}"
                                                    data-email="{{ $client->email ?? '' }}"
                                                    data-phone="{{ $client->phone ?? '' }}"
                                                    data-address="{{ $client->address ?? '' }}"
                                                    data-country="{{ $client->country ?? '' }}"
                                                    @selected(old('client_id') == $client->id)
                                                >
                                                    {{ $client->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                        @error('client_id')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                    {{-- VALID UNTIL --}}
                                    <div class="col-12 col-md-6">

                                        <label class="form-label">

                                            Valid Until
                                            <span class="text-danger">*</span>

                                        </label>

                                        <input
                                            type="date"
                                            name="valid_until"
                                            id="valid_until"
                                            class="form-control @error('valid_until') is-invalid @enderror"
                                            value="{{ old('valid_until', date('Y-m-d')) }}"
                                            required
                                        >

                                        @error('valid_until')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                    {{-- REMARKS --}}
                                    <div class="col-12">

                                        <label class="form-label">
                                            Remarks
                                        </label>

                                        <textarea
                                            name="notes"
                                            id="notes"
                                            class="form-control @error('notes') is-invalid @enderror"
                                            rows="3"
                                            placeholder="Additional information about this quotation..."
                                        >{{ old('notes') }}</textarea>

                                        @error('notes')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- QUOTATION ITEMS --}}
                        <div class="quotation-section">

                            <div class="quotation-section-header">

                                <h5>
                                    <i class="bi bi-box-seam me-2"></i>
                                    Quotation Items
                                </h5>

                                <p>
                                    Add the products or services included in this quotation.
                                </p>

                            </div>

                            <div class="quotation-section-body">

                                <div id="itemsContainer">

                                    @php

                                        $oldItems = old('items', [
                                            [
                                                'description' => '',
                                                'unit' => '',
                                                'quantity' => 1,
                                                'unit_price' => 0,
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

                                                {{-- DESCRIPTION --}}
                                                <div class="col-12 col-md-5">

                                                    <label class="form-label">

                                                        Description
                                                        <span class="text-danger">*</span>

                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="items[{{ $index }}][description]"
                                                        class="form-control"
                                                        value="{{ $item['description'] ?? '' }}"
                                                        placeholder="Example: Cement"
                                                        maxlength="255"
                                                        required
                                                    >

                                                </div>

                                                {{-- U/M --}}
                                                <div class="col-12 col-md-2">

                                                    <label class="form-label">

                                                        U/M
                                                        <span class="text-danger">*</span>

                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="items[{{ $index }}][unit]"
                                                        class="form-control unit-input"
                                                        value="{{ $item['unit'] ?? '' }}"
                                                        placeholder="EA"
                                                        maxlength="50"
                                                        required
                                                    >

                                                </div>

                                                {{-- QUANTITY --}}
                                                <div class="col-12 col-md-2">

                                                    <label class="form-label">

                                                        Quantity
                                                        <span class="text-danger">*</span>

                                                    </label>

                                                    <input
                                                        type="number"
                                                        name="items[{{ $index }}][quantity]"
                                                        class="form-control quantity-input"
                                                        value="{{ $item['quantity'] ?? 1 }}"
                                                        min="0.01"
                                                        step="0.01"
                                                        required
                                                    >

                                                </div>

                                                {{-- UNIT PRICE --}}
                                                <div class="col-12 col-md-3">

                                                    <label class="form-label">

                                                        Unit Price
                                                        <span class="text-danger">*</span>

                                                    </label>

                                                    <input
                                                        type="number"
                                                        name="items[{{ $index }}][unit_price]"
                                                        class="form-control unit-price-input"
                                                        value="{{ $item['unit_price'] ?? 0 }}"
                                                        min="0"
                                                        step="0.01"
                                                        required
                                                    >

                                                </div>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

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

                        {{-- FORM ACTIONS --}}
                        <div
                            class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top"
                        >

                            <a
                                href="{{ route('quotations.index') }}"
                                class="btn btn-secondary"
                            >

                                <i class="bi bi-x-lg me-1"></i>

                                Cancel

                            </a>

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

                                    <i class="bi bi-save me-1"></i>

                                    Create Quotation

                                </span>

                            </button>

                        </div>

                    </form>

                </div>

                {{-- RIGHT : LIVE PREVIEW — 50% --}}
                <div class="col-12 col-xl-6">

                    <div class="preview-wrapper">

                        <div class="preview-header">

                            <i class="bi bi-eye me-2"></i>

                            Quotation Preview

                            <span class="float-end small opacity-75">
                                Live
                            </span>

                        </div>

                        <div class="quotation-preview">

                            <section class="preview-top">

                                <div>

                                    <div class="preview-brand">

                                        <img
                                            src="{{ asset('logo/logo.png') }}"
                                            alt="AMC SARL"
                                            style="width: 90px; height: auto;"
                                        >

                                    </div>

                                    <div class="preview-meta">

                                        RCCM : CD/LSH/RCCM/21-B-00395<br>
                                        Id. Nat: 05-F4300-N77755L<br>
                                        NIF: A2158758R<br>
                                        TVA : 6634/2022<br>
                                        ARSP : 4885676212<br>
                                        Tél. : +243 970 520 222<br>

                                        Email:

                                        <span class="blue">
                                            info@amc-sarl.com
                                        </span>

                                    </div>

                                </div>

                                {{-- CLIENT ADDRESS --}}
                                <div
                                    class="preview-address"
                                    id="previewClientAddress"
                                >

                                    <div id="previewClientName">
                                        [CLIENT]
                                    </div>

                                    <div id="previewClientAddressText">
                                        [ADRESSE]
                                    </div>

                                    <div id="previewClientCountry">
                                        [PAYS]
                                    </div>

                                    <br>

                                    <div id="previewClientPhone">
                                        Tél: [TÉLÉPHONE]
                                    </div>

                                    <div id="previewClientEmail">
                                        Email: [EMAIL]
                                    </div>

                                </div>

                            </section>

                            <div class="preview-rule"></div>

                            <div class="preview-title-row">

                                <div class="preview-title">

                                    QUOTATION :

                                    <span id="previewQuotationNumber">
                                        QT-0001
                                    </span>

                                </div>

                                <div
                                    class="preview-date"
                                    id="previewDate"
                                >
                                    {{ date('d/m/Y') }}
                                </div>

                            </div>

                            <div class="preview-client-row">

                                <div>

                                    Client:

                                    <strong id="previewClient">
                                        [CLIENT]
                                    </strong>

                                </div>

                            </div>

                            <div class="preview-quote-no">

                                QUOTE

                                <span id="previewReference">
                                    QT-0001
                                </span>

                            </div>

                            {{-- PREVIEW ITEMS TABLE --}}
                            <table class="preview-table">

                                <thead>

                                <tr>

                                    <th>
                                        Line<br>N°
                                    </th>

                                    <th>
                                        Item Number / Description
                                    </th>

                                    <th>
                                        Quantity
                                    </th>

                                    <th>
                                        U/M
                                    </th>

                                    <th>
                                        Unit<br>Price
                                    </th>

                                    <th>
                                        Amount
                                    </th>

                                </tr>

                                </thead>

                                <tbody id="previewItems">

                                <tr>

                                    <td>
                                        1
                                    </td>

                                    <td class="preview-empty">
                                        Item description
                                    </td>

                                    <td>
                                        1.00
                                    </td>

                                    <td>
                                        EA
                                    </td>

                                    <td>
                                        $ 0.00
                                    </td>

                                    <td>
                                        $ 0.00
                                    </td>

                                </tr>

                                </tbody>

                            </table>

                            {{-- TOTAL --}}
                            <div class="preview-subtotal">

                                <div class="preview-sub-label">
                                    SUB TOTAL
                                </div>

                                <div class="preview-money">

                                    <div class="preview-money-row">

                                        <div class="label">
                                            $
                                        </div>

                                        <div
                                            class="value"
                                            id="previewSubtotal"
                                        >
                                            0.00
                                        </div>

                                    </div>

                                    <div class="preview-money-row">

                                        <div class="label">
                                            TOTAL
                                        </div>

                                        <div
                                            class="value"
                                            id="previewTotal"
                                        >
                                            $ 0.00
                                        </div>

                                    </div>

                                </div>

                            </div>

                            {{-- LOWER PREVIEW --}}
                            <section class="preview-lower">

                                <div class="preview-terms">

                                    Time delivery:

                                    <span id="previewDelivery">
                                        5-7 days
                                    </span>

                                    <br>

                                    Payment terms:

                                    <br>

                                    30 days from the date of
                                    service delivery.

                                    <br><br>

                                    A/C Number:

                                    <br>

                                    051000513401083019701/Rawbank

                                </div>

                                <div class="preview-signature">

                                    <div>
                                        AMC
                                    </div>

                                    <div
                                        style="margin-top:5px; margin-bottom:30px;"
                                    >
                                        LUSHIKA KAFUKU Patient
                                    </div>

                                    Manager

                                </div>

                            </section>

                            <div class="preview-footer">

                                <b>
                                    Adresse
                                </b>

                                :

                                ADRESSE : Av. Katakokombe Q/Kamanyola,
                                V/Kolwezi, Lualaba/RDC

                            </div>

                            <div class="preview-note">

                                Maquette visuelle uniquement —
                                ne constitue pas une facture ou un
                                document commercial valide.

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const form =
                document.getElementById('quotationForm');

            const itemsContainer =
                document.getElementById('itemsContainer');

            const addItemBtn =
                document.getElementById('addItemBtn');

            const clientInput =
                document.getElementById('client_id');

            const validUntilInput =
                document.getElementById('valid_until');

            const previewClient =
                document.getElementById('previewClient');

            const previewDate =
                document.getElementById('previewDate');

            const previewItems =
                document.getElementById('previewItems');

            const previewSubtotal =
                document.getElementById('previewSubtotal');

            const previewTotal =
                document.getElementById('previewTotal');

            const saveBtn =
                document.getElementById('saveBtn');

            const saveSpinner =
                document.getElementById('saveSpinner');

            const saveText =
                document.getElementById('saveText');

            let itemIndex =
                itemsContainer.querySelectorAll('.item-card').length;


            /* =====================================================
               MONEY
            ====================================================== */

            function money(value) {

                return Number(value || 0).toLocaleString('en-US', {

                    minimumFractionDigits: 2,

                    maximumFractionDigits: 2

                });

            }


            /* =====================================================
               DATE
            ====================================================== */

            function formatDate(dateString) {

                if (!dateString) {
                    return '-';
                }

                const parts =
                    dateString.split('-');

                if (parts.length !== 3) {
                    return dateString;
                }

                return parts[2] +
                    '/' +
                    parts[1] +
                    '/' +
                    parts[0];
            }


            /* =====================================================
               ESCAPE HTML
            ====================================================== */

            function escapeHtml(value) {

                const div =
                    document.createElement('div');

                div.textContent =
                    value;

                return div.innerHTML;
            }


            /* =====================================================
               UPDATE CLIENT PREVIEW
            ====================================================== */

            function updatePreviewInformation() {

                let clientName = '[CLIENT]';

                let clientEmail = '[EMAIL]';

                let clientPhone = '[TÉLÉPHONE]';

                let clientAddress = '[ADRESSE]';

                let clientCountry = '[PAYS]';


                if (
                    clientInput &&
                    clientInput.selectedIndex >= 0
                ) {

                    const selected =
                        clientInput.options[
                            clientInput.selectedIndex
                            ];


                    if (
                        selected &&
                        selected.value
                    ) {

                        clientName =
                            selected.dataset.name ||
                            '[CLIENT]';

                        clientEmail =
                            selected.dataset.email ||
                            '[EMAIL]';

                        clientPhone =
                            selected.dataset.phone ||
                            '[TÉLÉPHONE]';

                        clientAddress =
                            selected.dataset.address ||
                            '[ADRESSE]';

                        clientCountry =
                            selected.dataset.country ||
                            '[PAYS]';

                    }

                }


                previewClient.textContent =
                    clientName;


                document.getElementById(
                    'previewClientName'
                ).textContent =
                    clientName;


                document.getElementById(
                    'previewClientAddressText'
                ).textContent =
                    clientAddress;


                document.getElementById(
                    'previewClientCountry'
                ).textContent =
                    clientCountry;


                document.getElementById(
                    'previewClientPhone'
                ).textContent =
                    'Tél: ' + clientPhone;


                document.getElementById(
                    'previewClientEmail'
                ).textContent =
                    'Email: ' + clientEmail;


                previewDate.textContent =
                    formatDate(
                        validUntilInput.value
                    );

            }


            /* =====================================================
               CALCULATE TOTALS
            ====================================================== */

            function calculateTotals() {

                let subtotal = 0;


                const cards =
                    itemsContainer.querySelectorAll(
                        '.item-card'
                    );


                cards.forEach(function (card) {

                    const quantity =
                        parseFloat(
                            card.querySelector(
                                '.quantity-input'
                            )?.value
                        ) || 0;


                    const unitPrice =
                        parseFloat(
                            card.querySelector(
                                '.unit-price-input'
                            )?.value
                        ) || 0;


                    const amount =
                        quantity * unitPrice;


                    const amountInput =
                        card.querySelector(
                            '.amount-input'
                        );


                    if (amountInput) {

                        amountInput.value =
                            amount.toFixed(2);

                    }


                    subtotal += amount;

                });


                const total =
                    subtotal;


                previewSubtotal.textContent =
                    money(subtotal);


                previewTotal.textContent =
                    '$ ' + money(total);


                updatePreviewItems();

            }


            /* =====================================================
               UPDATE PREVIEW ITEMS
            ====================================================== */

            function updatePreviewItems() {

                previewItems.innerHTML = '';


                const cards =
                    itemsContainer.querySelectorAll(
                        '.item-card'
                    );


                if (cards.length === 0) {

                    previewItems.innerHTML = `

                        <tr>

                            <td
                                colspan="6"
                                class="preview-empty"
                            >
                                No items added
                            </td>

                        </tr>

                    `;

                    return;

                }


                cards.forEach(function (card, index) {

                    const descriptionInput =
                        card.querySelector(
                            'input[name*="[description]"]'
                        );


                    const unitInput =
                        card.querySelector(
                            '.unit-input'
                        );


                    const quantityInput =
                        card.querySelector(
                            '.quantity-input'
                        );


                    const unitPriceInput =
                        card.querySelector(
                            '.unit-price-input'
                        );


                    const description =
                        descriptionInput?.value.trim() ||
                        'Item description';


                    const unit =
                        unitInput?.value.trim() ||
                        'EA';


                    const quantity =
                        parseFloat(
                            quantityInput?.value
                        ) || 0;


                    const unitPrice =
                        parseFloat(
                            unitPriceInput?.value
                        ) || 0;


                    const amount =
                        quantity * unitPrice;


                    const row =
                        document.createElement('tr');


                    row.innerHTML = `

                        <td>
                            ${index + 1}
                        </td>

                        <td>
                            ${escapeHtml(description)}
                        </td>

                        <td>
                            ${quantity.toFixed(2)}
                        </td>

                        <td>
                            ${escapeHtml(unit)}
                        </td>

                        <td>
                            $ ${money(unitPrice)}
                        </td>

                        <td>
                            $ ${money(amount)}
                        </td>

                    `;


                    previewItems.appendChild(row);

                });

            }


            /* =====================================================
               ADD ITEM
            ====================================================== */

            addItemBtn.addEventListener(
                'click',
                function () {

                    const index =
                        itemIndex++;


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


                            <div class="col-12 col-md-5">

                                <label class="form-label">

                                    Description

                                    <span class="text-danger">*</span>

                                </label>


                                <input
                                    type="text"
                                    name="items[${index}][description]"
                                    class="form-control"
                                    placeholder="Example: Cement"
                                    maxlength="255"
                                    required
                                >

                            </div>


                            <div class="col-12 col-md-2">

                                <label class="form-label">

                                    U/M

                                    <span class="text-danger">*</span>

                                </label>


                                <input
                                    type="text"
                                    name="items[${index}][unit]"
                                    class="form-control unit-input"
                                    placeholder="EA"
                                    maxlength="50"
                                    required
                                >

                            </div>


                            <div class="col-12 col-md-2">

                                <label class="form-label">

                                    Quantity

                                    <span class="text-danger">*</span>

                                </label>


                                <input
                                    type="number"
                                    name="items[${index}][quantity]"
                                    class="form-control quantity-input"
                                    value="1"
                                    min="0.01"
                                    step="0.01"
                                    required
                                >

                            </div>


                            <div class="col-12 col-md-3">

                                <label class="form-label">

                                    Unit Price

                                    <span class="text-danger">*</span>

                                </label>


                                <input
                                    type="number"
                                    name="items[${index}][unit_price]"
                                    class="form-control unit-price-input"
                                    value="0"
                                    min="0"
                                    step="0.01"
                                    required
                                >

                            </div>


                        </div>

                    `;


                    itemsContainer.appendChild(
                        itemCard
                    );


                    updateItemNumbers();

                    updateRemoveButtons();

                    reindexItems();

                    calculateTotals();


                    const descriptionInput =
                        itemCard.querySelector(
                            'input[name*="[description]"]'
                        );


                    if (descriptionInput) {

                        descriptionInput.focus();

                    }

                }
            );


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
                        button.closest(
                            '.item-card'
                        );


                    if (!itemCard) {
                        return;
                    }


                    const itemCards =
                        itemsContainer.querySelectorAll(
                            '.item-card'
                        );


                    if (itemCards.length <= 1) {
                        return;
                    }


                    itemCard.remove();


                    updateItemNumbers();

                    updateRemoveButtons();

                    reindexItems();

                    calculateTotals();

                }
            );


            /* =====================================================
               INPUT EVENTS
            ====================================================== */

            itemsContainer.addEventListener(
                'input',
                function (event) {

                    if (

                        event.target.classList.contains(
                            'quantity-input'
                        ) ||

                        event.target.classList.contains(
                            'unit-price-input'
                        ) ||

                        event.target.classList.contains(
                            'unit-input'
                        ) ||

                        event.target.name?.includes(
                            '[description]'
                        )

                    ) {

                        calculateTotals();

                    }

                }
            );


            /* =====================================================
               CLIENT CHANGE
            ====================================================== */

            clientInput.addEventListener(
                'change',
                function () {

                    updatePreviewInformation();

                }
            );


            /* =====================================================
               DATE CHANGE
            ====================================================== */

            validUntilInput.addEventListener(
                'input',
                function () {

                    updatePreviewInformation();

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


                cards.forEach(
                    function (card, index) {

                        const number =
                            card.querySelector(
                                '.item-number-value'
                            );


                        if (number) {

                            number.textContent =
                                index + 1;

                        }

                    }
                );

            }


            /* =====================================================
               REINDEX ITEMS
            ====================================================== */

            function reindexItems() {

                const cards =
                    itemsContainer.querySelectorAll(
                        '.item-card'
                    );


                cards.forEach(
                    function (card, index) {

                        card.dataset.itemIndex =
                            index;


                        const descriptionInput =
                            card.querySelector(
                                'input[name*="[description]"]'
                            );


                        const unitInput =
                            card.querySelector(
                                'input[name*="[unit]"]'
                            );


                        const quantityInput =
                            card.querySelector(
                                'input[name*="[quantity]"]'
                            );


                        const unitPriceInput =
                            card.querySelector(
                                'input[name*="[unit_price]"]'
                            );


                        if (descriptionInput) {

                            descriptionInput.name =
                                `items[${index}][description]`;

                        }


                        if (unitInput) {

                            unitInput.name =
                                `items[${index}][unit]`;

                        }


                        if (quantityInput) {

                            quantityInput.name =
                                `items[${index}][quantity]`;

                        }


                        if (unitPriceInput) {

                            unitPriceInput.name =
                                `items[${index}][unit_price]`;

                        }

                    }
                );

            }


            /* =====================================================
               REMOVE BUTTONS
            ====================================================== */

            function updateRemoveButtons() {

                const cards =
                    itemsContainer.querySelectorAll(
                        '.item-card'
                    );


                cards.forEach(
                    function (card) {

                        const button =
                            card.querySelector(
                                '.remove-item-btn'
                            );


                        if (!button) {
                            return;
                        }


                        button.disabled =
                            cards.length === 1;

                    }
                );

            }


            /* =====================================================
               FORM SUBMIT
            ====================================================== */

            form.addEventListener(
                'submit',
                function (event) {

                    if (!form.checkValidity()) {

                        event.preventDefault();


                        const invalidField =
                            form.querySelector(
                                ':invalid'
                            );


                        if (invalidField) {

                            invalidField.focus();

                            invalidField.reportValidity();

                        }


                        return;

                    }


                    const itemCards =
                        itemsContainer.querySelectorAll(
                            '.item-card'
                        );


                    if (itemCards.length === 0) {

                        event.preventDefault();


                        alert(
                            'Please add at least one item to the quotation.'
                        );


                        return;

                    }


                    reindexItems();


                    saveBtn.disabled =
                        true;


                    saveSpinner.classList.remove(
                        'd-none'
                    );


                    saveText.innerHTML =
                        'Creating...';

                }
            );


            /* =====================================================
               INITIALIZATION
            ====================================================== */

            updateItemNumbers();

            updateRemoveButtons();

            reindexItems();

            updatePreviewInformation();

            calculateTotals();

        });

    </script>

@endsection
