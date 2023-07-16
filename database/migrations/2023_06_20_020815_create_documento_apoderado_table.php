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
        Schema::create('documento_apoderado', function (Blueprint $table) {
            $table->id('iddocumento');
 
            $table->unsignedBigInteger('idapoderado');
            $table->string('descripcion', 100);
            $table->string('imagen', 100)->nullable();
            $table->date('fecha_registro');
            $table->string('estado', 100);
            $table->boolean('eliminado')->default(false);
            
            $table->foreign('idapoderado')->references('idapoderado')->on('apoderados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documento_apoderado');
    }
};
