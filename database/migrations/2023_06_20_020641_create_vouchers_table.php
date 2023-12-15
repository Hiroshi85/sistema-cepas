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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id('idvoucher');
         
            $table->unsignedBigInteger('idpago');
            $table->date('fecha_pago');
            $table->decimal('monto', 10, 2);
            $table->string('codigo_operacion', 20)->nullable();
            $table->string('voucher', 100);
            $table->unsignedBigInteger('metodo_pago');
            $table->string('observacion', 100)->nullable();
            $table->string('estado', 50);
            $table->boolean('eliminado')->default(false);
            
            $table->foreign('idpago')->references('idpago')->on('pagos');
            $table->foreign('metodo_pago')->references('idmetodopago')->on('metodo_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
