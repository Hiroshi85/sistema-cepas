<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tabla = DB::table('puestos');
        $tabla->insert([
            'nombre' => 'Coordinador de Recursos Humanos',
            'equipo_id' => 1,
        ]);
        $tabla->insert([
            'nombre' => 'Especialista en Reclutamiento',
            'equipo_id' => 1,
        ]);
        $tabla->insert([
            'nombre' => 'Encargado de Evaluación',
            'equipo_id' => 1,
        ]);
        $tabla->insert([
            'nombre' => 'Empleado de Nóminas',
            'equipo_id' => 1,
        ]);
        $tabla->insert([
            'nombre' => 'Secretaria',
            'equipo_id' => 1,
        ]);

        $tabla->insert([
            'nombre' => 'Auxiliar',
            'equipo_id' => 1,
        ]);
        $tabla->insert([
            'nombre' => 'Coordinador de Proyectos',
            'equipo_id' => 2,
        ]);
        $tabla->insert([
            'nombre' => 'Coordinador de Tecnologías de Información',
            'equipo_id' => 3,
        ]);
        $tabla->insert([
            'nombre' => 'Coordinador de Docentes',
            'equipo_id' => 4,
        ]);
        $tabla->insert([
            'nombre' => 'Docente especialista en Matemáticas',
            'equipo_id' => 4,
        ]);
        $tabla->insert([
            'nombre' => 'Docente especialista en Arte y Cultura',
            'equipo_id' => 4,
        ]);
        $tabla->insert([
            'nombre' => 'Docente especialista en Idiomas',
            'equipo_id' => 4,
        ]);
        $tabla->insert([
            'nombre' => 'Docente especialista en Ciencias Sociales',
            'equipo_id' => 4,
        ]);
        $tabla->insert([
            'nombre' => 'Docente especialista en Ciencia y Tecnología',
            'equipo_id' => 4,
        ]);
        $tabla->insert([
            'nombre' => 'Docente especialista en Educación Física',
            'equipo_id' => 4,
        ]);
        $tabla->insert([
            'nombre' => 'Docente especialista en Desarrollo Personal',
            'equipo_id' => 4,
        ]);
        $tabla->insert([
            'nombre' => 'Docente especialista en Educación para el Trabajo',
            'equipo_id' => 4,
        ]);
        $tabla->insert([
            'nombre' => 'Docente especialista en Comunicación',
            'equipo_id' => 4,
        ]);
        $tabla->insert([
            'nombre' => 'Docente especialista en Educación Religiosa',
            'equipo_id' => 4,
        ]);
        $tabla->insert([
            'nombre' => 'Coordinador de Asuntos Legales',
            'equipo_id' => 5,
        ]);
        $tabla->insert([
            'nombre' => 'Abogado',
            'equipo_id' => 5,
        ]);
        $tabla->insert([
            'nombre' => 'Coordinador de Finanzas',
            'equipo_id' => 6,
        ]);
        $tabla->insert([
            'nombre' => 'Contador',
            'equipo_id' => 6,
        ]);
        $tabla->insert([
            'nombre' => 'Psicólogo',
            'equipo_id' => 7,
        ]);
    }
}
