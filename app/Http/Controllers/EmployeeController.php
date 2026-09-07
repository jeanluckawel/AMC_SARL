<?php

namespace App\Http\Controllers;

use App\Enums\ContractType;
use App\Enums\EmployeeType;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\WorkLocation;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeParent;
use App\Models\EmployeeSalary;
use App\Models\EmergencyContact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function create(): View
    {
        $departments = Department::orderBy('name', 'asc')->get();

        return view('employee.create', compact('departments'));
    }


    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | PERSONAL INFORMATION
            |--------------------------------------------------------------------------
            */

            'first_name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],

            'middle_name' => [
                'nullable',
                'string',
                'min:2',
                'max:255',
            ],

            'last_name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],

            'gender' => [
                'required',
                Rule::enum(Gender::class),
            ],

            'date_of_birth' => [
                'required',
                'date',
                'before:today',
            ],

            'number_card' => [
                'required',
                'string',
                'min:10',
                'max:255',
                'unique:employees,number_card',
            ],

            'country' => [
                'required',
                'string',
                'max:255',
            ],

            'marital_status' => [
                'required',
                Rule::enum(MaritalStatus::class),
            ],


            /*
            |--------------------------------------------------------------------------
            | CONTACT INFORMATION
            |--------------------------------------------------------------------------
            */

            'employee_work_phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'employee_phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'employee_email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'employee_address' => [
                'nullable',
                'string',
            ],

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

            'department_id' => [
                'required',
                'integer',
                'exists:departments,id',
            ],

            'section_id' => [
                'required',
                'integer',

                /*
                 * La section doit appartenir au département sélectionné.
                 */
                Rule::exists('sections', 'id')
                    ->where(function ($query) use ($request) {

                        $query->where(
                            'department_id',
                            $request->department_id
                        );

                    }),
            ],

            'job_title_id' => [
                'nullable',
                'integer',

                /*
                 * Le job title doit appartenir à la section sélectionnée.
                 */
                Rule::exists('job_titles', 'id')
                    ->where(function ($query) use ($request) {

                        $query->where(
                            'section_id',
                            $request->section_id
                        );

                    }),
            ],

            'contract_type' => [
                'required',
                Rule::enum(ContractType::class),
            ],

            'end_contract_date' => [
                'nullable',
                'date',
                Rule::requiredIf(function () use ($request) {

                    return in_array(
                        $request->contract_type,
                        [
                            'CDD',
                            'Stage',
                            'Consultant',
                        ],
                        true
                    );

                }),
            ],

            'work_location' => [
                'required',
                Rule::enum(WorkLocation::class),
            ],

            'supervisor' => [
                'nullable',
                'string',
                'max:255',
            ],

            'employee_type' => [
                'required',
                Rule::enum(EmployeeType::class),
            ],

            'hire_date' => [
                'required',
                'date',
            ],


            /*
            |--------------------------------------------------------------------------
            | SPOUSE
            |--------------------------------------------------------------------------
            */

            'spouse_status' => [
                'nullable',
                'string',
                'max:50',
            ],

            'spouse_full_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'spouse_phone' => [
                'nullable',
                'string',
                'max:50',
            ],


            /*
            |--------------------------------------------------------------------------
            | PARENTS
            |--------------------------------------------------------------------------
            */

            'parents' => [
                'nullable',
                'array',
            ],

            'parents.*.relationship' => [
                'nullable',
                'string',
                'max:100',
            ],

            'parents.*.full_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'parents.*.phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'parents.*.deceased' => [
                'nullable',
                'boolean',
            ],


            /*
            |--------------------------------------------------------------------------
            | EMERGENCY CONTACT
            |--------------------------------------------------------------------------
            */

            'emergency_relationship' => [
                'nullable',
                'string',
                'max:100',
            ],

            'emergency_full_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'emergency_phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'emergency_address' => [
                'nullable',
                'string',
            ],


            /*
            |--------------------------------------------------------------------------
            | SALARY
            |--------------------------------------------------------------------------
            */

            'salary_base_salary' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'salary_category' => [
                'nullable',
                'string',
                'max:20',
            ],

            'salary_echelon' => [
                'nullable',
                'string',
                'max:20',
            ],

            'salary_currency' => [
                'nullable',
                'string',
                'max:20',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | DATABASE TRANSACTION
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($request, $validated) {


            /*
            |--------------------------------------------------------------------------
            | GENERATE AMC EMPLOYEE ID
            |--------------------------------------------------------------------------
            |
            | Exemple :
            | AMC-001
            | AMC-002
            | AMC-003
            |
            */

            $lastEmployee = Employee::query()
                ->orderByDesc('id')
                ->first();

            if ($lastEmployee && $lastEmployee->employee_id) {

                $lastNumber = (int) str_replace(
                    'AMC-',
                    '',
                    $lastEmployee->employee_id
                );

                $employeeId = 'AMC-' . str_pad(
                        $lastNumber + 1,
                        3,
                        '0',
                        STR_PAD_LEFT
                    );

            } else {

                $employeeId = 'AMC-001';

            }


            /*
            |--------------------------------------------------------------------------
            | PHOTO
            |--------------------------------------------------------------------------
            */

            $photoPath = null;

            if ($request->hasFile('photo')) {

                $photoPath = $request
                    ->file('photo')
                    ->store(
                        'employees/photos',
                        'public'
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | CREATE EMPLOYEE
            |--------------------------------------------------------------------------
            */

            $employee = Employee::create([

                /*
                |--------------------------------------------------------------------------
                | Employee ID
                |--------------------------------------------------------------------------
                */

                'employee_id' => $employeeId,


                /*
                |--------------------------------------------------------------------------
                | Personal
                |--------------------------------------------------------------------------
                */

                'first_name' => $validated['first_name'],

                'middle_name' =>
                    $validated['middle_name'] ?? null,

                'last_name' =>
                    $validated['last_name'],

                'gender' =>
                    $validated['gender'],

                'date_of_birth' =>
                    $validated['date_of_birth'],

                'number_card' =>
                    $validated['number_card'],

                'country' =>
                    $validated['country'],

                'marital_status' =>
                    $validated['marital_status'],


                /*
                |--------------------------------------------------------------------------
                | Contact
                |--------------------------------------------------------------------------
                */

                'employee_work_phone' =>
                    $validated['employee_work_phone'] ?? null,

                'employee_phone' =>
                    $validated['employee_phone'] ?? null,

                'employee_email' =>
                    $validated['employee_email'] ?? null,

                'employee_address' =>
                    $validated['employee_address'] ?? null,


                /*
                |--------------------------------------------------------------------------
                | Photo
                |--------------------------------------------------------------------------
                */

                'photo' =>
                    $photoPath,


                /*
                |--------------------------------------------------------------------------
                | Company
                |--------------------------------------------------------------------------
                */

                'department_id' =>
                    $validated['department_id'],

                'section_id' =>
                    $validated['section_id'],

                'job_title_id' =>
                    $validated['job_title_id'] ?? 1,

                'contract_type' =>
                    $validated['contract_type'],

                'end_contract_date' =>
                    $validated['end_contract_date'] ?? null,

                'work_location' =>
                    $validated['work_location'],

                'supervisor' =>
                    $validated['supervisor'] ?? null,

                'employee_type' =>
                    $validated['employee_type'],


                /*
                |--------------------------------------------------------------------------
                | Spouse
                |--------------------------------------------------------------------------
                */

                'spouse_status' =>
                    $validated['spouse_status'] ?? null,

                'spouse_full_name' =>
                    $validated['spouse_full_name'] ?? null,

                'spouse_phone' =>
                    $validated['spouse_phone'] ?? null,
            ]);


            /*
            |--------------------------------------------------------------------------
            | PARENTS
            |--------------------------------------------------------------------------
            */

            if (!empty($validated['parents'])) {

                foreach ($validated['parents'] as $parent) {

                    /*
                     * Si aucune information n'est renseignée,
                     * on ne crée pas de ligne.
                     */

                    if (
                        empty($parent['full_name']) &&
                        empty($parent['phone'])
                    ) {
                        continue;
                    }


                    EmployeeParent::create([

                        'employee_id' =>
                            $employee->id,

                        'relationship' =>
                            $parent['relationship'] ?? null,

                        'full_name' =>
                            $parent['full_name'] ?? null,

                        'phone' =>
                            $parent['phone'] ?? null,

                        'deceased' =>
                            !empty($parent['deceased']),
                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | EMERGENCY CONTACT
            |--------------------------------------------------------------------------
            */

            if (
                !empty($validated['emergency_full_name']) ||
                !empty($validated['emergency_phone'])
            ) {

                EmergencyContact::create([

                    'employee_id' =>
                        $employee->id,

                    'relationship' =>
                        $validated['emergency_relationship'] ?? null,

                    'full_name' =>
                        $validated['emergency_full_name'] ?? null,

                    'phone' =>
                        $validated['emergency_phone'] ?? null,

                    'address' =>
                        $validated['emergency_address'] ?? null,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | SALARY
            |--------------------------------------------------------------------------
            */

            if (
                !empty($validated['salary_base_salary']) ||
                !empty($validated['salary_category']) ||
                !empty($validated['salary_currency'])
            ) {

                EmployeeSalary::create([

                    'employee_id' =>
                        $employee->id,

                    'base_salary' =>
                        $validated['salary_base_salary'] ?? null,

                    'category' =>
                        $validated['salary_category'] ?? null,

                    'echelon' =>
                        $validated['salary_echelon'] ?? null,

                    'currency' =>
                        $validated['salary_currency'] ?? null,
                ]);
            }

        });


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('employees.index')
            ->with(
                'success',
                'Employee created successfully.'
            );
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
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
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
}
