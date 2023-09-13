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
        Schema::create('sesion_prueba', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('prueba_psicologica_id');
            $table->foreign('prueba_psicologica_id')
                ->references('id')
                ->on('prueba_psicologica')
                ->onDelete('restrict');

            $table->unsignedBigInteger('psicologo_id');
            $table->foreign('psicologo_id')
                ->references('id')
                ->on('empleados')
                ->onDelete('restrict');

            $table->unsignedBigInteger('aula_id');
            $table->foreign('aula_id')
                ->references('idaula')
                ->on('aulas')
                ->onDelete('restrict');

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesion_prueba');
    }
};
