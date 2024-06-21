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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grado_materia_id')
                  ->constrained('grado_materias')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->foreignId('grado_alumno_id')
                  ->constrained('grado_alumnos')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->float('periodo1');
            $table->float('periodo2');
            $table->float('periodo3');
            $table->unique(['grado_materia_id','grado_alumno_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
