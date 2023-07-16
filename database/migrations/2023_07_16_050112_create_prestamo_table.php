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
        Schema::create('prestamo', function (Blueprint $table) {
            $table->id("prestamo_id");
            $table->unsignedBigInteger("usuario_id");
            $table->unsignedBigInteger("material_id");
            $table->date("fecha_inicio")->nullable();
            $table->date("fecha_fin")->nullable();
            
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('material_id')->references('material_id')->on('material_escolar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamo');
    }
};
