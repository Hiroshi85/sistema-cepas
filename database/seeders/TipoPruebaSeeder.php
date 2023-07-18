<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoPrueba;
class TipoPruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoPrueba::create(['tipo' => 'Emocional']);
        TipoPrueba::create(['tipo' => 'Inteligencia']);
        TipoPrueba::create(['tipo' => 'Aptitud']);
    }
}
