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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id');
            $table->unsignedBigInteger('apoderado_id');
            $table->unsignedBigInteger('citador_id');

            $table->string("motivo")->nullable();
            $table->string("estado", 20)->default("programado");
            $table->dateTime("fechaHoraInicio");
            $table->dateTime("fechaHoraFin");
            $table->tinyInteger("duracionMinutos")->nullable();
            $table->timestamps();

            $table->foreign('alumno_id')->references('idalumno')->on('alumnos');
            $table->foreign('apoderado_id')->references('idapoderado')->on('apoderados');
            $table->foreign('citador_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
