<?php

namespace Database\Factories;

use App\Models\Rrhh\Nomina;
use App\Models\Rrhh\Prestacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrestacionFactory extends Factory
{
    protected $model = Prestacion::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomina_id' => Nomina::InRandomOrder()->first()->id,
            'concepto' => $this->faker->word,
            'monto' => $this->faker->randomFloat(2, 0, 99999),
            'fecha_aplicacion' => $this->faker->date(),
        ];
    }
}
