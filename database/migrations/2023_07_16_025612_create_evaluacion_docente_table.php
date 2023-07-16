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
        Schema::create('evaluacion_docente', function (Blueprint $table) {
            $table->id("idevadoc");
            $table->unsignedBigInteger("iddocente");
            $table->float("calificacion")->nullable();
            $table->string("retroalimentacion", 500)->nullable();
            $table->foreign('iddocente')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacion_docente');
    }
};
