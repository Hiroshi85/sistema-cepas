<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EstadoResultadoPrueba;

class EstadoResultadoPruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        EstadoResultadoPrueba::create(['estado' => 'Normal']);
        EstadoResultadoPrueba::create(['estado' => 'Seguimiento']);
        EstadoResultadoPrueba::create(['estado' => 'Intervención']);
        EstadoResultadoPrueba::create(['estado' => 'Derivación']);
    }
}
