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
        Schema::create('rrhh_evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postulacion_id');
            $table->integer('experiencia_laboral');
            $table->text('educacion');
            $table->text('habilidades');
            $table->text('conocimiento_materias')->nullable(); // si es docente
            $table->double('puntaje_total')->nullable();
            $table->foreign('postulacion_id')->references('id')->on('postulaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rrhh_evaluaciones');
    }
};
