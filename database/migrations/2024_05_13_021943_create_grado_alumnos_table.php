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
        Schema::create('grado_alumnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grado_id')
                  ->constrained('grados')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->foreignId('alumno_id')
                  ->constrained('users')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->unique(['grado_id','alumno_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grado_alumnos');
    }
};
