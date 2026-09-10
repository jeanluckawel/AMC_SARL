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
        Schema::create('department_budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id') ->constrained('departments') ->cascadeOnDelete();
            $table->decimal('amount', 15, 2) ->default(0);
            $table->decimal('used_amount', 15, 2) ->default(0);
            $table->date('end_date');
            $table->timestamps();
            $table->index('department_id');
            $table->index('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_budgets');
    }
};
