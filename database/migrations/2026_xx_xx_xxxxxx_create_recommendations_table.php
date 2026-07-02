<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recommendations', function (Blueprint $table) {

            $table->id();

            // User yang mendapat rekomendasi
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Mata kuliah yang direkomendasikan
            $table->foreignId('subject_id')
                  ->constrained('subjects')
                  ->cascadeOnDelete();

            // Isi rekomendasi
            $table->text('recommendation');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
