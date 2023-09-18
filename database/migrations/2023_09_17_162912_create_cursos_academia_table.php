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
        Schema::create('areas_unt', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->longText('descripcion')->nullable();
            $table->boolean('eliminado')->default(false);
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('facultad_unt', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');

            $table->string('descripcion')->nullable();

            $table->boolean('eliminado')->default(false);

            $table->string('slug')->unique();

            $table->timestamps();
        });

        Schema::create('carreras_unt', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');

            $table->string('descripcion')->nullable();

            $table->boolean('eliminado')->default(false);

            $table->string('slug')->unique();

            $table->unsignedBigInteger('idarea');
            $table->foreign('idarea')->references('id')->on('areas_unt');

            $table->unsignedBigInteger('idfacultad');
            $table->foreign('idfacultad')->references('id')->on('facultad_unt');

            $table->timestamps();
        });

        Schema::create('cursos_academia', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');

            $table->string('descripcion')->nullable();

            $table->boolean('eliminado')->default(false);

            // NOTE: this slug should be unique.
            $table->string('slug');

            $table->unsignedBigInteger('idarea');
            $table->foreign('idarea')->references('id')->on('areas_unt');

            $table->timestamps();
        });




        Schema::table('solicitud_academia', function (Blueprint $table) {
            $table->unsignedBigInteger('idcarrera')->nullable();
            $table->foreign('idcarrera')->references('id')->on('carreras_unt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos_academia');
    }
};
