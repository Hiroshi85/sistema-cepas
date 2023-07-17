<?php

namespace Database\Seeders;

use App\Models\Candidato;
use Illuminate\Database\Seeder;

class CandidatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Candidato::factory(20)->create();
    }
}
