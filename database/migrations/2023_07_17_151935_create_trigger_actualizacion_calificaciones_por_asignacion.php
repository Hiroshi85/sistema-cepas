<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /*
     * Run the migrations.
     */
    public function up(): void
    {
        // Crea el trigger utilizando el método unprepared
        DB::unprepared('
            CREATE TRIGGER ActualizarCalificaciones
            AFTER UPDATE ON detallecurso
            FOR EACH ROW
            BEGIN
                IF (NEW.idcurso  <> OLD.idcurso) OR (NEW.idaula <> OLD.idaula) THEN
                    DELETE FROM CALIFICACION
                    WHERE idcurso = OLD.iddetalle;

                    INSERT INTO CALIFICACION (idalumno, idcurso)
                    SELECT idalumno, NEW.iddetalle
                    FROM ALUMNOS
                    WHERE idaula = NEW.idaula;
                END IF;
            END;
        ');
    }

    /*
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_insertar_calificaciones');
    }
};
