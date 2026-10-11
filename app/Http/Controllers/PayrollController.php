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


        /*
        |--------------------------------------------------------------------------
        | Vérifier si l'employé a déjà été payé
        |--------------------------------------------------------------------------
        */

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

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'employee_id' => [
                'required',
                'integer',
                'exists:employees,id',
            ],

            'year' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],

            'month' => [
                'required',
                'integer',
                'between:1,12',
            ],

            'days_worked' => [
                'required',
                'numeric',
                'min:0',
                'max:31',
            ],

            'basic_salary' => [
                'required',
                'numeric',
                'min:0',
            ],

            'overtime_hours' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'overtime_amount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'bonus' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'other_taxable_allowances' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'housing_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'transport_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'meal_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'family_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'medical_allowance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'other_non_taxable_allowances' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'cnss_employee' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'ipr' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'salary_advances' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'syndicate_deduction' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'other_deductions' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'cnss_employer' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'inpp_employer' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'onem_employer' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'ier' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'currency' => [
                'required',
                'string',
                'size:3',
                Rule::in([
                    'CDF',
                    'USD',
                ]),
            ],

            'payment_method' => [
                'nullable',
                'string',
                Rule::in([
                    'bank_transfer',
                    'cash',
                    'cheque',
                ]),
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | NORMALIZE VALUES
        |--------------------------------------------------------------------------
        */

        $employeeId = (int) $validated['employee_id'];

        $year = (int) $validated['year'];

        $month = (int) $validated['month'];


        /*
        |--------------------------------------------------------------------------
        | EMPLOYEE
        |--------------------------------------------------------------------------
        */

        $employee = Employee::findOrFail($employeeId);


        /*
        |--------------------------------------------------------------------------
        | CHECK DUPLICATE PAYROLL
        |--------------------------------------------------------------------------
        */

        $alreadyPaid = Payroll::query()
            ->where('employee_id', $employeeId)
            ->where('year', $year)
            ->where('month', $month)
            ->exists();


        if ($alreadyPaid) {

            return redirect()
                ->route('payroll.index', [
                    'year' => $year,
                    'month' => $month,
                ])
                ->with(
                    'error',
                    'This employee has already been paid for this payroll period.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GET VALUES
        |--------------------------------------------------------------------------
        */

        $basicSalary = (float) ($validated['basic_salary'] ?? 0);

        $overtimeHours = (float) ($validated['overtime_hours'] ?? 0);

        $overtimeAmount = (float) ($validated['overtime_amount'] ?? 0);

        $bonus = (float) ($validated['bonus'] ?? 0);

        $otherTaxableAllowances =
            (float) ($validated['other_taxable_allowances'] ?? 0);


        $housingAllowance =
            (float) ($validated['housing_allowance'] ?? 0);

        $transportAllowance =
            (float) ($validated['transport_allowance'] ?? 0);

        $mealAllowance =
            (float) ($validated['meal_allowance'] ?? 0);

        $familyAllowance =
            (float) ($validated['family_allowance'] ?? 0);

        $medicalAllowance =
            (float) ($validated['medical_allowance'] ?? 0);

        $otherNonTaxableAllowances =
            (float) ($validated['other_non_taxable_allowances'] ?? 0);


        $cnssEmployee =
            (float) ($validated['cnss_employee'] ?? 0);

        $ipr =
            (float) ($validated['ipr'] ?? 0);

        $salaryAdvances =
            (float) ($validated['salary_advances'] ?? 0);

        $syndicateDeduction =
            (float) ($validated['syndicate_deduction'] ?? 0);

        $otherDeductions =
            (float) ($validated['other_deductions'] ?? 0);


        $cnssEmployer =
            (float) ($validated['cnss_employer'] ?? 0);

        $inppEmployer =
            (float) ($validated['inpp_employer'] ?? 0);

        $onemEmployer =
            (float) ($validated['onem_employer'] ?? 0);

        $ier =
            (float) ($validated['ier'] ?? 0);


        /*
        |--------------------------------------------------------------------------
        | CALCULATE GROSS SALARY
        |--------------------------------------------------------------------------
        |
        | Gross =
        | basic salary
        | + overtime
        | + bonus
        | + taxable allowances
        | + non-taxable allowances
        |
        */

        $grossSalary =
            $basicSalary
            + $overtimeAmount
            + $bonus
            + $otherTaxableAllowances
            + $housingAllowance
            + $transportAllowance
            + $mealAllowance
            + $familyAllowance
            + $medicalAllowance
            + $otherNonTaxableAllowances;


        /*
        |--------------------------------------------------------------------------
        | SOCIAL BASE
        |--------------------------------------------------------------------------
        |
        | Base utilisée pour les calculs sociaux.
        |
        | Ici on utilise le brut comme base initiale.
        | Les règles de plafonnement peuvent être ajoutées
        | selon les paramètres légaux/conventionnels de l'entreprise.
        |
        */

        $socialBase = $grossSalary;


        /*
        |--------------------------------------------------------------------------
        | FISCAL BASE
        |--------------------------------------------------------------------------
        |
        | Base imposable initiale.
        |
        | À adapter avec les règles fiscales RDC définitives
        | appliquées par ton entreprise.
        |
        */

        $fiscalBase =
            $basicSalary
            + $overtimeAmount
            + $bonus
            + $otherTaxableAllowances;


        /*
        |--------------------------------------------------------------------------
        | TOTAL EMPLOYEE DEDUCTIONS
        |--------------------------------------------------------------------------
        |
        | IMPORTANT :
        | Les charges patronales ne sont PAS incluses ici.
        |
        */

        $totalDeductions =
            $cnssEmployee
            + $ipr
            + $salaryAdvances
            + $syndicateDeduction
            + $otherDeductions;


        /*
        |--------------------------------------------------------------------------
        | NET SALARY
        |--------------------------------------------------------------------------
        */

        $netSalary =
            $grossSalary - $totalDeductions;


        /*
        |--------------------------------------------------------------------------
        | PROTECTION
        |--------------------------------------------------------------------------
        */

        if ($netSalary < 0) {

            return back()
                ->withInput()
                ->withErrors([
                    'net_salary' =>
                        'The total deductions cannot be greater than the gross salary.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PAYMENT REFERENCE
        |--------------------------------------------------------------------------
        */

        $paymentReference =
            'PAY-' .
            $year .
            str_pad(
                (string) $month,
                2,
                '0',
                STR_PAD_LEFT
            ) .
            '-' .
            strtoupper(
                Str::random(8)
            );


        /*
        |--------------------------------------------------------------------------
        | PAYMENT METHOD
        |--------------------------------------------------------------------------
        */

        $paymentMethod =
            $validated['payment_method']
            ?? 'bank_transfer';


        /*
        |--------------------------------------------------------------------------
        | CREATE PAYROLL
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $employeeId,
            $year,
            $month,
            $validated,
            $basicSalary,
            $overtimeHours,
            $overtimeAmount,
            $bonus,
            $otherTaxableAllowances,
            $housingAllowance,
            $transportAllowance,
            $mealAllowance,
            $familyAllowance,
            $medicalAllowance,
            $otherNonTaxableAllowances,
            $grossSalary,
            $socialBase,
            $fiscalBase,
            $cnssEmployee,
            $ipr,
            $salaryAdvances,
            $syndicateDeduction,
            $otherDeductions,
            $cnssEmployer,
            $inppEmployer,
            $onemEmployer,
            $ier,
            $totalDeductions,
            $netSalary,
            $paymentReference,
            $paymentMethod
        ) {

            Payroll::create([

                /*
                |--------------------------------------------------------------------------
                | IDENTIFICATION
                |--------------------------------------------------------------------------
                */

                'employee_id' => $employeeId,

                'year' => $year,

                'month' => $month,


                /*
                |--------------------------------------------------------------------------
                | WORK TIME
                |--------------------------------------------------------------------------
                */

                'days_worked' =>
                    (float) ($validated['days_worked'] ?? 26),

                /*
                |--------------------------------------------------------------------------
                | EARNINGS
                |--------------------------------------------------------------------------
                */

                'basic_salary' => $basicSalary,

                'overtime_hours' => $overtimeHours,

                'overtime_amount' => $overtimeAmount,

                'bonus' => $bonus,

                'other_taxable_allowances' =>
                    $otherTaxableAllowances,

                'housing_allowance' =>
                    $housingAllowance,

                'transport_allowance' =>
                    $transportAllowance,

                'meal_allowance' =>
                    $mealAllowance,

                'family_allowance' =>
                    $familyAllowance,

                'medical_allowance' =>
                    $medicalAllowance,

                'other_non_taxable_allowances' =>
                    $otherNonTaxableAllowances,


                /*
                |--------------------------------------------------------------------------
                | BASES
                |--------------------------------------------------------------------------
                */

                'gross_salary' => $grossSalary,

                'social_base' => $socialBase,

                'fiscal_base' => $fiscalBase,


                /*
                |--------------------------------------------------------------------------
                | EMPLOYEE DEDUCTIONS
                |--------------------------------------------------------------------------
                */

                'cnss_employee' =>
                    $cnssEmployee,

                'ipr' =>
                    $ipr,

                'salary_advances' =>
                    $salaryAdvances,

                'syndicate_deduction' =>
                    $syndicateDeduction,

                'other_deductions' =>
                    $otherDeductions,


                /*
                |--------------------------------------------------------------------------
                | EMPLOYER CONTRIBUTIONS
                |--------------------------------------------------------------------------
                */

                'cnss_employer' =>
                    $cnssEmployer,

                'inpp_employer' =>
                    $inppEmployer,

                'onem_employer' =>
                    $onemEmployer,

                'ier' =>
                    $ier,


                /*
                |--------------------------------------------------------------------------
                | TOTALS
                |--------------------------------------------------------------------------
                */

                'total_deductions' =>
                    $totalDeductions,

                'net_salary' =>
                    $netSalary,


                /*
                |--------------------------------------------------------------------------
                | PAYMENT
                |--------------------------------------------------------------------------
                */

                'currency' =>
                    strtoupper($validated['currency']),

                'payment_date' =>
                    now()->toDateString(),

                'payment_method' =>
                    $paymentMethod,

                'payment_reference' =>
                    $paymentReference,


                /*
                |--------------------------------------------------------------------------
                | REMARKS
                |--------------------------------------------------------------------------
                */

                'remarks' =>
                    $validated['remarks'] ?? null,
            ]);
        });


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('payroll.index', [
                'year' => $year,
                'month' => $month,
            ])
            ->with(
                'success',
                'Payroll successfully processed for ' .
                $employee->first_name . ' ' .
                ($employee->last_name ?? '') .
                '. Payment reference: ' .
                $paymentReference
            );
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
