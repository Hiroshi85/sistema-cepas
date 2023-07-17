<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        // Crea el trigger utilizando el método unprepared
        DB::unprepared('
            CREATE TRIGGER crear_asistencia AFTER INSERT ON alumnos
            FOR EACH ROW
            BEGIN
                DECLARE i INT DEFAULT 1;
                
                WHILE i <= 4 DO
                    INSERT INTO asistencia_asignatura (idalumno, idcurso, bimestre) 
                    SELECT NEW.idalumno, iddetalle, i FROM DETALLECURSO WHERE idaula = NEW.idaula;
                    SET i = i + 1;
                END WHILE;
            END
        ');
    }

    public function down()
    {
        // Si es necesario, puedes definir una operación para revertir el trigger
        DB::unprepared('DROP TRIGGER IF EXISTS crear_asistencia');
    }

};
