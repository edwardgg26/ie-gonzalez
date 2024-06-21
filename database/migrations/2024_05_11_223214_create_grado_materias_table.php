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
        Schema::create('grado_materias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grado_id')->constrained('grados')
                   ->cascadeOnUpdate()
                   ->cascadeOnDelete();
            $table->foreignId('materia_id')
                   ->constrained('materias')
                   ->cascadeOnUpdate()
                   ->cascadeOnDelete();
            $table->foreignId('docente_id')
                   ->nullable()
                   ->constrained('users')
                   ->nullOnDelete()
                   ->cascadeOnUpdate();
            $table->foreignId('dia_id')->constrained('dias')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->foreignId('hora_id')->constrained('horas')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->foreignId('aula_id')
                    ->nullable()
                    ->constrained('aulas')
                    ->nullOnDelete()
                    ->cascadeOnUpdate();

            //Validar que no haya 2 materias el mismo dia y a la misma hora (Completado)
            $table->unique(['grado_id','dia_id','hora_id']);

            //Evitar duplicacion de registros
            $table->unique(['grado_id','materia_id','docente_id','dia_id','hora_id','aula_id'],'evitar_dup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grado_materias');
    }
};
