<?php

namespace Database\Seeders;

use App\Models\TipoPrestacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoPrestacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoPrestacion::create([
            'nombre' => 'Gratificación',
        ]);
        TipoPrestacion::create([
            'nombre' => 'Vacaciones',
        ]);

    }
}
