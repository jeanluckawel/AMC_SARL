<?php

namespace App\Http\Controllers;

use App\Models\DepartmentBudget;
use App\Models\RequestModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class RequestDocumentController extends Controller
{
    public function create(RequestModel $request): View
    {
        $request->load([
            'requester.employee.department',
        ]);

        return view(
            'requests.document-upload',
            compact('request')
        );
    }

    public function store(
        Request $httpRequest,
        RequestModel $request
    ): RedirectResponse {
        $validated = $httpRequest->validate([
            'document' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:10240',
            ],
        ], [
            'document.required' => 'Please select a document.',
            'document.file' => 'The uploaded document is invalid.',
            'document.mimes' => 'The document must be PDF, JPG, JPEG or PNG.',
            'document.max' => 'The document cannot exceed 10 MB.',
        ]);

        // Only approved requests can consume budget
//        if ($request->status !== 'approved') {
//            return back()->with(
//                'error',
//                'Only approved requests can have their amount released.'
//            );
//        }

        // Prevent consuming the budget twice
        if ($request->budget_consumed) {
            return back()->with(
                'error',
                'The amount for this request has already been released.'
            );
        }

        $path = null;

        DB::beginTransaction();

        try {
            /*
             * Request
             *   -> requester (User)
             *       -> employee (Employee)
             *           -> department (Department)
             */
            $request->load([
                'requester.employee.department',
            ]);

            if (!$request->requester) {
                throw new \Exception(
                    'The requester could not be found.'
                );
            }

            if (!$request->requester->employee) {
                throw new \Exception(
                    'The requester is not linked to an employee.'
                );
            }

            $employee = $request->requester->employee;

            if (!$employee->department_id) {
                throw new \Exception(
                    'The requester employee does not belong to a department.'
                );
            }

            $departmentId = $employee->department_id;

            /*
             * Find the active budget of the employee's department.
             */
            $budget = DepartmentBudget::query()
                ->where('department_id', $departmentId)
                ->whereDate('end_date', '>=', today())
                ->lockForUpdate()
                ->first();

            if (!$budget) {
                throw new \Exception(
                    'No active budget was found for this department.'
                );
            }

            $requestAmount = (float) $request->total_amount;
            $budgetAmount = (float) $budget->amount;
            $usedAmount = (float) $budget->used_amount;

            $remainingBudget = $budgetAmount - $usedAmount;

            /*
             * Check if there is enough money left.
             */
            if ($requestAmount > $remainingBudget) {
                DB::rollBack();

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Insufficient department budget. '
                        . 'Available: '
                        . number_format($remainingBudget, 2)
                        . ' | Requested: '
                        . number_format($requestAmount, 2)
                    );
            }

            /*
             * Store the uploaded document.
             */
            $file = $validated['document'];

            $path = $file->store(
                'requests/documents',
                'public'
            );

            /*
             * Consume the department budget.
             */
            $budget->update([
                'used_amount' => $usedAmount + $requestAmount,
            ]);

            /*
             * Mark the request as processed.
             */
            $request->update([
                'document_path' => $path,
                'budget_consumed' => true,
            ]);

            DB::commit();

            return redirect()
                ->route('requests.show', $request)
                ->with(
                    'success',
                    'Document uploaded and amount released successfully.'
                );

        } catch (\Throwable $e) {
            DB::rollBack();

            /*
             * Delete uploaded file if database transaction failed.
             */
            if (
                $path &&
                Storage::disk('public')->exists($path)
            ) {
                Storage::disk('public')->delete($path);
            }

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }
}
