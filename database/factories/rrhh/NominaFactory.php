<?php

namespace Database\Factories\rrhh;

use App\Models\Rrhh\Empleado;
use App\Models\Rrhh\Nomina;
use Illuminate\Database\Eloquent\Factories\Factory;

class NominaFactory extends Factory
{
    protected $model = Nomina::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'empleado_id' => Empleado::InRandomOrder()->first()->id,
            'fecha_inicio' => $this->faker->date(),
            'fecha_fin' => $this->faker->date(),
            'sueldo_basico' => $this->faker->randomFloat(2, 1000, 5000),
            'total_bruto' => $this->faker->randomFloat(2, 1000, 5000),
            'total_neto' => $this->faker->randomFloat(2, 800, 4000),
            'estado_pago' => $this->faker->randomElement(['pendiente', 'pagado']),
        ];
    }
}
