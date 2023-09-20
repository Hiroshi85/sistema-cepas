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
        DB::unprepared('
            CREATE TRIGGER tr_insertar_calificaciones
            AFTER INSERT ON detallecurso
            FOR EACH ROW
            BEGIN            
                -- Insertar registros en la tabla CALIFICACION para todos los alumnos de la aula
                INSERT INTO CALIFICACION (idalumno, idcurso)
                SELECT idalumno, NEW.iddetalle AS idcurso
                FROM ALUMNOS
                WHERE idaula = NEW.idaula;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS tr_insertar_calificaciones');
    }
};
