<?php

namespace Database\Seeders;

use App\Models\Rrhh\Candidato;
use App\Models\Rrhh\Nomina;
use Illuminate\Database\Seeder;

class NominaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nomina::factory(100)->create();
    }
}
