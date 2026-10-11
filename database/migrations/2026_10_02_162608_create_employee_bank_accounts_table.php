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
        Schema::create('employee_bank_accounts', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | EMPLOYEE
            |--------------------------------------------------------------------------
            */

            $table->foreignId('employee_id')
                ->unique()
                ->constrained('employees')
                ->cascadeOnDelete();

            $table->string('bank_name');

            $table->string('bank_branch')->nullable();

            $table->string('account_holder');

            $table->string('account_number');

            $table->string('account_type')->nullable();

            $table->string('rib')->unique();

            $table->string('iban')->nullable()->unique();

            $table->string('swift_code')->nullable();

            $table->string('currency', 3)->default('USD');

            $table->text('bank_address')->nullable();

            $table->string('bank_phone')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_bank_accounts');
    }
};
