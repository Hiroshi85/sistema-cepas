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
        Schema::create('cursos_academia', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');

            $table->string('descripcion')->nullable();

            $table->timestamps();
        });


        Schema::create('curso_area', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idcurso');
            $table->foreign('idcurso')->references('id')->on('cursos_academia');

            $table->unsignedBigInteger('idarea');
            $table->foreign('idarea')->references('id')->on('areas_unt');

            $table->timestamps();
        });

        Schema::create('curso_ciclo', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idcurso_area');
            $table->foreign('idcurso_area')->references('id')->on('curso_area');

            $table->unsignedBigInteger('idciclo_academico');
            $table->foreign('idciclo_academico')->references('id')->on('ciclo_academico');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos_academia');
    }
};
