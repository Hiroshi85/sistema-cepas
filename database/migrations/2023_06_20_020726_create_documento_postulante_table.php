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
        Schema::create('documento_postulante', function (Blueprint $table) {
            $table->id('iddocumento');
            
            $table->unsignedBigInteger('idpostulante');
            $table->string('descripcion', 100);
            $table->string('imagen', 100)->nullable();
            $table->date('fecha_registro');
            $table->string('observacion',200)->nullable();
            $table->string('estado', 100);
            $table->boolean('eliminado')->default(false);
            
            $table->foreign('idpostulante')->references('idpostulante')->on('postulantes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documento_postulante');
    }
};
