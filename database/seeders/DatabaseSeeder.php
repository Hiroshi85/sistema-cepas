<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EquipoSeeder::class);
        $this->call(PuestoSeeder::class);
        $this->call(ContratoSeeder::class);
        $this->call(AsignaturaSeeder::class);
        $this->call(CandidatoSeeder::class);
    }
}
