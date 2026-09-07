<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('employee_id')->unique();

            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');

            $table->string('gender');
            $table->date('date_of_birth');

            $table->string('number_card')->unique();

            $table->string('country');

            $table->string('marital_status');



            $table->string('employee_work_phone')->nullable();
            $table->string('employee_phone')->nullable();
            $table->string('employee_email')->nullable();

            $table->text('employee_address')->nullable();



            $table->string('photo')->nullable();



            $table->foreignId('department_id')
                ->constrained('departments')
                ->restrictOnDelete();

            $table->foreignId('section_id')
                ->constrained('sections')
                ->nullOnDelete();

            $table->foreignId('job_title_id')
                ->constrained('job_titles')
                ->restrictOnDelete();



            $table->string('contract_type');

            $table->date('end_contract_date')->nullable();

            $table->string('work_location');

            $table->string('supervisor')->nullable();

            $table->string('employee_type');

            $table->string('spouse_status')->nullable();

            $table->string('spouse_full_name')->nullable();

            $table->string('spouse_phone')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
