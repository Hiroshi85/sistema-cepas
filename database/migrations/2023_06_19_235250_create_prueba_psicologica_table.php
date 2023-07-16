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
        Schema::create('prueba_psicologica', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->tinyInteger('edad_minima')->nullable();
            $table->tinyInteger('edad_maxima')->nullable();
            $table->string('file_url')->nullable();
            $table->string('online_url')->nullable();

            $table->unsignedBigInteger('psicologo_id');
            $table->foreign('psicologo_id')
                ->references('id')
                ->on('empleados')
                ->onDelete('restrict');

            $table->tinyInteger('tipo_id')->unsigned();
            $table->foreign('tipo_id')
                ->references('id')
                ->on('tipo_prueba')
                ->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prueba_psicologica');
    }
};
