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
        Schema::create('apoderados', function (Blueprint $table) {
            $table->id('idapoderado');
            $table->unsignedBigInteger('idusuario')->nullable();
            $table->string('nombre_apellidos', 100);
            $table->char('dni', 8)->unique();
            $table->date('fecha_nacimiento');
            $table->char('numero_celular', 9)->unique();
            $table->string('ocupacion', 100);
            $table->string('centro_trabajo', 100);
            $table->string('correo', 100);
            $table->boolean('eliminado')->default(false);

            $table->foreign('idusuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apoderados');
    }
};
