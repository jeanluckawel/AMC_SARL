@extends('layouts.admin')

@section('title', __('menu.pay_page_title'))

@section('content')

    @php
        use App\Enums\PayrollMonth;

        $fullName = trim(($employee->first_name ?? '') . ' ' . ($employee->middle_name ?? '') . ' ' . ($employee->last_name ?? ''));

        $salary     = $employee->salary;
        $currency   = $salary?->currency ?? 'CDF';
        $baseSalary = (float) ($salary?->base_salary ?? 0);
        $category   = $salary?->category ?? 'N/A';
        $echelon    = $salary?->echelon ?? 'N/A';

        $payrollMonth = PayrollMonth::tryFrom((int) $month);
        $monthLabel   = $payrollMonth
            ? (app()->getLocale() === 'fr' ? $payrollMonth->labelFr() : $payrollMonth->label())
            : $month;
        $periodLabel  = $monthLabel . ' ' . $year;
        $indexUrl     = route('payroll.index', ['year' => $year, 'month' => $month]);

        // Taux de change automatique USD -> CDF
        $exchange = \Illuminate\Support\Facades\Cache::remember('usd_cdf_rate', now()->addHours(12), function () {
            try {
                $response = \Illuminate\Support\Facades\Http::timeout(5)->get('https://open.er-api.com/v6/latest/USD');

                if ($response->successful() && $response->json('result') === 'success' && $response->json('rates.CDF')) {
                    $data = ['rate' => round((float) $response->json('rates.CDF'), 2)];
                    \Illuminate\Support\Facades\Cache::forever('usd_cdf_rate_last', $data);
                    return $data;
                }
            } catch (\Throwable $e) {

            }

            return null;
        });

        $exchange = $exchange ?? \Illuminate\Support\Facades\Cache::get('usd_cdf_rate_last');
        $autoRate = $exchange['rate'] ?? 1;

        // Valeurs fixes issues de la fiche salariale
        $fixedAllowances = (float) ($salary?->housing_allowance ?? 0)
            + (float) ($salary?->transport_allowance ?? 0)
            + (float) ($salary?->meal_allowance ?? 0)
            + (float) ($salary?->family_allowance ?? 0)
            + (float) ($salary?->medical_allowance ?? 0)
            + (float) ($salary?->other_non_taxable_allowances ?? 0)
            + (float) ($salary?->other_taxable_allowances ?? 0);

        $fixedDeductions = (float) ($salary?->cnss_employee ?? 0)
            + (float) ($salary?->syndicate_deduction ?? 0);

        // Mêmes constantes que le controller
        $standardDays = 26;
        $hoursPerDay  = 8;
        $overtimeRate = 1.3;
    @endphp

    <style>

        .employee-card {
            border: 0;
            border-radius: 0 !important;
        }

        .employee-card-wrapper {
            margin: 24px;
        }

        .form-control,
        .form-select,
        .btn {
            border-radius: 0 !important;
        }

        .form-control,
        .form-select {
            min-height: 44px;
        }

        textarea.form-control {
            min-height: 80px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #FF6600;
            box-shadow: 0 0 0 .15rem rgba(255, 102, 0, .15);
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .step-title {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 12px;
            margin-bottom: 25px;
        }

        .step-title h5 {
            margin-bottom: 4px;
            font-weight: 600;
        }

        .validation-summary {
            border-radius: 0 !important;
        }

        .btn-orange {
            background-color: #FF6600;
            border-color: #FF6600;
            color: #fff;
        }

        .btn-orange:hover {
            background-color: #e65c00;
            border-color: #e65c00;
            color: #fff;
        }

        .info-item small {
            display: block;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: #6c757d;
        }

        .info-item strong {
            font-size: 15px;
        }

        .info-item .period {
            color: #FF6600;
        }

        @media (min-width: 992px) {

            .half-left {
                border-right: 1px solid #dee2e6;
                padding-right: 28px;
            }

            .half-right {
                padding-left: 28px;
            }
        }

        .half-left .form-label {
            font-size: 13px;
        }

        .summary-box {
            background: #f8f9fa;
            padding: 20px;
            margin-top: 30px;
        }

        .summary-item small {
            display: block;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: #6c757d;
        }

        .summary-value {
            font-size: 22px;
            font-weight: 700;
        }

        @media (max-width: 768px) {

            .employee-card-wrapper {
                margin: 10px !important;
            }

            .app-content-header .breadcrumb {
                float: none !important;
            }

            .pay-actions {
                flex-direction: column-reverse;
                gap: 10px;
            }

            .pay-actions .btn {
                width: 100%;
            }
        }

    </style>

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">

                <div class="col-md-6 col-12">
                    <h3 class="mb-0">{{ __('menu.pay_title') }}</h3>
                </div>

                <div class="col-md-6 col-12">
                    <ol class="breadcrumb float-md-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('menu.pay_home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ $indexUrl }}">{{ __('menu.payroll') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('menu.pay_title') }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="card employee-card employee-card-wrapper shadow-sm">

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger validation-summary" role="alert">
                    <div class="fw-bold mb-2">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ __('menu.pay_correct_errors') }}
                    </div>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Infos employé (lecture seule) --}}
            <div class="row g-3 mb-4">

                <div class="col-6 col-md-4 info-item">
                    <small>{{ __('menu.pay_employee') }}</small>
                    <strong>{{ $fullName ?: 'N/A' }}</strong>
                </div>

                <div class="col-6 col-md-4 info-item">
                    <small>{{ __('menu.pay_matricule') }}</small>
                    <strong>{{ $employee->employee_id ?? 'N/A' }}</strong>
                </div>

                <div class="col-6 col-md-4 info-item">
                    <small>{{ __('menu.pay_period') }}</small>
                    <strong class="period">{{ $periodLabel }}</strong>
                </div>

                <div class="col-6 col-md-4 info-item">
                    <small>{{ __('menu.pay_department') }}</small>
                    <strong>{{ $employee->department?->name ?? 'N/A' }}</strong>
                </div>

                <div class="col-6 col-md-4 info-item">
                    <small>{{ __('menu.pay_job_title') }}</small>
                    <strong>{{ $employee->jobTitle?->name ?? 'N/A' }}</strong>
                </div>

                <div class="col-6 col-md-4 info-item">
                    <small>{{ __('menu.pay_category_echelon') }}</small>
                    <strong>{{ $category }} / {{ $echelon }} / {{ number_format($baseSalary, 2) }} {{ $currency }}</strong>
                </div>

            </div>

            <form action="{{ route('payroll.store') }}" method="POST" id="payrollForm" autocomplete="off">

                @csrf

                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                <input type="hidden" name="year" value="{{ $year }}">
                <input type="hidden" name="month" value="{{ $month }}">

                <div class="row g-4">

                    {{-- Gains : saisies variables --}}
                    <div class="col-lg-7 col-12 half-left">

                        <div class="step-title">
                            <h5>
                                <i class="bi bi-plus-circle me-2 text-success"></i>
                                {{ __('menu.pay_gains') }}
                            </h5>
                        </div>

                        <div class="row g-3">

                            <div class="col-6 col-md-4">
                                <label class="form-label">
                                    {{ __('menu.pay_days_worked') }} <span class="text-danger">*</span>
                                </label>
                                <select name="days_worked" id="days_worked"
                                        class="form-select @error('days_worked') is-invalid @enderror" required>
                                    @for($i = 1; $i <= $standardDays; $i++)
                                        <option value="{{ $i }}" {{ (int) old('days_worked', $standardDays) === $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('days_worked')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6 col-md-4">
                                <label class="form-label">{{ __('menu.pay_sick_days') }}</label>
                                <input type="number" name="sick_days" id="sick_days"
                                       class="form-control @error('sick_days') is-invalid @enderror"
                                       value="{{ old('sick_days', 0) }}"
                                       min="0" max="31" step="0.5" autocomplete="off">
                                @error('sick_days')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6 col-md-4">
                                <label class="form-label">{{ __('menu.pay_overtime_hours') }}</label>
                                <input type="number" name="overtime_hours" id="overtime_hours"
                                       class="form-control @error('overtime_hours') is-invalid @enderror"
                                       value="{{ old('overtime_hours', 0) }}"
                                       min="0" step="0.1" autocomplete="off">
                                @error('overtime_hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6 col-md-4">
                                <label class="form-label">{{ __('menu.pay_bonus') }}</label>
                                <input type="number" name="bonus" id="bonus"
                                       class="form-control @error('bonus') is-invalid @enderror"
                                       value="{{ old('bonus', 0) }}"
                                       min="0" step="0.01" autocomplete="off">
                                @error('bonus')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6 col-md-4">
                                <label class="form-label">{{ __('menu.pay_exchange_rate') }}</label>
                                <input type="number" name="exchange_rate" id="exchange_rate"
                                       class="form-control @error('exchange_rate') is-invalid @enderror"
                                       value="{{ old('exchange_rate', $autoRate) }}"
                                       min="0" step="0.0001" autocomplete="off">
                                @error('exchange_rate')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <small class="text-muted d-block mt-1" style="font-size: 11px;">
                                    1 USD = {{ number_format($autoRate, 2) }} CDF
                                    &middot;
                                    <a href="#" id="resetRate" data-rate="{{ $autoRate }}">{{ __('menu.pay_rate_auto') }}</a>
                                    &middot;
                                    <a href="https://www.exchangerate-api.com" target="_blank" rel="noopener" class="text-muted">exchangerate-api.com</a>
                                </small>
                            </div>

                        </div>

                    </div>

                    {{-- Retenues : saisies variables --}}
                    <div class="col-lg-5 col-12 half-right">

                        <div class="step-title">
                            <h5>
                                <i class="bi bi-dash-circle me-2 text-danger"></i>
                                {{ __('menu.pay_deductions') }}
                            </h5>
                        </div>

                        <div class="row g-3">

                            @foreach([
                                'salary_advances'  => 'pay_salary_advances',
                                'other_deductions' => 'pay_other_deductions',
                            ] as $name => $label)

                                <div class="col-12 col-md-4">
                                    <label class="form-label">{{ __('menu.' . $label) }}</label>
                                    <input type="number" name="{{ $name }}" id="{{ $name }}"
                                           class="form-control @error($name) is-invalid @enderror"
                                           value="{{ old($name, 0) }}"
                                           min="0" step="0.01" autocomplete="off">
                                    @error($name)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                {{-- Récapitulatif (aperçu ; le serveur recalcule tout) --}}
                <div class="summary-box">

                    <div class="row g-3 text-center">

                        <div class="col-12 col-md-4 summary-item">
                            <small>{{ __('menu.pay_gross_salary') }}</small>
                            <div class="summary-value" id="gross_text">0.00 {{ $currency }}</div>
                        </div>

                        <div class="col-12 col-md-4 summary-item">
                            <small>{{ __('menu.pay_total_deductions') }}</small>
                            <div class="summary-value text-danger" id="deductions_text">0.00 {{ $currency }}</div>
                        </div>

                        <div class="col-12 col-md-4 summary-item">
                            <small>{{ __('menu.pay_net_salary') }}</small>
                            <div class="summary-value text-success" id="net_text">0.00 {{ $currency }}</div>
                        </div>

                        <div class="col-12 text-start">
                            <label class="form-label">{{ __('menu.pay_remarks') }}</label>
                            <textarea
                                name="remarks"
                                rows="2"
                                class="form-control @error('remarks') is-invalid @enderror"
                                placeholder="{{ __('menu.pay_remarks') }}"
                                autocomplete="off"
                                spellcheck="false"
                            >{{ old('remarks') }}</textarea>
                            @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                </div>

                <div class="d-flex justify-content-between mt-4 pt-3 border-top pay-actions">

                    <a href="{{ $indexUrl }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>
                        {{ __('menu.pay_cancel') }}
                    </a>

                    <button type="submit" class="btn btn-orange" id="saveBtn">

                        <span class="spinner-border spinner-border-sm d-none" id="saveSpinner" role="status" aria-hidden="true"></span>

                        <span id="saveText">
                            <i class="bi bi-cash-stack me-1"></i>
                            {{ __('menu.pay_submit') }}
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const form     = document.getElementById('payrollForm');
            const currency = @json($currency);

            const BASE             = @json($baseSalary);
            const FIXED_ALLOWANCES = @json($fixedAllowances);
            const FIXED_DEDUCTIONS = @json($fixedDeductions);
            const STANDARD_DAYS    = @json($standardDays);
            const HOURS_PER_DAY    = @json($hoursPerDay);
            const OVERTIME_RATE    = @json($overtimeRate);

            const val = function (id) {
                return parseFloat(document.getElementById(id).value) || 0;
            };

            function calculate() {
                const dailyRate  = BASE / STANDARD_DAYS;
                const hourlyRate = dailyRate / HOURS_PER_DAY;

                const basic    = dailyRate * val('days_worked');
                const overtime = val('overtime_hours') * hourlyRate * OVERTIME_RATE;

                const g = basic + overtime + val('bonus') + FIXED_ALLOWANCES;
                const d = FIXED_DEDUCTIONS + val('ipr') + val('salary_advances') + val('other_deductions');
                const n = g - d;

                document.getElementById('gross_text').textContent      = g.toFixed(2) + ' ' + currency;
                document.getElementById('deductions_text').textContent = d.toFixed(2) + ' ' + currency;

                const netText = document.getElementById('net_text');
                netText.textContent = n.toFixed(2) + ' ' + currency;
                netText.classList.toggle('text-success', n >= 0);
                netText.classList.toggle('text-danger', n < 0);
            }

            form.querySelectorAll('input[type="number"], select').forEach(function (field) {
                field.addEventListener('input', calculate);
                field.addEventListener('change', calculate);
            });

            calculate();

            const resetRate = document.getElementById('resetRate');

            if (resetRate) {
                resetRate.addEventListener('click', function (event) {
                    event.preventDefault();
                    document.getElementById('exchange_rate').value = this.dataset.rate;
                });
            }

            form.querySelectorAll('input, textarea, select').forEach(function (field) {
                field.addEventListener('input', function () {
                    if (this.checkValidity()) this.classList.remove('is-invalid');
                });
            });

            form.addEventListener('submit', function (event) {

                if (!form.checkValidity()) {

                    event.preventDefault();

                    form.querySelectorAll(':invalid').forEach(function (field) {
                        field.classList.add('is-invalid');
                    });

                    form.querySelector(':invalid').focus();
                    return;
                }

                document.getElementById('saveBtn').disabled = true;
                document.getElementById('saveSpinner').classList.remove('d-none');
                document.getElementById('saveText').textContent = @json(__('menu.pay_saving'));
            });

        });

    </script>

@endsection
