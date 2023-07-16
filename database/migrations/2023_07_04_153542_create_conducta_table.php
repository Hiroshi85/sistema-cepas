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
        Schema::create('conducta', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->tinyInteger('puntaje');
            // $table->unsignedBigInteger('severidad_id');
            
            // $table->foreign('severidad_id')
            // ->references('id')
            // ->on('severidad')
            // ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conducta');
    }
};
