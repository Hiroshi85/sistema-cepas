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
        Schema::create('documento_alumno', function (Blueprint $table) {
            $table->id('iddocumento');

            $table->unsignedBigInteger('idalumno');
            $table->string('descripcion', 100);
            $table->string('imagen', 100)->nullable();
            $table->date('fecha_registro');
            $table->string('estado', 100);
            $table->boolean('eliminado')->default(false);
            
            $table->foreign('idalumno')->references('idalumno')->on('alumnos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documento_alumno');
    }
};
