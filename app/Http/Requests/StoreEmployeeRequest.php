<?php

namespace App\Http\Requests;

use App\Enums\ContractType;
use App\Enums\EmployeeType;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\WorkLocation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $bankRequired = fn () => in_array(
            'bank_transfer',
            (array) $this->input('salary_payment_methods', []),
            true
        );

        $money = ['nullable', 'numeric', 'min:0'];

        return [


            'first_name'     => ['required', 'string', 'min:2', 'max:255'],
            'middle_name'    => ['nullable', 'string', 'min:2', 'max:255'],
            'last_name'      => ['required', 'string', 'min:2', 'max:255'],
            'gender'         => ['required', Rule::enum(Gender::class)],
            'date_of_birth'  => ['required', 'date', 'before:today'],
            'number_card'    => ['required', 'string', 'min:10', 'max:255', 'unique:employees,number_card'],
            'country'        => ['required', 'string', 'max:255'],
            'marital_status' => ['required', Rule::enum(MaritalStatus::class)],


            'employee_work_phone' => ['nullable', 'string', 'max:50'],
            'employee_phone'      => ['nullable', 'string', 'max:50'],
            'employee_email'      => ['nullable', 'email', 'max:255'],
            'employee_address'    => ['nullable', 'string'],
            'photo'               => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],


            'department_id' => ['required', 'integer', 'exists:departments,id'],


            'section_id' => [
                'required', 'integer',
                Rule::exists('sections', 'id')->where('department_id', $this->input('department_id')),
            ],


            'job_title_id' => [
                'nullable', 'integer',
                Rule::exists('job_titles', 'id')->where('section_id', $this->input('section_id')),
            ],

            'contract_type'     => ['required', Rule::enum(ContractType::class)],
            'end_contract_date' => [
                'nullable', 'date',
                Rule::requiredIf(fn () => in_array(
                    $this->input('contract_type'),
                    [ContractType::cases()],
                    true
                )),
            ],
            'work_location' => ['required', Rule::enum(WorkLocation::class)],
            'supervisor'    => ['nullable', 'string', 'max:255'],
            'employee_type' => ['required', Rule::enum(EmployeeType::class)],


            'spouse_status'    => ['nullable', 'string', 'max:50'],
            'spouse_full_name' => ['nullable', 'string', 'max:255'],
            'spouse_phone'     => ['nullable', 'string', 'max:50'],


            'parents'                => ['nullable', 'array'],
            'parents.*.relationship' => ['nullable', 'string', 'max:100'],
            'parents.*.full_name'    => ['nullable', 'string', 'max:255'],
            'parents.*.phone'        => ['nullable', 'string', 'max:50'],
            'parents.*.deceased'     => ['nullable', 'boolean'],


            'emergency_relationship' => ['nullable', 'string', 'max:100'],
            'emergency_full_name'    => ['nullable', 'string', 'max:255'],
            'emergency_phone'        => ['nullable', 'string', 'max:50'],
            'emergency_address'      => ['nullable', 'string'],


            'salary_base_salary' => $money,
            'salary_category'    => ['nullable', 'string', 'max:20'],
            'salary_echelon'     => ['nullable', 'string', 'max:20'],
            'salary_currency'    => ['nullable', 'string', 'max:20'],

            'salary_payment_methods'   => ['nullable', 'array'],
            'salary_payment_methods.*' => ['string', Rule::in(['cash', 'bank_transfer', 'mobile_money', 'cheque'])],

            'salary_housing_allowance'            => $money,
            'salary_transport_allowance'          => $money,
            'salary_meal_allowance'               => $money,
            'salary_family_allowance'             => $money,
            'salary_medical_allowance'            => $money,
            'salary_other_non_taxable_allowances' => $money,
            'salary_other_taxable_allowances'     => $money,

            'salary_cnss_employee'       => $money,
            'salary_syndicate_deduction' => $money,
            'salary_ier'                 => $money,

            'salary_cnss_employer' => $money,
            'salary_inpp_employer' => $money,
            'salary_onem_employer' => $money,


            'salary_bank_name'           => [Rule::requiredIf($bankRequired), 'nullable', 'string', 'max:255'],
            'salary_bank_account_holder' => [Rule::requiredIf($bankRequired), 'nullable', 'string', 'max:255'],
            'salary_bank_account_number' => [Rule::requiredIf($bankRequired), 'nullable', 'string', 'max:255'],
            'salary_rib_file'            => [Rule::requiredIf($bankRequired), 'nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:4096'],
        ];
    }
}
