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
        Schema::create('payrolls', function (Blueprint $table) {

            $table->id();

            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month');


            $table->decimal('days_worked', 4, 1)->default(26.0);
            $table->decimal('sick_days', 4, 1)->default(0);
            $table->decimal('basic_salary', 15, 2)->default(0);


            $table->decimal('overtime_hours', 8, 2)->default(0);
            $table->decimal('overtime_amount', 15, 2)->default(0);
            $table->decimal('bonus', 15, 2)->default(0);
            $table->decimal('other_taxable_allowances', 15, 2)->default(0);


            $table->decimal('housing_allowance', 15, 2)->default(0);
            $table->decimal('transport_allowance', 15, 2)->default(0);
            $table->decimal('meal_allowance', 15, 2)->default(0);
            $table->decimal('family_allowance', 15, 2)->default(0);
            $table->decimal('medical_allowance', 15, 2)->default(0);
            $table->decimal('other_non_taxable_allowances', 15, 2)->default(0);


            $table->decimal('gross_salary', 15, 2)->default(0);
            $table->decimal('social_base', 15, 2)->default(0);
            $table->decimal('fiscal_base', 15, 2)->default(0);


            $table->decimal('cnss_employee', 15, 2)->default(0);
            $table->decimal('ipr', 15, 2)->default(0);
            $table->decimal('salary_advances', 15, 2)->default(0);
            $table->decimal('syndicate_deduction', 15, 2)->default(0);
            $table->decimal('other_deductions', 15, 2)->default(0);


            $table->decimal('cnss_employer', 15, 2)->default(0);
            $table->decimal('inpp_employer', 15, 2)->default(0);
            $table->decimal('onem_employer', 15, 2)->default(0);

            $table->decimal('ier', 15, 2)->default(0);


            $table->decimal('total_deductions', 15, 2)->default(0);
            $table->decimal('net_salary', 15, 2)->default(0);


            $table->string('currency', 3)->default('CDF');
            $table->decimal('exchange_rate', 12, 4)->nullable();
            $table->date('payment_date')->nullable();
            $table->string('payment_method')->default('cash');
            $table->string('payment_reference')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['employee_id', 'year', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
