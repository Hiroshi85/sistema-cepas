<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\Horario;
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
