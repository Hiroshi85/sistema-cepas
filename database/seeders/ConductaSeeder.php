<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Conducta;
class ConductaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Conducta::create(['nombre' => 'Bebidas alcoholicas', 'puntaje' =>-6]);
        Conducta::create(['nombre' => 'Evasión', 'puntaje' =>-4]);
        Conducta::create(['nombre' => 'Realiza plagio en trabajo o examen', 'puntaje' =>-4]);
        Conducta::create(['nombre' => 'Malogra inmobiliario educativo', 'puntaje' =>-5]);
        Conducta::create(['nombre' => 'Palabras soeces', 'puntaje' =>-2]);
        
        Conducta::create(['nombre' => 'Representacion escolar', 'puntaje' =>4]);
        Conducta::create(['nombre' => 'Participa en actividades escolares', 'puntaje' =>2]);
        Conducta::create(['nombre' => 'Apoyo estudiantil', 'puntaje' =>1]);
    }
}
