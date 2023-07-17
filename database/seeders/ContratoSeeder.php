<?php

namespace Database\Seeders;

use App\Models\Contrato;
use App\Models\Empleado;
use Illuminate\Database\Seeder;

class ContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contrato::factory()->count(1)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 1,
            ])->id,
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 2,
            ])->id,
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 3,
            ])->id,
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 4,
            ])->id,
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 5,
            ])->id,
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 6,
            ])->id,
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 7,
            ])->id,
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 8,
            ])->id,
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 9,
            ])->id,
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 11,
            ])->id,
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 12,
            ])->id,
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 13,
            ])->id,
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 14,
            ])->id,
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 15,
            ])->id,
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 16,
            ])->id,
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 17,
            ])->id,
        ]);
        Contrato::factory()->count(4)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 18,
            ])->id,
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 19,
            ])->id,
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 20,
            ])->id,
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 21,
            ])->id,
        ]);
        Contrato::factory()->count(1)->create([
            'empleado_id' => Empleado::factory()->create([
                'puesto_id' => 22,
            ])->id,
        ]);
    }
}
