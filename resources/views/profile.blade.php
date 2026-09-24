@php
    use Carbon\Carbon;
@endphp

@extends('layouts.admin')

@section('title', 'AMC SARL | Profil')

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

@section('content')

    <style>

        /* =========================================================
           PAGE / WRAPPER
        ========================================================== */

        .fiche-wrapper {
            display: flex;
            justify-content: center;
            padding-top: 20px;
            position: relative;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        /* =========================================================
           FICHE
        ========================================================== */

        .fiche-container {
            position: relative;
            width: fit-content;
        }

        .fiche {
            width: 100%;
            max-width: 21cm;
            padding: 1.5cm;
            font-size: 11px;
            box-sizing: border-box;
            background-color: #fff;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            position: relative;
        }

        /* =========================================================
           DOWNLOAD BUTTON
        ========================================================== */

        .fiche-download {
            position: absolute;
            top: 20px;
            right: 15px;
            z-index: 1000;

            opacity: 0;
            visibility: hidden;

            transition: all .2s ease;
        }

        .fiche-container:hover .fiche-download {
            opacity: 1;
            visibility: visible;
        }

        .fiche-download-btn {
            border: 0;
            background: #4f8136;
            color: #fff;

            padding: 8px 13px;

            font-size: 12px;
            font-weight: 600;

            cursor: pointer;

            box-shadow: 0 2px 8px rgba(0, 0, 0, .15);

            border-radius: 0 !important;
        }

        .fiche-download-btn:hover {
            background: #3f692b;
            color: #fff;
        }

        /* =========================================================
           TABLE
        ========================================================== */

        .table td,
        .table th {
            vertical-align: middle;
            border-radius: 0 !important;
            border: 1px solid #000 !important;
        }

        /* =========================================================
           PHOTO / SIGNATURE
        ========================================================== */

        .photo-box,
        .signature-box,
        .alert {
            border-radius: 0 !important;
        }

        /* =========================================================
           HEADER LOGO
        ========================================================== */

        .header-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 768px) {

            .fiche {
                padding: 1rem;
                font-size: 10px;
            }

            .fiche .row > [class*="col-"] {
                margin-bottom: 1rem;
            }

            .fiche-download {
                top: 10px;
                right: 10px;
            }
        }

        /* =========================================================
           PRINT / PDF A4
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

            .fiche-wrapper {
                display: block;
                width: 210mm;
                min-height: 297mm;
                margin: 0;
                padding: 0;
                background: #fff !important;
            }

            .fiche-container {
                width: 210mm;
                margin: 0;
            }

            .fiche-download {
                display: none !important;
            }

            .fiche {
                width: 210mm;
                max-width: 210mm;
                min-height: 297mm;
                margin: 0;
                padding: 1.5cm;
                box-shadow: none !important;
            }
        }

    </style>


    {{-- =========================================================
         FICHE WRAPPER
    ========================================================== --}}

    <div class="fiche-wrapper">

        <div class="fiche-container">

            {{-- =====================================================
                 DOWNLOAD BUTTON
            ====================================================== --}}

            <div class="fiche-download">

                <button
                    type="button"
                    class="fiche-download-btn"
                    onclick="downloadEmployeeProfile()"
                    title="Download"
                    aria-label="Download employee profile"
                >
                    <i class="bi bi-download"></i>
                </button>

            </div>


            {{-- =====================================================
                 FICHE PRINCIPALE
            ====================================================== --}}

            <div class="fiche"
                 id="employee-profile">

                {{-- =================================================
                     EN-TÊTE
                ================================================== --}}

                <div class="d-flex align-items-center justify-content-between border-bottom mb-3">

                    <div style="flex:1;">

                        <h1 class="h4 fw-bold"
                            style="color:#000; margin:0;">

                            AMC SARL

                        </h1>

                    </div>


                    <div class="text-center"
                         style="flex:2;">

                        <h2 class="h5 fw-bold text-dark"
                            style="margin:0;">

                            Fiche de Renseignement du Salarié

                        </h2>

                    </div>


                    <div style="width:120px; height:120px; flex:none;"
                         class="header-logo">

                        <img
                            src="{{ asset('logo/logo.png') }}"
                            alt="AMC SARL Logo"
                        >

                    </div>

                </div>


                {{-- =================================================
                     PHOTO + INFORMATIONS
                ================================================== --}}

                <div class="row mb-2">

                    {{-- PHOTO --}}

                    <div class="col-md-2 text-center mb-5 mb-md-0">

                        <div
                            class="border bg-light d-flex align-items-center justify-content-center photo-box"
                            style="
                                width:128px;
                                height:160px;
                                font-size:10px;
                                overflow:hidden;
                            "
                        >

                            @if($employee->photo)

                                <img
                                    src="{{ asset('storage/' . $employee->photo) }}"
                                    alt="Photo de {{ $employee->first_name ?? '' }}"
                                    style="
                                        width:100%;
                                        height:100%;
                                        object-fit:cover;
                                    "
                                >

                            @else

                                Photo

                            @endif

                        </div>

                    </div>


                    {{-- TABLE INFORMATIONS --}}

                    <div class="col-md-10 table-responsive">

                        <table
                            class="table table-bordered table-sm mb-0"
                            style="font-size:11px;"
                        >

                            <tbody>

                            {{-- =================================================
                                 INFORMATIONS PERSONNELLES
                            ================================================== --}}

                            <tr class="table-secondary">

                                <th colspan="4">
                                    Informations Personnelles
                                </th>

                            </tr>


                            <tr>

                                <td>
                                    Entreprise
                                </td>

                                <td>
                                    AMC SARL
                                </td>

                                <td>
                                    Nom
                                </td>

                                <td>
                                    {{ $employee->first_name ?? 'N/A' }}
                                </td>

                            </tr>


                            <tr>

                                <td>
                                    Prénom
                                </td>

                                <td>
                                    {{ $employee->last_name ?? 'N/A' }}
                                </td>

                                <td>
                                    Situation familiale
                                </td>

                                @php

                                    $genderValue =
                                        $employee->gender?->value
                                        ?? $employee->gender
                                        ?? '';

                                    $maritalStatus =
                                        $employee->marital_status?->value
                                        ?? $employee->marital_status
                                        ?? '';

                                    $genderLower =
                                        strtolower($genderValue);

                                    $statusMap = [

                                        'single' => 'célibataire',

                                        'married' =>
                                            $genderLower === 'female'
                                                ? 'mariée'
                                                : 'marié',

                                        'divorced' =>
                                            $genderLower === 'female'
                                                ? 'divorcée'
                                                : 'divorcé',

                                        'widowed' =>
                                            $genderLower === 'female'
                                                ? 'veuve'
                                                : 'veuf',

                                    ];

                                @endphp

                                <td>

                                    {{
                                        $statusMap[
                                            strtolower($maritalStatus)
                                        ]
                                        ?? 'N/A'
                                    }}

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    Post nom
                                </td>

                                <td>
                                    {{ $employee->middle_name ?? 'N/A' }}
                                </td>

                                <td>
                                    Nombre d'enfants à charge
                                </td>

                                <td>

                                    {{ $employee->children?->count() ?? 0 }}

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    Nombre de personnes à charge
                                </td>

                                <td>

                                    {{ $employee->parents?->count() ?? 0 }}

                                </td>

                                <td>
                                    Date de naissance
                                </td>

                                <td>

                                    {{
                                        $employee->date_of_birth
                                            ? $employee->date_of_birth->format('d - m - Y')
                                            : 'N/A'
                                    }}

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    Département
                                </td>

                                <td>

                                    {{ $employee->department?->name ?? 'N/A' }}

                                </td>

                                <td>
                                    Pays
                                </td>

                                <td>

                                    {{ $employee->country ?? 'N/A' }}

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    N° carte CNSS
                                </td>

                                <td>
                                    ________________________
                                </td>

                                <td>
                                    N° pièce d'identité
                                </td>

                                <td>

                                    {{ $employee->number_card ?? 'N/A' }}

                                </td>

                            </tr>


                            {{-- =================================================
                                 INFORMATIONS FAMILIALES
                            ================================================== --}}

                            @php

                                $relationshipMap = [

                                    'father'  => 'Père',
                                    'mother'  => 'Mère',
                                    'spouse'  => 'Conjoint(e)',
                                    'brother' => 'Frère',
                                    'sister'  => 'Sœur',
                                    'mr'      => 'Monsieur',
                                    'mrs'     => 'Madame',
                                    'dr'      => 'Docteur',

                                ];

                            @endphp


                            <tr class="table-secondary">

                                <th colspan="4">
                                    Informations Familiales
                                </th>

                            </tr>


                            <tr>

                                <td>
                                    Relation
                                </td>

                                <td>
                                    Nom Complet
                                </td>

                                <td>
                                    Nº Telephone
                                </td>

                                <td>
                                    Adresse
                                </td>

                            </tr>


                            @forelse($employee->parents as $parent)

                                <tr>

                                    <td>

                                        {{
                                            $relationshipMap[
                                                strtolower(
                                                    $parent->relationship ?? ''
                                                )
                                            ]
                                            ?? (
                                                $parent->relationship
                                                ?? 'N/A'
                                            )
                                        }}

                                    </td>

                                    <td>

                                        {{ $parent->full_name ?? 'N/A' }}

                                    </td>

                                    <td>

                                        {{ $parent->phone ?? 'N/A' }}

                                    </td>

                                    <td>

                                        {{ $parent->address ?? 'N/A' }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4"
                                        class="text-center">

                                        Aucun parent enregistré

                                    </td>

                                </tr>

                            @endforelse


                            {{-- =================================================
                                 INFORMATIONS PROFESSIONNELLES
                            ================================================== --}}

                            <tr class="table-secondary">

                                <th colspan="4">
                                    Informations Professionnelles
                                </th>

                            </tr>


                            <tr>

                                <td>
                                    Adresse complète
                                </td>

                                <td colspan="3">

                                    {{ $employee->employee_address ?? 'N/A' }}

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    Emploi / Poste
                                </td>

                                <td colspan="3">

                                    {{ $employee->jobTitle?->name ?? 'N/A' }}

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    Section
                                </td>

                                <td>

                                    {{ $employee->section?->name ?? 'N/A' }}

                                </td>

                                <td>
                                    Position
                                </td>

                                <td>

                                    {{ $employee->jobTitle?->name ?? 'N/A' }}

                                </td>

                            </tr>


                            {{-- =================================================
                                 SALAIRE
                            ================================================== --}}

                            @php

                                $salary = $employee->salary;

                                $currency =
                                    $salary?->currency ?? '';

                                $baseSalary =
                                    $salary?->base_salary ?? 0;

                                $category =
                                    $salary?->category ?? 'N/A';

                                $echelon =
                                    $salary?->echelon ?? 'N/A';

                                $contractType =
                                    strtolower(
                                        $employee->contract_type?->value
                                        ?? $employee->contract_type
                                        ?? ''
                                    );

                                $hoursPerDay =
                                    str_contains(
                                        $contractType,
                                        'part'
                                    )
                                    ? 4
                                    : 8;

                                $daysPerWeek = 5;

                                $weeksPerMonth = 4;

                                $monthlyHours =
                                    $hoursPerDay
                                    * $daysPerWeek
                                    * $weeksPerMonth;

                                $hourlySalary =
                                    $monthlyHours > 0
                                    ? $baseSalary / $monthlyHours
                                    : 0;

                            @endphp


                            <tr>

                                <td>
                                    Niveau
                                </td>

                                <td>

                                    {{ $category }}

                                </td>

                                <td>
                                    Coefficient
                                </td>

                                <td>

                                    {{ number_format($baseSalary, 2) }}

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    Échelon
                                </td>

                                <td>

                                    {{ $echelon }}

                                </td>

                                <td>
                                    Taux horaire brut (FC)
                                </td>

                                <td>
                                    FC 2.200
                                </td>

                            </tr>


                            <tr>

                                <td>
                                    Salaire mensuel brut
                                </td>

                                <td>

                                    {{ $currency }}
                                    {{ number_format($baseSalary, 2) }}

                                </td>

                                <td>
                                    Horaire hebdomadaire
                                </td>

                                <td>

                                    {{ $currency }}
                                    {{ number_format($hourlySalary, 2) }}

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    Date d'embauche
                                </td>

                                <td>

                                    @if($employee->hire_date)

                                        {{ $employee->hire_date->format('d - m - Y') }}

                                    @else

                                        N/A

                                    @endif

                                </td>

                                <td>
                                    Numéro matricule
                                </td>

                                <td>

                                    {{ $employee->employee_id ?? 'N/A' }}

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    Type de contrat
                                </td>

                                <td>

                                    {{
                                        $employee->contract_type?->value
                                        ?? $employee->contract_type
                                        ?? 'N/A'
                                    }}

                                </td>

                                <td>
                                    Lieu de travail
                                </td>

                                <td>

                                    {{
                                        $employee->work_location?->value
                                        ?? $employee->work_location
                                        ?? 'N/A'
                                    }}

                                </td>

                            </tr>


                            {{-- =================================================
                                 CONJOINT & ENFANTS
                            ================================================== --}}

                            <tr class="table-secondary">

                                <th colspan="4">
                                    Conjoint(e) et Enfants
                                </th>

                            </tr>


                            <tr>

                                <td>
                                    Nom du conjoint(e)
                                </td>

                                <td colspan="3">

                                    @if($employee->spouse_full_name)

                                        {{ $employee->spouse_full_name }}

                                        @if($employee->spouse_phone)

                                            -
                                            {{ $employee->spouse_phone }}

                                        @endif

                                    @else

                                        Aucun conjoint enregistré

                                    @endif

                                </td>

                            </tr>


                            <tr>

                                <td colspan="4">

                                    <div class="table-responsive">

                                        <table
                                            class="table table-bordered table-sm mb-0"
                                            style="font-size:10px;"
                                        >

                                            <thead class="table-light">

                                            <tr>

                                                <th>
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

                                            @forelse($employee->children ?? [] as $child)

                                                <tr>

                                                    <td class="text-center">

                                                        {{ $loop->iteration }}

                                                    </td>

                                                    <td>

                                                        {{
                                                            $child->full_name
                                                            ?? 'N/A'
                                                        }}

                                                    </td>

                                                    <td>

                                                        {{
                                                            $child->gender
                                                            ?? 'N/A'
                                                        }}

                                                    </td>

                                                    <td>

                                                        @if($child->date_of_birth)

                                                            {{
                                                                Carbon::parse(
                                                                    $child->date_of_birth
                                                                )->format(
                                                                    'd - m - Y'
                                                                )
                                                            }}

                                                        @else

                                                            N/A

                                                        @endif

                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>

                                                    <td colspan="4"
                                                        class="text-center">

                                                        Aucun enfant enregistré

                                                    </td>

                                                </tr>

                                            @endforelse

                                            </tbody>

                                        </table>

                                    </div>

                                </td>

                            </tr>


                            {{-- =================================================
                                 URGENCE
                            ================================================== --}}

                            <tr class="table-secondary">

                                <th colspan="4">
                                    Personne à contacter en cas d'urgence
                                </th>

                            </tr>


                            <tr>

                                <td colspan="4">

                                    <div class="table-responsive">

                                        <table
                                            class="table table-bordered table-sm mb-0"
                                            style="font-size:10px;"
                                        >

                                            <thead class="table-light">

                                            <tr>

                                                <th>
                                                    N°
                                                </th>

                                                <th>
                                                    Nom Complet
                                                </th>

                                                <th>
                                                    Adresse
                                                </th>

                                                <th>
                                                    Numéro Téléphone
                                                </th>

                                            </tr>

                                            </thead>


                                            <tbody>

                                            @forelse($employee->emergencyContacts as $emergency)

                                                <tr>

                                                    <td class="text-center">

                                                        {{ $loop->iteration }}

                                                    </td>

                                                    <td>

                                                        {{
                                                            $emergency->full_name
                                                            ?? ''
                                                        }}

                                                    </td>

                                                    <td>

                                                        {{
                                                            $emergency->address
                                                            ?? ''
                                                        }}

                                                    </td>

                                                    <td>

                                                        {{
                                                            $emergency->phone
                                                            ?? ''
                                                        }}

                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>

                                                    <td colspan="4"
                                                        class="text-center">

                                                        Aucune personne à contacter enregistrée

                                                    </td>

                                                </tr>

                                            @endforelse

                                            </tbody>

                                        </table>

                                    </div>

                                </td>

                            </tr>


                            </tbody>

                        </table>

                    </div>

                </div>


                <br>


                {{-- =================================================
                     ALERT + SIGNATURES
                ================================================== --}}

                <div class="alert-signatures-wrapper"
                     style="font-size:10px;">

                    {{-- ALERT --}}

                    <div class="alert alert-warning p-2 mb-3"
                         role="alert">

                        <strong>
                            Attention :
                        </strong>

                        <ul class="mb-0">

                            <li>
                                Aucun de ceux du salaire ne pourra être établi
                                après retour de cette fiche dûment complétée.
                            </li>

                            <li>
                                Les champs signalés par un calendrier sont
                                obligatoires pour établir la déclaration annuelle
                                des salaires.
                            </li>

                        </ul>

                    </div>


                    {{-- SIGNATURES --}}

                    <div class="row mt-3 text-center">

                        <div class="col-md-6 mb-2 mb-md-0">

                            <div class="border p-2 signature-box">

                                <p class="fw-bold mb-2">

                                    Date et signature du représentant légal
                                    de l'entreprise

                                </p>

                                <div class="border-top mt-1"
                                     style="height:50px;">
                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="border p-2 signature-box">

                                <p class="fw-bold mb-2">

                                    Date et signature de l'agent

                                </p>

                                <div class="border-top mt-1"
                                     style="height:50px;">
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         HTML2PDF
    ========================================================== --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


    <script>

        function downloadEmployeeProfile() {

            const element =
                document.querySelector('#employee-profile');

            const employeeId =
                @json($employee->employee_id ?? 'Employee');

            const firstName =
                @json($employee->first_name ?? '');

            const lastName =
                @json($employee->last_name ?? '');

            const safeEmployeeId =
                employeeId
                    .toString()
                    .replace(/[^a-zA-Z0-9_-]/g, '-');

            const safeFirstName =
                firstName
                    .toString()
                    .replace(/[^a-zA-Z0-9_-]/g, '-');

            const safeLastName =
                lastName
                    .toString()
                    .replace(/[^a-zA-Z0-9_-]/g, '-');

            const filename =
                'Employee-' +
                safeEmployeeId +
                '-' +
                safeFirstName +
                '-' +
                safeLastName +
                '.pdf';


            const options = {

                margin: 0,

                filename: filename,

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
