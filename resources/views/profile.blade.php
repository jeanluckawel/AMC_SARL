@extends('layouts.admin')

@section('title', 'Employee Information Sheet')

@section('content')

    <style>

        /* =========================================================
           GLOBAL
        ========================================================== */

        body {
            background: #eef1f3;
        }

        /* =========================================================
           WRAPPER
        ========================================================== */

        .employee-wrapper {
            position: relative;
            width: fit-content;
            margin: 0 auto;
        }

        /* =========================================================
           DOWNLOAD
        ========================================================== */

        .employee-actions {
            position: absolute;
            top: 18px;
            right: 18px;
            z-index: 1000;

            opacity: 0;
            visibility: hidden;

            transition: all .2s ease;
        }

        .employee-wrapper:hover .employee-actions {
            opacity: 1;
            visibility: visible;
        }

        .employee-download-btn {
            border: 0;
            background: #0a9745;
            color: #fff;

            padding: 9px 15px;

            font-size: 12px;
            font-weight: 700;

            cursor: pointer;

            box-shadow: 0 3px 10px rgba(0, 0, 0, .18);

            transition: all .2s ease;
        }

        .employee-download-btn:hover {
            background: #087d39;
            transform: translateY(-1px);
        }

        /* =========================================================
           A4
        ========================================================== */

        .employee-page {
            width: 210mm;
            min-height: 297mm;

            margin: 18px auto;

            background: #fff;

            padding: 9mm 10mm;

            box-sizing: border-box;

            box-shadow: 0 4px 22px rgba(0, 0, 0, .10);
        }

        /* =========================================================
           DOCUMENT
        ========================================================== */

        .employee-document {
            width: 100%;

            background: #fff;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: #222;

            font-size: 10px;
        }

        /* =========================================================
           HEADER
        ========================================================== */

        .employee-header {
            border: 1px solid #222;
        }

        .employee-header-top {
            display: grid;
            grid-template-columns: 32% 1fr;

            min-height: 70px;

            border-bottom: 1px solid #222;
        }

        .employee-logo-area {
            display: flex;
            align-items: center;
            justify-content: center;

            padding: 8px;

            border-right: 1px solid #222;
        }

        .employee-logo {
            width: 125px;
            height: auto;
        }

        .employee-title-area {
            display: flex;
            flex-direction: column;

            justify-content: center;

            padding: 8px 15px;
        }

        .employee-title {
            color: #0a9745;

            font-size: 20px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .3px;
        }

        .employee-title-line {
            width: 55px;
            height: 3px;

            background: #fcec10;

            margin-top: 6px;
        }

        .employee-title-subtitle {
            margin-top: 5px;

            color: #666;

            font-size: 9px;

            font-weight: 600;

            letter-spacing: .5px;
        }

        /* =========================================================
           COMPANY BAR
        ========================================================== */

        .employee-company-row {
            display: grid;

            grid-template-columns:
                17%
                1fr
                9%
                9%
                9%
                10%;

            min-height: 30px;
        }

        .employee-company-label {
            display: flex;
            align-items: center;

            padding: 5px;

            font-weight: 800;

            color: #0a9745;

            background: #f7faf8;

            border-right: 1px solid #222;
        }

        .employee-company-name {
            display: flex;
            align-items: center;
            justify-content: center;

            padding: 5px;

            font-size: 12px;

            font-weight: 800;

            color: #0a9745;

            border-right: 1px solid #222;
        }

        .employee-company-letter {
            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: 800;

            font-style: italic;

            border-right: 1px solid #222;
        }

        .employee-company-letter:last-child {
            border-right: 0;
        }

        /* =========================================================
           SECTION HEADER
        ========================================================== */

        .employee-section-header {
            display: flex;
            align-items: center;

            margin-top: 9px;
            margin-bottom: 0;

            background: black;

            color: #fff;

            font-size: 10px;

            font-weight: 800;

            text-transform: uppercase;

            padding: 6px 9px;

            letter-spacing: .2px;
        }

        /*.employee-section-header::before {*/
        /*    content: "";*/

        /*    width: 4px;*/
        /*    height: 14px;*/

        /*    background: #fcec10;*/

        /*    margin-right: 7px;*/
        /*}*/

        /* =========================================================
           INFORMATION TABLE
        ========================================================== */

        .employee-info-table {
            width: 100%;

            border-collapse: collapse;

            table-layout: fixed;
        }

        .employee-info-table td {
            border: 1px solid #c9c9c9;

            padding: 5px 7px;

            min-height: 24px;

            vertical-align: middle;
        }

        .employee-label {
            width: 21%;

            background: #f7f8f8;

            font-weight: 700;

            color: #444;
        }

        .employee-value {
            width: 29%;

            font-weight: 600;

            color: #111;
        }

        .employee-value-highlight {
            color: #0a9745;

            font-weight: 800;
        }

        /* =========================================================
           CLASSIFICATION
        ========================================================== */

        .employee-classification {
            width: 100%;

            border-collapse: collapse;
        }

        .employee-classification td {
            border: 1px solid #c9c9c9;

            padding: 6px 7px;

            font-weight: 700;
        }

        .employee-classification-head {
            background: #f3f5f4;

            color: #0a9745;

            font-weight: 800 !important;
        }

        /* =========================================================
           CHECKBOX
        ========================================================== */

        .employee-checkbox {
            width: 18px;
            height: 18px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            border: 1.5px solid #555;

            margin-right: 5px;

            vertical-align: middle;

            background: #fff;
        }

        .employee-checkbox.checked {
            border-color: #0a9745;

            background: #0a9745;

            color: #fff;
        }

        .employee-checkbox.checked::after {
            content: "✓";

            font-size: 13px;

            font-weight: 800;
        }

        .employee-status-row {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 10px;

            padding: 6px 8px;
        }

        .employee-status-item {
            display: flex;

            align-items: center;

            font-weight: 700;

            white-space: nowrap;
        }

        /* =========================================================
           CONTRACT
        ========================================================== */

        .employee-contract-row {
            display: grid;

            grid-template-columns:
                1fr
                1fr
                1fr
                1fr;

            border: 1px solid #c9c9c9;
        }

        .employee-contract-item {
            padding: 7px;

            font-weight: 700;

            border-right: 1px solid #c9c9c9;
        }

        .employee-contract-item:last-child {
            border-right: 0;
        }

        /* =========================================================
           CHILDREN
        ========================================================== */

        .employee-children-title {
            margin-top: 10px;

            padding: 6px;

            text-align: center;

            color: #0a9745;

            background: #f5f8f6;

            border: 1px solid #c9c9c9;

            border-bottom: 0;

            font-size: 10px;

            font-weight: 800;
        }

        .employee-children-table,
        .employee-emergency-table {
            width: 100%;

            border-collapse: collapse;

            table-layout: fixed;
        }

        .employee-children-table th,
        .employee-children-table td,
        .employee-emergency-table th,
        .employee-emergency-table td {
            border: 1px solid #c9c9c9;

            padding: 5px;
        }

        .employee-children-table th,
        .employee-emergency-table th {
            background: #f3f5f4;

            color: black;

            text-align: center;

            font-weight: 800;
        }

        .employee-children-table td,
        .employee-emergency-table td {
            text-align: center;
        }

        .employee-children-table tbody tr {
            height: 24px;
        }

        /* =========================================================
           EMERGENCY
        ========================================================== */

        .employee-emergency-title {
            margin-bottom: 0;

            padding: 6px;

            text-align: center;

            color: black;

            background: #f5f8f6;

            border: 1px solid #c9c9c9;

            border-bottom: 0;

            font-weight: 800;

            font-size: 11px;
        }

        /* =========================================================
           ATTENTION
        ========================================================== */

        .employee-attention {
            margin-top: 12px;

            border: 1px solid #c9c9c9;

            background: #fff;
        }

        .employee-attention-title {
            color: #d84f5d;

            text-align: center;

            font-size: 11px;

            font-weight: 800;

            padding: 5px;

            border-bottom: 1px solid #ddd;
        }

        .employee-attention-text {
            text-align: center;

            font-size: 9px;

            font-weight: 600;

            line-height: 1.5;

            padding: 6px;
        }

        .employee-attention-note {
            color: #a64f58;

            font-style: italic;
        }

        /* =========================================================
           SIGNATURE
        ========================================================== */

        .employee-signature-table {
            width: 100%;

            margin-top: 12px;

            border-collapse: collapse;
        }

        .employee-signature-table th {
            border: 1px solid #222;

            background: #f3f5f4;

            padding: 6px;

            text-align: left;

            font-size: 10px;

            font-weight: 800;
        }

        .employee-signature-table td {
            border: 1px solid #222;

            height: 90px;

            vertical-align: bottom;

            padding: 8px;
        }

        .employee-signature-content {
            text-align: center;

            font-size: 9px;

            color: #555;
        }

        /* =========================================================
           PAGE 2 TITLE
        ========================================================== */

        .employee-page-title {
            color: #0a9745;

            font-size: 15px;

            font-weight: 800;

            border-bottom: 3px solid #fcec10;

            padding-bottom: 5px;

            margin-bottom: 12px;
        }

        /* =========================================================
           FOOTER
        ========================================================== */

        .employee-footer {
            margin-top: 25px;

            padding-top: 7px;

            border-top: 2px solid #0a9745;

            text-align: center;

            font-size: 8px;

            line-height: 1.6;

            color: #555;
        }

        .employee-footer strong {
            color: #0a9745;
        }

        /* =========================================================
           PAGE BREAK
        ========================================================== */

        .employee-page-break {
            page-break-before: always;

            break-before: page;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 900px) {

            body {
                background: #fff;
            }

            .employee-wrapper {
                width: 100%;
            }

            .employee-page {
                width: 100%;

                min-height: auto;

                margin: 0;

                padding: 20px;

                box-shadow: none;
            }
        }

        @media (max-width: 768px) {

            .employee-page {
                padding: 12px;
            }

            .employee-header-top {
                grid-template-columns: 1fr;
            }

            .employee-logo-area {
                border-right: 0;

                border-bottom: 1px solid #222;
            }

            .employee-company-row {
                grid-template-columns:
                    20%
                    1fr
                    8%
                    8%
                    8%
                    10%;
            }

            .employee-company-name {
                font-size: 9px;
            }

            .employee-title {
                font-size: 16px;
            }

            .employee-info-table {
                font-size: 8px;
            }

            .employee-status-row {
                flex-wrap: wrap;
            }

            .employee-children-table,
            .employee-emergency-table {
                font-size: 8px;
            }
        }

        /* =========================================================
           PRINT
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

            .employee-actions {
                display: none !important;
            }

            .employee-wrapper {
                width: 210mm;

                margin: 0;
            }

            .employee-page {
                width: 210mm;

                min-height: 297mm;

                margin: 0;

                padding: 9mm 10mm;

                box-shadow: none;
            }
        }

    </style>


    {{-- =========================================================
         WRAPPER
    ========================================================== --}}

    <div class="employee-wrapper">

        {{-- =====================================================
             DOWNLOAD BUTTON
        ====================================================== --}}

        <div class="employee-actions">

            <button
                type="button"
                class="employee-download-btn"
                onclick="downloadEmployeeInformation()"
                title="Download employee information"
            >
                <i class="bi bi-download"></i>
                Download
            </button>

        </div>


        {{-- =========================================================
             PAGE 1
        ========================================================== --}}

        <div class="employee-page">

            <div
                class="employee-document"
                id="employee-information-document"
            >

                {{-- =================================================
                     HEADER
                ================================================== --}}

                <div class="employee-header">

                    <div class="employee-header-top">

                        <div class="employee-logo-area">

                            <img
                                src="{{ asset('logo/logo.png') }}"
                                alt="AMC SARL"
                                class="employee-logo"
                            >

                        </div>

                        <div class="employee-title-area">

                            <div class="employee-title">
                                Fiche de Renseignement du Salarié
                            </div>

                            <div class="employee-title-line"></div>

                        </div>

                    </div>


                    <div class="employee-company-row">

                        <div class="employee-company-label">
                            Entreprise
                        </div>

                        <div class="employee-company-name">
                            AFRICA MADGENGO COMPANY SARL
                        </div>

                        <div class="employee-company-letter">
                            A
                        </div>

                        <div class="employee-company-letter">
                            M
                        </div>

                        <div class="employee-company-letter">
                            C
                        </div>

                        <div class="employee-company-letter">
                            SARL
                        </div>

                    </div>

                </div>


                {{-- =================================================
                     VARIABLES
                ================================================== --}}

                @php

                    $employeeName = trim(
                        ($employee->last_name ?? '') . ' ' .
                        ($employee->middle_name ?? '')
                    );

                    $maritalStatus =
                        $employee->marital_status?->value
                        ?? $employee->marital_status
                        ?? '-';

                    $gender =
                        $employee->gender?->value
                        ?? $employee->gender
                        ?? '-';

                    $contractType =
                        $employee->contract_type?->value
                        ?? $employee->contract_type
                        ?? '-';

                    $workLocation =
                        $employee->work_location?->value
                        ?? $employee->work_location
                        ?? '-';

                    $employeeType =
                        $employee->employee_type?->value
                        ?? $employee->employee_type
                        ?? '';

                    $salary = $employee->salary;

                    $salaryAmount =
                        data_get($salary, 'gross_salary')
                        ?? data_get($salary, 'monthly_salary')
                        ?? data_get($salary, 'basic_salary')
                        ?? data_get($salary, 'amount')
                        ?? null;

                    $father = $employee->parents
                        ->first(function ($parent) {

                            $relation = strtolower(
                                (string) (
                                    data_get($parent, 'relationship')
                                    ?? data_get($parent, 'relation')
                                    ?? data_get($parent, 'type')
                                    ?? ''
                                )
                            );

                            return str_contains($relation, 'father')
                                || str_contains($relation, 'père')
                                || str_contains($relation, 'pere');

                        });

                    $mother = $employee->parents
                        ->first(function ($parent) {

                            $relation = strtolower(
                                (string) (
                                    data_get($parent, 'relationship')
                                    ?? data_get($parent, 'relation')
                                    ?? data_get($parent, 'type')
                                    ?? ''
                                )
                            );

                            return str_contains($relation, 'mother')
                                || str_contains($relation, 'mère')
                                || str_contains($relation, 'mere');

                        });

                @endphp


                {{-- =================================================
                     PERSONAL INFORMATION
                ================================================== --}}

                <div class="employee-section-header">
                    Informations personnelles
                </div>


                <table class="employee-info-table">

                    <tr>

                        <td class="employee-label">
                            * Nom
                        </td>

                        <td class="employee-value employee-value-highlight">
                            {{ $employee->last_name ?? '-' }}
                        </td>

                        <td class="employee-label">
                            * Prénom
                        </td>

                        <td class="employee-value employee-value-highlight">
                            {{ $employee->first_name ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="employee-label">
                            Autre Nom
                        </td>

                        <td class="employee-value">
                            {{ $employee->middle_name ?? '-' }}
                        </td>

                        <td class="employee-label">
                            * Situation Familiale
                        </td>

                        <td class="employee-value">
                            {{ strtoupper(str_replace('_', ' ', $maritalStatus)) }}
                        </td>

                    </tr>


                    <tr>

                        <td colspan="4"
                            style="
                                text-align:center;
                                color:#777;
                                font-size:8px;
                            ">

                            Célibataire · Divorcé · Vie maritale · Marié(e)
                            · Séparé(e) · Veuf(ve)

                        </td>

                    </tr>


                    <tr>

                        <td class="employee-label">
                            Nbre d'enfant(s) à charge
                        </td>

                        <td class="employee-value">
                            {{ $employee->children_count ?? $employee->number_of_children ?? '-' }}
                        </td>

                        <td class="employee-label">
                            Nbre de personne(s) à charge
                        </td>

                        <td class="employee-value">
                            {{ $employee->dependants_count ?? $employee->number_of_dependants ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="employee-label">
                            * Numéro Téléphone
                        </td>

                        <td colspan="3" class="employee-value">
                            {{ $employee->employee_phone ?? $employee->employee_work_phone ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="employee-label">
                            Nom du père
                        </td>

                        <td class="employee-value">

                            {{ data_get($father, 'full_name')
                                ?? data_get($father, 'name')
                                ?? trim(
                                    (string) data_get($father, 'first_name') . ' ' .
                                    (string) data_get($father, 'last_name')
                                )
                                ?: '-' }}

                        </td>

                        <td class="employee-label">
                            Nom de la mère
                        </td>

                        <td class="employee-value">

                            {{ data_get($mother, 'full_name')
                                ?? data_get($mother, 'name')
                                ?? trim(
                                    (string) data_get($mother, 'first_name') . ' ' .
                                    (string) data_get($mother, 'last_name')
                                )
                                ?: '-' }}

                        </td>

                    </tr>


                    <tr>

                        <td class="employee-label">
                            Lieu de naissance
                        </td>

                        <td class="employee-value">
                            {{ $employee->place_of_birth ?? '-' }}
                        </td>

                        <td class="employee-label">
                            Date de naissance
                        </td>

                        <td class="employee-value">

                            @if($employee->date_of_birth)

                                {{ $employee->date_of_birth->format('d/m/Y') }}

                            @else

                                -

                            @endif

                        </td>

                    </tr>


                    <tr>

                        <td class="employee-label">
                            Département
                        </td>

                        <td class="employee-value employee-value-highlight">
                            {{ $employee->department?->name ?? '-' }}
                        </td>

                        <td class="employee-label">
                            Nationalité
                        </td>

                        <td class="employee-value">
                            {{ $employee->country ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="employee-label">
                            N° pièce d'identité
                        </td>

                        <td class="employee-value">
                            {{ $employee->number_card ?? '-' }}
                        </td>

                        <td class="employee-label">
                            Date d'expiration
                        </td>

                        <td class="employee-value">

                            @if($employee->identity_expiry_date ?? false)

                                {{ \Carbon\Carbon::parse(
                                    $employee->identity_expiry_date
                                )->format('d/m/Y') }}

                            @else

                                -

                            @endif

                        </td>

                    </tr>


                    <tr>

                        <td class="employee-label">
                            Adresse complète
                        </td>

                        <td colspan="3" class="employee-value">
                            {{ $employee->employee_address ?? '-' }}
                        </td>

                    </tr>

                </table>


                {{-- =================================================
                     EMPLOYMENT INFORMATION
                ================================================== --}}

                <div class="employee-section-header">
                    Informations professionnelles
                </div>


                <table class="employee-info-table">

                    <tr>

                        <td class="employee-label">
                            Emploi / Poste
                        </td>

                        <td class="employee-value employee-value-highlight">
                            {{ $employee->jobTitle?->name
                                ?? $employee->jobTitle?->title
                                ?? '-' }}
                        </td>

                        <td class="employee-label">
                            Matricule
                        </td>

                        <td class="employee-value employee-value-highlight">
                            {{ $employee->employee_id ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <td class="employee-label">
                            Section
                        </td>

                        <td class="employee-value">
                            {{ $employee->section?->name ?? '-' }}
                        </td>

                        <td class="employee-label">
                            Lieu de travail
                        </td>

                        <td class="employee-value">
                            {{ strtoupper(str_replace('_', ' ', $workLocation)) }}
                        </td>

                    </tr>


                    <tr>

                        <td class="employee-label">
                            Superviseur
                        </td>

                        <td class="employee-value">
                            {{ $employee->supervisor ?? '-' }}
                        </td>

                        <td class="employee-label">
                            Sexe
                        </td>

                        <td class="employee-value">
                            {{ strtoupper($gender) }}
                        </td>

                    </tr>

                </table>


                {{-- =================================================
                     CLASSIFICATION
                ================================================== --}}

                <div class="employee-section-header">
                    Classification
                </div>


                <table class="employee-classification">

                    <tr class="employee-classification-head">

                        <td>
                            Niveau
                        </td>

                        <td>
                            Coefficient
                        </td>

                        <td>
                            Échelon
                        </td>

                        <td>
                            Position
                        </td>

                    </tr>

                    <tr>

                        <td>
                            {{ $employee->level ?? '-' }}
                        </td>

                        <td>
                            {{ $employee->coefficient ?? '-' }}
                        </td>

                        <td>
                            {{ $employee->step ?? '-' }}
                        </td>

                        <td>
                            {{ $employee->position ?? '-' }}
                        </td>

                    </tr>

                </table>


                {{-- =================================================
                     EMPLOYEE STATUS
                ================================================== --}}

                <div class="employee-section-header">
                    Statut du salarié
                </div>


                <div
                    style="
                        border:1px solid #c9c9c9;
                        border-top:0;
                    "
                >

                    <div class="employee-status-row">

                        <div class="employee-status-item">

                            <span
                                class="employee-checkbox
                                {{ strtolower($employeeType) === 'cadre'
                                    ? 'checked'
                                    : '' }}"
                            ></span>

                            Cadre

                        </div>


                        <div class="employee-status-item">

                            <span
                                class="employee-checkbox
                                {{ str_contains(
                                    strtolower($employeeType),
                                    'maitrise'
                                )
                                || str_contains(
                                    strtolower($employeeType),
                                    'maîtrise'
                                )
                                    ? 'checked'
                                    : '' }}"
                            ></span>

                            Agent de maîtrise

                        </div>


                        <div class="employee-status-item">

                            <span
                                class="employee-checkbox
                                {{ str_contains(
                                    strtolower($employeeType),
                                    'employ'
                                )
                                || str_contains(
                                    strtolower($employeeType),
                                    'apprenti'
                                )
                                    ? 'checked'
                                    : '' }}"
                            ></span>

                            Employé / Apprenti

                        </div>


                        <div class="employee-status-item">

                            <span
                                class="employee-checkbox
                                {{ str_contains(
                                    strtolower($employeeType),
                                    'ouvrier'
                                )
                                    ? 'checked'
                                    : '' }}"
                            ></span>

                            Ouvrier

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     SALARY
                ================================================== --}}

                <div class="employee-section-header">
                    Rémunération et contrat
                </div>


                <table class="employee-info-table">

                    <tr>

                        <td class="employee-label">
                            Taux horaire brut en FC
                        </td>

                        <td class="employee-value">

                            {{ $employee->hourly_rate ?? '-' }}

                        </td>

                        <td class="employee-label">
                            Salaire mensuel brut en FC
                        </td>

                        <td class="employee-value employee-value-highlight">

                            @if($salaryAmount !== null)

                                {{ number_format(
                                    (float) $salaryAmount,
                                    2,
                                    ',',
                                    ' '
                                ) }}

                            @else

                                -

                            @endif

                        </td>

                    </tr>


                    <tr>

                        <td class="employee-label">
                            Date d'embauche
                        </td>

                        <td class="employee-value">

                            @if($employee->hire_date)

                                {{ $employee->hire_date->format('d/m/Y') }}

                            @else

                                -

                            @endif

                        </td>

                        <td class="employee-label">
                            Fin du contrat
                        </td>

                        <td class="employee-value">

                            @if($employee->end_contract_date)

                                {{ $employee->end_contract_date->format('d/m/Y') }}

                            @else

                                -

                            @endif

                        </td>

                    </tr>

                </table>


                {{-- =================================================
                     CONTRACT TYPE
                ================================================== --}}

                <div class="employee-contract-row">

                    <div class="employee-contract-item">

                        <span
                            class="employee-checkbox
                            {{ strtolower($contractType) === 'cdi'
                                ? 'checked'
                                : '' }}"
                        ></span>

                        CDI

                    </div>


                    <div class="employee-contract-item">

                        <span
                            class="employee-checkbox
                            {{ strtolower($contractType) === 'cdd'
                                ? 'checked'
                                : '' }}"
                        ></span>

                        CDD

                    </div>


                    <div class="employee-contract-item">

                        <span
                            class="employee-checkbox
                            {{ in_array(
                                strtolower($contractType),
                                ['full_time', 'full time', 'temps plein']
                            )
                                ? 'checked'
                                : '' }}"
                        ></span>

                        Temps plein

                    </div>


                    <div class="employee-contract-item">

                        <span
                            class="employee-checkbox
                            {{ in_array(
                                strtolower($contractType),
                                ['part_time', 'part time', 'temps partiel']
                            )
                                ? 'checked'
                                : '' }}"
                        ></span>

                        Temps partiel

                    </div>

                </div>


                {{-- =================================================
                     SPOUSE
                ================================================== --}}

                <div class="employee-section-header">
                    Situation familiale
                </div>


                <table class="employee-info-table">

                    <tr>

                        <td class="employee-label">
                            Nom du conjoint(e)
                        </td>

                        <td class="employee-value">
                            {{ $employee->spouse_full_name ?? '-' }}
                        </td>

                        <td class="employee-label">
                            Téléphone
                        </td>

                        <td class="employee-value">
                            {{ $employee->spouse_phone ?? '-' }}
                        </td>

                    </tr>

                </table>


                {{-- =================================================
                     CHILDREN
                ================================================== --}}

                <div class="employee-children-title">
                    NOM DES ENFANTS
                </div>


                <table class="employee-children-table">

                    <thead>

                    <tr>

                        <th style="width:7%;">
                            N
                        </th>

                        <th style="width:18%;">
                            Prénom
                        </th>

                        <th style="width:27%;">
                            Nom & Post-Nom
                        </th>

                        <th style="width:20%;">
                            Date de naissance
                        </th>

                        <th style="width:28%;">
                            Situation familiale
                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    @for($i = 1; $i <= 7; $i++)

                        <tr>

                            <td>
                                {{ $i }}
                            </td>

                            <td></td>

                            <td></td>

                            <td></td>

                            <td>

                                <span style="font-size:8px;">
                                    Décédé
                                </span>

                                <span
                                    class="employee-checkbox"
                                    style="
                                        width:12px;
                                        height:12px;
                                        margin-left:4px;
                                    "
                                ></span>

                                <span style="font-size:8px;">
                                    En vie
                                </span>

                                <span
                                    class="employee-checkbox"
                                    style="
                                        width:12px;
                                        height:12px;
                                        margin-left:4px;
                                    "
                                ></span>

                            </td>

                        </tr>

                    @endfor

                    </tbody>

                </table>

            </div>

        </div>


        {{-- =========================================================
             PAGE 2
        ========================================================== --}}

        <div class="employee-page employee-page-break">

            <div class="employee-document">

{{--                <div class="employee-page-title">--}}
{{--                    Informations complémentaires du salarié--}}
{{--                </div>--}}


                {{-- =================================================
                     EMERGENCY CONTACT
                ================================================== --}}

                <div class="employee-emergency-title">
                    PERSONNE À CONTACTER EN CAS D'URGENCE
                </div>


                <table class="employee-emergency-table">

                    <thead>

                    <tr>

                        <th style="width:8%;">
                            N
                        </th>

                        <th style="width:22%;">
                            Prénom
                        </th>

                        <th style="width:30%;">
                            Nom & Post-Nom
                        </th>

                        <th style="width:40%;">
                            Numéro Téléphone
                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse(
                        $employee->emergencyContacts
                        as $index => $contact
                    )

                        <tr>

                            <td>
                                {{ $index + 1 }}
                            </td>

                            <td>
                                {{ data_get($contact, 'first_name')
                                    ?? data_get($contact, 'firstname')
                                    ?? '-' }}
                            </td>

                            <td>
                                {{ data_get($contact, 'full_name')
                                    ?? data_get($contact, 'name')
                                    ?? trim(
                                        (string) data_get(
                                            $contact,
                                            'last_name'
                                        ) . ' ' .
                                        (string) data_get(
                                            $contact,
                                            'middle_name'
                                        )
                                    )
                                    ?: '-' }}
                            </td>

                            <td>
                                {{ data_get($contact, 'phone')
                                    ?? data_get($contact, 'telephone')
                                    ?? data_get(
                                        $contact,
                                        'phone_number'
                                    )
                                    ?? '-' }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td>1</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>


                {{-- =================================================
                     ATTENTION
                ================================================== --}}

                <div class="employee-attention">

                    <div class="employee-attention-title">
                        Attention
                    </div>

                    <div class="employee-attention-text">

                        La fiche de paie du salarié ne pourra être établie
                        qu'après retour de cette fiche complétée.

                        <br>

                        <span class="employee-attention-note">

                            Les champs signalés par un astérisque sont
                            obligatoires pour établir la déclaration annuelle
                            des salaires.

                        </span>

                    </div>

                </div>


                {{-- =================================================
                     SIGNATURE
                ================================================== --}}

                <table class="employee-signature-table">

                    <thead>

                    <tr>

                        <th>
                            Date et Signature du représentant légal de l'entreprise
                        </th>

                        <th>
                            Date et Signature de l'agent
                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    <tr>

                        <td>

                            <div class="employee-signature-content">

                                <br><br><br>

                                AFRICA MADGENGO COMPANY SARL

                                <br><br>

                                ______________________________

                            </div>

                        </td>

                        <td>

                            <div class="employee-signature-content">

                                Date :

                                @if($employee->hire_date)

                                    {{ $employee->hire_date->format('d/m/Y') }}

                                @else

                                    __________________

                                @endif

                                <br><br>

                                Signature :

                                ______________________________

                            </div>

                        </td>

                    </tr>

                    </tbody>

                </table>


                {{-- =================================================
                     CONTACT / SYSTEM INFORMATION
                ================================================== --}}

{{--                <div class="employee-section-header"--}}
{{--                     style="margin-top:18px;">--}}

{{--                    Informations administratives--}}

{{--                </div>--}}


{{--                <table class="employee-info-table">--}}

{{--                    <tr>--}}

{{--                        <td class="employee-label">--}}
{{--                            Matricule--}}
{{--                        </td>--}}

{{--                        <td class="employee-value employee-value-highlight">--}}
{{--                            {{ $employee->employee_id ?? '-' }}--}}
{{--                        </td>--}}

{{--                        <td class="employee-label">--}}
{{--                            Email--}}
{{--                        </td>--}}

{{--                        <td class="employee-value">--}}
{{--                            {{ $employee->employee_email ?? '-' }}--}}
{{--                        </td>--}}

{{--                    </tr>--}}


{{--                    <tr>--}}

{{--                        <td class="employee-label">--}}
{{--                            Téléphone professionnel--}}
{{--                        </td>--}}

{{--                        <td class="employee-value">--}}
{{--                            {{ $employee->employee_work_phone ?? '-' }}--}}
{{--                        </td>--}}

{{--                        <td class="employee-label">--}}
{{--                            Téléphone personnel--}}
{{--                        </td>--}}

{{--                        <td class="employee-value">--}}
{{--                            {{ $employee->employee_phone ?? '-' }}--}}
{{--                        </td>--}}

{{--                    </tr>--}}


{{--                    <tr>--}}

{{--                        <td class="employee-label">--}}
{{--                            Département--}}
{{--                        </td>--}}

{{--                        <td class="employee-value">--}}
{{--                            {{ $employee->department?->name ?? '-' }}--}}
{{--                        </td>--}}

{{--                        <td class="employee-label">--}}
{{--                            Section--}}
{{--                        </td>--}}

{{--                        <td class="employee-value">--}}
{{--                            {{ $employee->section?->name ?? '-' }}--}}
{{--                        </td>--}}

{{--                    </tr>--}}


{{--                    <tr>--}}

{{--                        <td class="employee-label">--}}
{{--                            Poste--}}
{{--                        </td>--}}

{{--                        <td class="employee-value">--}}
{{--                            {{ $employee->jobTitle?->name--}}
{{--                                ?? $employee->jobTitle?->title--}}
{{--                                ?? '-' }}--}}
{{--                        </td>--}}

{{--                        <td class="employee-label">--}}
{{--                            Superviseur--}}
{{--                        </td>--}}

{{--                        <td class="employee-value">--}}
{{--                            {{ $employee->supervisor ?? '-' }}--}}
{{--                        </td>--}}

{{--                    </tr>--}}

{{--                </table>--}}


                {{-- =================================================
                     FOOTER
                ================================================== --}}

                <div class="employee-footer">

                    <strong>
                        AFRICA MADGENGO COMPANY SARL
                    </strong>

                    <br>

                    RCCM :
                    CD/LSH/RCCM/21-B-00395

                    &nbsp; | &nbsp;

                    Tél. :
                    +243 970 520 222

                    &nbsp; | &nbsp;

                    Email :
                    info@amc-sarl.com

                    <br>

                    Adresse :
                    Av. Katakokombe Q/Kamanyola,
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

        function downloadEmployeeInformation() {

            const documentElement =
                document.querySelector('.employee-wrapper');

            const employeeId = @json(
                $employee->employee_id ?? 'Employee'
            );

            const safeEmployeeId = employeeId
                .toString()
                .replace(/[^a-zA-Z0-9_-]/g, '-');


            const options = {

                margin: 0,

                filename:
                    'Employee-Information-' +
                    safeEmployeeId +
                    '.pdf',

                image: {
                    type: 'jpeg',
                    quality: 0.98
                },

                html2canvas: {

                    scale: 2,

                    useCORS: true,

                    backgroundColor: '#ffffff',

                    scrollX: 0,

                    scrollY: 0

                },

                jsPDF: {

                    unit: 'mm',

                    format: 'a4',

                    orientation: 'portrait'

                }

            };


            html2pdf()

                .set(options)

                .from(documentElement)

                .save();

        }

    </script>

@endsection
