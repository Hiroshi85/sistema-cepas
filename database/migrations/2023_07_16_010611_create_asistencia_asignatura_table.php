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
        Schema::create('asistencia_asignatura', function (Blueprint $table) {
            $table->id("idasistencia");
            $table->unsignedBigInteger("idalumno");
            $table->unsignedBigInteger("idcurso");
            $table->integer("bimestre");
            $table->char("s1",1)->default('F');
            $table->char("s2",1)->default('F');
            $table->char("s3",1)->default('F');
            $table->char("s4",1)->default('F');
            $table->char("s5",1)->default('F');
            $table->char("s6",1)->default('F');
            $table->char("s7",1)->default('F');
            $table->char("s8",1)->default('F');
            $table->foreign('idalumno')->references('idalumno')->on('alumnos');
            $table->foreign('idcurso')->references('iddetalle')->on('detallecurso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencia_asignatura');
    }
};
