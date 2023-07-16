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
        Schema::create('asistencia', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->unsignedBigInteger('alumno_id');
            $table->tinyInteger('tipo_id')->unsigned();

            $table->foreign('alumno_id')
            ->references('idalumno')
            ->on('alumnos')
            ->onDelete('restrict');

            $table->foreign('tipo_id')
            ->references('id')
            ->on('tipo_asistencia')
            ->onDelete('restrict');
            // $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencia');
    }
};
