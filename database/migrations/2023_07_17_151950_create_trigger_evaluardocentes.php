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
            CREATE TRIGGER crear_evaluaciones AFTER INSERT ON empleados
            FOR EACH ROW
            BEGIN
                IF NEW.esDocente = 1 THEN
                    INSERT INTO evaluacion_docente (iddocente)
                    VALUES (NEW.id);
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS crear_evaluaciones');

    }
};
