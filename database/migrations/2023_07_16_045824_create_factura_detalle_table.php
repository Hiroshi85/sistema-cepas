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
        Schema::create('factura_detalle', function (Blueprint $table) {
            $table->id("factura_detalle_id");
            $table->unsignedBigInteger("factura_id");
            $table->unsignedBigInteger("material_id");
            $table->integer("cantidad");
            $table->decimal("precio_unitario", 10, 2);
            
            $table->foreign('factura_id')->references('factura_id')->on('factura');
            $table->foreign('material_id')->references('material_id')->on('material_escolar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_detalle');
    }
};
