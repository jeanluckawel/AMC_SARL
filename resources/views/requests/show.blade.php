@extends('layouts.admin')

@section('title', 'Request')

@section('content')

    <style>

        /* =========================================================
           A4 DOCUMENT
        ========================================================== */

        body {
            background: #f1f3f5;
        }

        .request-wrapper {
            position: relative;
            width: fit-content;
            margin: 0 auto;
        }

        .request-page {
            width: 210mm;
            min-height: 297mm;
            margin: 15px auto;
            background: #fff;
            padding: 10mm 11mm;
            box-sizing: border-box;
            box-shadow: 0 3px 18px rgba(0, 0, 0, .12);
        }

        /* =========================================================
           DOWNLOAD ACTION
        ========================================================== */

        .request-actions {
            position: absolute;
            top: 25px;
            right: 15px;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all .2s ease;
        }

        .request-wrapper:hover .request-actions {
            opacity: 1;
            visibility: visible;
        }

        .request-download-btn {
            border: 0;
            background: #4f8136;
            color: #fff;
            padding: 8px 13px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
        }

        .request-download-btn:hover {
            background: #3f692b;
            color: #fff;
        }

        /* =========================================================
           DOCUMENT
        ========================================================== */

        .request-preview {
            width: 100%;
            background: #fff;
            font-family: Arial, Helvetica, sans-serif;
            color: #111;
            font-size: 12px;
        }

        /* =========================================================
           TOP
        ========================================================== */

        .request-top {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            min-height: 135px;
        }

        .request-brand {
            font-size: 32px;
            font-weight: 800;
            font-style: italic;
            color: #555;
            letter-spacing: -2px;
        }

        .request-meta {
            margin-top: 10px;
            font-size: 10px;
            line-height: 1.6;
        }

        .request-meta .blue {
            color: #0879c9;
        }

        .request-information {
            font-size: 11px;
            line-height: 1.7;
            text-align: justify;
            text-justify: inter-word;
        }

        .request-information strong {
            font-weight: 800;
        }

        /* =========================================================
           ORANGE RULE
        ========================================================== */

        .request-rule {
            height: 2px;
            background: #f47721;
            margin: 8px 12px 14px;
        }

        /* =========================================================
           TITLE
        ========================================================== */

        .request-title-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            border: 1px solid #222;
            min-height: 45px;
        }

        .request-title {
            background: #4f8136;
            color: #000;
            font-size: 17px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .request-date {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            text-align: center;
        }

        /* =========================================================
           REQUEST REFERENCE
        ========================================================== */

        .request-reference-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            font-size: 11px;
        }

        .request-reference {
            font-weight: 700;
        }

        .request-type {
            font-weight: 700;
            text-align: right;
        }

        /* =========================================================
           ITEMS TABLE
        ========================================================== */

        .request-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 9px;
            font-size: 10px;
        }

        .request-table th,
        .request-table td {
            border: 1px solid #222;
            padding: 8px 5px;
            vertical-align: middle;
        }

        .request-table th {
            background: #d9d9d9;
            text-align: center;
            font-weight: 800;
            font-size: 10px;
        }

        .request-table th:nth-child(1) {
            width: 7%;
        }

        .request-table th:nth-child(2) {
            width: 38%;
        }

        .request-table th:nth-child(3) {
            width: 11%;
        }

        .request-table th:nth-child(4) {
            width: 10%;
        }

        .request-table th:nth-child(5) {
            width: 17%;
        }

        .request-table th:nth-child(6) {
            width: 17%;
        }

        .request-table td {
            text-align: center;
        }

        .request-table td:nth-child(2) {
            text-align: left;
            word-break: break-word;
        }

        .request-table td:nth-child(5),
        .request-table td:nth-child(6) {
            text-align: right;
        }

        .request-empty {
            text-align: center !important;
            color: #777;
            padding: 20px !important;
        }

        /* =========================================================
           TOTALS
        ========================================================== */

        .request-total-section {
            margin-top: 18px;
            display: grid;
            grid-template-columns: 1fr 190px;
            align-items: stretch;
        }

        .request-total-label {
            background: #d9d9d9;
            border: 1px solid #222;
            border-right: 0;
            font-weight: 800;
            text-align: center;
            padding: 8px;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .request-money {
            border: 1px solid #222;
            font-size: 10px;
        }

        .request-money-row {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
        }

        .request-money-row > div {
            border-bottom: 1px solid #222;
            padding: 7px;
        }

        .request-money-row:last-child > div {
            border-bottom: 0;
        }

        .request-money-row .label {
            font-weight: 800;
            text-align: center;
        }

        .request-money-row .value {
            text-align: right;
            font-weight: 800;
            padding-right: 8px;
        }

        /* =========================================================
           APPROVAL SECTION
        ========================================================== */

        .request-approval-title {
            margin-top: 28px;
            border: 1px solid #222;
            background: #d9d9d9;
            padding: 8px;
            text-align: center;
            font-size: 12px;
            font-weight: 800;
        }

        .request-approval {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
            margin-top: 10px;
        }

        .request-approval-box {
            border: 1px solid #222;
            min-height: 85px;
            text-align: center;
        }

        .request-approval-header {
            background: #d9d9d9;
            border-bottom: 1px solid #222;
            padding: 7px;
            font-size: 10px;
            font-weight: 800;
        }

        .request-approval-body {
            padding: 12px 5px;
            font-size: 10px;
            font-weight: 700;
        }

        .request-approved {
            color: #4f8136;
        }

        .request-rejected {
            color: #8b0000;
        }

        .request-pending {
            color: #555;
        }

        /* =========================================================
           LOWER SECTION
        ========================================================== */

        .request-lower {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 28px;
        }

        .request-terms {
            text-align: center;
            font-size: 10px;
            font-weight: 700;
            line-height: 1.8;
            padding-top: 3px;
        }

        .request-signature {
            text-align: center;
            font-size: 11px;
            font-weight: 700;
        }

        /* =========================================================
           FOOTER
        ========================================================== */

        .request-footer {
            margin-top: 120px;
            border-top: 1px solid #f47721;
            padding-top: 8px;
            font-size: 9px;
            line-height: 1.5;
            text-align: center;
        }

        .request-footer b {
            display: inline;
            width: auto;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 900px) {

            body {
                background: #fff;
            }

            .request-wrapper {
                width: 100%;
            }

            .request-page {
                width: 100%;
                min-height: auto;
                margin: 0;
                padding: 20px;
                box-shadow: none;
            }
        }

        @media (max-width: 768px) {

            .request-page {
                padding: 15px;
            }

            .request-top {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .request-information {
                text-align: justify;
            }

            .request-title {
                font-size: 14px;
            }

            .request-table {
                font-size: 8px;
            }

            .request-table th,
            .request-table td {
                padding: 5px 3px;
            }

            .request-total-section {
                grid-template-columns: 1fr;
            }

            .request-total-label {
                border-right: 1px solid #222;
                border-bottom: 0;
            }

            .request-approval {
                grid-template-columns: 1fr;
            }

            .request-lower {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        /* =========================================================
           PRINT A4
        ========================================================== */

        @media print {

            @page {
                size: A4;
                margin: 0;
            }

            html,
            body {
                width: 210mm;
                min-height: 297mm;
                margin: 0 !important;
                padding: 0 !important;
                background: #fff !important;
            }

            .request-actions {
                display: none !important;
            }

            .request-wrapper {
                width: 210mm;
                margin: 0;
            }

            .request-page {
                width: 210mm;
                min-height: 297mm;
                margin: 0;
                padding: 10mm 11mm;
                box-shadow: none;
            }

            .request-preview {
                width: 100%;
            }
        }

    </style>


    {{-- =========================================================
         REQUEST WRAPPER
    ========================================================== --}}

    <div class="request-wrapper">

        {{-- =====================================================
             DOWNLOAD BUTTON
        ====================================================== --}}

        <div class="request-actions">

            <button
                type="button"
                class="request-download-btn"
                onclick="downloadRequest()"
                title="Download"
            >
                <i class="bi bi-download"></i>
            </button>

        </div>


        <div class="request-page">

            <div class="request-preview">

                {{-- =================================================
                     COMPANY + REQUEST INFORMATION
                ================================================== --}}

                <section class="request-top">

                    {{-- COMPANY --}}
                    <div>

                        <div class="request-brand">

                            <img
                                src="{{ asset('logo/logo.png') }}"
                                alt="AMC SARL"
                                style="width: 120px; height: auto;"
                            >

                        </div>

                        <div class="request-meta">

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


                    {{-- REQUEST INFORMATION --}}
                    <div class="request-information">

                        <div>
                            <strong>REQUEST INFORMATION</strong>
                        </div>

                        <br>

                        <div>
                            Reference:
                            <strong>
                                {{ $requestModel->reference ?? '-' }}
                            </strong>
                        </div>

                        <div>
                            Date:
                            <strong>
                                {{ $requestModel->created_at?->format('d/m/Y') ?? '-' }}
                            </strong>
                        </div>

                        <div>
                            Requester:
                            <strong>
                                {{   $requestModel->requester?->name?? '-' }}
                            </strong>
                        </div>

                        <div>
                            Department:
                            <strong>
                                {{ $requestModel->requester?->employee?->department->name ?? '-' }}
                            </strong>
                        </div>

                    </div>

                </section>


                {{-- =================================================
                     ORANGE LINE
                ================================================== --}}

                <div class="request-rule"></div>


                {{-- =================================================
                     REQUEST TITLE
                ================================================== --}}

                <div class="request-title-row">

                    <div class="request-title">

                        PURCHASE REQUEST :

                        <span style="margin-left: 7px;">
                            {{ $requestModel->reference ?? '-' }}
                        </span>

                    </div>

                    <div class="request-date">

                      Kolwezi le,  {{ $requestModel->created_at?->format('d/m/Y') ?? '-' }}

                    </div>

                </div>


                {{-- =================================================
                     REQUEST REFERENCE
                ================================================== --}}

                <div class="request-reference-row">

                    <div class="request-reference">

                        Request Reference:

                        <span>
                            {{ $requestModel->reference ?? '-' }}
                        </span>

                    </div>

                    <div class="request-type">

                        PURCHASE REQUEST

                    </div>

                </div>


                {{-- =================================================
                     ITEMS
                ================================================== --}}

                <table class="request-table">

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

                    <tbody>

                    @forelse($requestModel->items as $index => $item)

                        <tr>

                            <td>
                                {{ $index + 1 }}
                            </td>

                            <td>
                                {{ $item->name ?? '-' }}
                            </td>

                            <td>
                                {{ number_format((float) ($item->quantity ?? 0), 2) }}
                            </td>

                            <td>
                                {{ $item->unit ?? '-' }}
                            </td>

                            <td>
                                $ {{ number_format((float) ($item->unit_price ?? 0), 2) }}
                            </td>

                            <td>
                                $ {{ number_format((float) ($item->total_price ?? 0), 2) }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="request-empty">
                                No items available
                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>


                {{-- =================================================
                     TOTALS
                ================================================== --}}

                @php

                    $subtotal = (float) ($requestModel->total_amount ?? 0);

                    $vat = ($subtotal * 16) / 100;

                    $grandTotal = $subtotal + $vat;

                @endphp


                <div class="request-total-section">

                    <div class="request-total-label">
                        TOTALS
                    </div>

                    <div class="request-money">

                        {{-- SUB TOTAL --}}
                        <div class="request-money-row">

                            <div class="label">
                                SUB TOTAL
                            </div>

                            <div class="value">
                                $ {{ number_format($subtotal, 2) }}
                            </div>

                        </div>


                        {{-- VAT --}}
                        <div class="request-money-row">

                            <div class="label">
                                VAT 16%
                            </div>

                            <div class="value">
                                $ {{ number_format($vat, 2) }}
                            </div>

                        </div>


                        {{-- TOTAL --}}
                        <div class="request-money-row">

                            <div class="label">
                                TOTAL
                            </div>

                            <div class="value">
                                $ {{ number_format($grandTotal, 2) }}
                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     APPROVAL WORKFLOW
                ================================================== --}}

                <div class="request-approval-title">

                    APPROVAL WORKFLOW

                </div>


                @php

                    $procurementStep = $requestModel->steps
                        ->firstWhere('step.value', 'procurement');

                    $financeStep = $requestModel->steps
                        ->firstWhere('step.value', 'finance');

                    $ceoStep = $requestModel->steps
                        ->firstWhere('step.value', 'ceo');

                @endphp


                <section class="request-approval">

                    {{-- PROCUREMENT --}}
                    <div class="request-approval-box">

                        <div class="request-approval-header">
                            PROCUREMENT
                        </div>

                        <div class="request-approval-body">

                            @if($procurementStep)

                                @if($procurementStep->decision?->value === 'approved')

                                    <span class="request-approved">
                                        APPROVED
                                    </span>

                                @elseif($procurementStep->decision?->value === 'rejected')

                                    <span class="request-rejected">
                                        REJECTED
                                    </span>

                                @else

                                    <span class="request-pending">
                                        {{ strtoupper($procurementStep->decision?->value ?? 'PENDING') }}
                                    </span>

                                @endif

                            @else

                                <span class="request-pending">
                                    PENDING
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- FINANCE --}}
                    <div class="request-approval-box">

                        <div class="request-approval-header">
                            FINANCE
                        </div>

                        <div class="request-approval-body">

                            @if($financeStep)

                                @if($financeStep->decision?->value === 'approved')

                                    <span class="request-approved">
                                        APPROVED
                                    </span>

                                @elseif($financeStep->decision?->value === 'rejected')

                                    <span class="request-rejected">
                                        REJECTED
                                    </span>

                                @else

                                    <span class="request-pending">
                                        {{ strtoupper($financeStep->decision?->value ?? 'PENDING') }}
                                    </span>

                                @endif

                            @else

                                <span class="request-pending">
                                    PENDING
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- CEO --}}
                    <div class="request-approval-box">

                        <div class="request-approval-header">
                            DG
                        </div>

                        <div class="request-approval-body">

                            @if($ceoStep)

                                @if($ceoStep->decision?->value === 'approved')

                                    <span class="request-approved">
                                        APPROVED
                                    </span>

                                @elseif($ceoStep->decision?->value === 'rejected')

                                    <span class="request-rejected">
                                        REJECTED
                                    </span>

                                @else

                                    <span class="request-pending">
                                        {{ strtoupper($ceoStep->decision?->value ?? 'PENDING') }}
                                    </span>

                                @endif

                            @else

                                <span class="request-pending">
                                    PENDING
                                </span>

                            @endif

                        </div>

                    </div>

                </section>


                {{-- =================================================
                     TERMS + SIGNATURE
                ================================================== --}}

                <section class="request-lower">

                    {{-- TERMS --}}
                    <div class="request-terms">

                        Request type:

                        <span>
                            Internal Purchase Request
                        </span>

                        <br>

                        Approval required before procurement.

                        <br><br>

                        Currency:

                        <span>
                            USD
                        </span>

                    </div>


                    {{-- SIGNATURE --}}
                    <div class="request-signature">

                        <div>
                            AMC
                        </div>

                        <div style="margin-top:5px; margin-bottom:35px;">
                            LUSHIKA KAFUKU Patient
                        </div>

                        <br><br>

                        Manager

                    </div>

                </section>


                {{-- =================================================
                     ADDRESS - VERY BOTTOM
                ================================================== --}}

                <div class="request-footer">

                    <b>Adresse</b> :

                    ADRESSE : Av. Katakokombe Q/Kamanyola,
                    V/Kolwezi, Lualaba/RDC

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         HTML2PDF
    ========================================================== --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>

        function downloadRequest() {

            const element = document.querySelector('.request-page');

            const requestReference = @json(
                $requestModel->reference ?? 'Request'
            );

            const safeReference = requestReference
                .toString()
                .replace(/[^a-zA-Z0-9_-]/g, '-');

            const options = {

                margin: 0,

                filename: 'Request-' + safeReference + '.pdf',

                image: {
                    type: 'jpeg',
                    quality: 0.98
                },

                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    backgroundColor: '#ffffff'
                },

                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }

            };

            html2pdf()
                .set(options)
                .from(element)
                .save();

        }

    </script>

@endsection
