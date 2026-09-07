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
        Schema::create('request_steps', function (Blueprint $table) {
            $table->id();

            $table->foreignId('request_id')
                ->constrained('request_models')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->enum('step', [
                'procurement',
                'finance',
                'ceo',
            ]);

            $table->enum('decision', [
                'approved',
                'rejected',
            ]);

            $table->text('comment')
                ->nullable();

            $table->timestamp('processed_at');

            $table->timestamps();

            $table->index('request_id');
            $table->index('user_id');
            $table->index('step');
            $table->index('decision');


            $table->unique([
                'request_id',
                'step',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_steps');
    }
};
