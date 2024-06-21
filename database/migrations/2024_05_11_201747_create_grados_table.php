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
        Schema::create('grados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipogrado_id')
                  ->nullable()
                  ->constrained('tipo_grados')
                  ->nullOnDelete();
            $table->foreignId('jornada_id')
                  ->nullable()
                  ->constrained('jornadas')
                  ->nullOnDelete();
            $table->string('group');
            $table->integer('year');
            $table->unique(['tipogrado_id','group','year']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grados');
    }
};
