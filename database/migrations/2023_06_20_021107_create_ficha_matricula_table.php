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
        Schema::create('ficha_matricula', function (Blueprint $table) {
            $table->unsignedBigInteger('idmatricula');
            $table->unsignedBigInteger('idalumno');
            $table->date('fecha_registro');
            $table->text('observaciones')->nullable();
            $table->boolean('eliminado')->default(false);
            
            $table->primary(['idmatricula', 'idalumno']);
            $table->foreign('idmatricula')->references('idmatricula')->on('matriculas');
            $table->foreign('idalumno')->references('idalumno')->on('alumnos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_matricula');
    }
};
