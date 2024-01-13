<?php

namespace Database\Seeders;

use App\Http\Controllers\EmpleadoController;
use App\Models\Rrhh\Contrato;
use App\Models\Rrhh\Empleado;
use Illuminate\Database\Seeder;

class ContratoSeeder extends Seeder
{
    // private validos = [];
    private function createEmpleadoAndUser(int $idp): int
    {
        $user = null;
        $empleado = Empleado::factory()->create([
            'puesto_id' => $idp,
        ]);

        EmpleadoController::createUser($empleado);
        return $empleado->id;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(1),
            // Empleado::factory()->create([
            //     'puesto_id' => 1,
            // ])
            // ->id,
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(2),
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(3),
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(4),
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(5),
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(6),
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(7),
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(8),
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => $this->createEmpleadoAndUser(9),
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => $this->createEmpleadoAndUser(10),
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => $this->createEmpleadoAndUser(11),
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => $this->createEmpleadoAndUser(12),
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => $this->createEmpleadoAndUser(13),
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => $this->createEmpleadoAndUser(14),
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => $this->createEmpleadoAndUser(15),
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => $this->createEmpleadoAndUser(16),
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => $this->createEmpleadoAndUser(17),
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => $this->createEmpleadoAndUser(18),
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(19),
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(20),
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(21),
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(22),
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(23),
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => $this->createEmpleadoAndUser(24),
        ]);
    }
}
