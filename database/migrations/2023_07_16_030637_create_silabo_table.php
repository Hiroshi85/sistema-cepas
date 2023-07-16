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
        Schema::create('silabo', function (Blueprint $table) {
            $table->id("idsilabo");
            $table->string("namefile",100);
            $table->unsignedBigInteger("idcurso");
            $table->string("estado", 20);
            $table->foreign('idcurso')->references('iddetalle')->on('detallecurso');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('silabo');
    }
};
