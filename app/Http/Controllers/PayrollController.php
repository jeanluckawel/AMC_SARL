<?php

namespace App\Http\Controllers;

use App\Enums\PayrollMonth;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PayrollController extends Controller
{
    public function index(Request $request)
    {
        $year = (int) $request->input('year', now()->year);

        $month = (int) $request->input(
            'month',
            now()->month
        );


        if ($month < 1 || $month > 12) {
            $month = now()->month;
        }

        $payrolls = Employee::with([
            'salary',
        ])
            ->whereDoesntHave('payrolls', function ($query) use ($year, $month) {

                $query->where('year', $year)
                    ->where('month', $month);

            })
            ->orderBy('employee_id', 'asc')
            ->get();

        return view('payroll.index', [
            'payrolls' => $payrolls,
            'selectedYear' => $year,
            'selectedMonth' => $month,
            'months' => PayrollMonth::options(),
        ]);
    }


    public function create(Request $request)
    {
        $employeeId = $request->input('employee');

        $year = (int) $request->input(
            'year',
            now()->year
        );

        $month = (int) $request->input(
            'month',
            now()->month
        );

        if ($month < 1 || $month > 12) {
            $month = now()->month;
        }

        $employee = Employee::with([
            'salary',
            'department',
            'section',
            'jobTitle',
        ])->findOrFail($employeeId);




        $existingPayroll = Payroll::where('employee_id', $employee->id)
            ->where('year', $year)
            ->where('month', $month)
            ->first();

        if ($existingPayroll) {

            return redirect()
                ->route('payroll.index', [
                    'year' => $year,
                    'month' => $month,
                ])
                ->with(
                    'error',
                    'This employee has already been paid for the selected month.'
                );
        }


        return view('payroll.create', [

            'employee' => $employee,

            'year' => $year,

            'month' => $month,

            'months' => PayrollMonth::options(),

        ]);
    }






    private const STANDARD_DAYS = 26;
    private const HOURS_PER_DAY = 8;
    private const OVERTIME_RATE = 1.3;

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'year'        => ['required', 'integer', 'min:2000', 'max:2100'],
            'month'       => ['required', 'integer', 'between:1,12'],

            // Gains (saisies)
            'days_worked'    => ['required', 'integer', 'between:1,26'],
            'sick_days'      => ['nullable', 'numeric', 'min:0', 'max:31'],
            'overtime_hours' => ['nullable', 'numeric', 'min:0', 'max:300'],
            'bonus'          => ['nullable', 'numeric', 'min:0'],
            'exchange_rate'  => ['nullable', 'numeric', 'min:0'],

            // Retenues (saisies)
            'ipr'              => ['nullable', 'numeric', 'min:0'],
            'salary_advances'  => ['nullable', 'numeric', 'min:0'],
            'other_deductions' => ['nullable', 'numeric', 'min:0'],

            'remarks' => ['nullable', 'string', 'max:5000'],
        ]);

        $employeeId = (int) $validated['employee_id'];
        $year       = (int) $validated['year'];
        $month      = (int) $validated['month'];

        $employee = Employee::with('salary')->findOrFail($employeeId);
        $salary   = $employee->salary;

        if (! $salary) {
            return back()->withInput()->withErrors([
                'employee_id' => 'Cet employé n\'a pas de fiche salariale.',
            ]);
        }

        // Doublon
        $alreadyPaid = Payroll::where('employee_id', $employeeId)
            ->where('year', $year)
            ->where('month', $month)
            ->exists();

        if ($alreadyPaid) {
            return redirect()
                ->route('payroll.index', ['year' => $year, 'month' => $month])
                ->with('error', 'Cet employé a déjà été payé pour cette période.');
        }

        // Valeurs issues du système (fiche salariale)
        $s = fn (string $field): float => (float) ($salary->{$field} ?? 0);

        $baseSalary = $s('base_salary');

        $housing         = $s('housing_allowance');
        $transport       = $s('transport_allowance');
        $meal            = $s('meal_allowance');
        $family          = $s('family_allowance');
        $medical         = $s('medical_allowance');
        $otherNonTaxable = $s('other_non_taxable_allowances');
        $otherTaxable    = $s('other_taxable_allowances');

        $cnssEmployee = $s('cnss_employee');
        $syndicate    = $s('syndicate_deduction');
        $ier          = $s('ier');

        $cnssEmployer = $s('cnss_employer');
        $inppEmployer = $s('inpp_employer');
        $onemEmployer = $s('onem_employer');

        // Valeurs saisies
        $daysWorked      = (float) $validated['days_worked'];
        $sickDays        = (float) ($validated['sick_days'] ?? 0);
        $overtimeHours   = (float) ($validated['overtime_hours'] ?? 0);
        $bonus           = (float) ($validated['bonus'] ?? 0);
        $exchangeRate    = (float) ($validated['exchange_rate'] ?? 0) ?: null;
        $ipr             = (float) ($validated['ipr'] ?? 0);
        $salaryAdvances  = (float) ($validated['salary_advances'] ?? 0);
        $otherDeductions = (float) ($validated['other_deductions'] ?? 0);

        // Calculs
        $dailyRate   = $baseSalary / self::STANDARD_DAYS;
        $hourlyRate  = $dailyRate / self::HOURS_PER_DAY;

        $basicSalary    = round($dailyRate * $daysWorked, 2);
        $overtimeAmount = round($overtimeHours * $hourlyRate * self::OVERTIME_RATE, 2);

        $grossSalary = $basicSalary
            + $overtimeAmount
            + $bonus
            + $otherTaxable
            + $housing + $transport + $meal + $family + $medical
            + $otherNonTaxable;

        $socialBase = $grossSalary;
        $fiscalBase = $basicSalary + $overtimeAmount + $bonus + $otherTaxable;

        // Les charges patronales et l'IER ne sont pas déduits du net
        $totalDeductions = $cnssEmployee + $ipr + $salaryAdvances + $syndicate + $otherDeductions;
        $netSalary       = $grossSalary - $totalDeductions;

        if ($netSalary < 0) {
            return back()->withInput()->withErrors([
                'net_salary' => 'Le total des retenues ne peut pas dépasser le salaire brut.',
            ]);
        }

        // Mode de paiement : premier mode défini sur la fiche salariale
        $methods = $salary->payment_methods ?? [];
        if (is_string($methods)) {
            $methods = json_decode($methods, true) ?: [];
        }
        $paymentMethod = array_values((array) $methods)[0] ?? 'cash';

        $paymentReference = 'PAY-' . $year . str_pad((string) $month, 2, '0', STR_PAD_LEFT)
            . '-' . strtoupper(Str::random(8));

        DB::transaction(function () use (
            $employeeId, $year, $month, $daysWorked, $sickDays, $basicSalary,
            $overtimeHours, $overtimeAmount, $exchangeRate, $bonus,
            $otherTaxable, $housing, $transport, $meal, $family, $medical, $otherNonTaxable,
            $grossSalary, $socialBase, $fiscalBase,
            $cnssEmployee, $ipr, $salaryAdvances, $syndicate, $otherDeductions,
            $cnssEmployer, $inppEmployer, $onemEmployer, $ier, $totalDeductions,
            $netSalary, $salary, $paymentMethod, $paymentReference, $validated
        ) {
            Payroll::create([
                'employee_id' => $employeeId,
                'year'        => $year,
                'month'       => $month,

                'days_worked'    => $daysWorked,
                'sick_days'      => $sickDays,
                'overtime_hours' => $overtimeHours,

                'basic_salary'                 => $basicSalary,
                'overtime_amount'              => $overtimeAmount,
                'bonus'                        => $bonus,
                'other_taxable_allowances'     => $otherTaxable,
                'housing_allowance'            => $housing,
                'transport_allowance'          => $transport,
                'meal_allowance'               => $meal,
                'family_allowance'             => $family,
                'medical_allowance'            => $medical,
                'other_non_taxable_allowances' => $otherNonTaxable,

                'gross_salary' => $grossSalary,
                'social_base'  => $socialBase,
                'fiscal_base'  => $fiscalBase,

                'cnss_employee'       => $cnssEmployee,
                'ipr'                 => $ipr,
                'salary_advances'     => $salaryAdvances,
                'syndicate_deduction' => $syndicate,
                'other_deductions'    => $otherDeductions,

                'cnss_employer' => $cnssEmployer,
                'inpp_employer' => $inppEmployer,
                'onem_employer' => $onemEmployer,
                'ier'           => $ier,

                'total_deductions' => $totalDeductions,
                'net_salary'       => $netSalary,

                'currency'          => strtoupper($salary->currency ?? 'CDF'),
                'exchange_rate'     => $exchangeRate,
                'payment_date'      => now()->toDateString(),
                'payment_method'    => $paymentMethod,
                'payment_reference' => $paymentReference,

                'remarks' => $validated['remarks'] ?? null,
            ]);
        });

        return redirect()
            ->route('payroll.index', ['year' => $year, 'month' => $month])
            ->with('success', 'Paie traitée pour ' . $employee->first_name . ' '
                . ($employee->last_name ?? '') . '. Référence : ' . $paymentReference);
    }

    public function show(Payroll $payroll): View
    {
        $payroll->load([
            'employee.department',
            'employee.section',
            'employee.jobTitle',
        ]);

        return view('payroll.show', compact('payroll'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    public function payslips(Request $request): View
    {
        // =========================================================
        // PAYROLL PERIOD
        // =========================================================

        $year = (int) $request->input(
            'year',
            now()->year
        );

        $month = (int) $request->input(
            'month',
            now()->month
        );


        // =========================================================
        // VALIDATE MONTH
        // =========================================================

        if ($month < 1 || $month > 12) {

            $month = now()->month;

        }


        // =========================================================
        // PAYSLIPS
        // =========================================================

        $payrolls = Payroll::with([
            'employee.department',
            'employee.section',
            'employee.jobTitle',
        ])

            ->where('year', $year)

            ->where('month', $month)

            ->orderByDesc('id')

            ->get();


        // =========================================================
        // VIEW
        // =========================================================

        return view('payroll.payslips', [

            'payrolls' => $payrolls,

            'selectedYear' => $year,

            'selectedMonth' => $month,

            'months' => PayrollMonth::options(),

        ]);
    }
}
