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
        Schema::create('alumno_academia', function (Blueprint $table) {
            $table->id();

            $table->string('public_id', 100)->unique();

            $table->boolean('eliminado')->default(false);

            $table->unsignedBigInteger('idalumno')->nullable();
            $table->foreign('idalumno')->references('idalumno')->on('alumnos');

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
        Schema::dropIfExists('alumno_academica');
    }
};
