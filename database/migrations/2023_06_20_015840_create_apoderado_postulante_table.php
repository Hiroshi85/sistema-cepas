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
        Schema::create('apoderado_postulante', function (Blueprint $table) {
            $table->unsignedBigInteger('idapoderado');
            $table->unsignedBigInteger('idpostulante');
            $table->string('parentesco', 100);
            $table->enum('convivencia', ['si', 'no']);
            $table->boolean('eliminado')->default(false);
            
            $table->foreign('idapoderado')->references('idapoderado')->on('apoderados');
            $table->foreign('idpostulante')->references('idpostulante')->on('postulantes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apoderado_postulante');
    }
};
