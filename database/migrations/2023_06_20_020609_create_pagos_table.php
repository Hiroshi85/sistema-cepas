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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id('idpago');
   
            $table->unsignedBigInteger('idapoderado');
            $table->string('concepto', 100);
            $table->unsignedBigInteger('idpostulante')->nullable();
            $table->unsignedBigInteger('idalumno')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('estado', 100);
            $table->boolean('eliminado')->default(false);
            
            $table->foreign('idapoderado')->references('idapoderado')->on('apoderados');
            $table->foreign('idpostulante')->references('idpostulante')->on('postulantes');
            $table->foreign('idalumno')->references('idalumno')->on('alumnos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
