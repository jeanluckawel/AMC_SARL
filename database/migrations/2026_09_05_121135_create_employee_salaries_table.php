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
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->id();


            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnDelete();

            $table->decimal('base_salary', 15, 2)->nullable();

            $table->string('category')->nullable();

            $table->string('echelon')->nullable();

            $table->string('currency')->nullable();

            $table->json('payment_methods')->nullable();

            $table->decimal('housing_allowance', 15, 2)->default(0);
            $table->decimal('transport_allowance', 15, 2)->default(0);
            $table->decimal('meal_allowance', 15, 2)->default(0);
            $table->decimal('family_allowance', 15, 2)->default(0);
            $table->decimal('medical_allowance', 15, 2)->default(0);
            $table->decimal('other_non_taxable_allowances', 15, 2)->default(0);
            $table->decimal('other_taxable_allowances', 15, 2)->default(0);

            $table->decimal('cnss_employee', 15, 2)->default(0);
            $table->decimal('syndicate_deduction', 15, 2)->default(0);
            $table->decimal('ier', 15, 2)->default(0);

            $table->decimal('cnss_employer', 15, 2)->default(0);
            $table->decimal('inpp_employer', 15, 2)->default(0);
            $table->decimal('onem_employer', 15, 2)->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salaries');
    }
};
