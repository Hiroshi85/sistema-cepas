<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('descuentos', function (Blueprint $table) {
            $table->unsignedBigInteger('nomina_id');
            $table->unsignedBigInteger('tipo_descuento_id');
            $table->decimal('monto', 10, 2);
            $table->timestamps();

            $table->foreign('tipo_descuento_id')->references('id')->on('tipos_descuento')->onDelete('cascade');
            $table->foreign('nomina_id')->references('id')->on('nominas')->onDelete('cascade');
            $table->primary(['nomina_id', 'tipo_descuento_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descuentos');
    }
}
