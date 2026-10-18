<?php

namespace App\Http\Controllers;

use App\Enums\ContractType;
use App\Enums\EmployeeType;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\WorkLocation;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeBankAccount;
use App\Models\EmployeeChild;
use App\Models\EmployeeParent;
use App\Models\EmployeeSalary;
use App\Models\EmergencyContact;
use App\Models\JobTitle;
use App\Models\Section;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class EmployeeController extends Controller
{
    public function create(): View
    {
        $departments = Department::orderBy('name')->get();

        $sections = Section::orderBy('name')->get();

        $jobTitles = JobTitle::orderBy('name')->get();

        return view('employee.create', compact(
            'departments',
            'sections',
            'jobTitles'
        ));
    }


    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        $validated = $request->validated();


        $storedFiles = [];

        try {

            DB::transaction(function () use ($request, $validated, &$storedFiles) {


                $photoPath = null;

                if ($request->hasFile('photo')) {
                    $photoPath = $request->file('photo')->store('employees/photos', 'public');
                    $storedFiles[] = ['public', $photoPath];
                }

                $ribFilePath = null;

                if ($request->hasFile('salary_rib_file')) {
                    $ribFilePath = $request->file('salary_rib_file')->store('employees/rib', 'local');
                    $storedFiles[] = ['local', $ribFilePath];
                }


                $employee = Employee::create(array_merge(
                    Arr::only($validated, [
                        'first_name', 'middle_name', 'last_name', 'gender', 'date_of_birth',
                        'number_card', 'country', 'marital_status',
                        'employee_work_phone', 'employee_phone', 'employee_email', 'employee_address',
                        'department_id', 'section_id', 'contract_type', 'end_contract_date',
                        'work_location', 'supervisor', 'employee_type',
                        'spouse_status', 'spouse_full_name', 'spouse_phone',
                    ]),
                    [
                        'employee_id'  => $this->generateEmployeeId(),
                        'photo'        => $photoPath,
                        'job_title_id' => $validated['job_title_id'] ?? 1,
                    ]
                ));

                $now = now();



                $parents = collect($validated['parents'] ?? [])
                    ->filter(fn ($p) => !empty($p['full_name']) || !empty($p['phone']))
                    ->map(fn ($p) => [
                        'employee_id'  => $employee->id,
                        'relationship' => $p['relationship'] ?? null,
                        'full_name'    => $p['full_name'] ?? null,
                        'phone'        => $p['phone'] ?? null,
                        'deceased'     => !empty($p['deceased']),
                        'created_at'   => $now,
                        'updated_at'   => $now,
                    ])
                    ->values()
                    ->all();

                if ($parents) {
                    EmployeeParent::insert($parents);
                }



                if (!empty($validated['emergency_full_name']) || !empty($validated['emergency_phone'])) {

                    EmergencyContact::create([
                        'employee_id'  => $employee->id,
                        'relationship' => $validated['emergency_relationship'] ?? null,
                        'full_name'    => $validated['emergency_full_name'] ?? null,
                        'phone'        => $validated['emergency_phone'] ?? null,
                        'address'      => $validated['emergency_address'] ?? null,
                    ]);
                }



                $amountFields = [
                    'housing_allowance', 'transport_allowance', 'meal_allowance',
                    'family_allowance', 'medical_allowance',
                    'other_non_taxable_allowances', 'other_taxable_allowances',
                    'cnss_employee', 'syndicate_deduction', 'ier',
                    'cnss_employer', 'inpp_employer', 'onem_employer',
                ];


                $amounts = [];
                foreach ($amountFields as $field) {
                    $amounts[$field] = $validated["salary_{$field}"] ?? 0;
                }

                $paymentMethods = $validated['salary_payment_methods'] ?? [];

                $hasSalaryData = !empty($paymentMethods)
                    || !empty($validated['salary_base_salary'])
                    || !empty($validated['salary_category'])
                    || !empty($validated['salary_currency'])
                    || array_sum($amounts) > 0;

                if ($hasSalaryData) {

                    EmployeeSalary::create(array_merge($amounts, [
                        'employee_id'     => $employee->id,
                        'base_salary'     => $validated['salary_base_salary'] ?? null,
                        'category'        => $validated['salary_category'] ?? null,
                        'echelon'         => $validated['salary_echelon'] ?? null,
                        'currency'        => $validated['salary_currency'] ?? null,
                        'payment_methods' => $paymentMethods,
                    ]));
                }



                if (in_array('bank_transfer', $paymentMethods, true)) {

                    EmployeeBankAccount::create([
                        'employee_id'    => $employee->id,
                        'bank_name'      => $validated['salary_bank_name'] ?? null,
                        'account_holder' => $validated['salary_bank_account_holder'] ?? null,
                        'account_number' => $validated['salary_bank_account_number'] ?? null,
                        'rib_file'       => $ribFilePath,
                        'currency'       => $validated['salary_currency'] ?? null,
                    ]);
                }
            });

        } catch (Throwable $e) {


            foreach ($storedFiles as [$disk, $path]) {
                Storage::disk($disk)->delete($path);
            }

            throw $e;
        }

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }


    private function generateEmployeeId(): string
    {
        $last = Employee::query()
            ->lockForUpdate()
            ->orderByDesc('id')
            ->value('employee_id');

        $number = $last ? ((int) preg_replace('/\D/', '', $last)) + 1 : 1;

        return 'AMC-OA' . str_pad((string) $number, 4, '0', STR_PAD_LEFT);
    }


    public function show(Employee $employee)
    {
        //
    }


//    public function edit(Employee $employee): View
//    {
//
//        $employee->load(['parents', 'emergencyContacts', 'salary']);
//
//        $departments = Department::all();
//
//        $sections = Section::where(
//            'department_id',
//            $employee->department_id
//        )->get();
//
//        $jobTitles = JobTitle::where(
//            'section_id',
//            $employee->section_id
//        )->get();
//
//        return view(
//            'admin.employees.edit',
//            compact('employee', 'departments', 'sections', 'jobTitles')
//        );
//    }






    public function edit(Employee $employee): View
    {

        $employee->load(['parents', 'emergencyContacts', 'salary', 'bankAccount']);

        $departments = Department::all();
        $sections    = Section::where('department_id', $employee->department_id)->get();
        $jobTitles   = JobTitle::where('section_id', $employee->section_id)->get();

        return view('admin.employees.edit', compact('employee', 'departments', 'sections', 'jobTitles'));
    }


    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $validated = $request->validated();

        $storedFiles = [];
        $oldFiles    = [];

        try {

            DB::transaction(function () use ($request, $validated, $employee, &$storedFiles, &$oldFiles) {

                /* ---------------- PHOTO ---------------- */

                $photoPath = $employee->photo;

                if ($request->hasFile('photo')) {
                    $photoPath = $request->file('photo')->store('employees/photos', 'public');
                    $storedFiles[] = ['public', $photoPath];

                    if ($employee->photo) {
                        $oldFiles[] = ['public', $employee->photo];
                    }
                }

                /* ---------------- EMPLOYEE ----------------
                 * Colonnes NOT NULL : on ne les écrase que si une valeur est envoyée
                 * (aucun champ n'est obligatoire en édition).
                 */

                $keepIfEmpty = [
                    'first_name', 'last_name', 'gender', 'date_of_birth', 'number_card',
                    'country', 'marital_status', 'department_id', 'section_id',
                    'contract_type', 'work_location', 'employee_type',
                ];

                $nullable = [
                    'middle_name', 'employee_work_phone', 'employee_phone', 'employee_email',
                    'employee_address', 'end_contract_date', 'supervisor',
                    'spouse_status', 'spouse_full_name', 'spouse_phone',
                ];

                $data = ['photo' => $photoPath];

                foreach ($keepIfEmpty as $field) {
                    if (filled($validated[$field] ?? null)) {
                        $data[$field] = $validated[$field];
                    }
                }

                foreach ($nullable as $field) {
                    $data[$field] = $validated[$field] ?? null;
                }

                if (filled($validated['job_title_id'] ?? null)) {
                    $data['job_title_id'] = $validated['job_title_id'];
                }

                $employee->update($data);

                /* ---------------- PARENTS ---------------- */

                $employee->parents()->delete();

                $now = now();

                $parents = collect($validated['parents'] ?? [])
                    ->filter(fn ($p) => !empty($p['full_name']) || !empty($p['phone']))
                    ->map(fn ($p) => [
                        'employee_id'  => $employee->id,
                        'relationship' => $p['relationship'] ?? null,
                        'full_name'    => $p['full_name'] ?? null,
                        'phone'        => $p['phone'] ?? null,
                        'deceased'     => !empty($p['deceased']),
                        'created_at'   => $now,
                        'updated_at'   => $now,
                    ])
                    ->values()
                    ->all();

                if ($parents) {
                    EmployeeParent::insert($parents);
                }

                /* ---------------- EMERGENCY CONTACT ---------------- */

                if (!empty($validated['emergency_full_name']) || !empty($validated['emergency_phone'])) {

                    EmergencyContact::updateOrCreate(
                        ['employee_id' => $employee->id],
                        [
                            'relationship' => $validated['emergency_relationship'] ?? null,
                            'full_name'    => $validated['emergency_full_name'] ?? null,
                            'phone'        => $validated['emergency_phone'] ?? null,
                            'address'      => $validated['emergency_address'] ?? null,
                        ]
                    );
                }

                /* ---------------- SALARY ---------------- */

                $amountFields = [
                    'housing_allowance', 'transport_allowance', 'meal_allowance',
                    'family_allowance', 'medical_allowance',
                    'other_non_taxable_allowances', 'other_taxable_allowances',
                    'cnss_employee', 'syndicate_deduction', 'ier',
                    'cnss_employer', 'inpp_employer', 'onem_employer',
                ];

                $amounts = [];
                foreach ($amountFields as $field) {
                    $amounts[$field] = $validated["salary_{$field}"] ?? 0;
                }

                $paymentMethods = $validated['salary_payment_methods'] ?? [];

                $hasSalaryData = !empty($paymentMethods)
                    || !empty($validated['salary_base_salary'])
                    || !empty($validated['salary_category'])
                    || !empty($validated['salary_currency'])
                    || array_sum($amounts) > 0;

                if ($hasSalaryData) {

                    EmployeeSalary::updateOrCreate(
                        ['employee_id' => $employee->id],
                        array_merge($amounts, [
                            'base_salary'     => $validated['salary_base_salary'] ?? null,
                            'category'        => $validated['salary_category'] ?? null,
                            'echelon'         => $validated['salary_echelon'] ?? null,
                            'currency'        => $validated['salary_currency'] ?? null,
                            'payment_methods' => $paymentMethods,
                        ])
                    );
                }

                /* ---------------- BANK ACCOUNT ----------------
                 * Seulement si "bank_transfer" est coché. Les données existantes
                 * ne sont jamais supprimées si la case est décochée.
                 */

                if (in_array('bank_transfer', $paymentMethods, true)) {

                    $bank = EmployeeBankAccount::firstOrNew(['employee_id' => $employee->id]);

                    $ribFilePath = $bank->rib_file;

                    if ($request->hasFile('salary_rib_file')) {
                        $ribFilePath = $request->file('salary_rib_file')->store('employees/rib', 'local');
                        $storedFiles[] = ['local', $ribFilePath];

                        if ($bank->rib_file) {
                            $oldFiles[] = ['local', $bank->rib_file];
                        }
                    }

                    $bank->fill([
                        'bank_name'      => $validated['salary_bank_name'] ?? null,
                        'account_holder' => $validated['salary_bank_account_holder'] ?? null,
                        'account_number' => $validated['salary_bank_account_number'] ?? null,
                        'rib_file'       => $ribFilePath,
                        'currency'       => $validated['salary_currency'] ?? null,
                    ])->save();
                }
            });

        } catch (Throwable $e) {

            foreach ($storedFiles as [$disk, $path]) {
                Storage::disk($disk)->delete($path);
            }

            throw $e;
        }

        // La transaction a réussi : on peut supprimer les anciens fichiers.
        foreach ($oldFiles as [$disk, $path]) {
            Storage::disk($disk)->delete($path);
        }

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }

    public function getSections(Department $department): \Illuminate\Http\JsonResponse
    {
        $sections = $department->sections()
            ->orderBy('name', 'asc')
            ->get([
                'id',
                'name',
            ]);

        return response()->json($sections);
    }

    public function getJobTitles(Section $section): \Illuminate\Http\JsonResponse
    {
        $jobTitles = $section->jobTitles()
            ->orderBy('name', 'asc')
            ->get([
                'id',
                'name',
            ]);

        return response()->json($jobTitles);
    }

    public function index(): View
    {
        $employees = Employee::with([
            'department',
            'section',
            'jobTitle',
        ])
            ->orderBy('first_name', 'asc')
            ->get();

        return view('employee.index', compact('employees'));
    }

    public function profile(Employee $employee)
    {
        return view('profile', compact('employee'));

    }



    public function myProfile()
    {

        $employee = auth()->user()->employee;

        if (!$employee) {
            abort(404, 'Aucun profil employé associé à ce compte.');
        }

        $employee->load(['department', 'section', 'jobTitle']);

        return view('admin.employees.profile', compact('employee'));
    }


    public function createChild(Employee $employee)
    {
        return view('employees.children.create', compact('employee'));
    }


    public function storeChild(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'children' => ['required', 'array', 'min:1'],

            'children.*.first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'children.*.middle_name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'children.*.last_name' => [
                'required',
                'string',
                'max:100',
            ],

            'children.*.gender' => [
                'nullable',
                'string',
                'max:20',
            ],

            'children.*.date_of_birth' => [
                'nullable',
                'date',
                'before_or_equal:today',
            ],

            'children.*.document_type' => [
                'nullable',
                Rule::in([
                    'birth_certificate',
                    'passport',
                    'other',
                ]),
            ],

            'children.*.document' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:4096',
            ],
        ]);

        $storedFiles = [];

        try {
            DB::transaction(function () use (
                $validated,
                $employee,
                &$storedFiles
            ) {
                foreach ($validated['children'] as $childData) {
                    $documentPath = null;

                    if (
                        isset($childData['document']) &&
                        $childData['document']->isValid()
                    ) {
                        $documentPath = $childData['document']->store(
                            'employee-children/documents',
                            'public'
                        );

                        $storedFiles[] = $documentPath;
                    }

                    EmployeeChild::create([
                        'employee_id' => $employee->id,
                        'first_name' => $childData['first_name'],
                        'middle_name' => $childData['middle_name'] ?? null,
                        'last_name' => $childData['last_name'],
                        'gender' => $childData['gender'] ?? null,
                        'date_of_birth' => $childData['date_of_birth'] ?? null,
                        'document_type' => $childData['document_type'] ?? null,
                        'document_path' => $documentPath,
                    ]);
                }
            });
        } catch (\Throwable $exception) {
            foreach ($storedFiles as $path) {
                Storage::disk('public')->delete($path);
            }

            report($exception);

            return back()
                ->withInput($request->except('children.*.document'))
                ->withErrors([
                    'children' => "Une erreur est survenue lors de l'enregistrement des enfants.",
                ]);
        }

        return redirect()
            ->route('employees.index')
            ->with('success', 'Les enfants ont été enregistrés avec succès.');
    }
}
