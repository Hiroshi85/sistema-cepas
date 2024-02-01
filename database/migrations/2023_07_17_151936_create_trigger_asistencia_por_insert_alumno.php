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
            CREATE TRIGGER tr_insertar_asistencias_insert_alumno
            AFTER INSERT ON alumnos
            FOR EACH ROW
            BEGIN
                DECLARE i INT DEFAULT 1;

                IF NEW.estado = 'Matriculado' THEN
                    WHILE i <= 4 DO
                        INSERT INTO asistencia_asignatura (idalumno, idcurso, bimestre)
                        SELECT NEW.idalumno, iddetalle, i FROM detallecurso WHERE idaula = NEW.idaula;
                        SET i = i + 1;
                    END WHILE;
                END IF;
            END;
        ");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_insertar_asistencias_insert_alumno');
    }
};
