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
        Schema::create('material_escolar', function (Blueprint $table) {
            $table->id("material_id");
            $table->string("nombre",100)->nullable();
            $table->string("descripcion",200)->nullable();
            $table->integer("stock")->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_escolar');
    }
};
