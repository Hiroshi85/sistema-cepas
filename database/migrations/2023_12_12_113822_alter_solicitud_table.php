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
        Schema::table('solicitud_academia', function (Blueprint $table){
            $table->string('public_id')->unique();
        });

        Schema::table('alumno_academia', function (Blueprint $table){
            $table->unsignedBigInteger('idcarrera')->nullable();
            $table->foreign('idcarrera')->references('id')->on('carreras_unt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
