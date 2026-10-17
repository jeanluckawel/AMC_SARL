<?php

namespace App\Http\Controllers;

use App\Enums\ContractType;
use App\Enums\EmployeeType;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\WorkLocation;
use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeBankAccount;
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

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee): View
    {

        $employee->load(['parents', 'emergencyContacts', 'salary']);

        $departments = Department::all();

        $sections = Section::where(
            'department_id',
            $employee->department_id
        )->get();

        $jobTitles = JobTitle::where(
            'section_id',
            $employee->section_id
        )->get();

        return view(
            'admin.employees.edit',
            compact('employee', 'departments', 'sections', 'jobTitles')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | PERSONAL INFORMATION
            |--------------------------------------------------------------------------
            */

            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'middle_name' => ['nullable', 'string', 'min:2', 'max:255'],
            'last_name' => ['required', 'string', 'min:2', 'max:255'],
            'gender' => ['required', Rule::enum(Gender::class)],
            'date_of_birth' => ['required', 'date', 'before:today'],

            'number_card' => [
                'required',
                'string',
                'min:10',
                'max:255',

                // On ignore l'employé actuel dans la règle unique
                Rule::unique('employees', 'number_card')
                    ->ignore($employee->id),
            ],

            'country' => ['required', 'string', 'max:255'],
            'marital_status' => ['required', Rule::enum(MaritalStatus::class)],


            /*
            |--------------------------------------------------------------------------
            | CONTACT INFORMATION
            |--------------------------------------------------------------------------
            */

            'employee_work_phone' => ['nullable', 'string', 'max:50'],
            'employee_phone' => ['nullable', 'string', 'max:50'],
            'employee_email' => ['nullable', 'email', 'max:255'],
            'employee_address' => ['nullable', 'string'],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],


            /*
            |--------------------------------------------------------------------------
            | COMPANY
            |--------------------------------------------------------------------------
            */

            'department_id' => ['required', 'integer', 'exists:departments,id'],

            'section_id' => [
                'required',
                'integer',
                Rule::exists('sections', 'id')
                    ->where(fn ($query) => $query->where(
                        'department_id',
                        $request->department_id
                    )),
            ],

            'job_title_id' => [
                'nullable',
                'integer',
                Rule::exists('job_titles', 'id')
                    ->where(fn ($query) => $query->where(
                        'section_id',
                        $request->section_id
                    )),
            ],

            'contract_type' => ['required', Rule::enum(ContractType::class)],

            'end_contract_date' => [
                'nullable',
                'date',
                Rule::requiredIf(function () use ($request) {
                    return in_array(
                        $request->contract_type,
                        ['CDD', 'Stage', 'Consultant'],
                        true
                    );
                }),
            ],

            'work_location' => ['required', Rule::enum(WorkLocation::class)],
            'supervisor' => ['nullable', 'string', 'max:255'],
            'employee_type' => ['required', Rule::enum(EmployeeType::class)],


            /*
            |--------------------------------------------------------------------------
            | SPOUSE
            |--------------------------------------------------------------------------
            */

            'spouse_status' => ['nullable', 'string', 'max:50'],
            'spouse_full_name' => ['nullable', 'string', 'max:255'],
            'spouse_phone' => ['nullable', 'string', 'max:50'],


            /*
            |--------------------------------------------------------------------------
            | PARENTS
            |--------------------------------------------------------------------------
            */

            'parents' => ['nullable', 'array'],
            'parents.*.relationship' => ['nullable', 'string', 'max:100'],
            'parents.*.full_name' => ['nullable', 'string', 'max:255'],
            'parents.*.phone' => ['nullable', 'string', 'max:50'],
            'parents.*.deceased' => ['nullable', 'boolean'],


            /*
            |--------------------------------------------------------------------------
            | EMERGENCY CONTACT
            |--------------------------------------------------------------------------
            */

            'emergency_relationship' => ['nullable', 'string', 'max:100'],
            'emergency_full_name' => ['nullable', 'string', 'max:255'],
            'emergency_phone' => ['nullable', 'string', 'max:50'],
            'emergency_address' => ['nullable', 'string'],


            /*
            |--------------------------------------------------------------------------
            | SALARY
            |--------------------------------------------------------------------------
            */

            'salary_base_salary' => ['nullable', 'numeric', 'min:0'],
            'salary_category' => ['nullable', 'string', 'max:20'],
            'salary_echelon' => ['nullable', 'string', 'max:20'],
            'salary_currency' => ['nullable', 'string', 'max:20'],
        ]);


        DB::transaction(function () use ($request, $validated, $employee) {

            /*
            |--------------------------------------------------------------------------
            | PHOTO (on ne remplace que si un nouveau fichier est envoyé)
            |--------------------------------------------------------------------------
            */

            $photoPath = $employee->photo;

            if ($request->hasFile('photo')) {

                // On supprime l'ancienne photo si elle existe
                if ($employee->photo) {
                    Storage::disk('public')->delete($employee->photo);
                }

                $photoPath = $request
                    ->file('photo')
                    ->store('employees/photos', 'public');
            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE EMPLOYEE
            |--------------------------------------------------------------------------
            */

            $employee->update([

                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'] ?? null,
                'last_name' => $validated['last_name'],
                'gender' => $validated['gender'],
                'date_of_birth' => $validated['date_of_birth'],
                'number_card' => $validated['number_card'],
                'country' => $validated['country'],
                'marital_status' => $validated['marital_status'],

                'employee_work_phone' => $validated['employee_work_phone'] ?? null,
                'employee_phone' => $validated['employee_phone'] ?? null,
                'employee_email' => $validated['employee_email'] ?? null,
                'employee_address' => $validated['employee_address'] ?? null,

                'photo' => $photoPath,

                'department_id' => $validated['department_id'],
                'section_id' => $validated['section_id'],
                'job_title_id' => $validated['job_title_id'] ?? 1,
                'contract_type' => $validated['contract_type'],
                'end_contract_date' => $validated['end_contract_date'] ?? null,
                'work_location' => $validated['work_location'],
                'supervisor' => $validated['supervisor'] ?? null,
                'employee_type' => $validated['employee_type'],

                'spouse_status' => $validated['spouse_status'] ?? null,
                'spouse_full_name' => $validated['spouse_full_name'] ?? null,
                'spouse_phone' => $validated['spouse_phone'] ?? null,
            ]);


            /*
            |--------------------------------------------------------------------------
            | PARENTS (on remplace la liste existante)
            |--------------------------------------------------------------------------
            */

            $employee->parents()->delete();

            if (!empty($validated['parents'])) {

                foreach ($validated['parents'] as $parent) {

                    if (empty($parent['full_name']) && empty($parent['phone'])) {
                        continue;
                    }

                    EmployeeParent::create([
                        'employee_id' => $employee->id,
                        'relationship' => $parent['relationship'] ?? null,
                        'full_name' => $parent['full_name'] ?? null,
                        'phone' => $parent['phone'] ?? null,
                        'deceased' => !empty($parent['deceased']),
                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | EMERGENCY CONTACT (updateOrCreate)
            |--------------------------------------------------------------------------
            */

            if (
                !empty($validated['emergency_full_name']) ||
                !empty($validated['emergency_phone'])
            ) {

                EmergencyContact::updateOrCreate(
                    ['employee_id' => $employee->id],
                    [
                        'relationship' => $validated['emergency_relationship'] ?? null,
                        'full_name' => $validated['emergency_full_name'] ?? null,
                        'phone' => $validated['emergency_phone'] ?? null,
                        'address' => $validated['emergency_address'] ?? null,
                    ]
                );
            }


            /*
            |--------------------------------------------------------------------------
            | SALARY (updateOrCreate)
            |--------------------------------------------------------------------------
            */

            if (
                !empty($validated['salary_base_salary']) ||
                !empty($validated['salary_category']) ||
                !empty($validated['salary_currency'])
            ) {

                EmployeeSalary::updateOrCreate(
                    ['employee_id' => $employee->id],
                    [
                        'base_salary' => $validated['salary_base_salary'] ?? null,
                        'category' => $validated['salary_category'] ?? null,
                        'echelon' => $validated['salary_echelon'] ?? null,
                        'currency' => $validated['salary_currency'] ?? null,
                    ]
                );
            }

        });


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
}
