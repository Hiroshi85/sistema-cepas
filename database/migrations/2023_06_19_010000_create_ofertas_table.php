<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('puesto_id');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->text('descripcion');
            $table->decimal('salario', 10, 2);
            $table->text('beneficios')->nullable();
            $table->timestamps();

            $table->foreign('puesto_id')->references('id')->on('puestos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
}
