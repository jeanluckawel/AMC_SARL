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
        Schema::create('request_models', function (Blueprint $table) {
            $table->id();

            $table->foreignId('requester_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('reference')
                ->unique();

            $table->string('title');

            $table->text('description')
                ->nullable();

            // Montant calculé par Procurement
            $table->decimal('total_amount', 15, 2)
                ->default(0);

            $table->string('status');

            $table->timestamp('approved_at')
                ->nullable();

            $table->timestamp('rejected_at')
                ->nullable();

            $table->string('document_path')
                ->nullable()
                ->after('total_amount');

            $table->boolean('budget_consumed')
                ->default(false);

            $table->timestamps();

            $table->index('requester_id');
            $table->index('status');
            $table->index('created_at');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_models');
    }
};
