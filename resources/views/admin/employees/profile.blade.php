@extends('layouts.admin')

@section('content')

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 col-12">
                    <h3 class="mb-0">Profil Employé</h3>
                </div>
                <div class="col-md-6 col-12">
                    <ol class="breadcrumb float-md-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('employees.index') }}">Employés</a>
                        </li>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            {{-- =====================================================
                EN-TÊTE PROFIL
            ====================================================== --}}

            <div class="card shadow-sm mb-3 profile-header-card">
                <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-3">

                    <div class="d-flex align-items-center">

                        @if($employee->photo)
                            <img
                                src="{{ asset('storage/' . $employee->photo) }}"
                                class="profile-avatar-img me-3"
                                alt="Photo"
                            >
                        @else
                            <div class="profile-avatar me-3">
                                {{ strtoupper(substr($employee->first_name, 0, 1) . substr($employee->last_name, 0, 1)) }}
                            </div>
                        @endif

                        <div>
                            <h4 class="mb-0">
                                {{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }}
                            </h4>
                            <span class="text-muted">
                                {{ $employee->jobTitle->name ?? 'Aucun poste assigné' }}
                            </span>
                        </div>

                    </div>

                    <span class="badge employee-type-badge">
                        {{ $employee->employee_type?->label() ?? 'Type non défini' }}
                    </span>

                </div>
            </div>

            {{-- =====================================================
                ONGLETS
            ====================================================== --}}

            <ul class="nav nav-tabs mb-3" id="profileTabs">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#infos">
                        Informations générales
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#contact">
                        Coordonnées
                    </button>
                </li>
            </ul>

            <div class="tab-content">

                {{-- =================================================
                    ONGLET 1 : INFORMATIONS GÉNÉRALES
                ================================================== --}}

                <div class="tab-pane fade show active" id="infos">
                    <div class="row g-3">

                        {{-- Colonne gauche : infos de base --}}
                        <div class="col-lg-6">
                            <div class="card shadow-sm profile-card h-100">
                                <div class="card-body">
                                    <h6 class="section-title">Informations de base</h6>

                                    <div class="info-row">
                                        <span>Genre</span>
                                        <strong>{{ $employee->gender?->label() ?? '-' }}</strong>
                                    </div>
                                    <div class="info-row">
                                        <span>Date de naissance</span>
                                        <strong>{{ $employee->date_of_birth?->format('d/m/Y') ?? '-' }}</strong>
                                    </div>
                                    <div class="info-row">
                                        <span>Etat civil</span>
                                        <strong>{{ $employee->marital_status?->label() ?? '-' }}</strong>
                                    </div>
                                    <div class="info-row">
                                        <span>Pays</span>
                                        <strong>{{ $employee->country ?? '-' }}</strong>
                                    </div>
                                    <div class="info-row">
                                        <span>N° Carte</span>
                                        <strong>{{ $employee->number_card ?? '-' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Colonne droite : infos professionnelles --}}
                        <div class="col-lg-6">
                            <div class="card shadow-sm profile-card h-100">
                                <div class="card-body">
                                    <h6 class="section-title">Informations professionnelles</h6>

                                    <div class="info-row">
                                        <span>Département</span>
                                        <strong>{{ $employee->department->name ?? '-' }}</strong>
                                    </div>
                                    <div class="info-row">
                                        <span>Section</span>
                                        <strong>{{ $employee->section->name ?? '-' }}</strong>
                                    </div>
                                    <div class="info-row">
                                        <span>Type de contrat</span>
                                        <strong>{{ $employee->contract_type?->label() ?? '-' }}</strong>
                                    </div>
                                    <div class="info-row">
                                        <span>Lieu de travail</span>
                                        <strong>{{ $employee->work_location?->label() ?? '-' }}</strong>
                                    </div>
                                    <div class="info-row">
                                        <span>Superviseur</span>
                                        <strong>{{ $employee->supervisor ?? '-' }}</strong>
                                    </div>
                                    <div class="info-row">
                                        <span>Fin de contrat</span>
                                        <strong>{{ $employee->end_contract_date?->format('d/m/Y') ?? '-' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bloc Identifiants (façon "Person IDs") --}}
                        <div class="col-12">
                            <div class="card shadow-sm profile-card">
                                <div class="card-body">
                                    <h6 class="section-title">Identifiants</h6>

                                    <div class="info-row">
                                        <span>Matricule</span>
                                        <strong>{{ $employee->employee_id ?? '-' }}</strong>
                                    </div>
{{--                                    <div class="info-row">--}}
{{--                                        <span>ID Interne</span>--}}
{{--                                        <strong>{{ $employee->id }}</strong>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- =================================================
                    ONGLET 2 : COORDONNÉES
                ================================================== --}}

                <div class="tab-pane fade" id="contact">
                    <div class="card shadow-sm profile-card">
                        <div class="card-body">
                            <h6 class="section-title">Coordonnées</h6>

                            <div class="info-row">
                                <span>Téléphone</span>
                                <strong>{{ $employee->employee_phone ?? '-' }}</strong>
                            </div>
                            <div class="info-row">
                                <span>Téléphone bureau</span>
                                <strong>{{ $employee->employee_work_phone ?? '-' }}</strong>
                            </div>
                            <div class="info-row">
                                <span>Email</span>
                                <strong>{{ $employee->employee_email ?? '-' }}</strong>
                            </div>
                            <div class="info-row">
                                <span>Adresse</span>
                                <strong>{{ $employee->employee_address ?? '-' }}</strong>
                            </div>

                            @if($employee->spouse_status)
                                <hr class="my-3">
                                <h6 class="section-title">Conjoint(e)</h6>

                                <div class="info-row">
                                    <span>Nom</span>
                                    <strong>{{ $employee->spouse_full_name ?? '-' }}</strong>
                                </div>
                                <div class="info-row">
                                    <span>Téléphone</span>
                                    <strong>{{ $employee->spouse_phone ?? '-' }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- =====================================================
        CSS
    ====================================================== --}}

    <style>

        .profile-header-card {
            border-radius: 0 !important;
            border: 1px solid #dee2e6;
        }

        .profile-avatar,
        .profile-avatar-img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
        }

        .profile-avatar {
            background: #FFE9DA;
            color: #FF6600;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 22px;
        }

        .profile-avatar-img {
            object-fit: cover;
            border: 1px solid #dee2e6;
        }

        .employee-type-badge {
            background: #FF6600 !important;
            color: #fff;
            border-radius: 0 !important;
            padding: 7px 12px;
            font-weight: 500;
        }

        .profile-card {
            border-radius: 0 !important;
            border: 1px solid #dee2e6;
        }

        .section-title {
            font-weight: 600;
            color: #212529;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .nav-tabs .nav-link.active {
            border-color: #FF6600 #FF6600 #fff;
            color: #FF6600;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .profile-header-card .card-body {
                flex-direction: column;
                align-items: flex-start !important;
            }
        }

    </style>

@endsection
