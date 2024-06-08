<?php

namespace Database\Factories\Rrhh;

use App\Models\Rrhh\Empleado;
use App\Models\Rrhh\Horario;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioFactory extends Factory
{
    protected $model = Horario::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'empleado_id' => Empleado::inRandomOrder()->first()->id,
            'horas_semana' => $this->faker->numberBetween(1, 40),
            'horas_mensuales' => $this->faker->numberBetween(1, 160),
        ];
    }
}
