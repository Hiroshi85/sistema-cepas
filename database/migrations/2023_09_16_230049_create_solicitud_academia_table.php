<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitud_academia', function (Blueprint $table) {
            $table->id();
            $table->longText('observaciones')->nullable();

            $table->unsignedBigInteger('idalumno');
            $table->foreign('idalumno')->references('idalumno')->on('alumnos');

            $table->date('fecha_solicitud')->default(now('America/Lima')->toDateString());

            $table->enum('estado', ['pendiente', 'aceptado', 'rechazado'])->default('pendiente');

            $table->timestamps();
        });

        Schema::create('documento_solicitud_academia', function (Blueprint $table) {
            $table->id();
            $table->enum('estado', ['pendiente', 'aceptado', 'rechazado'])->default('pendiente');
            
            $table->unsignedBigInteger('idsolicitud');
            $table->foreign('idsolicitud')->references('id')->on('solicitud_academia');            
            
            $table->longText('observaciones')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documento_solicitud_academia');
        Schema::dropIfExists('solicitud_academia');
    }
};
