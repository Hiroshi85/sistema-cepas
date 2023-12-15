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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id('idmatricula');
        
            $table->char('año', 4);
            $table->date('fecha_apertura');
            $table->date('fecha_cierre');
            $table->decimal('tarifa', 10, 2);
            $table->string('estado', 100);
            $table->integer('total_alumnos', false, true)->default(0); //total de alumnos registrados al momento entre matriculados y no matriculados
            $table->boolean('eliminado')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
