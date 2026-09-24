@extends('layouts.admin')

@section('content')

    @php
        use App\Enums\PayrollMonth;

        /*
        |--------------------------------------------------------------------------
        | EMPLOYEE INFORMATION
        |--------------------------------------------------------------------------
        */

        $fullName = trim(
            ($employee->first_name ?? '') . ' ' .
            ($employee->middle_name ?? '') . ' ' .
            ($employee->last_name ?? '')
        );

        /*
        |--------------------------------------------------------------------------
        | SALARY INFORMATION
        |--------------------------------------------------------------------------
        */

        $salary = $employee->salary;

        $currency = $salary?->currency ?? 'CDF';

        $baseSalary = (float) ($salary?->base_salary ?? 0);

        $category = $salary?->category ?? 'N/A';

        $echelon = $salary?->echelon ?? 'N/A';

        /*
        |--------------------------------------------------------------------------
        | PAYROLL PERIOD
        |--------------------------------------------------------------------------
        */

        $payrollMonth = PayrollMonth::tryFrom((int) $month);

        $monthLabel = $payrollMonth
            ? (
                app()->getLocale() === 'fr'
                    ? $payrollMonth->labelFr()
                    : $payrollMonth->label()
            )
            : $month;

        $periodLabel = $monthLabel . ' ' . $year;
    @endphp


    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="app-content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6 col-12">

                    <h3 class="mb-0">
                        Pay Employee
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

                            <a
                                href="{{ route('payroll.index', [
                                    'year' => $year,
                                    'month' => $month,
                                ]) }}"
                            >
                                Payroll
                            </a>

                        </li>


                        <li class="breadcrumb-item active">

                            Pay Employee

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        PAGE CONTENT
    ========================================================== --}}

    <div class="app-content">

        <div class="container-fluid">

            <form
                action="{{ route('payroll.store') }}"
                method="POST"
            >

                @csrf


                {{-- =================================================
                    HIDDEN DATA
                ================================================== --}}

                <input
                    type="hidden"
                    name="employee_id"
                    value="{{ $employee->id }}"
                >

                <input
                    type="hidden"
                    name="year"
                    value="{{ $year }}"
                >

                <input
                    type="hidden"
                    name="month"
                    value="{{ $month }}"
                >

                <input
                    type="hidden"
                    name="currency"
                    value="{{ old('currency', $currency) }}"
                >


                {{-- =================================================
                    PAYROLL EMPLOYEE INFORMATION
                ================================================== --}}

                <div class="card shadow-sm payroll-card mb-3">

                    <div class="card-header payroll-header">

                        <div>

                            <i class="bi bi-person-badge me-2"></i>

                            Payroll Employee Information

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="row align-items-start">


                            {{-- =================================================
                                PHOTO
                            ================================================== --}}

                            <div class="col-md-2 text-center mb-3 mb-md-0">

                                <div class="employee-photo-box">

                                    @if($employee->photo)

                                        <img
                                            src="{{ asset('storage/' . $employee->photo) }}"
                                            alt="Photo de {{ $fullName }}"
                                            class="employee-photo"
                                        >

                                    @else

                                        <div class="employee-photo-default">

                                            <i class="bi bi-person-fill"></i>

                                        </div>

                                    @endif

                                </div>

                            </div>


                            {{-- =================================================
                                PAYROLL INFORMATION
                            ================================================== --}}

                            <div class="col-md-10">

                                <div class="table-responsive">

                                    <table
                                        class="table table-bordered table-sm mb-0 employee-info-table"
                                    >

                                        <tbody>


                                        {{-- =================================================
                                            EMPLOYEE
                                        ================================================== --}}

                                        <tr class="table-section">

                                            <th colspan="4">

                                                <i class="bi bi-person me-1"></i>

                                                Employee

                                            </th>

                                        </tr>


                                        <tr>

                                            <td>
                                                Employee
                                            </td>

                                            <td>
                                                {{ $fullName ?: 'N/A' }}
                                            </td>

                                            <td>
                                                Matricule
                                            </td>

                                            <td>
                                                {{ $employee->employee_id ?? 'N/A' }}
                                            </td>

                                        </tr>


                                        <tr>

                                            <td>
                                                Department
                                            </td>

                                            <td>
                                                {{ $employee->department?->name ?? 'N/A' }}
                                            </td>

                                            <td>
                                                Job Title
                                            </td>

                                            <td>
                                                {{ $employee->jobTitle?->name ?? 'N/A' }}
                                            </td>

                                        </tr>


                                        {{-- =================================================
                                            SALARY
                                        ================================================== --}}

                                        <tr class="table-section">

                                            <th colspan="4">

                                                <i class="bi bi-wallet2 me-1"></i>

                                                Salary

                                            </th>

                                        </tr>


                                        <tr>

                                            <td>
                                                Basic Salary
                                            </td>

                                            <td>

                                                <strong>

                                                    {{ number_format($baseSalary, 2) }}

                                                    {{ $currency }}

                                                </strong>

                                            </td>

                                            <td>
                                                Currency
                                            </td>

                                            <td>
                                                {{ $currency }}
                                            </td>

                                        </tr>


                                        <tr>

                                            <td>
                                                Category
                                            </td>

                                            <td>
                                                {{ $category }}
                                            </td>

                                            <td>
                                                Echelon
                                            </td>

                                            <td>
                                                {{ $echelon }}
                                            </td>

                                        </tr>


                                        {{-- =================================================
                                            PAYROLL PERIOD
                                        ================================================== --}}

                                        <tr class="table-section">

                                            <th colspan="4">

                                                <i class="bi bi-calendar3 me-1"></i>

                                                Payroll Period

                                            </th>

                                        </tr>


                                        <tr>

                                            <td>
                                                Year
                                            </td>

                                            <td>
                                                {{ $year }}
                                            </td>

                                            <td>
                                                Month
                                            </td>

                                            <td>
                                                {{ $monthLabel }}
                                            </td>

                                        </tr>


                                        <tr>

                                            <td>
                                                Payment Period
                                            </td>

                                            <td colspan="3">

                                                <strong class="payroll-period-value">

                                                    {{ $periodLabel }}

                                                </strong>

                                            </td>

                                        </tr>


                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    EARNINGS + DEDUCTIONS
                ================================================== --}}

                <div class="row g-3 mb-3">


                    {{-- =================================================
                        EARNINGS
                    ================================================== --}}

                    <div class="col-lg-6 col-12">

                        <div class="card shadow-sm payroll-card h-100">

                            <div class="card-header payroll-header">

                                <div>

                                    <i class="bi bi-plus-circle me-2"></i>

                                    Earnings

                                </div>

                            </div>


                            <div class="card-body">

                                <div class="row g-3">


                                    {{-- BASIC SALARY --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Basic Salary
                                        </label>

                                        <input
                                            type="number"
                                            name="basic_salary"
                                            id="basic_salary"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('basic_salary', $baseSalary) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- DAYS WORKED --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Days Worked
                                        </label>

                                        <input
                                            type="number"
                                            name="days_worked"
                                            id="days_worked"
                                            step="0.1"
                                            min="0"
                                            max="31"
                                            value="{{ old('days_worked', 26) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- HOUSING --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Housing Allowance
                                        </label>

                                        <input
                                            type="number"
                                            name="housing_allowance"
                                            id="housing_allowance"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('housing_allowance', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- TRANSPORT --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Transport Allowance
                                        </label>

                                        <input
                                            type="number"
                                            name="transport_allowance"
                                            id="transport_allowance"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('transport_allowance', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- MEAL --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Meal Allowance
                                        </label>

                                        <input
                                            type="number"
                                            name="meal_allowance"
                                            id="meal_allowance"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('meal_allowance', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- FAMILY --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Family Allowance
                                        </label>

                                        <input
                                            type="number"
                                            name="family_allowance"
                                            id="family_allowance"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('family_allowance', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- MEDICAL --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Medical Allowance
                                        </label>

                                        <input
                                            type="number"
                                            name="medical_allowance"
                                            id="medical_allowance"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('medical_allowance', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- OTHER NON TAXABLE --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Other Non-Taxable Allowances
                                        </label>

                                        <input
                                            type="number"
                                            name="other_non_taxable_allowances"
                                            id="other_non_taxable_allowances"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('other_non_taxable_allowances', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- OTHER TAXABLE --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Other Taxable Allowances
                                        </label>

                                        <input
                                            type="number"
                                            name="other_taxable_allowances"
                                            id="other_taxable_allowances"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('other_taxable_allowances', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- BONUS --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Bonus
                                        </label>

                                        <input
                                            type="number"
                                            name="bonus"
                                            id="bonus"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('bonus', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- OVERTIME HOURS --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Overtime Hours
                                        </label>

                                        <input
                                            type="number"
                                            name="overtime_hours"
                                            id="overtime_hours"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('overtime_hours', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- OVERTIME AMOUNT --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Overtime Amount
                                        </label>

                                        <input
                                            type="number"
                                            name="overtime_amount"
                                            id="overtime_amount"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('overtime_amount', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        DEDUCTIONS
                    ================================================== --}}

                    <div class="col-lg-6 col-12">

                        <div class="card shadow-sm payroll-card h-100">

                            <div class="card-header payroll-header">

                                <div>

                                    <i class="bi bi-dash-circle me-2"></i>

                                    Deductions

                                </div>

                            </div>


                            <div class="card-body">

                                <div class="row g-3">


                                    {{-- CNSS EMPLOYEE --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            CNSS Employee
                                        </label>

                                        <input
                                            type="number"
                                            name="cnss_employee"
                                            id="cnss_employee"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('cnss_employee', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- IPR --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            IPR
                                        </label>

                                        <input
                                            type="number"
                                            name="ipr"
                                            id="ipr"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('ipr', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- SALARY ADVANCES --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Salary Advances
                                        </label>

                                        <input
                                            type="number"
                                            name="salary_advances"
                                            id="salary_advances"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('salary_advances', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- SYNDICATE --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Syndicate Deduction
                                        </label>

                                        <input
                                            type="number"
                                            name="syndicate_deduction"
                                            id="syndicate_deduction"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('syndicate_deduction', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- OTHER DEDUCTIONS --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            Other Deductions
                                        </label>

                                        <input
                                            type="number"
                                            name="other_deductions"
                                            id="other_deductions"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('other_deductions', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>


                                    {{-- =================================================
                                        EMPLOYER CONTRIBUTIONS
                                    ================================================== --}}

                                    <div class="col-12">

                                        <hr class="my-2">

                                        <div class="small fw-bold text-muted">
                                            Employer Contributions
                                        </div>

                                    </div>


                                    {{-- CNSS EMPLOYER --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            CNSS Employer
                                        </label>

                                        <input
                                            type="number"
                                            name="cnss_employer"
                                            id="cnss_employer"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('cnss_employer', 0) }}"
                                            class="form-control employer-input"
                                        >

                                    </div>


                                    {{-- INPP --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            INPP Employer
                                        </label>

                                        <input
                                            type="number"
                                            name="inpp_employer"
                                            id="inpp_employer"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('inpp_employer', 0) }}"
                                            class="form-control employer-input"
                                        >

                                    </div>


                                    {{-- ONEM --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            ONEM Employer
                                        </label>

                                        <input
                                            type="number"
                                            name="onem_employer"
                                            id="onem_employer"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('onem_employer', 0) }}"
                                            class="form-control employer-input"
                                        >

                                    </div>


                                    {{-- IER --}}

                                    <div class="col-md-6 col-12">

                                        <label class="form-label">
                                            IER
                                        </label>

                                        <input
                                            type="number"
                                            name="ier"
                                            id="ier"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('ier', 0) }}"
                                            class="form-control payroll-input"
                                        >

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    PAYROLL SUMMARY
                ================================================== --}}

                <div class="card shadow-sm payroll-card mb-3">

                    <div class="card-header payroll-header">

                        <div>

                            <i class="bi bi-calculator me-2"></i>

                            Payroll Summary

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">


                            {{-- GROSS --}}

                            <div class="col-md-4 col-12">

                                <label class="form-label">
                                    Gross Salary
                                </label>

                                <input
                                    type="number"
                                    name="gross_salary"
                                    id="gross_salary"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('gross_salary', 0) }}"
                                    class="form-control summary-input"
                                    readonly
                                >

                            </div>


                            {{-- TOTAL DEDUCTIONS --}}

                            <div class="col-md-4 col-12">

                                <label class="form-label">
                                    Total Deductions
                                </label>

                                <input
                                    type="number"
                                    name="total_deductions"
                                    id="total_deductions"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('total_deductions', 0) }}"
                                    class="form-control summary-input"
                                    readonly
                                >

                            </div>


                            {{-- NET --}}

                            <div class="col-md-4 col-12">

                                <label class="form-label">
                                    Net Salary
                                </label>

                                <input
                                    type="number"
                                    name="net_salary"
                                    id="net_salary"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('net_salary', 0) }}"
                                    class="form-control summary-input net-salary"
                                    readonly
                                >

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    REMARKS
                ================================================== --}}

                <div class="card shadow-sm payroll-card mb-3">

                    <div class="card-header payroll-header">

                        <div>

                            <i class="bi bi-chat-left-text me-2"></i>

                            Remarks

                        </div>

                    </div>


                    <div class="card-body">

                        <textarea
                            name="remarks"
                            rows="3"
                            class="form-control"
                            placeholder="Remarks"
                        >{{ old('remarks') }}</textarea>

                    </div>

                </div>


                {{-- =================================================
                    ACTIONS
                ================================================== --}}

                <div class="payroll-form-actions">

                    <a
                        href="{{ route('payroll.index', [
                            'year' => $year,
                            'month' => $month,
                        ]) }}"
                        class="btn btn-secondary payroll-action-button"
                    >

                        <i class="bi bi-arrow-left me-1"></i>

                        Cancel

                    </a>


                    <button
                        type="submit"
                        class="btn btn-success payroll-action-button"
                    >

                        <i class="bi bi-cash-stack me-1"></i>

                        Pay Employee

                    </button>

                </div>


            </form>

        </div>

    </div>


    {{-- =========================================================
        CSS
    ========================================================== --}}

    <style>

        .payroll-card {

            border: 1px solid #dee2e6;

            border-radius: 0 !important;

        }


        .payroll-header {

            display: flex;

            align-items: center;

            background: #f8f9fa;

            color: #212529;

            font-weight: 600;

            padding: 12px 15px;

            border-radius: 0 !important;

        }


        /* =====================================================
           EMPLOYEE HEADER
        ====================================================== */

        .employee-photo-box {

            width: 128px;

            height: 160px;

            margin: 0 auto;

            border: 1px solid #dee2e6;

            background: #f8f9fa;

            display: flex;

            align-items: center;

            justify-content: center;

            overflow: hidden;

        }


        .employee-photo {

            width: 100%;

            height: 100%;

            object-fit: cover;

            display: block;

        }


        .employee-photo-default {

            width: 100%;

            height: 100%;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f1f1f1;

            color: #777;

            font-size: 42px;

        }


        .employee-info-table {

            width: 100%;

            font-size: 11px;

            table-layout: fixed;

        }


        .employee-info-table td,

        .employee-info-table th {

            padding: 7px 9px;

            vertical-align: middle;

        }


        .employee-info-table td:nth-child(odd) {

            width: 17%;

            font-weight: 600;

            background: #f8f9fa;

            color: #495057;

        }


        .employee-info-table td:nth-child(even) {

            width: 33%;

        }


        .employee-info-table .table-section th {

            background: #e9ecef;

            color: #212529;

            font-size: 11px;

            font-weight: 700;

            text-transform: uppercase;

        }


        .payroll-period-value {

            color: #0a9745;

            font-size: 12px;

        }


        /* =====================================================
           FORM
        ====================================================== */

        .form-label {

            font-size: 13px;

            font-weight: 600;

            margin-bottom: 6px;

            color: #343a40;

        }


        .form-control,

        .form-select {

            min-height: 38px;

            border-radius: 0 !important;

            font-size: 14px;

        }


        .form-control:focus,

        .form-select:focus {

            border-color: #FF6600;

            box-shadow:

                0 0 0 0.15rem

                rgba(255, 102, 0, .15);

        }


        .summary-input {

            background: #f8f9fa;

            font-weight: 700;

        }


        .net-salary {

            border-color: #0a9745;

            color: #0a9745;

            background: #f4faf6;

        }


        /* =====================================================
           ACTIONS
        ====================================================== */

        .payroll-form-actions {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 10px;

            margin-bottom: 20px;

        }


        .payroll-action-button {

            min-height: 40px;

            padding: 8px 18px;

            border-radius: 0 !important;

        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 768px) {

            .app-content-header .row {

                row-gap: 8px;

            }


            .app-content-header .breadcrumb {

                float: none !important;

            }


            .employee-photo-box {

                margin-bottom: 15px;

            }


            .employee-info-table {

                font-size: 10px;

            }


            .employee-info-table td,

            .employee-info-table th {

                padding: 6px;

            }


            .employee-info-table td:nth-child(odd) {

                width: 25%;

            }


            .employee-info-table td:nth-child(even) {

                width: 25%;

            }


            .payroll-form-actions {

                flex-direction: column;

                align-items: stretch;

            }


            .payroll-action-button {

                width: 100%;

            }

        }

    </style>


    {{-- =========================================================
        JAVASCRIPT
    ========================================================== --}}

    @push('scripts')

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                function () {

                    /*
                    |--------------------------------------------------------------------------
                    | EARNINGS
                    |--------------------------------------------------------------------------
                    */

                    const earningFields = [

                        'basic_salary',

                        'overtime_amount',

                        'bonus',

                        'other_taxable_allowances',

                        'housing_allowance',

                        'transport_allowance',

                        'meal_allowance',

                        'family_allowance',

                        'medical_allowance',

                        'other_non_taxable_allowances'

                    ];


                    /*
                    |--------------------------------------------------------------------------
                    | EMPLOYEE DEDUCTIONS
                    |--------------------------------------------------------------------------
                    */

                    const deductionFields = [

                        'cnss_employee',

                        'ipr',

                        'salary_advances',

                        'syndicate_deduction',

                        'other_deductions'

                    ];


                    function getValue(id) {

                        const element =
                            document.getElementById(id);

                        if (!element) {

                            return 0;

                        }


                        const value =
                            parseFloat(element.value);


                        return isNaN(value)
                            ? 0
                            : value;

                    }


                    function calculatePayroll() {

                        let gross = 0;

                        let deductions = 0;


                        /*
                        |--------------------------------------------------------------------------
                        | GROSS SALARY
                        |--------------------------------------------------------------------------
                        */

                        earningFields.forEach(
                            function (field) {

                                gross += getValue(field);

                            }
                        );


                        /*
                        |--------------------------------------------------------------------------
                        | TOTAL EMPLOYEE DEDUCTIONS
                        |--------------------------------------------------------------------------
                        */

                        deductionFields.forEach(
                            function (field) {

                                deductions += getValue(field);

                            }
                        );


                        /*
                        |--------------------------------------------------------------------------
                        | NET SALARY
                        |--------------------------------------------------------------------------
                        */

                        const net =
                            gross - deductions;


                        /*
                        |--------------------------------------------------------------------------
                        | DISPLAY RESULTS
                        |--------------------------------------------------------------------------
                        */

                        const grossElement =
                            document.getElementById(
                                'gross_salary'
                            );

                        const deductionsElement =
                            document.getElementById(
                                'total_deductions'
                            );

                        const netElement =
                            document.getElementById(
                                'net_salary'
                            );


                        if (grossElement) {

                            grossElement.value =
                                gross.toFixed(2);

                        }


                        if (deductionsElement) {

                            deductionsElement.value =
                                deductions.toFixed(2);

                        }


                        if (netElement) {

                            netElement.value =
                                net.toFixed(2);

                        }

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | RECALCULATE WHEN INPUT CHANGES
                    |--------------------------------------------------------------------------
                    */

                    document
                        .querySelectorAll(
                            '.payroll-input'
                        )
                        .forEach(
                            function (input) {

                                input.addEventListener(
                                    'input',
                                    calculatePayroll
                                );

                            }
                        );

                    calculatePayroll();

                }
            );

        </script>

    @endpush

@endsection
