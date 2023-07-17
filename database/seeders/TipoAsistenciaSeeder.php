<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoAsistencia;

class TipoAsistenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoAsistencia::create(['descripcion' => 'Presente']);
        TipoAsistencia::create(['descripcion' => 'Falta']);
        TipoAsistencia::create(['descripcion' => 'Justificado']);
        TipoAsistencia::create(['descripcion' => 'Tardanza']);
    }
}
