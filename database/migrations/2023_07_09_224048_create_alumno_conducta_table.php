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
        Schema::create('alumno_conducta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id');
            $table->unsignedBigInteger('conducta_id');
            $table->tinyInteger('bimestre')->nullable();
            $table->string('observacion')->nullable();
            $table->date('fecha');

            $table->foreign('alumno_id')
                ->references('idalumno')
                ->on('alumnos')
                ->onDelete('restrict');

            $table->foreign('conducta_id')
            ->references('id')
            ->on('conducta')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno_conducta');
    }
};
