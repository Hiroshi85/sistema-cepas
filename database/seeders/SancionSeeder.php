<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sancion;

class SancionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sancion::create(['nombre'=>'Amonestación escrita']);
        Sancion::create(['nombre'=>'Reparación de daños']);
        Sancion::create(['nombre'=>'Expulsión temporal (2 días)']);
        Sancion::create(['nombre'=>'Expulsión temporal (3 días)']);
        Sancion::create(['nombre'=>'Expulsión temporal (5 días)']);
        Sancion::create(['nombre'=>'Expulsión permanente']);
    }
}
