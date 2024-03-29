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

        $this->call(AulaSeeder::class);
        $this->call(MetodoPagoSeeder::class);

        $this->call(EquipoSeeder::class);
        $this->call(PuestoSeeder::class);
        $this->call(ContratoSeeder::class);
        $this->call(TipoPrestacionSeeder::class);
        $this->call(TipoDescuentoSeeder::class);
        $this->call(NominaSeeder::class);
        $this->call(AsignaturaSeeder::class);
        $this->call(CandidatoSeeder::class);

        $this->call(TipoAsistenciaSeeder::class);
        $this->call(TipoPruebaSeeder::class);
        $this->call(ConductaSeeder::class);
        $this->call(EstadoResultadoPruebaSeeder::class);

        $this->call(AsignacionSeeder::class);

        $this->call(ApoderadoSeeder::class);
        $this->call(PostulanteSeeder::class);
        $this->call(CursosSeeder::class);
        $this->call(SancionSeeder::class);
    }
}
