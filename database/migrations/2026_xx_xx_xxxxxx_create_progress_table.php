<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->integer('quiz_total')->default(0);

            $table->double('average_score', 5, 2)->default(0);

            $table->string('level')->default('Beginner');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
