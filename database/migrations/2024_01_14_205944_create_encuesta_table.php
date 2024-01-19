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
        Schema::create('encuesta', function (Blueprint $table) {
            $table->id("idencuesta");
            $table->unsignedBigInteger("idalumno");
            $table->unsignedBigInteger("idcurso");
            $table->string("estado")->default(1);
            $table->date("fecha")->nullable()->default(now()->toDateString());
            $table->string("resultados", 10)->default($this->generateRandomString());
            $table->foreign('idalumno')->references('idalumno')->on('alumnos');
            $table->foreign('idcurso')->references('iddetalle')->on('detallecurso');
            $table->timestamps();
        });
    }

    protected function generateRandomString($length = 10)
    {
        $characters = '12345'; // Allowed characters
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuesta');
    }
};
