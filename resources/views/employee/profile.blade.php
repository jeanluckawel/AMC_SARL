@extends('layouts.admin')

@section('title', 'Fiche salarié')

@section('content')

    {{-- =========================================================
        PAGE HEADER
    ========================================================= --}}
    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-sm-6">

                    <div class="d-flex align-items-center gap-2">

                        <h3 class="mb-0">
                            Fiche salarié
                        </h3>

                        {{-- Voir --}}
                        <button type="button"
                                class="btn btn-sm btn-outline-secondary"
                                id="btnViewPdf"
                                title="Voir la fiche">
                            <i class="bi bi-eye"></i>
                        </button>

                        {{-- Télécharger --}}
                        <button type="button"
                                class="btn btn-sm btn-outline-secondary"
                                id="btnDownloadPdf"
                                title="Télécharger la fiche">
                            <i class="bi bi-download"></i>
                        </button>

                    </div>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-end mb-0">

                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                Home
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            Employees
                        </li>

                        <li class="breadcrumb-item active">
                            Fiche salarié
                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        PAGE CONTENT
    ========================================================= --}}
    <div class="app-content">

        <div class="container-fluid px-0">

            {{-- =====================================================
                FICHE
            ====================================================== --}}
            <div id="employeeSheet" class="employee-sheet">


                {{-- =================================================
                    DOCUMENT HEADER
                ================================================== --}}
                <div class="document-header">

                    <div class="company-information">

                        <div class="company-name">
                            AMC SARL
                        </div>

                        <div class="company-details">
                            Société à Responsabilité Limitée
                        </div>

                    </div>


                    <div class="document-heading">

                        <div class="document-title">
                            FICHE DE RENSEIGNEMENT
                        </div>

                        <div class="document-subtitle">
                            DU SALARIÉ
                        </div>

                    </div>


                    <div class="document-logo">

                        <img src="{{ asset('logo/img.png') }}"
                             alt="AMC SARL">

                    </div>

                </div>


                {{-- =================================================
                    REFERENCE





                {{-- =================================================
                    1. INFORMATIONS PERSONNELLES
                ================================================== --}}

                <div class="section-header">
                    1. INFORMATIONS PERSONNELLES
                </div>

                <table class="sheet-table">

                    <tbody>

                    <tr>

                        <td class="field-label">
                            Nom
                        </td>

                        <td>
                            {{ $employee->first_name ?? 'N/A' }}
                        </td>

                        <td class="field-label">
                            Prénom
                        </td>

                        <td>
                            {{ $employee->middle_name ?? 'N/A' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="field-label">
                            Post-nom
                        </td>

                        <td>
                            {{ $employee->last_name ?? 'N/A' }}
                        </td>

                        <td class="field-label">
                            Sexe
                        </td>

                        <td>
                            {{ $employee->gender->value ?? 'N/A' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="field-label">
                            Date de naissance
                        </td>

                        <td>
                             {{ $employee->date_of_birth->format('m d y') }}
                        </td>

                        <td class="field-label">
                            Lieu de naissance
                        </td>

                        <td>
{{--                            {{ $employee-> }}--}}
                        </td>

                    </tr>


                    <tr>

                        <td class="field-label">
                            Situation familiale
                        </td>

                        <td>
                            {{ $employee->marital_status->value }}
                        </td>

                        <td class="field-label">
                            Nationalité
                        </td>

                        <td>
                            Congolaise
                        </td>

                    </tr>


                    <tr>

                        <td class="field-label">
                            Nombre d'enfants
                        </td>

                        <td>
                            2
                        </td>

                        <td class="field-label">
                            Personnes à charge
                        </td>

                        <td>
                            3
                        </td>

                    </tr>


                    <tr>

                        <td class="field-label">
                            N° pièce d'identité
                        </td>

                        <td>
                            ID-123456789
                        </td>

                        <td class="field-label">
                            N° carte CNSS
                        </td>

                        <td>
                            __________________
                        </td>

                    </tr>


                    <tr>

                        <td class="field-label">
                            Téléphone
                        </td>

                        <td>
                            +243 999 000 111
                        </td>

                        <td class="field-label">
                            Email
                        </td>

                        <td>
                            jean.kabila@example.com
                        </td>

                    </tr>

                    </tbody>

                </table>


                {{-- =================================================
                    2. INFORMATIONS FAMILIALES
                ================================================== --}}
                <div class="section-header">
                    2. INFORMATIONS FAMILIALES
                </div>

                <table class="sheet-table">

                    <thead>

                    <tr>

                        <th>
                            Relation
                        </th>

                        <th>
                            Nom complet
                        </th>

                        <th>
                            Téléphone
                        </th>

                        <th>
                            Adresse
                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    <tr>

                        <td>
                            Épouse
                        </td>

                        <td>
                            Marie KABILA
                        </td>

                        <td>
                            +243 999 222 333
                        </td>

                        <td>
                            Kolwezi, Lualaba
                        </td>

                    </tr>


                    <tr>

                        <td>
                            Père
                        </td>

                        <td>
                            Joseph KABILA
                        </td>

                        <td>
                            +243 999 444 555
                        </td>

                        <td>
                            Lubumbashi, Haut-Katanga
                        </td>

                    </tr>

                    </tbody>

                </table>


                {{-- =================================================
                    3. INFORMATIONS PROFESSIONNELLES
                ================================================== --}}
                <div class="section-header">
                    3. INFORMATIONS PROFESSIONNELLES
                </div>

                <table class="sheet-table">

                    <tbody>

                    <tr>

                        <td class="field-label">
                            Département
                        </td>

                        <td>
                            Administration
                        </td>

                        <td class="field-label">
                            Section
                        </td>

                        <td>
                            Ressources Humaines
                        </td>

                    </tr>


                    <tr>

                        <td class="field-label">
                            Emploi / Poste
                        </td>

                        <td>
                            Responsable Administratif
                        </td>

                        <td class="field-label">
                            Position
                        </td>

                        <td>
                            Cadre
                        </td>

                    </tr>


                    <tr>

                        <td class="field-label">
                            Type de contrat
                        </td>

                        <td>
                            Full Time
                        </td>

                        <td class="field-label">
                            Lieu de travail
                        </td>

                        <td>
                            Kolwezi
                        </td>

                    </tr>


                    <tr>

                        <td class="field-label">
                            Date d'embauche
                        </td>

                        <td>
                            02 - 01 - 2024
                        </td>

                        <td class="field-label">
                            Matricule
                        </td>

                        <td>
                            AMC-2026-001
                        </td>

                    </tr>


                    <tr>

                        <td class="field-label">
                            Niveau
                        </td>

                        <td>
                            Niveau 5
                        </td>

                        <td class="field-label">
                            Échelon
                        </td>

                        <td>
                            2
                        </td>

                    </tr>


                    <tr>

                        <td class="field-label">
                            Coefficient
                        </td>

                        <td>
                            250
                        </td>

                        <td class="field-label">
                            Taux horaire brut
                        </td>

                        <td>
                            FC 12 500
                        </td>

                    </tr>


                    <tr>

                        <td class="field-label">
                            Salaire mensuel brut
                        </td>

                        <td>
                            USD 2 000,00
                        </td>

                        <td class="field-label">
                            Horaire hebdomadaire
                        </td>

                        <td>
                            40 heures
                        </td>

                    </tr>


                    <tr>

                        <td class="field-label">
                            Adresse complète
                        </td>

                        <td colspan="3">
                            N° 25, Avenue Lumumba,
                            Quartier Mutoshi,
                            Kolwezi, Lualaba, RDC
                        </td>

                    </tr>

                    </tbody>

                </table>


                {{-- =================================================
                    4. CONJOINT ET ENFANTS
                ================================================== --}}
                <div class="section-header">
                    4. CONJOINT(E) ET ENFANTS
                </div>

                <table class="sheet-table">

                    <tbody>

                    <tr>

                        <td class="field-label">
                            Nom du conjoint(e)
                        </td>

                        <td colspan="3">
                            Marie KABILA
                            — +243 999 222 333
                            — Kolwezi, Lualaba
                        </td>

                    </tr>

                    </tbody>

                </table>


                <table class="sheet-table children-table">

                    <thead>

                    <tr>

                        <th style="width: 50px;">
                            N°
                        </th>

                        <th>
                            Nom complet
                        </th>

                        <th>
                            Genre
                        </th>

                        <th>
                            Date de naissance
                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    <tr>

                        <td class="text-center">
                            1
                        </td>

                        <td>
                            David KABILA
                        </td>

                        <td>
                            Masculin
                        </td>

                        <td>
                            12 - 03 - 2018
                        </td>

                    </tr>


                    <tr>

                        <td class="text-center">
                            2
                        </td>

                        <td>
                            Sarah KABILA
                        </td>

                        <td>
                            Féminin
                        </td>

                        <td>
                            20 - 08 - 2021
                        </td>

                    </tr>

                    </tbody>

                </table>


                {{-- =================================================
                    5. PERSONNE URGENCE
                ================================================== --}}
                <div class="section-header">
                    5. PERSONNE À CONTACTER EN CAS D'URGENCE
                </div>

                <table class="sheet-table">

                    <thead>

                    <tr>

                        <th style="width: 50px;">
                            N°
                        </th>

                        <th>
                            Nom complet
                        </th>

                        <th>
                            Adresse
                        </th>

                        <th>
                            Téléphone
                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    <tr>

                        <td class="text-center">
                            1
                        </td>

                        <td>
                            Marie KABILA
                        </td>

                        <td>
                            Kolwezi, Lualaba
                        </td>

                        <td>
                            +243 999 222 333
                        </td>

                    </tr>

                    </tbody>

                </table>


                {{-- =================================================
                    NOTICE
                ================================================== --}}
                <div class="sheet-notice">

                    <div class="notice-title">
                        Attention
                    </div>

                    <ul>

                        <li>
                            Cette fiche doit être complétée et tenue à jour
                            par le salarié.
                        </li>

                        <li>
                            Les informations fournies sont destinées à la
                            gestion administrative et RH du salarié.
                        </li>

                    </ul>

                </div>


                {{-- =================================================
                    SIGNATURES
                ================================================== --}}
                <div class="signature-section">

                    <div class="signature-card">

                        <div class="signature-label">
                            Date et signature du représentant légal
                            de l'entreprise
                        </div>

                        <div class="signature-area"></div>

                    </div>


                    <div class="signature-card">

                        <div class="signature-label">
                            Date et signature du salarié
                        </div>

                        <div class="signature-area"></div>

                    </div>

                </div>


            </div>

        </div>

    </div>


    {{-- =========================================================
        CSS
    ========================================================= --}}
    <style>

        /* =========================================================
           FICHE
        ========================================================= */

        .employee-sheet {

            width: 100%;
            max-width: 1100px;

            margin: 0 auto;
            padding: 20px;

            color: #212529;

            /*
             * On utilise la police du thème AdminLTE.
             */
            font-family: inherit;

            /*
             * Taille normale.
             */
            font-size: 13px;

            line-height: 1.5;
        }


        /* =========================================================
           HEADER DOCUMENT
        ========================================================= */

        .document-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            min-height: 95px;

            padding: 10px 0 14px;

            border-bottom: 2px solid #212529;
        }


        .company-information {
            width: 30%;
        }


        .company-name {

            font-size: 24px;

            font-weight: 700;

            letter-spacing: .2px;
        }


        .company-details {

            margin-top: 4px;

            color: #6c757d;

            font-size: 12px;
        }


        .document-heading {

            width: 45%;

            text-align: center;
        }


        .document-title {

            font-size: 18px;

            font-weight: 700;

            letter-spacing: .3px;
        }


        .document-subtitle {

            margin-top: 3px;

            font-size: 14px;

            font-weight: 600;
        }


        .document-logo {

            width: 90px;

            height: 70px;

            display: flex;

            align-items: center;

            justify-content: center;
        }


        .document-logo img {

            max-width: 100%;

            max-height: 100%;

            object-fit: contain;
        }


        /* =========================================================
           REFERENCE
        ========================================================= */

        .document-reference {

            display: flex;

            justify-content: space-between;

            padding: 8px 0;

            margin-bottom: 12px;

            border-bottom: 1px solid #dee2e6;

            color: #6c757d;

            font-size: 11px;
        }


        /* =========================================================
           IDENTIFICATION SALARIÉ
        ========================================================= */

        .employee-heading {

            display: flex;

            align-items: center;

            gap: 18px;

            margin-bottom: 14px;

            padding: 12px;

            border: 1px solid #adb5bd;

            background: transparent;
        }


        .employee-photo-wrapper {

            flex: 0 0 auto;

            text-align: center;
        }


        .employee-photo {

            width: 85px;

            height: 105px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 1px solid #adb5bd;

            background: transparent;

            color: #adb5bd;

            font-size: 32px;
        }


        .photo-label {

            margin-top: 4px;

            color: #6c757d;

            font-size: 9px;

            font-weight: 600;
        }


        .employee-main-info {

            flex: 1;
        }


        .employee-name {

            font-size: 21px;

            font-weight: 700;

            text-transform: uppercase;
        }


        .employee-job {

            margin-top: 5px;

            color: #495057;

            font-size: 14px;

            font-weight: 600;
        }


        .employee-matricule {

            margin-top: 9px;

            color: #6c757d;

            font-size: 12px;
        }


        /* =========================================================
           SECTIONS
        ========================================================= */

        .section-header {

            margin-top: 12px;

            padding: 7px 9px;

            background: #343a40;

            color: #fff;

            font-size: 12px;

            font-weight: 700;

            letter-spacing: .2px;

            page-break-after: avoid;
        }


        /* =========================================================
           TABLEAUX
        ========================================================= */

        .sheet-table {

            width: 100%;

            margin: 0;

            border-collapse: collapse;

            table-layout: fixed;

            font-size: 12px;
        }


        .sheet-table th,
        .sheet-table td {

            padding: 7px 8px;

            border: 1px solid #adb5bd;

            vertical-align: middle;

            word-break: break-word;
        }


        .sheet-table th {

            background: #f1f3f5;

            color: #212529;

            font-weight: 600;

            text-align: left;
        }


        .sheet-table .field-label {

            width: 20%;

            background: #f8f9fa;

            color: #343a40;

            font-weight: 600;
        }


        .children-table {

            margin-top: 5px;
        }


        /* =========================================================
           NOTICE
        ========================================================= */

        .sheet-notice {

            margin-top: 14px;

            padding: 10px 12px;

            border: 1px solid #adb5bd;

            background: transparent;

            font-size: 11px;
        }


        .notice-title {

            margin-bottom: 4px;

            font-weight: 700;

            text-transform: uppercase;
        }


        .sheet-notice ul {

            margin: 4px 0 0 18px;

            padding: 0;
        }


        .sheet-notice li {

            margin-bottom: 2px;
        }


        /* =========================================================
           SIGNATURES
        ========================================================= */

        .signature-section {

            display: flex;

            gap: 15px;

            margin-top: 18px;

            page-break-inside: avoid;
        }


        .signature-card {

            flex: 1;

            border: 1px solid #adb5bd;
        }


        .signature-label {

            min-height: 35px;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 6px;

            background: #f8f9fa;

            border-bottom: 1px solid #adb5bd;

            text-align: center;

            font-size: 10px;

            font-weight: 600;
        }


        .signature-area {

            height: 60px;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .document-footer {

            display: flex;

            justify-content: space-between;

            margin-top: 14px;

            padding-top: 7px;

            border-top: 1px solid #dee2e6;

            color: #6c757d;

            font-size: 9px;
        }


        /* =========================================================
           BOUTONS HEADER
        ========================================================= */

        #btnViewPdf,
        #btnDownloadPdf {

            width: 32px;

            height: 32px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 0;

            border-radius: 4px;
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 768px) {

            .employee-sheet {

                padding: 12px;

                font-size: 12px;
            }


            .document-header {

                flex-wrap: wrap;
            }


            .company-information {

                width: 50%;
            }


            .document-heading {

                width: 100%;

                order: 3;

                margin-top: 10px;
            }


            .document-logo {

                width: 70px;

                height: 55px;
            }


            .employee-heading {

                align-items: flex-start;
            }


            .employee-photo {

                width: 70px;

                height: 90px;
            }


            .employee-name {

                font-size: 17px;
            }


            .sheet-table {

                font-size: 11px;
            }


            .sheet-table th,
            .sheet-table td {

                padding: 6px;
            }


            .signature-section {

                flex-direction: column;
            }


            .document-footer {

                flex-direction: column;

                gap: 3px;
            }

        }


        /* =========================================================
           PRINT
        ========================================================= */

        @media print {

            body {

                background: #fff !important;
            }


            .app-header,
            .app-sidebar,
            .app-content-header,
            .app-footer {

                display: none !important;
            }


            .app-content {

                margin: 0 !important;

                padding: 0 !important;
            }


            .container-fluid {

                max-width: none !important;

                margin: 0 !important;

                padding: 0 !important;
            }


            .employee-sheet {

                width: 100%;

                max-width: none;

                padding: 0;

                font-size: 11px;
            }


            .section-header {

                print-color-adjust: exact;

                -webkit-print-color-adjust: exact;
            }


            .sheet-table th {

                print-color-adjust: exact;

                -webkit-print-color-adjust: exact;
            }


            .sheet-table .field-label {

                print-color-adjust: exact;

                -webkit-print-color-adjust: exact;
            }


            @page {

                size: A4 portrait;

                margin: 8mm;
            }

        }

    </style>


    {{-- =========================================================
        HTML2PDF
    ========================================================= --}}
    @push('scripts')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                const element = document.getElementById('employeeSheet');

                const viewButton = document.getElementById('btnViewPdf');

                const downloadButton = document.getElementById('btnDownloadPdf');


                const options = {

                    margin: [0.3, 0.3, 0.3, 0.3],

                    filename: 'AMC_SARL_Fiche_Salarie.pdf',

                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },

                    html2canvas: {

                        scale: 2,

                        useCORS: true,

                        logging: false
                    },

                    jsPDF: {

                        unit: 'cm',

                        format: 'a4',

                        orientation: 'portrait'
                    },

                    pagebreak: {

                        mode: ['css', 'legacy']
                    }

                };


                /* =====================================================
                   VOIR PDF
                ====================================================== */

                if (viewButton) {

                    viewButton.addEventListener('click', function () {

                        html2pdf()

                            .set(options)

                            .from(element)

                            .outputPdf('blob')

                            .then(function (blob) {

                                const url = URL.createObjectURL(blob);

                                window.open(url, '_blank');

                            });

                    });

                }


                /* =====================================================
                   TÉLÉCHARGER PDF
                ====================================================== */

                if (downloadButton) {

                    downloadButton.addEventListener('click', function () {

                        html2pdf()

                            .set(options)

                            .from(element)

                            .save();

                    });

                }

            });

        </script>

    @endpush

@endsection
