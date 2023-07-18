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
        Schema::create('postulante_admision', function (Blueprint $table) {
            $table->unsignedBigInteger('idadmision');
            $table->unsignedBigInteger('idpostulante');
            $table->date('fecha_registro');
            $table->string('resultado', 50);
                       
            $table->primary(['idadmision', 'idpostulante']);
            $table->foreign('idadmision')->references('idadmision')->on('admisions');
            $table->foreign('idpostulante')->references('idpostulante')->on('postulantes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulante_admision');
    }
};
