<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crea el trigger utilizando el método unprepared
        DB::unprepared("
            CREATE TRIGGER tr_insertar_calificaciones_insert_alumno
            AFTER INSERT ON ALUMNOS
            FOR EACH ROW
            BEGIN
                IF NEW.estado = 'Matriculado' THEN
                    INSERT INTO CALIFICACION (idalumno, idcurso)
                    SELECT NEW.idalumno, dc.iddetalle
                    FROM detallecurso dc
                    WHERE dc.idaula = NEW.idaula;
                END IF;
            END;
        ");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_insertar_calificaciones_insert_alumno');
    }
};
