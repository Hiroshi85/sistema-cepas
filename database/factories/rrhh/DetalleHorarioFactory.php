<?php

namespace Database\Factories\Rrhh;

use App\Models\Rrhh\DetalleHorario;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleHorarioFactory extends Factory
{
    protected $model = DetalleHorario::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->sentence,
            'horas_semana' => $this->faker->numberBetween(20, 40),
            'horas_mensuales' => $this->faker->numberBetween(80, 160),
        ];
    }
}
