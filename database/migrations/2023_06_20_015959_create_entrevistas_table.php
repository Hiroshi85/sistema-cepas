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
        Schema::create('entrevistas', function (Blueprint $table) {
            $table->id('identrevista');
            $table->unsignedBigInteger('idpostulante');
            //$table->unsignedBigInteger('idapoderado');
            $table->date('fecha');
            $table->time('hora');
            $table->string('resultado', 100)->nullable();
            $table->string('estado', 100);
            $table->boolean('eliminado')->default(false);
            
            $table->foreign('idpostulante')->references('idpostulante')->on('postulantes');
            //$table->foreign('idapoderado')->references('idapoderado')->on('apoderados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrevistas');
    }
};
