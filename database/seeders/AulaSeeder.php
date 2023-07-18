<?php

namespace Database\Seeders;

use App\Models\Aula;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grados = [1, 2, 3, 4, 5];
        $secciones = ['A', 'B'];

        $totalAulas = 0;

    
        foreach ($grados as $grado) {
            foreach ($secciones as $seccion) {
                Aula::factory()->create([
                    'grado' => $grado,
                    'seccion' => $seccion,
                ]);
                $totalAulas++;
                if ($totalAulas >= 10) {
                    break 2;
                }
            }
        }
    }
}
