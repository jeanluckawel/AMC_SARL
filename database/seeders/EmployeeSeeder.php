<?php

namespace database\seeders;

use App\Enums\ContractType;
use App\Enums\EmployeeType;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\WorkLocation;
use App\Models\Department;
use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Section;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE 1 - GENERAL MANAGEMENT
            |--------------------------------------------------------------------------
            */
            [
                'employee_id' => 'AMC-001',

                'first_name' => 'John',
                'middle_name' => 'Michael',
                'last_name' => 'Doe',

                'gender' => Gender::MALE->value,
                'date_of_birth' => '1990-05-15',
                'number_card' => 'CARD-0001',
                'country' => 'DR Congo',
                'marital_status' => MaritalStatus::SINGLE->value,

                'employee_work_phone' => '+243 810 000 001',
                'employee_phone' => '+243 970 000 001',
                'employee_email' => 'john.doe@example.com',
                'employee_address' => 'Kolwezi, Lualaba',

                'department_code' => 'DEP-GM',
                'section_code' => 'SEC-GM',
                'job_title_code' => 'JOB-GM-MD',

                'contract_type' => ContractType::CDI->value,
                'end_contract_date' => null,
                'work_location' => WorkLocation::HEAD_OFFICE->value,
                'supervisor' => null,
                'employee_type' => EmployeeType::FULL_TIME->value,

                'spouse_status' => null,
                'spouse_full_name' => null,
                'spouse_phone' => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE 2 - OPERATIONS & PROJECTS
            |--------------------------------------------------------------------------
            */
            [
                'employee_id' => 'AMC-002',

                'first_name' => 'Patrick',
                'middle_name' => null,
                'last_name' => 'Mwamba',

                'gender' => Gender::MALE->value,
                'date_of_birth' => '1988-02-11',
                'number_card' => 'CARD-0002',
                'country' => 'DR Congo',
                'marital_status' => MaritalStatus::MARRIED->value,

                'employee_work_phone' => '+243 810 000 002',
                'employee_phone' => '+243 970 000 002',
                'employee_email' => 'patrick.mwamba@example.com',
                'employee_address' => 'Manika, Kolwezi',

                'department_code' => 'DEP-OP',
                'section_code' => 'SEC-OP-OPS',
                'job_title_code' => 'JOB-OP-OPO',

                'contract_type' => ContractType::CDI->value,
                'end_contract_date' => null,
                'work_location' => WorkLocation::KAMOA_COPPER->value,
                'supervisor' => 'Managing Director',
                'employee_type' => EmployeeType::FULL_TIME->value,

                'spouse_status' => MaritalStatus::MARRIED->value,
                'spouse_full_name' => 'Marie Mwamba',
                'spouse_phone' => '+243 970 100 002',
            ],

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE 3 - MASONRY
            |--------------------------------------------------------------------------
            */
            [
                'employee_id' => 'AMC-003',

                'first_name' => 'David',
                'middle_name' => 'Paul',
                'last_name' => 'Kalala',

                'gender' => Gender::MALE->value,
                'date_of_birth' => '1995-11-05',
                'number_card' => 'CARD-0003',
                'country' => 'DR Congo',
                'marital_status' => MaritalStatus::SINGLE->value,

                'employee_work_phone' => '+243 810 000 003',
                'employee_phone' => '+243 970 000 003',
                'employee_email' => 'david.kalala@example.com',
                'employee_address' => 'Kolwezi, Lualaba',

                'department_code' => 'DEP-OP',
                'section_code' => 'SEC-OP-MAS',
                'job_title_code' => 'JOB-OP-MO',

                'contract_type' => ContractType::CDD->value,
                'end_contract_date' => null,
                'work_location' => WorkLocation::KAMOA_COPPER->value,
                'supervisor' => 'Operations and Projects Officer',
                'employee_type' => EmployeeType::FULL_TIME->value,

                'spouse_status' => null,
                'spouse_full_name' => null,
                'spouse_phone' => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE 4 - HUMAN RESOURCES
            |--------------------------------------------------------------------------
            */
            [
                'employee_id' => 'AMC-004',

                'first_name' => 'Sarah',
                'middle_name' => 'Grace',
                'last_name' => 'Smith',

                'gender' => Gender::FEMALE->value,
                'date_of_birth' => '1993-08-20',
                'number_card' => 'CARD-0004',
                'country' => 'DR Congo',
                'marital_status' => MaritalStatus::MARRIED->value,

                'employee_work_phone' => '+243 810 000 004',
                'employee_phone' => '+243 970 000 004',
                'employee_email' => 'sarah.smith@example.com',
                'employee_address' => 'Kolwezi, Lualaba',

                'department_code' => 'DEP-HR',
                'section_code' => 'SEC-HR',
                'job_title_code' => 'JOB-HR-HRO',

                'contract_type' => ContractType::CDI->value,
                'end_contract_date' => null,
                'work_location' => WorkLocation::HEAD_OFFICE->value,
                'supervisor' => 'Managing Director',
                'employee_type' => EmployeeType::FULL_TIME->value,

                'spouse_status' => MaritalStatus::MARRIED->value,
                'spouse_full_name' => 'Daniel Smith',
                'spouse_phone' => '+243 970 100 004',
            ],

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE 5 - FINANCE
            |--------------------------------------------------------------------------
            */
            [
                'employee_id' => 'AMC-005',

                'first_name' => 'Daniel',
                'middle_name' => 'Junior',
                'last_name' => 'Kabila',

                'gender' => Gender::MALE->value,
                'date_of_birth' => '1987-04-22',
                'number_card' => 'CARD-0005',
                'country' => 'DR Congo',
                'marital_status' => MaritalStatus::MARRIED->value,

                'employee_work_phone' => '+243 810 000 005',
                'employee_phone' => '+243 970 000 005',
                'employee_email' => 'daniel.kabila@example.com',
                'employee_address' => 'Kolwezi, Lualaba',

                'department_code' => 'DEP-FIN',
                'section_code' => 'SEC-FIN',
                'job_title_code' => 'JOB-FIN-FO',

                'contract_type' => ContractType::CDI->value,
                'end_contract_date' => null,
                'work_location' => WorkLocation::HEAD_OFFICE->value,
                'supervisor' => 'Managing Director',
                'employee_type' => EmployeeType::FULL_TIME->value,

                'spouse_status' => MaritalStatus::MARRIED->value,
                'spouse_full_name' => 'Grace Kabila',
                'spouse_phone' => '+243 970 100 005',
            ],

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE 6 - SAFETY
            |--------------------------------------------------------------------------
            */
            [
                'employee_id' => 'AMC-006',

                'first_name' => 'Michel',
                'middle_name' => 'Joseph',
                'last_name' => 'Tshibangu',

                'gender' => Gender::MALE->value,
                'date_of_birth' => '1985-09-25',
                'number_card' => 'CARD-0006',
                'country' => 'DR Congo',
                'marital_status' => MaritalStatus::MARRIED->value,

                'employee_work_phone' => '+243 810 000 006',
                'employee_phone' => '+243 970 000 006',
                'employee_email' => 'michel.tshibangu@example.com',
                'employee_address' => 'Kolwezi, Lualaba',

                'department_code' => 'DEP-SAF',
                'section_code' => 'SEC-SAF-HSE',
                'job_title_code' => 'JOB-SAF-HSE',

                'contract_type' => ContractType::CDI->value,
                'end_contract_date' => null,
                'work_location' => WorkLocation::KAMOA_COPPER->value,
                'supervisor' => 'Managing Director',
                'employee_type' => EmployeeType::FULL_TIME->value,

                'spouse_status' => MaritalStatus::MARRIED->value,
                'spouse_full_name' => 'Jeanne Tshibangu',
                'spouse_phone' => '+243 970 100 006',
            ],

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE 7 - TRANSPORT
            |--------------------------------------------------------------------------
            */
            [
                'employee_id' => 'AMC-007',

                'first_name' => 'Kevin',
                'middle_name' => null,
                'last_name' => 'Ilunga',

                'gender' => Gender::MALE->value,
                'date_of_birth' => '1997-03-12',
                'number_card' => 'CARD-0007',
                'country' => 'DR Congo',
                'marital_status' => MaritalStatus::SINGLE->value,

                'employee_work_phone' => '+243 810 000 007',
                'employee_phone' => '+243 970 000 007',
                'employee_email' => 'kevin.ilunga@example.com',
                'employee_address' => 'Kolwezi, Lualaba',

                'department_code' => 'DEP-TRA',
                'section_code' => 'SEC-TRA',
                'job_title_code' => 'JOB-TRA-TDR',

                'contract_type' => ContractType::CDD->value,
                'end_contract_date' => '2027-06-30',
                'work_location' => WorkLocation::KAMOA_COPPER->value,
                'supervisor' => 'Supervisor Officer',
                'employee_type' => EmployeeType::FULL_TIME->value,

                'spouse_status' => null,
                'spouse_full_name' => null,
                'spouse_phone' => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE 8 - LOGISTICS
            |--------------------------------------------------------------------------
            */
            [
                'employee_id' => 'AMC-008',

                'first_name' => 'Esther',
                'middle_name' => 'Rose',
                'last_name' => 'Mutombo',

                'gender' => Gender::FEMALE->value,
                'date_of_birth' => '1992-12-01',
                'number_card' => 'CARD-0008',
                'country' => 'DR Congo',
                'marital_status' => MaritalStatus::MARRIED->value,

                'employee_work_phone' => '+243 810 000 008',
                'employee_phone' => '+243 970 000 008',
                'employee_email' => 'esther.mutombo@example.com',
                'employee_address' => 'Manika, Kolwezi',

                'department_code' => 'DEP-LOG',
                'section_code' => 'SEC-LOG',
                'job_title_code' => 'JOB-LOG-LO',

                'contract_type' => ContractType::CDI->value,
                'end_contract_date' => null,
                'work_location' => WorkLocation::KAMOA_COPPER->value,
                'supervisor' => 'Managing Director',
                'employee_type' => EmployeeType::FULL_TIME->value,

                'spouse_status' => MaritalStatus::MARRIED->value,
                'spouse_full_name' => 'Paul Mutombo',
                'spouse_phone' => '+243 970 100 008',
            ],

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE 9 - PROCUREMENT
            |--------------------------------------------------------------------------
            */
            [
                'employee_id' => 'AMC-009',

                'first_name' => 'Alice',
                'middle_name' => 'Marie',
                'last_name' => 'Kabeya',

                'gender' => Gender::FEMALE->value,
                'date_of_birth' => '1991-06-18',
                'number_card' => 'CARD-0009',
                'country' => 'DR Congo',
                'marital_status' => MaritalStatus::SINGLE->value,

                'employee_work_phone' => '+243 810 000 009',
                'employee_phone' => '+243 970 000 009',
                'employee_email' => 'alice.kabeya@example.com',
                'employee_address' => 'Dilala, Kolwezi',

                'department_code' => 'DEP-PRO',
                'section_code' => 'SEC-PRO',
                'job_title_code' => 'JOB-PRO-OFF',

                'contract_type' => ContractType::CDI->value,
                'end_contract_date' => null,
                'work_location' => WorkLocation::HEAD_OFFICE->value,
                'supervisor' => 'Managing Director',
                'employee_type' => EmployeeType::FULL_TIME->value,

                'spouse_status' => null,
                'spouse_full_name' => null,
                'spouse_phone' => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE 10 - INFORMATION TECHNOLOGY
            |--------------------------------------------------------------------------
            */
            [
                'employee_id' => 'AMC-010',

                'first_name' => 'Rachel',
                'middle_name' => null,
                'last_name' => 'Kasongo',

                'gender' => Gender::FEMALE->value,
                'date_of_birth' => '1996-07-30',
                'number_card' => 'CARD-0010',
                'country' => 'DR Congo',
                'marital_status' => MaritalStatus::SINGLE->value,

                'employee_work_phone' => '+243 810 000 010',
                'employee_phone' => '+243 970 000 010',
                'employee_email' => 'rachel.kasongo@example.com',
                'employee_address' => 'Kolwezi, Lualaba',

                'department_code' => 'DEP-IT',
                'section_code' => 'SEC-IT',
                'job_title_code' => 'JOB-IT-OFF',

                'contract_type' => ContractType::CDI->value,
                'end_contract_date' => null,
                'work_location' => WorkLocation::HEAD_OFFICE->value,
                'supervisor' => 'Managing Director',
                'employee_type' => EmployeeType::FULL_TIME->value,

                'spouse_status' => null,
                'spouse_full_name' => null,
                'spouse_phone' => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE 11 - SECURITY
            |--------------------------------------------------------------------------
            */
            [
                'employee_id' => 'AMC-011',

                'first_name' => 'Paul',
                'middle_name' => null,
                'last_name' => 'Kabongo',

                'gender' => Gender::MALE->value,
                'date_of_birth' => '1994-01-18',
                'number_card' => 'CARD-0011',
                'country' => 'DR Congo',
                'marital_status' => MaritalStatus::SINGLE->value,

                'employee_work_phone' => '+243 810 000 011',
                'employee_phone' => '+243 970 000 011',
                'employee_email' => 'paul.kabongo@example.com',
                'employee_address' => 'Kolwezi, Lualaba',

                'department_code' => 'DEP-SEC',
                'section_code' => 'SEC-SEC',
                'job_title_code' => 'JOB-SEC-OFF',

                'contract_type' => ContractType::CDD->value,
                'end_contract_date' => null,
                'work_location' => WorkLocation::KAMOA_COPPER->value,
                'supervisor' => 'Managing Director',
                'employee_type' => EmployeeType::FULL_TIME->value,

                'spouse_status' => null,
                'spouse_full_name' => null,
                'spouse_phone' => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE 12 - CLEANING
            |--------------------------------------------------------------------------
            */
            [
                'employee_id' => 'AMC-012',

                'first_name' => 'Marie',
                'middle_name' => 'Louise',
                'last_name' => 'Kalume',

                'gender' => Gender::FEMALE->value,
                'date_of_birth' => '1996-10-10',
                'number_card' => 'CARD-0012',
                'country' => 'DR Congo',
                'marital_status' => MaritalStatus::SINGLE->value,

                'employee_work_phone' => '+243 810 000 012',
                'employee_phone' => '+243 970 000 012',
                'employee_email' => 'marie.kalume@example.com',
                'employee_address' => 'Kolwezi, Lualaba',

                'department_code' => 'DEP-CLN',
                'section_code' => 'SEC-CLN',
                'job_title_code' => 'JOB-CLN-CLR',

                'contract_type' => ContractType::CDD->value,
                'end_contract_date' => null,
                'work_location' => WorkLocation::HEAD_OFFICE->value,
                'supervisor' => 'Managing Director',
                'employee_type' => EmployeeType::FULL_TIME->value,

                'spouse_status' => null,
                'spouse_full_name' => null,
                'spouse_phone' => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE 13 - RESTAURATION
            |--------------------------------------------------------------------------
            */
            [
                'employee_id' => 'AMC-013',

                'first_name' => 'Joseph',
                'middle_name' => null,
                'last_name' => 'Mukendi',

                'gender' => Gender::MALE->value,
                'date_of_birth' => '1993-09-14',
                'number_card' => 'CARD-0013',
                'country' => 'DR Congo',
                'marital_status' => MaritalStatus::SINGLE->value,

                'employee_work_phone' => '+243 810 000 013',
                'employee_phone' => '+243 970 000 013',
                'employee_email' => 'joseph.mukendi@example.com',
                'employee_address' => 'Kolwezi, Lualaba',

                'department_code' => 'DEP-RES',
                'section_code' => 'SEC-RES',
                'job_title_code' => 'JOB-RES-FF',

                'contract_type' => ContractType::CDD->value,
                'end_contract_date' => null,
                'work_location' => WorkLocation::HEAD_OFFICE->value,
                'supervisor' => 'Managing Director',
                'employee_type' => EmployeeType::FULL_TIME->value,

                'spouse_status' => null,
                'spouse_full_name' => null,
                'spouse_phone' => null,
            ],
        ];

        foreach ($employees as $data) {

            /*
            |--------------------------------------------------------------------------
            | FIND DEPARTMENT BY CODE
            |--------------------------------------------------------------------------
            */
            $department = Department::where('code', $data['department_code'])
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | FIND SECTION BY CODE
            |--------------------------------------------------------------------------
            */
            $section = Section::where('code', $data['section_code'])
                ->where('department_id', $department->id)
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | FIND JOB TITLE BY CODE
            |--------------------------------------------------------------------------
            */
            $jobTitle = JobTitle::where('code', $data['job_title_code'])
                ->where('section_id', $section->id)
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | CREATE EMPLOYEE
            |--------------------------------------------------------------------------
            */
            Employee::create([
                'employee_id' => $data['employee_id'],

                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],

                'gender' => $data['gender'],
                'date_of_birth' => $data['date_of_birth'],
                'number_card' => $data['number_card'],
                'country' => $data['country'],
                'marital_status' => $data['marital_status'],

                'employee_work_phone' => $data['employee_work_phone'],
                'employee_phone' => $data['employee_phone'],
                'employee_email' => $data['employee_email'],
                'employee_address' => $data['employee_address'],

                'photo' => null,

                'department_id' => $department->id,
                'section_id' => $section->id,
                'job_title_id' => $jobTitle->id,

                'contract_type' => $data['contract_type'],
                'end_contract_date' => $data['end_contract_date'],
                'work_location' => $data['work_location'],
                'supervisor' => $data['supervisor'],
                'employee_type' => $data['employee_type'],

                'spouse_status' => $data['spouse_status'],
                'spouse_full_name' => $data['spouse_full_name'],
                'spouse_phone' => $data['spouse_phone'],
            ]);
        }
    }
}
