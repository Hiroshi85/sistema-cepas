<?php

namespace Database\Seeders;

use App\Models\TipoDescuento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoDescuentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoDescuento::create([
            'nombre' => 'AFP',
        ]);
        TipoDescuento::create([
            'nombre' => 'Impuesto a la renta de 5ta categoría',
        ]);

        TipoDescuento::create([
            'nombre' => 'Seguro de salud (EsSalud)',
        ]);

    }
}
