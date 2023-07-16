<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestacionesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('nomina_id');
            $table->string('concepto');
            $table->decimal('monto', 10, 2);
            $table->timestamps();

            $table->foreign('nomina_id')->references('id')->on('nominas')->onDelete('cascade');
            $table->primary(['nomina_id', 'concepto']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestaciones');
    }
}
