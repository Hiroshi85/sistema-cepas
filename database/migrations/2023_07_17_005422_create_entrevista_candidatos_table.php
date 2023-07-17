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
        Schema::create('rrhh_entrevistas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluacion_id');
            $table->foreign('evaluacion_id')->references('id')->on('rrhh_evaluaciones')->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora');
            $table->enum('estado', ['pendiente', 'aprobada', 'reprobada'])->default('pendiente');
            $table->text('observaciones')->nullable();
            $table->unsignedBigInteger('entrevistador_id');
            $table->foreign('entrevistador_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rrhh_entrevistas');
    }
};
