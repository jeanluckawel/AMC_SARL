@extends('layouts.admin')

@section('title', 'Quotation')

@section('content')


    <style>

        /* =========================================================
           BODY
        ========================================================== */

        body {
            background: #f1f3f5;
        }

        /* =========================================================
           DOCUMENT WRAPPER
        ========================================================== */

        .quotation-wrapper {
            position: relative;
            width: fit-content;
            margin: 15px auto;
        }

        /* =========================================================
           DOWNLOAD BUTTON
        ========================================================== */

        .quotation-actions {
            position: absolute;
            top: 12px;
            right: 12px;

            z-index: 100;

            opacity: 0;
            visibility: hidden;

            transform: translateY(-5px);

            transition:
                opacity .2s ease,
                visibility .2s ease,
                transform .2s ease;
        }

        .quotation-wrapper:hover .quotation-actions {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .quotation-action-btn {
            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 0;
            border-radius: 4px;

            background: #198754;

            color: #fff;

            cursor: pointer;

            box-shadow: 0 2px 7px rgba(0, 0, 0, .18);

            transition:
                transform .15s ease,
                opacity .15s ease;
        }

        .quotation-action-btn:hover {
            transform: translateY(-1px);
            opacity: .9;
        }

        .quotation-action-btn i {
            font-size: 15px;
        }

        /* =========================================================
           A4 DOCUMENT
        ========================================================== */

        .quotation-page {
            width: 210mm;
            min-height: 297mm;

            margin: 0;

            background: #fff;

            padding: 10mm 11mm;

            box-sizing: border-box;

            box-shadow: 0 3px 18px rgba(0, 0, 0, .12);
        }

        /* =========================================================
           DOCUMENT
        ========================================================== */

        .quotation-preview {
            width: 100%;

            background: #fff;

            font-family: Arial, Helvetica, sans-serif;

            color: #111;

            font-size: 12px;
        }

        /* =========================================================
           TOP
        ========================================================== */

        .preview-top {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 25px;

            min-height: 135px;
        }

        .preview-brand {
            font-size: 32px;

            font-weight: 800;

            font-style: italic;

            color: #555;

            letter-spacing: -2px;
        }

        .preview-meta {
            margin-top: 10px;

            font-size: 10px;

            line-height: 1.6;
        }

        .preview-meta .blue {
            color: #0879c9;
        }

        .preview-address {
            font-size: 11px;

            line-height: 1.6;

            text-align: justify;

            text-justify: inter-word;
        }

        /* =========================================================
           ORANGE RULE
        ========================================================== */

        .preview-rule {
            height: 2px;

            background: #f47721;

            margin: 8px 12px 14px;
        }

        /* =========================================================
           TITLE
        ========================================================== */

        .preview-title-row {
            display: grid;

            grid-template-columns: 2fr 1fr;

            border: 1px solid #222;

            min-height: 45px;
        }

        .preview-title {
            background: #4f8136;

            color: #000;

            font-size: 17px;

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

            font-size: 11px;

            text-align: center;
        }

        /* =========================================================
           CLIENT
        ========================================================== */

        .preview-client-row {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-top: 9px;

            font-size: 11px;
        }

        .preview-quote-no {
            font-weight: 700;

            margin-top: 7px;

            text-align: right;

            font-size: 11px;
        }

        /* =========================================================
           TABLE
        ========================================================== */

        .preview-table {
            width: 100%;

            border-collapse: collapse;

            table-layout: fixed;

            margin-top: 8px;

            font-size: 10px;
        }

        .preview-table th,
        .preview-table td {
            border: 1px solid #222;

            padding: 8px 5px;

            vertical-align: middle;
        }

        .preview-table th {
            background: #d9d9d9;

            text-align: center;

            font-weight: 800;

            font-size: 10px;
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

            padding: 20px !important;
        }

        /* =========================================================
           TOTALS
        ========================================================== */

        .preview-subtotal {
            margin-top: 18px;

            display: grid;

            grid-template-columns: 1fr 190px;

            align-items: stretch;
        }

        .preview-sub-label {
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

        .preview-money {
            border: 1px solid #222;

            font-size: 10px;
        }

        .preview-money-row {
            display: grid;

            grid-template-columns: 1fr 1.5fr;
        }

        .preview-money-row > div {
            border-bottom: 1px solid #222;

            padding: 7px;
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

            padding-right: 8px;
        }

        /* =========================================================
           LOWER SECTION
        ========================================================== */

        .preview-lower {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 40px;

            margin-top: 28px;
        }

        .preview-terms {
            text-align: center;

            font-size: 10px;

            font-weight: 700;

            line-height: 1.8;

            padding-top: 3px;
        }

        .preview-signature {
            text-align: center;

            font-size: 11px;

            font-weight: 700;
        }

        /* =========================================================
           ADDRESS AT VERY BOTTOM
        ========================================================== */

        .preview-footer {
            margin-top: 180px;

            border-top: 1px solid #f47721;

            padding-top: 8px;

            font-size: 9px;

            line-height: 1.5;

            text-align: center;
        }

        .preview-footer b {
            display: inline;

            width: auto;
        }

        /* =========================================================
           NOTE
        ========================================================== */

        .preview-note {
            margin-top: 10px;

            border-top: 1px solid #f47721;

            padding-top: 8px;

            text-align: center;

            color: #8b0000;

            font-size: 8px;

            font-weight: 700;

            line-height: 1.5;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 900px) {

            body {
                background: #fff;
            }

            .quotation-wrapper {
                width: 100%;

                margin: 0;
            }

            .quotation-page {
                width: 100%;

                min-height: auto;

                padding: 20px;

                box-shadow: none;
            }
        }

        @media (max-width: 768px) {

            .quotation-page {
                padding: 15px;
            }

            .preview-top {
                grid-template-columns: 1fr;

                gap: 15px;
            }

            .preview-address {
                text-align: justify;
            }

            .preview-title {
                font-size: 14px;
            }

            .preview-table {
                font-size: 8px;
            }

            .preview-table th,
            .preview-table td {
                padding: 5px 3px;
            }

            .preview-subtotal {
                grid-template-columns: 1fr;
            }

            .preview-sub-label {
                border-right: 1px solid #222;

                border-bottom: 0;
            }

            .preview-lower {
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

            .quotation-wrapper {
                width: 210mm;

                margin: 0;
            }

            .quotation-actions {
                display: none !important;
            }

            .quotation-page {
                width: 210mm;

                min-height: 297mm;

                margin: 0;

                padding: 10mm 11mm;

                box-shadow: none;
            }

            .quotation-preview {
                width: 100%;
            }
        }

    </style>


    {{-- =========================================================
         QUOTATION WRAPPER
    ========================================================== --}}

    <div class="quotation-wrapper">

        {{-- =====================================================
             DOWNLOAD ACTION
        ====================================================== --}}

        <div class="quotation-actions">

            <button
                type="button"
                class="quotation-action-btn"
                id="downloadQuotation"
                title="Download quotation"
                aria-label="Download quotation"
            >

                <i class="bi bi-download"></i>

            </button>

        </div>


        {{-- =====================================================
             A4 DOCUMENT
        ====================================================== --}}

        <div
            class="quotation-page"
            id="quotationDocument"
        >

            <div class="quotation-preview">

                {{-- =================================================
                     COMPANY + CLIENT
                ================================================== --}}

                <section class="preview-top">

                    {{-- COMPANY --}}
                    <div>

                        <div class="preview-brand">

                            <img
                                src="{{ asset('logo/logo.png') }}"
                                alt="AMC SARL"
                                style="width: 120px; height: auto;"
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


                    {{-- CLIENT --}}
                    <div class="preview-address">

                        <div>
                            {{ $quotation->client?->name ?? '[CLIENT]' }}
                        </div>

                        <div>
                            {{ $quotation->client?->address ?? '[ADRESSE]' }}
                        </div>

                        <div>
                            {{ $quotation->client?->country ?? '[PAYS]' }}
                        </div>

                        <br>

                        <div>
                            Tél:
                            {{ $quotation->client?->phone ?? '[TÉLÉPHONE]' }}
                        </div>

                        <div>
                            Email:
                            {{ $quotation->client?->email ?? '[EMAIL]' }}
                        </div>

                    </div>

                </section>


                {{-- =================================================
                     ORANGE LINE
                ================================================== --}}

                <div class="preview-rule"></div>


                {{-- =================================================
                     QUOTATION TITLE
                ================================================== --}}

                <div class="preview-title-row">

                    <div class="preview-title">

                        QUOTATION :

                        <span style="margin-left: 7px;">
                        {{ $quotation->quotario_number }}
                    </span>

                    </div>

                    <div class="preview-date">

                        {{ $quotation->created_at?->format('d/m/Y') }}

                    </div>

                </div>


                {{-- =================================================
                     CLIENT
                ================================================== --}}

                <div class="preview-client-row">

                    <div>

                        Client:

                        <strong>
                            {{ $quotation->client?->name ?? '[CLIENT]' }}
                        </strong>

                    </div>

                </div>


                {{-- =================================================
                     QUOTE NUMBER
                ================================================== --}}

                <div class="preview-quote-no">

                    QUOTE

                    <span>
                    {{ $quotation->quotario_number }}
                </span>

                </div>


                {{-- =================================================
                     ITEMS
                ================================================== --}}

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

                    <tbody>

                    @forelse($quotation->items as $index => $item)

                        <tr>

                            <td>
                                {{ $index + 1 }}
                            </td>

                            <td>
                                {{ $item->description }}
                            </td>

                            <td>
                                {{ number_format((float) $item->quantity, 2) }}
                            </td>

                            <td>
                                {{ $item->unit }}
                            </td>

                            <td>
                                $ {{ number_format((float) $item->unit_price, 2) }}
                            </td>

                            <td>
                                $ {{ number_format((float) $item->amount, 2) }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="preview-empty"
                            >
                                No items available
                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>


                {{-- =================================================
                     SUB TOTAL / TAX / TOTAL
                ================================================== --}}

                <div class="preview-subtotal">

                    <div class="preview-sub-label">
                        TOTALS
                    </div>

                    <div class="preview-money">

                        {{-- SUB TOTAL --}}
                        <div class="preview-money-row">

                            <div class="label">
                                SUB TOTAL
                            </div>

                            <div class="value">
                                $
                                {{ number_format((float) $quotation->subtotal, 2) }}
                            </div>

                        </div>


                        {{-- TAX 16% --}}
                        <div class="preview-money-row">

                            <div class="label">
                                TAX 16%
                            </div>

                            <div class="value">
                                $
                                {{ number_format((float) $quotation->tax, 2) }}
                            </div>

                        </div>


                        {{-- TOTAL --}}
                        <div class="preview-money-row">

                            <div class="label">
                                TOTAL
                            </div>

                            <div class="value">
                                $
                                {{ number_format((float) $quotation->total_amount, 2) }}
                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     TERMS + SIGNATURE
                ================================================== --}}

                <section class="preview-lower">

                    {{-- TERMS --}}
                    <div class="preview-terms">

                        Time delivery:

                        <span>
                        5-7 days
                    </span>

                        <br>

                        Payment terms:

                        <br>

                        30 days from the date of service delivery.

                        <br><br>

                        A/C Number:

                        <br>

                        051000513401083019701/Rawbank

                    </div>


                    {{-- SIGNATURE --}}
                    <div class="preview-signature">

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

                <div class="preview-footer">

                    <b>Adresse</b> :

                    ADRESSE : Av. Katakokombe Q/Kamanyola,
                    V/Kolwezi, Lualaba/RDC

                </div>


                {{-- =================================================
                     NOTE
                ================================================== --}}

                @if($quotation->notes)

                    <div class="preview-note">

                        {{ $quotation->notes }}

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================================================
         HTML2PDF.JS
    ========================================================== --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const downloadButton =
                document.getElementById('downloadQuotation');

            const quotationDocument =
                document.getElementById('quotationDocument');


            /* =====================================================
               DOWNLOAD PDF
            ====================================================== */

            downloadButton.addEventListener('click', function () {

                const quotationNumber =
                    @json($quotation->quotario_number);

                const fileName =
                    'Quotation-' + quotationNumber + '.pdf';


                const options = {

                    margin: 0,

                    filename: fileName,

                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },

                    html2canvas: {

                        scale: 2,

                        useCORS: true,

                        logging: false,

                        backgroundColor: '#ffffff'

                    },

                    jsPDF: {

                        unit: 'mm',

                        format: 'a4',

                        orientation: 'portrait'

                    },

                    pagebreak: {

                        mode: [
                            'avoid-all',
                            'css',
                            'legacy'
                        ]

                    }

                };


                html2pdf()
                    .set(options)
                    .from(quotationDocument)
                    .save();

            });

        });

    </script>


@endsection
