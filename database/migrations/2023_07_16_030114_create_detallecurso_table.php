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
        Schema::create('detallecurso', function (Blueprint $table) {
            $table->id("iddetalle");
            $table->unsignedBigInteger("idcurso");
            $table->unsignedBigInteger("idaula");
            $table->unsignedBigInteger("iddocente");
            $table->string("horario", 50);
            $table->foreign('idcurso')->references('id')->on('asignaturas');
            $table->foreign('idaula')->references('idaula')->on('aulas');
            $table->foreign('iddocente')->references('id')->on('empleados');
            // Campo para el Soft Delete
            $table->integer("estado");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallecurso');
    }
};
