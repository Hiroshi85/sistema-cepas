<?php

namespace Database\Factories;

use App\Models\Rrhh\Descuento;
use App\Models\Rrhh\Nomina;
use Illuminate\Database\Eloquent\Factories\Factory;

class DescuentoFactory extends Factory
{
    protected $model = Descuento::class;

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
        ];
    }
}
