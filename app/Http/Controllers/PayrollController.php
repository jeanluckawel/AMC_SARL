<?php

namespace App\Http\Controllers;

use App\Enums\PayrollMonth;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;
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
    }

    public function show($id)
    {
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
}
