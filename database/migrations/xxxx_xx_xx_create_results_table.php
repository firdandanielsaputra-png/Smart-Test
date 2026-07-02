<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {

            $table->id();

            // User yang mengerjakan quiz
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Mata kuliah quiz
            $table->foreignId('subject_id')
                  ->constrained('subjects')
                  ->cascadeOnDelete();

            // Nilai quiz
            $table->integer('score');

            // Jumlah benar
            $table->integer('correct');

            // Jumlah salah
            $table->integer('wrong');

            // Lulus / Tidak Lulus
            $table->string('status');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
