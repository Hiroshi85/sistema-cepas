<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS registrar_encuestas');
        DB::unprepared("
            CREATE PROCEDURE registrar_encuestas()
            BEGIN
                DECLARE done INT DEFAULT FALSE;
                DECLARE aula_id, curso_id, alumno_id INT;

                DECLARE cur_detallecurso CURSOR FOR
                    SELECT dc.idaula, dc.iddetalle, a.idalumno
                    FROM detallecurso dc
                    JOIN alumnos a ON dc.idaula = a.idaula
                    where a.estado = 'Matriculado';

                DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

                OPEN cur_detallecurso;

                read_loop: LOOP
                    FETCH cur_detallecurso INTO aula_id, curso_id, alumno_id;

                    IF done THEN
                        LEAVE read_loop;
                    END IF;


                    INSERT INTO encuesta (idcurso, idalumno)
                    VALUES (curso_id, alumno_id);

                END LOOP;

                CLOSE cur_detallecurso;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP PROCEDURE IF EXISTS registrar_encuestas');
    }
};
