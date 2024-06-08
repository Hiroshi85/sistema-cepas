<?php

namespace Database\Factories\Rrhh;

use App\Models\Rrhh\Contrato;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratoFactory extends Factory
{
    protected $model = Contrato::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fecha_inicio = $this->faker->dateTimeBetween('-1 years', '+1 week');
        $fecha_fin = $this->faker->dateTimeBetween($fecha_inicio, '+5 years');
        return [
            'tipo_contrato' => $this->faker->randomElement(['tiempo completo', 'tiempo parcial']),
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'descripcion' => $this->faker->text,
            'remuneracion' => $this->faker->randomFloat(2, 1000, 10000),
            'empleado_id' => 0,

        ];
    }
}
