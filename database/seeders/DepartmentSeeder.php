<?php

namespace Database\Seeders;


use App\Models\Department;
use App\Models\JobTitle;
use App\Models\Section;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {

        $department = Department::create([
            'name' => 'Management',
            'code' => 'DEP-MD',
        ]);

        $section = Section::create([
            'department_id' => $department->id,
            'name' => 'Management',
            'code' => 'SEC-GM',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Managing Director',
            'code' => 'JOB-GM-MD',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 2. OPERATIONS & PROJECTS
        |--------------------------------------------------------------------------
        */
        $department = Department::create([
            'name' => 'Operations & Projects',
            'code' => 'DEP-OP',
        ]);

        // Operations
        $section = Section::create([
            'department_id' => $department->id,
            'name' => 'Operations',
            'code' => 'SEC-OP-OPS',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Operations and Projects Officer',
            'code' => 'JOB-OP-OPO',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Supervisor Officer',
            'code' => 'JOB-OP-SUP',
        ]);

        // Masonry
        $section = Section::create([
            'department_id' => $department->id,
            'name' => 'Masonry',
            'code' => 'SEC-OP-MAS',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Masonry Officer',
            'code' => 'JOB-OP-MO',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Assistant Masonry Officer',
            'code' => 'JOB-OP-AMO',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 3. HUMAN RESOURCES
        |--------------------------------------------------------------------------
        */
        $department = Department::create([
            'name' => 'Human Resources',
            'code' => 'DEP-HR',
        ]);

        $section = Section::create([
            'department_id' => $department->id,
            'name' => 'Human Resources',
            'code' => 'SEC-HR',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'HR Officer',
            'code' => 'JOB-HR-HRO',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Assistant HR Officer',
            'code' => 'JOB-HR-AHRO',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 4. FINANCE
        |--------------------------------------------------------------------------
        */
        $department = Department::create([
            'name' => 'Finance',
            'code' => 'DEP-FIN',
        ]);

        $section = Section::create([
            'department_id' => $department->id,
            'name' => 'Finance',
            'code' => 'SEC-FIN',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Finance Officer',
            'code' => 'JOB-FIN-FO',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 5. SAFETY
        |--------------------------------------------------------------------------
        */
        $department = Department::create([
            'name' => 'Safety',
            'code' => 'DEP-SAF',
        ]);

        $section = Section::create([
            'department_id' => $department->id,
            'name' => 'HSE',
            'code' => 'SEC-SAF-HSE',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'HSE Officer',
            'code' => 'JOB-SAF-HSE',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Assistant Safety Officer',
            'code' => 'JOB-SAF-ASO',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 6. TRANSPORT
        |--------------------------------------------------------------------------
        */
        $department = Department::create([
            'name' => 'Transport',
            'code' => 'DEP-TRA',
        ]);

        $section = Section::create([
            'department_id' => $department->id,
            'name' => 'Transport',
            'code' => 'SEC-TRA',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Supervisor Officer',
            'code' => 'JOB-TRA-SUP',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Driver Officer',
            'code' => 'JOB-TRA-DO',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => "Truck Driver's Assistant",
            'code' => 'JOB-TRA-TDA',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Truck Driver',
            'code' => 'JOB-TRA-TDR',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Operator Officer',
            'code' => 'JOB-TRA-OO',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Transport Dispatcher',
            'code' => 'JOB-TRA-DSP',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 7. LOGISTICS
        |--------------------------------------------------------------------------
        */
        $department = Department::create([
            'name' => 'Logistics',
            'code' => 'DEP-LOG',
        ]);

        $section = Section::create([
            'department_id' => $department->id,
            'name' => 'Logistics',
            'code' => 'SEC-LOG',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Logistics Officer',
            'code' => 'JOB-LOG-LO',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Store Officer',
            'code' => 'JOB-LOG-SO',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 8. PROCUREMENT
        |--------------------------------------------------------------------------
        */
        $department = Department::create([
            'name' => 'Procurement',
            'code' => 'DEP-PRO',
        ]);

        $section = Section::create([
            'department_id' => $department->id,
            'name' => 'Procurement',
            'code' => 'SEC-PRO',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Procurement Officer',
            'code' => 'JOB-PRO-OFF',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 9. INFORMATION TECHNOLOGY
        |--------------------------------------------------------------------------
        */
        $department = Department::create([
            'name' => 'Information Technology',
            'code' => 'DEP-IT',
        ]);

        $section = Section::create([
            'department_id' => $department->id,
            'name' => 'Information Technology',
            'code' => 'SEC-IT',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'IT Officer',
            'code' => 'JOB-IT-OFF',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 10. SECURITY
        |--------------------------------------------------------------------------
        */
        $department = Department::create([
            'name' => 'Security',
            'code' => 'DEP-SEC',
        ]);

        $section = Section::create([
            'department_id' => $department->id,
            'name' => 'Security',
            'code' => 'SEC-SEC',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Security Officer',
            'code' => 'JOB-SEC-OFF',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 11. CLEANING
        |--------------------------------------------------------------------------
        */
        $department = Department::create([
            'name' => 'Cleaning',
            'code' => 'DEP-CLN',
        ]);

        $section = Section::create([
            'department_id' => $department->id,
            'name' => 'Cleaning',
            'code' => 'SEC-CLN',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Cleaner',
            'code' => 'JOB-CLN-CLR',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 12. RESTAURATION
        |--------------------------------------------------------------------------
        */
        $department = Department::create([
            'name' => 'Restauration',
            'code' => 'DEP-RES',
        ]);

        $section = Section::create([
            'department_id' => $department->id,
            'name' => 'Restauration',
            'code' => 'SEC-RES',
        ]);

        JobTitle::create([
            'section_id' => $section->id,
            'name' => 'Fast Food',
            'code' => 'JOB-RES-FF',
        ]);
    }
}
