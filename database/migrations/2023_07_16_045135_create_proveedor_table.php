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
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id("proveedor_id");
            $table->string("correo", 100)->nullable();
            $table->string("direccion", 200)->nullable();
            $table->string("nombre", 100)->nullable();
            $table->string("telefono", 9)->nullable();
            $table->char("dni", 8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedor');
    }
};
