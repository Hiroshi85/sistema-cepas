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
        Schema::create('encuesta', function (Blueprint $table) {
            $table->id("idencuesta");
            $table->unsignedBigInteger("idalumno");
            $table->unsignedBigInteger("idcurso");
            $table->string("estado")->default(0);
            $table->date("fecha")->nullable();
            $table->string("resultados");
            $table->foreign('idalumno')->references('idalumno')->on('alumnos');
            $table->foreign('idcurso')->references('iddetalle')->on('detallecurso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuesta');
    }
};
