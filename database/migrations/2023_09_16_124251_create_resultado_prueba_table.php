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
        Schema::create('resultado_prueba', function (Blueprint $table) {
            $table->string('recomendacion');
            $table->string('observacion');
            $table->unsignedBigInteger('sesion_prueba_id');
            $table->unsignedBigInteger('alumno_id');
            $table->tinyInteger('estado_resultado_prueba_id')->unsigned();

            $table->primary(['sesion_prueba_id', 'alumno_id']);

            $table->foreign('sesion_prueba_id')
                ->references('id')
                ->on('sesion_prueba')
                ->onDelete('restrict');

            $table->foreign('alumno_id')
                ->references('idalumno')
                ->on('alumnos')
                ->onDelete('restrict');

            $table->foreign('estado_resultado_prueba_id')
                ->references('id')
                ->on('estado_resultado_prueba')
                ->onDelete('restrict');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultado_prueba');
    }
};
