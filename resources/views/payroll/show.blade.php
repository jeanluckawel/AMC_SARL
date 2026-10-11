@extends('layouts.admin')

@section('title', 'AMC SARL | Bulletin de Paie')

@section('content')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .fiche-wrapper {
            display: flex;
            justify-content: center;
            padding: 20px;
            background: #f5f6f8;
            min-height: 100vh;
        }

        .fiche-container {
            position: relative;
            width: 100%;
            max-width: 21cm;
        }

        .fiche {
            width: 100%;
            min-height: 297mm;
            padding: 15mm;
            background: #fff;
            color: #000;
            font-size: 11px;
            box-sizing: border-box;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .12);
        }

        .fiche-download {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
            opacity: 0;
            visibility: hidden;
            transition: .2s;
        }

        .fiche-container:hover .fiche-download {
            opacity: 1;
            visibility: visible;
        }

        .fiche-download-btn {
            background: #343a40;
            color: #fff;
            border: 0;
            border-radius: 4px;
            padding: 9px 14px;
            cursor: pointer;
        }

        .fiche-download-btn:hover {
            background: #212529;
        }

        .fiche-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .header-company {
            flex: 1;
        }

        .header-title {
            flex: 2;
            text-align: center;
        }

        .header-logo {
            width: 90px;
            height: 90px;
            flex-shrink: 0;
        }

        .header-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .employee-info {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
            margin-bottom: 25px;
        }

        .employee-info-column {
            min-width: 0;
        }

        .employee-info-title {
            font-size: 12px;
            font-weight: bold;
            border-bottom: 1.5px solid #000;
            padding-bottom: 7px;
            margin-bottom: 7px;
        }

        .employee-info-item {
            display: grid;
            grid-template-columns: 105px minmax(0, 1fr);
            gap: 5px;
            padding: 6px 0;
            border-bottom: 1px solid #ddd;
            break-inside: avoid;
        }

        .employee-info-label {
            font-weight: bold;
            color: #333;
        }

        .employee-info-value {
            overflow-wrap: anywhere;
        }

        .salary-section {
            margin: 25px 0;
        }

        .salary-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .salary-table th,
        .salary-table td {
            border: 1px solid #000;
            padding: 8px;
        }

        .salary-table thead th {
            background: #e9ecef;
            font-weight: bold;
        }

        .salary-table .total-row {
            background: #e9ecef;
            font-weight: bold;
        }

        /* RÉSUMÉ SUR UNE SEULE LIGNE */
        .salary-summary {
            border: 1px solid #bfc3c7;
            margin: 20px 0;
            background: #fff;
            break-inside: avoid;
        }

        .salary-summary-title {
            font-size: 12px;
            font-weight: bold;
            margin: 0;
            padding: 10px 12px;
            background: #e9ecef;
            color: #000;
            border-bottom: 1px solid #bfc3c7;
        }

        .salary-summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .salary-summary-item {
            min-width: 0;
            padding: 12px 8px;
            text-align: center;
            border-right: 1px solid #ddd;
        }

        .salary-summary-item:last-child {
            border-right: none;
        }

        .salary-summary-label {
            display: block;
            font-size: 10px;
            color: #555;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .salary-summary-value {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #000;
            overflow-wrap: anywhere;
        }

        .salary-summary-item.net {
            background: #f1f3f5;
        }

        .salary-summary-item.net .salary-summary-value {
            font-size: 14px;
        }

        .salary-summary-note {
            border-top: 1px solid #ddd;
            padding: 10px 12px;
            color: #555;
            font-size: 10px;
            line-height: 1.5;
        }

        .signature-box {
            border: 1px solid #000;
            padding: 10px;
            min-height: 105px;
            height: 100%;
            box-sizing: border-box;
        }

        .signature-space {
            height: 45px;
            border-top: 1px solid #999;
            margin-top: 15px;
        }

        @media (max-width: 600px) {
            .fiche-wrapper {
                padding: 5px;
            }

            .fiche {
                padding: 15px;
            }

            .employee-info {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .header-logo {
                width: 55px;
                height: 55px;
            }

            .fiche-header h1 {
                font-size: 15px;
            }

            .fiche-header h2 {
                font-size: 12px;
            }

            .salary-table {
                font-size: 9px;
            }

            .salary-table th,
            .salary-table td {
                padding: 5px;
            }

            .salary-summary-item {
                padding: 10px 4px;
            }

            .salary-summary-label {
                font-size: 9px;
            }

            .salary-summary-value {
                font-size: 11px;
            }

            .salary-summary-item.net .salary-summary-value {
                font-size: 11px;
            }
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 0;
            }

            html,
            body {
                width: 210mm;
                margin: 0 !important;
                padding: 0 !important;
                background: #fff !important;
            }

            .fiche-wrapper {
                display: block;
                padding: 0;
                margin: 0;
                background: #fff !important;
                min-height: auto;
            }

            .fiche-container {
                width: 210mm;
                max-width: 210mm;
            }

            .fiche {
                width: 210mm;
                min-height: 297mm;
                padding: 15mm;
                box-shadow: none;
            }

            .fiche-download {
                display: none !important;
            }

            .employee-info {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 15px;
            }

            .employee-info-item {
                grid-template-columns: 95px minmax(0, 1fr);
                padding: 5px 0;
            }

            .employee-info-item,
            .salary-table tr,
            .salary-summary,
            .signature-box {
                break-inside: avoid;
            }

            .salary-summary-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }

            .salary-table thead th,
            .salary-table .total-row,
            .salary-summary-title,
            .salary-summary-item.net {
                background: #e9ecef !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>

    <div class="fiche-wrapper">
        <div class="fiche-container">

            {{-- BOUTON PDF --}}
            <div class="fiche-download">
                <button type="button"
                        class="fiche-download-btn"
                        onclick="downloadEmployeeProfile()">
                    <i class="bi bi-download"></i>
                    Télécharger PDF
                </button>
            </div>

            <div class="fiche" id="employee-profile">

                {{-- EN-TÊTE --}}
                <div class="fiche-header">

                    <div class="header-company">
                        <h1 class="h4 fw-bold mb-0">AMC SARL</h1>
{{--                        <div style="font-size:10px;margin-top:5px;">--}}
{{--                            Fiche du personnel--}}
{{--                        </div>--}}
                    </div>

                    <div class="header-title">
                        <h2 class="h5 fw-bold mb-0">BULLETIN DE PAIE</h2>
                        <div style="font-size:10px;margin-top:5px;">
                            Période : Août 2026
                        </div>
                    </div>

                    <div class="header-logo">
                        <img src="{{ asset('logo/logo.png') }}" alt="Logo AMC SARL">
                    </div>

                </div>

                {{-- INFORMATIONS EMPLOYÉ / EMPLOYEUR --}}
                <div class="employee-info">

                    <div class="employee-info-column">

                        <div class="employee-info-title">
                            Informations de l'employé
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">Matricule</span>
                            <span class="employee-info-value">{{ $payroll->employee->employee_id ?? 'N/A' }}</span>
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">Nom complet</span>
                            <span class="employee-info-value">
                            {{ collect([
                                $payroll->employee->first_name ?? null,
                                $payroll->employee->last_name ?? null,
                                $payroll->employee->middle_name ?? null,
                            ])->filter(fn ($name) => filled($name))->join(' ') ?: 'N/A' }}
                        </span>
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">Fonction</span>
                            <span class="employee-info-value">{{ $payroll->employee->jobTitle->name ?? 'N/A' }}</span>
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">Département</span>
                            <span class="employee-info-value">{{ $payroll->employee->department->name ?? 'N/A' }}</span>
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">Date embauche</span>
                            <span class="employee-info-value">
                            {{ $payroll->employee->created_at
                                    ? \Carbon\Carbon::parse( $payroll->employee->created_at)->format('d/m/Y')
                                    : 'N/A' }}
                            </span>
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">Point de paie</span>
                            <span class="employee-info-value">KAMOA</span>
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">Salaire de base</span>
                            <span class="employee-info-value">
                            {{ number_format((float) ($payroll->employee->salary->base_salary ?? 0), 2, '.', ',') }}
                                                    {{ $payroll->employee->salary->currency ?? 'USD' }}
                        </span>
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">Enfants</span>
                            <span class="employee-info-value">0</span>
                        </div>

                    </div>


                    <div class="employee-info-column">

                        <div class="employee-info-title">
                            Informations de l'entreprise
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">Raison sociale</span>
                            <span class="employee-info-value">AMC SARL</span>
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">Adresse</span>
                            <span class="employee-info-value">
            Av. Katakokombe, Q. Kamanyola
        </span>
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">Commune / Ville</span>
                            <span class="employee-info-value">
            Kolwezi, Lualaba, RDC
        </span>
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">RCCM</span>
                            <span class="employee-info-value">
            CD/LSH/RCCM/21-B-00395
        </span>
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">ID. Nat.</span>
                            <span class="employee-info-value">
            05-F4300-N77755L
        </span>
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">NIF</span>
                            <span class="employee-info-value">
            A2158758R
        </span>
                        </div>

{{--                        <div class="employee-info-item">--}}
{{--                            <span class="employee-info-label">TVA</span>--}}
{{--                            <span class="employee-info-value">--}}
{{--            6634/2022--}}
{{--        </span>--}}
{{--                        </div>--}}

{{--                        <div class="employee-info-item">
                            <span class="employee-info-label">ARSP</span>
                            <span class="employee-info-value">
            4885676212
        </span>
                        </div>--}}

                        <div class="employee-info-item">
                            <span class="employee-info-label">Téléphone</span>
                            <span class="employee-info-value">
            +243 970 520 222
        </span>
                        </div>

                        <div class="employee-info-item">
                            <span class="employee-info-label">Email</span>
                            <span class="employee-info-value">
            info@amc-sarl.com
        </span>
                        </div>

                    </div>

                </div>

                {{-- DÉTAILS DU SALAIRE --}}
                <div class="salary-section">

                    <div class="employee-info-title">
                        Détails du salaire
                    </div>

                    <table class="salary-table">
                        <thead>
                        <tr>
                            <th>Désignation</th>
                            <th style="text-align:center;">
                                Nombre de jours / heures
                            </th>
                            <th style="text-align:right;">
                                Montant (USD)
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>Salaire de base</td>
                            <td style="text-align:center;">-</td>
                            <td style="text-align:right;"> {{ number_format((float) ($payroll->employee->salary->base_salary ?? 0), 2, '.', ',') }}
                                {{ $payroll->employee->salary->currency ?? 'USD' }}</td>
                        </tr>

                        <tr>
                            <td>Salaire du travail</td>
                            <td style="text-align:center;">26 jours</td>
                            <td style="text-align:right;">250.00 USD</td>
                        </tr>

                        <tr>
                            <td>Congé maladie</td>
                            <td style="text-align:center;">0 jour</td>
                            <td style="text-align:right;">0.00 USD</td>
                        </tr>

                        <tr>
                            <td>Heures supplémentaires</td>
                            <td style="text-align:center;">0 heure</td>
                            <td style="text-align:right;">0.00 USD</td>
                        </tr>

                        <tr>
                            <td>Primes et indemnités</td>
                            <td style="text-align:center;">-</td>
                            <td style="text-align:right;">0.00 USD</td>
                        </tr>

                        <tr>
                            <td>Retenues</td>
                            <td style="text-align:center;">-</td>
                            <td style="text-align:right;">0.00 USD</td>
                        </tr>

                        <tr class="total-row">
                            <td colspan="2" style="text-align:right;">
                                TOTAL NET À PAYER
                            </td>
                            <td style="text-align:right;">250.00 USD</td>
                        </tr>
                        </tbody>
                    </table>

                </div>

                {{-- RÉSUMÉ DE LA RÉMUNÉRATION SUR UNE SEULE LIGNE --}}
                <div class="salary-summary">

                    <h6 class="salary-summary-title">
                        RÉSUMÉ DE LA RÉMUNÉRATION
                    </h6>

                    <div class="salary-summary-grid">

                        <div class="salary-summary-item">
                        <span class="salary-summary-label">
                            SALAIRE BRUT (USD)
                        </span>
                            <strong class="salary-summary-value">
                                250.00 USD
                            </strong>
                        </div>

                        <div class="salary-summary-item">
                        <span class="salary-summary-label">
                            TOTAL RETENUES (USD)
                        </span>
                            <strong class="salary-summary-value">
                                0.00 USD
                            </strong>
                        </div>

                        <div class="salary-summary-item">
                        <span class="salary-summary-label">
                            TAUX DE CHANGE
                        </span>
                            <strong class="salary-summary-value">
                                2 500.00
                            </strong>
                            <small>CDF / USD</small>
                        </div>

                        <div class="salary-summary-item net">
                        <span class="salary-summary-label">
                            NET À PAYER (CDF)
                        </span>
                            <strong class="salary-summary-value">
                                625 000.00 CDF
                            </strong>
                        </div>

                    </div>



                </div>

                {{-- SIGNATURES --}}
                <div class="row mt-4 text-center">

                    <div class="col-6 mb-2">
                        <div class="signature-box">
                            <p class="fw-bold mb-2">
                                Date et signature du représentant légal
                                de l'entreprise
                            </p>
                            <div class="signature-space"></div>
                        </div>
                    </div>

                    <div class="col-6 mb-2">
                        <div class="signature-box">
                            <p class="fw-bold mb-2">
                                Date et signature de l'agent
                            </p>
                            <div class="signature-space"></div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- EXPORT PDF --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        function downloadEmployeeProfile() {
            const element = document.getElementById('employee-profile');

            if (!element) {
                alert('Le bulletin de paie est introuvable.');
                return;
            }

            const options = {
                margin: 0,
                filename: 'Bulletin-Paie-{{ $payroll->employee->employee_id }}-{{ $payroll->month }}-{{ $payroll->year }}.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },

                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    backgroundColor: '#ffffff',
                    scrollY: 0
                },

                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                },

                pagebreak: {
                    mode: ['css', 'legacy'],
                    avoid: [
                        '.employee-info-item',
                        '.salary-summary',
                        '.signature-box'
                    ]
                }
            };

            html2pdf()
                .set(options)
                .from(element)
                .save();
        }
    </script>

@endsection
