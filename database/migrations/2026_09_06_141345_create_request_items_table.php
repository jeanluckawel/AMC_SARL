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
        Schema::create('request_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('request_id')
                ->constrained('request_models')
                ->cascadeOnDelete();


            $table->string('name');

            $table->decimal('quantity', 15, 2)
                ->default(1);

            $table->string('unit')
                ->nullable();

            $table->text('description')
                ->nullable();

            // Complété par Procurement
            $table->decimal('unit_price', 15, 2)
                ->nullable();

            $table->decimal('total_price', 15, 2)
                ->nullable();

            $table->string('supplier')
                ->nullable();

            $table->string('supplier_reference')
                ->nullable();

            $table->text('procurement_note')
                ->nullable();

            $table->timestamps();

            $table->index('request_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_items');
    }
};
