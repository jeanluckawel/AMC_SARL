{{--@extends('layouts.admin')--}}

{{--@section('content')--}}

{{--    @php--}}
{{--        use App\Enums\PayrollMonth;--}}

{{--        /*--}}
{{--        |----------------------------------------------------------------------------}}
{{--        | EMPLOYEE INFORMATION--}}
{{--        |----------------------------------------------------------------------------}}
{{--        */--}}

{{--        $fullName = trim(--}}
{{--            ($employee->first_name ?? '') . ' ' .--}}
{{--            ($employee->middle_name ?? '') . ' ' .--}}
{{--            ($employee->last_name ?? '')--}}
{{--        );--}}

{{--        /*--}}
{{--        |----------------------------------------------------------------------------}}
{{--        | SALARY INFORMATION--}}
{{--        |----------------------------------------------------------------------------}}
{{--        */--}}

{{--        $salary = $employee->salary;--}}

{{--        $currency = $salary?->currency ?? 'CDF';--}}

{{--        $baseSalary = (float) ($salary?->base_salary ?? 0);--}}

{{--        $category = $salary?->category ?? 'N/A';--}}

{{--        $echelon = $salary?->echelon ?? 'N/A';--}}

{{--        /*--}}
{{--        |----------------------------------------------------------------------------}}
{{--        | PAYROLL PERIOD--}}
{{--        |----------------------------------------------------------------------------}}
{{--        */--}}

{{--        $payrollMonth = PayrollMonth::tryFrom((int) $month);--}}

{{--        $monthLabel = $payrollMonth--}}
{{--            ? (--}}
{{--                app()->getLocale() === 'fr'--}}
{{--                    ? $payrollMonth->labelFr()--}}
{{--                    : $payrollMonth->label()--}}
{{--            )--}}
{{--            : $month;--}}

{{--        $periodLabel = $monthLabel . ' ' . $year;--}}
{{--    @endphp--}}


{{--    --}}{{-- =========================================================--}}
{{--        PAGE HEADER--}}
{{--    ========================================================== --}}

{{--    <div class="app-content-header">--}}

{{--        <div class="container-fluid">--}}

{{--            <div class="row align-items-center">--}}

{{--                <div class="col-md-6 col-12">--}}

{{--                    <h3 class="mb-0">--}}
{{--                        Pay Employee--}}
{{--                    </h3>--}}

{{--                </div>--}}


{{--                <div class="col-md-6 col-12">--}}

{{--                    <ol class="breadcrumb float-md-end mb-0">--}}

{{--                        <li class="breadcrumb-item">--}}

{{--                            <a href="{{ url('/') }}">--}}
{{--                                Home--}}
{{--                            </a>--}}

{{--                        </li>--}}


{{--                        <li class="breadcrumb-item">--}}

{{--                            <a--}}
{{--                                href="{{ route('payroll.index', [--}}
{{--                                    'year' => $year,--}}
{{--                                    'month' => $month,--}}
{{--                                ]) }}"--}}
{{--                            >--}}
{{--                                Payroll--}}
{{--                            </a>--}}

{{--                        </li>--}}


{{--                        <li class="breadcrumb-item active">--}}

{{--                            Pay Employee--}}

{{--                        </li>--}}

{{--                    </ol>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}

{{--    </div>--}}


{{--    --}}{{-- =========================================================--}}
{{--        PAGE CONTENT--}}
{{--    ========================================================== --}}

{{--    <div class="app-content">--}}

{{--        <div class="container-fluid">--}}

{{--            <form--}}
{{--                action="{{ route('payroll.store') }}"--}}
{{--                method="POST"--}}
{{--            >--}}

{{--                @csrf--}}


{{--                --}}{{-- =================================================--}}
{{--                    HIDDEN DATA--}}
{{--                ================================================== --}}

{{--                <input--}}
{{--                    type="hidden"--}}
{{--                    name="employee_id"--}}
{{--                    value="{{ $employee->id }}"--}}
{{--                >--}}

{{--                <input--}}
{{--                    type="hidden"--}}
{{--                    name="year"--}}
{{--                    value="{{ $year }}"--}}
{{--                >--}}

{{--                <input--}}
{{--                    type="hidden"--}}
{{--                    name="month"--}}
{{--                    value="{{ $month }}"--}}
{{--                >--}}

{{--                <input--}}
{{--                    type="hidden"--}}
{{--                    name="currency"--}}
{{--                    value="{{ old('currency', $currency) }}"--}}
{{--                >--}}


{{--                --}}{{-- =================================================--}}
{{--                    PAYROLL EMPLOYEE INFORMATION--}}
{{--                ================================================== --}}

{{--                <div class="card shadow-sm payroll-card mb-3">--}}

{{--                    <div class="card-header payroll-header">--}}

{{--                        <div>--}}

{{--                            <i class="bi bi-person-badge me-2"></i>--}}

{{--                            Payroll Employee Information--}}

{{--                        </div>--}}

{{--                    </div>--}}


{{--                    <div class="card-body">--}}

{{--                        <div class="row align-items-start">--}}


{{--                            --}}{{-- =================================================--}}
{{--                                PHOTO--}}
{{--                            ================================================== --}}

{{--                            <div class="col-md-2 text-center mb-3 mb-md-0">--}}

{{--                                <div class="employee-photo-box">--}}

{{--                                    @if($employee->photo)--}}

{{--                                        <img--}}
{{--                                            src="{{ asset('storage/' . $employee->photo) }}"--}}
{{--                                            alt="Photo de {{ $fullName }}"--}}
{{--                                            class="employee-photo"--}}
{{--                                        >--}}

{{--                                    @else--}}

{{--                                        <div class="employee-photo-default">--}}

{{--                                            <i class="bi bi-person-fill"></i>--}}

{{--                                        </div>--}}

{{--                                    @endif--}}

{{--                                </div>--}}

{{--                            </div>--}}


{{--                            --}}{{-- =================================================--}}
{{--                                PAYROLL INFORMATION--}}
{{--                            ================================================== --}}

{{--                            <div class="col-md-10">--}}

{{--                                <div class="table-responsive">--}}

{{--                                    <table--}}
{{--                                        class="table table-bordered table-sm mb-0 employee-info-table"--}}
{{--                                    >--}}

{{--                                        <tbody>--}}


{{--                                        --}}{{-- =================================================--}}
{{--                                            EMPLOYEE--}}
{{--                                        ================================================== --}}

{{--                                        <tr class="table-section">--}}

{{--                                            <th colspan="4">--}}

{{--                                                <i class="bi bi-person me-1"></i>--}}

{{--                                                Employee--}}

{{--                                            </th>--}}

{{--                                        </tr>--}}


{{--                                        <tr>--}}

{{--                                            <td>--}}
{{--                                                Employee--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                {{ $fullName ?: 'N/A' }}--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                Matricule--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                {{ $employee->employee_id ?? 'N/A' }}--}}
{{--                                            </td>--}}

{{--                                        </tr>--}}


{{--                                        <tr>--}}

{{--                                            <td>--}}
{{--                                                Department--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                {{ $employee->department?->name ?? 'N/A' }}--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                Job Title--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                {{ $employee->jobTitle?->name ?? 'N/A' }}--}}
{{--                                            </td>--}}

{{--                                        </tr>--}}


{{--                                        --}}{{-- =================================================--}}
{{--                                            SALARY--}}
{{--                                        ================================================== --}}

{{--                                        <tr class="table-section">--}}

{{--                                            <th colspan="4">--}}

{{--                                                <i class="bi bi-wallet2 me-1"></i>--}}

{{--                                                Salary--}}

{{--                                            </th>--}}

{{--                                        </tr>--}}


{{--                                        <tr>--}}

{{--                                            <td>--}}
{{--                                                Basic Salary--}}
{{--                                            </td>--}}

{{--                                            <td>--}}

{{--                                                <strong>--}}

{{--                                                    {{ number_format($baseSalary, 2) }}--}}

{{--                                                    {{ $currency }}--}}

{{--                                                </strong>--}}

{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                Currency--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                {{ $currency }}--}}
{{--                                            </td>--}}

{{--                                        </tr>--}}


{{--                                        <tr>--}}

{{--                                            <td>--}}
{{--                                                Category--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                {{ $category }}--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                Echelon--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                {{ $echelon }}--}}
{{--                                            </td>--}}

{{--                                        </tr>--}}


{{--                                        --}}{{-- =================================================--}}
{{--                                            PAYROLL PERIOD--}}
{{--                                        ================================================== --}}

{{--                                        <tr class="table-section">--}}

{{--                                            <th colspan="4">--}}

{{--                                                <i class="bi bi-calendar3 me-1"></i>--}}

{{--                                                Payroll Period--}}

{{--                                            </th>--}}

{{--                                        </tr>--}}


{{--                                        <tr>--}}

{{--                                            <td>--}}
{{--                                                Year--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                {{ $year }}--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                Month--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                {{ $monthLabel }}--}}
{{--                                            </td>--}}

{{--                                        </tr>--}}


{{--                                        <tr>--}}

{{--                                            <td>--}}
{{--                                                Payment Period--}}
{{--                                            </td>--}}

{{--                                            <td colspan="3">--}}

{{--                                                <strong class="payroll-period-value">--}}

{{--                                                    {{ $periodLabel }}--}}

{{--                                                </strong>--}}

{{--                                            </td>--}}

{{--                                        </tr>--}}


{{--                                        </tbody>--}}

{{--                                    </table>--}}

{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}


{{--                --}}{{-- =================================================--}}
{{--                    EARNINGS + DEDUCTIONS--}}
{{--                ================================================== --}}

{{--                <div class="row g-3 mb-3">--}}


{{--                    --}}{{-- =================================================--}}
{{--                        EARNINGS--}}
{{--                    ================================================== --}}

{{--                    <div class="col-lg-6 col-12">--}}

{{--                        <div class="card shadow-sm payroll-card h-100">--}}

{{--                            <div class="card-header payroll-header">--}}

{{--                                <div>--}}

{{--                                    <i class="bi bi-plus-circle me-2"></i>--}}

{{--                                    Earnings--}}

{{--                                </div>--}}

{{--                            </div>--}}


{{--                            <div class="card-body">--}}

{{--                                <div class="row g-3">--}}


{{--                                    --}}{{-- BASIC SALARY --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Basic Salary--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="basic_salary"--}}
{{--                                            id="basic_salary"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('basic_salary', $baseSalary) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- DAYS WORKED --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Days Worked--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="days_worked"--}}
{{--                                            id="days_worked"--}}
{{--                                            step="0.1"--}}
{{--                                            min="0"--}}
{{--                                            max="31"--}}
{{--                                            value="{{ old('days_worked', 26) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- HOUSING --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Housing Allowance--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="housing_allowance"--}}
{{--                                            id="housing_allowance"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('housing_allowance', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- TRANSPORT --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Transport Allowance--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="transport_allowance"--}}
{{--                                            id="transport_allowance"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('transport_allowance', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- MEAL --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Meal Allowance--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="meal_allowance"--}}
{{--                                            id="meal_allowance"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('meal_allowance', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- FAMILY --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Family Allowance--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="family_allowance"--}}
{{--                                            id="family_allowance"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('family_allowance', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- MEDICAL --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Medical Allowance--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="medical_allowance"--}}
{{--                                            id="medical_allowance"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('medical_allowance', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- OTHER NON TAXABLE --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Other Non-Taxable Allowances--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="other_non_taxable_allowances"--}}
{{--                                            id="other_non_taxable_allowances"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('other_non_taxable_allowances', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- OTHER TAXABLE --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Other Taxable Allowances--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="other_taxable_allowances"--}}
{{--                                            id="other_taxable_allowances"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('other_taxable_allowances', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- BONUS --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Bonus--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="bonus"--}}
{{--                                            id="bonus"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('bonus', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- OVERTIME HOURS --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Overtime Hours--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="overtime_hours"--}}
{{--                                            id="overtime_hours"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('overtime_hours', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- OVERTIME AMOUNT --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Overtime Amount--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="overtime_amount"--}}
{{--                                            id="overtime_amount"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('overtime_amount', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}

{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}


{{--                    --}}{{-- =================================================--}}
{{--                        DEDUCTIONS--}}
{{--                    ================================================== --}}

{{--                    <div class="col-lg-6 col-12">--}}

{{--                        <div class="card shadow-sm payroll-card h-100">--}}

{{--                            <div class="card-header payroll-header">--}}

{{--                                <div>--}}

{{--                                    <i class="bi bi-dash-circle me-2"></i>--}}

{{--                                    Deductions--}}

{{--                                </div>--}}

{{--                            </div>--}}


{{--                            <div class="card-body">--}}

{{--                                <div class="row g-3">--}}


{{--                                    --}}{{-- CNSS EMPLOYEE --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            CNSS Employee--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="cnss_employee"--}}
{{--                                            id="cnss_employee"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('cnss_employee', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- IPR --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            IPR--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="ipr"--}}
{{--                                            id="ipr"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('ipr', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- SALARY ADVANCES --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Salary Advances--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="salary_advances"--}}
{{--                                            id="salary_advances"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('salary_advances', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- SYNDICATE --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Syndicate Deduction--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="syndicate_deduction"--}}
{{--                                            id="syndicate_deduction"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('syndicate_deduction', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- OTHER DEDUCTIONS --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            Other Deductions--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="other_deductions"--}}
{{--                                            id="other_deductions"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('other_deductions', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- =================================================--}}
{{--                                        EMPLOYER CONTRIBUTIONS--}}
{{--                                    ================================================== --}}

{{--                                    <div class="col-12">--}}

{{--                                        <hr class="my-2">--}}

{{--                                        <div class="small fw-bold text-muted">--}}
{{--                                            Employer Contributions--}}
{{--                                        </div>--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- CNSS EMPLOYER --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            CNSS Employer--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="cnss_employer"--}}
{{--                                            id="cnss_employer"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('cnss_employer', 0) }}"--}}
{{--                                            class="form-control employer-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- INPP --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            INPP Employer--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="inpp_employer"--}}
{{--                                            id="inpp_employer"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('inpp_employer', 0) }}"--}}
{{--                                            class="form-control employer-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- ONEM --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            ONEM Employer--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="onem_employer"--}}
{{--                                            id="onem_employer"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('onem_employer', 0) }}"--}}
{{--                                            class="form-control employer-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}


{{--                                    --}}{{-- IER --}}

{{--                                    <div class="col-md-6 col-12">--}}

{{--                                        <label class="form-label">--}}
{{--                                            IER--}}
{{--                                        </label>--}}

{{--                                        <input--}}
{{--                                            type="number"--}}
{{--                                            name="ier"--}}
{{--                                            id="ier"--}}
{{--                                            step="0.01"--}}
{{--                                            min="0"--}}
{{--                                            value="{{ old('ier', 0) }}"--}}
{{--                                            class="form-control payroll-input"--}}
{{--                                        >--}}

{{--                                    </div>--}}

{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}


{{--                --}}{{-- =================================================--}}
{{--                    PAYROLL SUMMARY--}}
{{--                ================================================== --}}

{{--                <div class="card shadow-sm payroll-card mb-3">--}}

{{--                    <div class="card-header payroll-header">--}}

{{--                        <div>--}}

{{--                            <i class="bi bi-calculator me-2"></i>--}}

{{--                            Payroll Summary--}}

{{--                        </div>--}}

{{--                    </div>--}}


{{--                    <div class="card-body">--}}

{{--                        <div class="row g-3">--}}


{{--                            --}}{{-- GROSS --}}

{{--                            <div class="col-md-4 col-12">--}}

{{--                                <label class="form-label">--}}
{{--                                    Gross Salary--}}
{{--                                </label>--}}

{{--                                <input--}}
{{--                                    type="number"--}}
{{--                                    name="gross_salary"--}}
{{--                                    id="gross_salary"--}}
{{--                                    step="0.01"--}}
{{--                                    min="0"--}}
{{--                                    value="{{ old('gross_salary', 0) }}"--}}
{{--                                    class="form-control summary-input"--}}
{{--                                    readonly--}}
{{--                                >--}}

{{--                            </div>--}}


{{--                            --}}{{-- TOTAL DEDUCTIONS --}}

{{--                            <div class="col-md-4 col-12">--}}

{{--                                <label class="form-label">--}}
{{--                                    Total Deductions--}}
{{--                                </label>--}}

{{--                                <input--}}
{{--                                    type="number"--}}
{{--                                    name="total_deductions"--}}
{{--                                    id="total_deductions"--}}
{{--                                    step="0.01"--}}
{{--                                    min="0"--}}
{{--                                    value="{{ old('total_deductions', 0) }}"--}}
{{--                                    class="form-control summary-input"--}}
{{--                                    readonly--}}
{{--                                >--}}

{{--                            </div>--}}


{{--                            --}}{{-- NET --}}

{{--                            <div class="col-md-4 col-12">--}}

{{--                                <label class="form-label">--}}
{{--                                    Net Salary--}}
{{--                                </label>--}}

{{--                                <input--}}
{{--                                    type="number"--}}
{{--                                    name="net_salary"--}}
{{--                                    id="net_salary"--}}
{{--                                    step="0.01"--}}
{{--                                    min="0"--}}
{{--                                    value="{{ old('net_salary', 0) }}"--}}
{{--                                    class="form-control summary-input net-salary"--}}
{{--                                    readonly--}}
{{--                                >--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}


{{--                --}}{{-- =================================================--}}
{{--                    REMARKS--}}
{{--                ================================================== --}}

{{--                <div class="card shadow-sm payroll-card mb-3">--}}

{{--                    <div class="card-header payroll-header">--}}

{{--                        <div>--}}

{{--                            <i class="bi bi-chat-left-text me-2"></i>--}}

{{--                            Remarks--}}

{{--                        </div>--}}

{{--                    </div>--}}


{{--                    <div class="card-body">--}}

{{--                        <textarea--}}
{{--                            name="remarks"--}}
{{--                            rows="3"--}}
{{--                            class="form-control"--}}
{{--                            placeholder="Remarks"--}}
{{--                        >{{ old('remarks') }}</textarea>--}}

{{--                    </div>--}}

{{--                </div>--}}


{{--                --}}{{-- =================================================--}}
{{--                    ACTIONS--}}
{{--                ================================================== --}}

{{--                <div class="payroll-form-actions">--}}

{{--                    <a--}}
{{--                        href="{{ route('payroll.index', [--}}
{{--                            'year' => $year,--}}
{{--                            'month' => $month,--}}
{{--                        ]) }}"--}}
{{--                        class="btn btn-secondary payroll-action-button"--}}
{{--                    >--}}

{{--                        <i class="bi bi-arrow-left me-1"></i>--}}

{{--                        Cancel--}}

{{--                    </a>--}}


{{--                    <button--}}
{{--                        type="submit"--}}
{{--                        class="btn btn-success payroll-action-button"--}}
{{--                    >--}}

{{--                        <i class="bi bi-cash-stack me-1"></i>--}}

{{--                        Pay Employee--}}

{{--                    </button>--}}

{{--                </div>--}}


{{--            </form>--}}

{{--        </div>--}}

{{--    </div>--}}


{{--    --}}{{-- =========================================================--}}
{{--        CSS--}}
{{--    ========================================================== --}}

{{--    <style>--}}

{{--        .payroll-card {--}}

{{--            border: 1px solid #dee2e6;--}}

{{--            border-radius: 0 !important;--}}

{{--        }--}}


{{--        .payroll-header {--}}

{{--            display: flex;--}}

{{--            align-items: center;--}}

{{--            background: #f8f9fa;--}}

{{--            color: #212529;--}}

{{--            font-weight: 600;--}}

{{--            padding: 12px 15px;--}}

{{--            border-radius: 0 !important;--}}

{{--        }--}}


{{--        /* =====================================================--}}
{{--           EMPLOYEE HEADER--}}
{{--        ====================================================== */--}}

{{--        .employee-photo-box {--}}

{{--            width: 128px;--}}

{{--            height: 160px;--}}

{{--            margin: 0 auto;--}}

{{--            border: 1px solid #dee2e6;--}}

{{--            background: #f8f9fa;--}}

{{--            display: flex;--}}

{{--            align-items: center;--}}

{{--            justify-content: center;--}}

{{--            overflow: hidden;--}}

{{--        }--}}


{{--        .employee-photo {--}}

{{--            width: 100%;--}}

{{--            height: 100%;--}}

{{--            object-fit: cover;--}}

{{--            display: block;--}}

{{--        }--}}


{{--        .employee-photo-default {--}}

{{--            width: 100%;--}}

{{--            height: 100%;--}}

{{--            display: flex;--}}

{{--            align-items: center;--}}

{{--            justify-content: center;--}}

{{--            background: #f1f1f1;--}}

{{--            color: #777;--}}

{{--            font-size: 42px;--}}

{{--        }--}}


{{--        .employee-info-table {--}}

{{--            width: 100%;--}}

{{--            font-size: 11px;--}}

{{--            table-layout: fixed;--}}

{{--        }--}}


{{--        .employee-info-table td,--}}

{{--        .employee-info-table th {--}}

{{--            padding: 7px 9px;--}}

{{--            vertical-align: middle;--}}

{{--        }--}}


{{--        .employee-info-table td:nth-child(odd) {--}}

{{--            width: 17%;--}}

{{--            font-weight: 600;--}}

{{--            background: #f8f9fa;--}}

{{--            color: #495057;--}}

{{--        }--}}


{{--        .employee-info-table td:nth-child(even) {--}}

{{--            width: 33%;--}}

{{--        }--}}


{{--        .employee-info-table .table-section th {--}}

{{--            background: #e9ecef;--}}

{{--            color: #212529;--}}

{{--            font-size: 11px;--}}

{{--            font-weight: 700;--}}

{{--            text-transform: uppercase;--}}

{{--        }--}}


{{--        .payroll-period-value {--}}

{{--            color: #0a9745;--}}

{{--            font-size: 12px;--}}

{{--        }--}}


{{--        /* =====================================================--}}
{{--           FORM--}}
{{--        ====================================================== */--}}

{{--        .form-label {--}}

{{--            font-size: 13px;--}}

{{--            font-weight: 600;--}}

{{--            margin-bottom: 6px;--}}

{{--            color: #343a40;--}}

{{--        }--}}


{{--        .form-control,--}}

{{--        .form-select {--}}

{{--            min-height: 38px;--}}

{{--            border-radius: 0 !important;--}}

{{--            font-size: 14px;--}}

{{--        }--}}


{{--        .form-control:focus,--}}

{{--        .form-select:focus {--}}

{{--            border-color: #FF6600;--}}

{{--            box-shadow:--}}

{{--                0 0 0 0.15rem--}}

{{--                rgba(255, 102, 0, .15);--}}

{{--        }--}}


{{--        .summary-input {--}}

{{--            background: #f8f9fa;--}}

{{--            font-weight: 700;--}}

{{--        }--}}


{{--        .net-salary {--}}

{{--            border-color: #0a9745;--}}

{{--            color: #0a9745;--}}

{{--            background: #f4faf6;--}}

{{--        }--}}


{{--        /* =====================================================--}}
{{--           ACTIONS--}}
{{--        ====================================================== */--}}

{{--        .payroll-form-actions {--}}

{{--            display: flex;--}}

{{--            align-items: center;--}}

{{--            justify-content: space-between;--}}

{{--            gap: 10px;--}}

{{--            margin-bottom: 20px;--}}

{{--        }--}}


{{--        .payroll-action-button {--}}

{{--            min-height: 40px;--}}

{{--            padding: 8px 18px;--}}

{{--            border-radius: 0 !important;--}}

{{--        }--}}


{{--        /* =====================================================--}}
{{--           RESPONSIVE--}}
{{--        ====================================================== */--}}

{{--        @media (max-width: 768px) {--}}

{{--            .app-content-header .row {--}}

{{--                row-gap: 8px;--}}

{{--            }--}}


{{--            .app-content-header .breadcrumb {--}}

{{--                float: none !important;--}}

{{--            }--}}


{{--            .employee-photo-box {--}}

{{--                margin-bottom: 15px;--}}

{{--            }--}}


{{--            .employee-info-table {--}}

{{--                font-size: 10px;--}}

{{--            }--}}


{{--            .employee-info-table td,--}}

{{--            .employee-info-table th {--}}

{{--                padding: 6px;--}}

{{--            }--}}


{{--            .employee-info-table td:nth-child(odd) {--}}

{{--                width: 25%;--}}

{{--            }--}}


{{--            .employee-info-table td:nth-child(even) {--}}

{{--                width: 25%;--}}

{{--            }--}}


{{--            .payroll-form-actions {--}}

{{--                flex-direction: column;--}}

{{--                align-items: stretch;--}}

{{--            }--}}


{{--            .payroll-action-button {--}}

{{--                width: 100%;--}}

{{--            }--}}

{{--        }--}}

{{--    </style>--}}


{{--    --}}{{-- =========================================================--}}
{{--        JAVASCRIPT--}}
{{--    ========================================================== --}}

{{--    @push('scripts')--}}

{{--        <script>--}}

{{--            document.addEventListener(--}}
{{--                'DOMContentLoaded',--}}
{{--                function () {--}}

{{--                    /*--}}
{{--                    |----------------------------------------------------------------------------}}
{{--                    | EARNINGS--}}
{{--                    |----------------------------------------------------------------------------}}
{{--                    */--}}

{{--                    const earningFields = [--}}

{{--                        'basic_salary',--}}

{{--                        'overtime_amount',--}}

{{--                        'bonus',--}}

{{--                        'other_taxable_allowances',--}}

{{--                        'housing_allowance',--}}

{{--                        'transport_allowance',--}}

{{--                        'meal_allowance',--}}

{{--                        'family_allowance',--}}

{{--                        'medical_allowance',--}}

{{--                        'other_non_taxable_allowances'--}}

{{--                    ];--}}


{{--                    /*--}}
{{--                    |----------------------------------------------------------------------------}}
{{--                    | EMPLOYEE DEDUCTIONS--}}
{{--                    |----------------------------------------------------------------------------}}
{{--                    */--}}

{{--                    const deductionFields = [--}}

{{--                        'cnss_employee',--}}

{{--                        'ipr',--}}

{{--                        'salary_advances',--}}

{{--                        'syndicate_deduction',--}}

{{--                        'other_deductions'--}}

{{--                    ];--}}


{{--                    function getValue(id) {--}}

{{--                        const element =--}}
{{--                            document.getElementById(id);--}}

{{--                        if (!element) {--}}

{{--                            return 0;--}}

{{--                        }--}}


{{--                        const value =--}}
{{--                            parseFloat(element.value);--}}


{{--                        return isNaN(value)--}}
{{--                            ? 0--}}
{{--                            : value;--}}

{{--                    }--}}


{{--                    function calculatePayroll() {--}}

{{--                        let gross = 0;--}}

{{--                        let deductions = 0;--}}


{{--                        /*--}}
{{--                        |----------------------------------------------------------------------------}}
{{--                        | GROSS SALARY--}}
{{--                        |----------------------------------------------------------------------------}}
{{--                        */--}}

{{--                        earningFields.forEach(--}}
{{--                            function (field) {--}}

{{--                                gross += getValue(field);--}}

{{--                            }--}}
{{--                        );--}}


{{--                        /*--}}
{{--                        |----------------------------------------------------------------------------}}
{{--                        | TOTAL EMPLOYEE DEDUCTIONS--}}
{{--                        |----------------------------------------------------------------------------}}
{{--                        */--}}

{{--                        deductionFields.forEach(--}}
{{--                            function (field) {--}}

{{--                                deductions += getValue(field);--}}

{{--                            }--}}
{{--                        );--}}


{{--                        /*--}}
{{--                        |----------------------------------------------------------------------------}}
{{--                        | NET SALARY--}}
{{--                        |----------------------------------------------------------------------------}}
{{--                        */--}}

{{--                        const net =--}}
{{--                            gross - deductions;--}}


{{--                        /*--}}
{{--                        |----------------------------------------------------------------------------}}
{{--                        | DISPLAY RESULTS--}}
{{--                        |----------------------------------------------------------------------------}}
{{--                        */--}}

{{--                        const grossElement =--}}
{{--                            document.getElementById(--}}
{{--                                'gross_salary'--}}
{{--                            );--}}

{{--                        const deductionsElement =--}}
{{--                            document.getElementById(--}}
{{--                                'total_deductions'--}}
{{--                            );--}}

{{--                        const netElement =--}}
{{--                            document.getElementById(--}}
{{--                                'net_salary'--}}
{{--                            );--}}


{{--                        if (grossElement) {--}}

{{--                            grossElement.value =--}}
{{--                                gross.toFixed(2);--}}

{{--                        }--}}


{{--                        if (deductionsElement) {--}}

{{--                            deductionsElement.value =--}}
{{--                                deductions.toFixed(2);--}}

{{--                        }--}}


{{--                        if (netElement) {--}}

{{--                            netElement.value =--}}
{{--                                net.toFixed(2);--}}

{{--                        }--}}

{{--                    }--}}


{{--                    /*--}}
{{--                    |----------------------------------------------------------------------------}}
{{--                    | RECALCULATE WHEN INPUT CHANGES--}}
{{--                    |----------------------------------------------------------------------------}}
{{--                    */--}}

{{--                    document--}}
{{--                        .querySelectorAll(--}}
{{--                            '.payroll-input'--}}
{{--                        )--}}
{{--                        .forEach(--}}
{{--                            function (input) {--}}

{{--                                input.addEventListener(--}}
{{--                                    'input',--}}
{{--                                    calculatePayroll--}}
{{--                                );--}}

{{--                            }--}}
{{--                        );--}}

{{--                    calculatePayroll();--}}

{{--                }--}}
{{--            );--}}

{{--        </script>--}}

{{--    @endpush--}}

{{--@endsection--}}
@extends('layouts.admin')

@section('title', __('menu.pay_page_title'))

@section('content')

    @php
        use App\Enums\PayrollMonth;

        /* ---------- EMPLOYEE ---------- */
        $fullName = trim(($employee->first_name ?? '') . ' ' . ($employee->middle_name ?? '') . ' ' . ($employee->last_name ?? ''));

        /* ---------- SALARY ---------- */
        $salary     = $employee->salary;
        $currency   = $salary?->currency ?? 'CDF';
        $baseSalary = (float) ($salary?->base_salary ?? 0);
        $category   = $salary?->category ?? 'N/A';
        $echelon    = $salary?->echelon ?? 'N/A';

        /* ---------- PERIOD ---------- */
        $payrollMonth = PayrollMonth::tryFrom((int) $month);
        $monthLabel   = $payrollMonth
            ? (app()->getLocale() === 'fr' ? $payrollMonth->labelFr() : $payrollMonth->label())
            : $month;
        $periodLabel  = $monthLabel . ' ' . $year;
        $indexUrl     = route('payroll.index', ['year' => $year, 'month' => $month]);

        /* ---------- EXCHANGE RATE (1 USD = ? CDF) ----------
           Fetched once and cached for 12h, so the API is not called on every page load.
           If the API is down, the last known rate is used, then 1 as a last resort.
        */
        $exchange = \Illuminate\Support\Facades\Cache::remember('usd_cdf_rate', now()->addHours(12), function () {
            try {
                $response = \Illuminate\Support\Facades\Http::timeout(5)->get('https://open.er-api.com/v6/latest/USD');

                if ($response->successful() && $response->json('result') === 'success' && $response->json('rates.CDF')) {
                    $data = ['rate' => round((float) $response->json('rates.CDF'), 2)];
                    \Illuminate\Support\Facades\Cache::forever('usd_cdf_rate_last', $data);
                    return $data;
                }
            } catch (\Throwable $e) {
                // ignore, fallback below
            }

            return null;
        });

        $exchange = $exchange ?? \Illuminate\Support\Facades\Cache::get('usd_cdf_rate_last');
        $autoRate = $exchange['rate'] ?? 1;

        /* ---------- FIELDS ----------
           name => [label key, default value, type]
           gain = added to gross | deduct = subtracted | info = not calculated
        */
        $gains = [
            'basic_salary'                 => ['pay_basic_salary',        $baseSalary, 'gain'],
            'days_worked'                  => ['pay_days_worked',         26,          'info'],
            'exchange_rate'                => ['pay_exchange_rate',       $autoRate,   'info'],
            'housing_allowance'            => ['pay_housing_allowance',   0,           'gain'],
            'transport_allowance'          => ['pay_transport_allowance', 0,           'gain'],
            'meal_allowance'               => ['pay_meal_allowance',      0,           'gain'],
            'family_allowance'             => ['pay_family_allowance',    0,           'gain'],
            'medical_allowance'            => ['pay_medical_allowance',   0,           'gain'],
            'other_non_taxable_allowances' => ['pay_other_non_taxable',   0,           'gain'],
            'other_taxable_allowances'     => ['pay_other_taxable',       0,           'gain'],
            'bonus'                        => ['pay_bonus',               0,           'gain'],
            'overtime_hours'               => ['pay_overtime_hours',      0,           'info'],
            'overtime_amount'              => ['pay_overtime_amount',     0,           'gain'],
        ];

        $deductions = [
            'cnss_employee'       => ['pay_cnss_employee',       0, 'deduct'],
            'ipr'                 => ['pay_ipr',                 0, 'deduct'],
            'salary_advances'     => ['pay_salary_advances',     0, 'deduct'],
            'syndicate_deduction' => ['pay_syndicate_deduction', 0, 'deduct'],
            'other_deductions'    => ['pay_other_deductions',    0, 'deduct'],
            'ier'                 => ['pay_ier',                 0, 'info'],
        ];

        $employer = [
            'cnss_employer' => ['pay_cnss', 0],
            'inpp_employer' => ['pay_inpp', 0],
            'onem_employer' => ['pay_onem', 0],
        ];

        $required = ['basic_salary', 'days_worked'];
    @endphp

    <style>

        /* =========================================================
           SAME LOOK AS CREATE EMPLOYEE
        ========================================================== */

        .employee-card {
            border: 0;
            border-radius: 0 !important;
        }

        .employee-card-wrapper {
            margin: 24px;
        }

        .form-control,
        .btn {
            border-radius: 0 !important;
        }

        .form-control {
            min-height: 44px;
        }

        textarea.form-control {
            min-height: 80px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-control:focus {
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

        /* =========================================================
           EMPLOYEE INFO (TEXT)
        ========================================================== */

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

        /* =========================================================
           TWO HALVES
        ========================================================== */

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

        /* =========================================================
           SUMMARY (TEXT)
        ========================================================== */

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

        /* =========================================================
           MOBILE
        ========================================================== */

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


    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

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


    {{-- =========================================================
         MAIN CARD
    ========================================================== --}}

    <div class="card employee-card employee-card-wrapper shadow-sm">

        <div class="card-body">

            {{-- ERRORS --}}
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


            {{-- =====================================================
                 EMPLOYEE INFORMATION (TOP, TEXT ONLY)
            ====================================================== --}}

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
                    <strong>{{ $category }} / {{ $echelon }}</strong>
                </div>

            </div>


            {{-- =====================================================
                 FORM
            ====================================================== --}}

            <form action="{{ route('payroll.store') }}" method="POST" id="payrollForm" autocomplete="off">

                @csrf

                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                <input type="hidden" name="year" value="{{ $year }}">
                <input type="hidden" name="month" value="{{ $month }}">
                <input type="hidden" name="currency" value="{{ old('currency', $currency) }}">


                <div class="row g-4">

                    {{-- ================= LEFT : GAINS ================= --}}

                    <div class="col-lg-7 col-12 half-left">

                        <div class="step-title">
                            <h5>
                                <i class="bi bi-plus-circle me-2 text-success"></i>
                                {{ __('menu.pay_gains') }}
                            </h5>
                        </div>

                        <div class="row g-3">

                            @foreach($gains as $name => [$label, $default, $type])

                                <div class="col-6 col-md-3">

                                    <label class="form-label">
                                        {{ __('menu.' . $label) }}
                                        @if(in_array($name, $required))
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>

                                    <input
                                        type="number"
                                        name="{{ $name }}"
                                        id="{{ $name }}"
                                        class="form-control @error($name) is-invalid @enderror"
                                        value="{{ old($name, $default) }}"
                                        min="0"
                                        step="{{ $name === 'days_worked' ? '0.1' : ($name === 'exchange_rate' ? '0.0001' : '0.01') }}"
                                        @if($name === 'days_worked') max="31" @endif
                                        @if($type === 'gain') data-gain @endif
                                        @if(in_array($name, $required)) required @endif
                                        autocomplete="off"
                                    >

                                    @error($name)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    @if($name === 'exchange_rate')
                                        <small class="text-muted d-block mt-1" style="font-size: 11px;">
                                            1 USD = {{ number_format($autoRate, 2) }} CDF
                                            &middot;
                                            <a href="#" id="resetRate" data-rate="{{ $autoRate }}">{{ __('menu.pay_rate_auto') }}</a>
                                            &middot;
                                            <a href="https://www.exchangerate-api.com" target="_blank" rel="noopener" class="text-muted">exchangerate-api.com</a>
                                        </small>
                                    @endif

                                </div>

                            @endforeach

                        </div>

                    </div>


                    {{-- ================= RIGHT : DEDUCTIONS ================= --}}

                    <div class="col-lg-5 col-12 half-right">

                        <div class="step-title">
                            <h5>
                                <i class="bi bi-dash-circle me-2 text-danger"></i>
                                {{ __('menu.pay_deductions') }}
                            </h5>
                        </div>

                        <div class="row g-3">

                            @foreach($deductions as $name => [$label, $default, $type])

                                <div class="col-12 col-md-6">

                                    <label class="form-label">{{ __('menu.' . $label) }}</label>

                                    <input
                                        type="number"
                                        name="{{ $name }}"
                                        id="{{ $name }}"
                                        class="form-control @error($name) is-invalid @enderror"
                                        value="{{ old($name, $default) }}"
                                        min="0"
                                        step="0.01"
                                        @if($type === 'deduct') data-deduct @endif
                                        autocomplete="off"
                                    >

                                    @error($name)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                            @endforeach


                            {{-- EMPLOYER CONTRIBUTIONS --}}

                            <div class="col-12 mt-4">
                                <h6 class="mb-0">
                                    <i class="bi bi-building me-2"></i>
                                    {{ __('menu.pay_employer_contributions') }}
                                </h6>
                            </div>

                            @foreach($employer as $name => [$label, $default])

                                <div class="col-12 col-md-4">

                                    <label class="form-label">{{ __('menu.' . $label) }}</label>

                                    <input
                                        type="number"
                                        name="{{ $name }}"
                                        id="{{ $name }}"
                                        class="form-control @error($name) is-invalid @enderror"
                                        value="{{ old($name, $default) }}"
                                        min="0"
                                        step="0.01"
                                        autocomplete="off"
                                    >

                                    @error($name)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     SUMMARY (BOTTOM, TEXT ONLY)
                ================================================== --}}

                <div class="summary-box">

                    <div class="row g-3 text-center">

                        <div class="col-12 col-md-4 summary-item">
                            <small>{{ __('menu.pay_gross_salary') }}</small>
                            <div class="summary-value" id="gross_text">0.00 {{ $currency }}</div>
                            <input type="hidden" name="gross_salary" id="gross_salary" value="{{ old('gross_salary', 0) }}">
                        </div>

                        <div class="col-12 col-md-4 summary-item">
                            <small>{{ __('menu.pay_total_deductions') }}</small>
                            <div class="summary-value text-danger" id="deductions_text">0.00 {{ $currency }}</div>
                            <input type="hidden" name="total_deductions" id="total_deductions" value="{{ old('total_deductions', 0) }}">
                        </div>

                        <div class="col-12 col-md-4 summary-item">
                            <small>{{ __('menu.pay_net_salary') }}</small>
                            <div class="summary-value text-success" id="net_text">0.00 {{ $currency }}</div>
                            <input type="hidden" name="net_salary" id="net_salary" value="{{ old('net_salary', 0) }}">
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


                {{-- =================================================
                     BUTTONS
                ================================================== --}}

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


    {{-- =========================================================
         JAVASCRIPT
    ========================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const form     = document.getElementById('payrollForm');
            const gross    = document.getElementById('gross_salary');
            const ded      = document.getElementById('total_deductions');
            const net      = document.getElementById('net_salary');
            const currency = @json($currency);

            const sum = function (selector) {
                let total = 0;
                form.querySelectorAll(selector).forEach(function (input) {
                    total += parseFloat(input.value) || 0;
                });
                return total;
            };

            function calculate() {
                const g = sum('[data-gain]');
                const d = sum('[data-deduct]');
                const n = g - d;

                /* Hidden inputs (sent to the controller) */
                gross.value = g.toFixed(2);
                ded.value   = d.toFixed(2);
                net.value   = n.toFixed(2);

                /* Displayed text */
                document.getElementById('gross_text').textContent      = g.toFixed(2) + ' ' + currency;
                document.getElementById('deductions_text').textContent = d.toFixed(2) + ' ' + currency;

                const netText = document.getElementById('net_text');
                netText.textContent = n.toFixed(2) + ' ' + currency;
                netText.classList.toggle('text-success', n >= 0);
                netText.classList.toggle('text-danger', n < 0);
            }

            form.querySelectorAll('[data-gain], [data-deduct]').forEach(function (input) {
                input.addEventListener('input', calculate);
            });

            calculate();


            /* Reset the exchange rate to the automatic one */
            const resetRate = document.getElementById('resetRate');

            if (resetRate) {
                resetRate.addEventListener('click', function (event) {
                    event.preventDefault();
                    document.getElementById('exchange_rate').value = this.dataset.rate;
                });
            }


            /* Remove red border once the field is valid */
            form.querySelectorAll('input, textarea').forEach(function (field) {
                field.addEventListener('input', function () {
                    if (this.checkValidity()) this.classList.remove('is-invalid');
                });
            });


            /* Submit */
            form.addEventListener('submit', function (event) {

                calculate();

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
