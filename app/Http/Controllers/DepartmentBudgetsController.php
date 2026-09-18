<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentBudget;
use Illuminate\Http\Request;
use Illuminate\View\View;

class departmentBudgetsController extends Controller
{

    public function departmentBudgets(): View
    {
//        abort_unless(
//            auth()->user()->hasRole('Finance'),
//            403
//        );






        $departments = Department::with([
            'budgets',
        ])
            ->orderBy('name')
            ->get();

        $amountBuget = DepartmentBudget::sum('amount');


        return view(
            'finance.department-budgets',
            compact('departments','amountBuget')
        );
    }


    public function create(Department $department): View
    {
        return view(
            'finance.department-budgets-create',
            compact('department')
        );
    }


    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0.01',
                'max:999999999999.99',
            ],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
        ], [
            'department_id.required' => 'The department is required.',
            'department_id.exists' => 'The selected department does not exist.',

            'amount.required' => 'Please enter the budget amount.',
            'amount.numeric' => 'The budget amount must be a number.',
            'amount.min' => 'The budget amount must be greater than 0.',

            'end_date.required' => 'Please enter the budget end date.',
            'end_date.date' => 'The end date is invalid.',
            'end_date.after_or_equal' => 'The end date cannot be in the past.',
        ]);


        /*
         * Check if the department already has
         * an active budget.
         */
        $existingBudget = DepartmentBudget::query()
            ->where(
                'department_id',
                $validated['department_id']
            )
            ->whereDate(
                'end_date',
                '>=',
                today()
            )
            ->exists();


        if ($existingBudget) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'This department already has an active budget.'
                );
        }


        /*
         * Create the budget.
         */
        DepartmentBudget::create([
            'department_id' => $validated['department_id'],
            'amount' => $validated['amount'],
            'used_amount' => 0,
            'end_date' => $validated['end_date'],
        ]);


        /*
         * Return to Department Budget list.
         */
        return redirect()
            ->route('finance.department-budgets')
            ->with(
                'success',
                'Department budget created successfully.'
            );
    }

    public function edit(DepartmentBudget $departmentBudget): View
    {
        $departmentBudget->load('department');

        return view(
            'finance.department-budgets-edit',
            compact('departmentBudget')
        );
    }

    public function update(
        Request $request,
        DepartmentBudget $departmentBudget
    ): \Illuminate\Http\RedirectResponse
    {

        $validated = $request->validate([
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
                'max:999999999999.99',
            ],


            'end_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
        ], [
            'amount.required' => 'Please enter the budget amount.',
            'amount.numeric' => 'The budget amount must be a number.',
            'amount.min' => 'The budget amount must be greater than 0.',

            'used_amount.required' => 'Please enter the used amount.',
            'used_amount.numeric' => 'The used amount must be a number.',
            'used_amount.min' => 'The used amount cannot be negative.',

            'end_date.required' => 'Please enter the budget end date.',
            'end_date.date' => 'The end date is invalid.',
            'end_date.after_or_equal' => 'The end date cannot be in the past.',
        ]);
//
//        if (
//            (float) $validated['used_amount'] >
//            (float) $validated['amount']
//        ) {
//            return back()
//                ->withInput()
//                ->with(
//                    'error',
//                    'The used amount cannot be greater than the budget amount.'
//                );
//        }

        $departmentBudget->update([
            'amount' => $validated['amount'],
            'end_date' => $validated['end_date'],
        ]);

        return redirect()
            ->route('finance.department-budgets')
            ->with(
                'success',
                'Department budget updated successfully.'
            );
    }


}
