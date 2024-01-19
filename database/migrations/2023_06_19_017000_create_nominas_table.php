<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nominas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('dias_laborados')->nullable();
            $table->decimal('sueldo_basico', 10, 2);
            $table->decimal('total_bruto', 10, 2)->nullable();
            $table->decimal('total_neto', 10, 2)->nullable();
            $table->enum('estado_pago', ['pendiente', 'pagado']);
            $table->date('fecha_pago')->nullable();
            $table->timestamps();

            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominas');
    }
}
