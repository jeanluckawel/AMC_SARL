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

            // Employee
            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Payroll period
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month');

            // Salary
            $table->decimal('basic_salary', 15, 2)->default(0);

            // Allowances
            $table->decimal('housing_allowance', 15, 2)->default(0);
            $table->decimal('transport_allowance', 15, 2)->default(0);
            $table->decimal('meal_allowance', 15, 2)->default(0);
            $table->decimal('other_allowances', 15, 2)->default(0);

            // Overtime
            $table->decimal('overtime_hours', 8, 2)->default(0);
            $table->decimal('overtime_amount', 15, 2)->default(0);

            // Bonuses
            $table->decimal('bonus', 15, 2)->default(0);

            // Deductions
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('social_security', 15, 2)->default(0);
            $table->decimal('other_deductions', 15, 2)->default(0);

            // Totals
            $table->decimal('gross_salary', 15, 2)->default(0);
            $table->decimal('total_deductions', 15, 2)->default(0);
            $table->decimal('net_salary', 15, 2)->default(0);

            // Currency
            $table->string('currency', 3)->default('USD');

            // Payment
            $table->date('payment_date')->nullable();
            $table->string('payment_reference')->nullable();

            // Remarks
            $table->text('remarks')->nullable();

            $table->timestamps();
            $table->softDeletes();


            $table->unique(
                ['employee_id', 'year', 'month'],
                'payroll_employee_period_unique'
            );

            // Indexes
            $table->index(['year', 'month']);
            $table->index('currency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
