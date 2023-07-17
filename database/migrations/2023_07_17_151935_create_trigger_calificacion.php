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
        // Crea el trigger utilizando el método unprepared
        DB::unprepared('
            CREATE TRIGGER crear_calificacion AFTER INSERT ON alumnos
            FOR EACH ROW
            BEGIN
                INSERT INTO calificacion (idalumno, idcurso) 
                SELECT NEW.idalumno, iddetalle FROM DETALLECURSO WHERE idaula = NEW.idaula;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS crear_calificacion');
    }
};
