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
        Schema::create('postulantes', function (Blueprint $table) {
            $table->id('idpostulante');

            $table->unsignedBigInteger('idaula');

            $table->string('nombre_apellidos', 100);
            $table->date('fecha_nacimiento');
            $table->char('dni', 8)->unique();
            $table->string('domicilio', 100);
            $table->char('numero_celular', 9)->unique();
            $table->integer('nro_hermanos');
            $table->date('fecha_postulacion');
            $table->string('estado', 50);
            $table->boolean('eliminado')->default(false);

            $table->foreign('idaula')->references('idaula')->on('aulas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulantes');
    }
};
