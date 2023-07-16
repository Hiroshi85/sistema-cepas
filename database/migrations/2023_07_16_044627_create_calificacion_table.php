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
        Schema::create('calificacion', function (Blueprint $table) {
            $table->id("idcalificacion");
            $table->unsignedBigInteger("idalumno");
            $table->unsignedBigInteger("idcurso");
            $table->float("b1")->default(0.0)->nullable();
            $table->float("b2")->default(0.0)->nullable();
            $table->float("b3")->default(0.0)->nullable();
            $table->float("b4")->default(0.0)->nullable();
            $table->float("prom")->nullable();
            $table->foreign('idalumno')->references('idalumno')->on('alumnos');
            $table->foreign('idcurso')->references('iddetalle')->on('detallecurso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacion');
    }
};
