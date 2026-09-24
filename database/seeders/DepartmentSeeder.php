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
        $section = Section::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'Masonry',
            'code' => 'SEC-OP-MAS',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Masonry Officer',
            'code' => 'JOB-OP-MO',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Assistant Masonry Officer',
            'code' => 'JOB-OP-AMO',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 3. HUMAN RESOURCES
        |--------------------------------------------------------------------------
        */
        $department = Department::firstOrCreate([
            'name' => 'Human Resources',
            'code' => 'DEP-HR',
        ]);

        $section = Section::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'Human Resources',
            'code' => 'SEC-HR',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'HR Officer',
            'code' => 'JOB-HR-HRO',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Assistant HR Officer',
            'code' => 'JOB-HR-AHRO',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 4. FINANCE
        |--------------------------------------------------------------------------
        */
        $department = Department::firstOrCreate([
            'name' => 'Finance',
            'code' => 'DEP-FIN',
        ]);

        $section = Section::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'Finance',
            'code' => 'SEC-FIN',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Finance Officer',
            'code' => 'JOB-FIN-FO',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 5. SAFETY
        |--------------------------------------------------------------------------
        */
        $department = Department::firstOrCreate([
            'name' => 'Safety',
            'code' => 'DEP-SAF',
        ]);

        $section = Section::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'HSE',
            'code' => 'SEC-SAF-HSE',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'HSE Officer',
            'code' => 'JOB-SAF-HSE',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Assistant Safety Officer',
            'code' => 'JOB-SAF-ASO',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 6. TRANSPORT
        |--------------------------------------------------------------------------
        */
        $department = Department::firstOrCreate([
            'name' => 'Transport',
            'code' => 'DEP-TRA',
        ]);

        $section = Section::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'Transport',
            'code' => 'SEC-TRA',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Supervisor Officer',
            'code' => 'JOB-TRA-SUP',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Driver Officer',
            'code' => 'JOB-TRA-DO',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => "Truck Driver's Assistant",
            'code' => 'JOB-TRA-TDA',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Truck Driver',
            'code' => 'JOB-TRA-TDR',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Operator Officer',
            'code' => 'JOB-TRA-OO',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Transport Dispatcher',
            'code' => 'JOB-TRA-DSP',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 7. LOGISTICS
        |--------------------------------------------------------------------------
        */
        $department = Department::firstOrCreate([
            'name' => 'Logistics',
            'code' => 'DEP-LOG',
        ]);

        $section = Section::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'Logistics',
            'code' => 'SEC-LOG',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Logistics Officer',
            'code' => 'JOB-LOG-LO',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Store Officer',
            'code' => 'JOB-LOG-SO',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 8. PROCUREMENT
        |--------------------------------------------------------------------------
        */
        $department = Department::firstOrCreate([
            'name' => 'Procurement',
            'code' => 'DEP-PRO',
        ]);

        $section = Section::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'Procurement',
            'code' => 'SEC-PRO',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Procurement Officer',
            'code' => 'JOB-PRO-OFF',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 9. INFORMATION TECHNOLOGY
        |--------------------------------------------------------------------------
        */
        $department = Department::firstOrCreate([
            'name' => 'Information Technology',
            'code' => 'DEP-IT',
        ]);

        $section = Section::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'Information Technology',
            'code' => 'SEC-IT',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'IT Officer',
            'code' => 'JOB-IT-OFF',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 10. SECURITY
        |--------------------------------------------------------------------------
        */
        $department = Department::firstOrCreate([
            'name' => 'Security',
            'code' => 'DEP-SEC',
        ]);

        $section = Section::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'Security',
            'code' => 'SEC-SEC',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Security Officer',
            'code' => 'JOB-SEC-OFF',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 11. CLEANING
        |--------------------------------------------------------------------------
        */
        $department = Department::firstOrCreate([
            'name' => 'Cleaning',
            'code' => 'DEP-CLN',
        ]);

        $section = Section::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'Cleaning',
            'code' => 'SEC-CLN',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Cleaner',
            'code' => 'JOB-CLN-CLR',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 12. RESTAURATION
        |--------------------------------------------------------------------------
        */
        $department = Department::firstOrCreate([
            'name' => 'Restauration',
            'code' => 'DEP-RES',
        ]);

        $section = Section::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'Restauration',
            'code' => 'SEC-RES',
        ]);

        JobTitle::firstOrCreate([
            'section_id' => $section->id,
            'name' => 'Fast Food',
            'code' => 'JOB-RES-FF',
        ]);
    }
}
