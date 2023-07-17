<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tabla = DB::table('equipos');
        $tabla->insert([
            'nombre' => 'Administrativo',
        ]);
        $tabla->insert([
            'nombre' => 'Proyectos',
        ]);
        $tabla->insert([
            'nombre' => 'Tecnologías de Información',
        ]);
        $tabla->insert([
            'nombre' => 'Docentes',
        ]);
        $tabla->insert([
            'nombre' => 'Legal',
        ]);
        $tabla->insert([
            'nombre' => 'Finanzas',
        ]);
        $tabla->insert([
            'nombre' => 'Psicología',
        ]);
    }
}
