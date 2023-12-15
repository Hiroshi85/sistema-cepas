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
        Schema::create('ciclo_academico', function (Blueprint $table) {
            $table->id();
            $table->string('public_id')->unique();
            $table->string('nombre');
            $table->longText('descripcion')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::table('solicitud_academia', function (Blueprint $table) {
            $table->unsignedBigInteger('idciclo_academico')->nullable();
            $table->foreign('idciclo_academico')->references('id')->on('ciclo_academico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciclo_academico');
    }
};
