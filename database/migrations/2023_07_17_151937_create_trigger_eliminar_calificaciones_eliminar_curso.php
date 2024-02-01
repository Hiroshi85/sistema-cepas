<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            CREATE TRIGGER Soft_Delete_DetalleCurso
            AFTER UPDATE ON detallecurso
            FOR EACH ROW
            BEGIN
                IF NEW.estado  <> OLD.estado THEN
                    DELETE FROM calificacion
                    WHERE idcurso = OLD.iddetalle;

                    DELETE FROM asistencia_asignatura
                    WHERE idcurso = OLD.iddetalle;

                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS Soft_Delete_DetalleCurso');
    }
};
