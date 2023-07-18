<?php

namespace Database\Factories;

use App\Models\Aula;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aula>
 */
class AulaFactory extends Factory
{
    protected $model = Aula::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'grado' => $this->faker->numberBetween(1, 5),
            'seccion' => $this->faker->randomElement(['A', 'B']),
            'nro_vacantes_total' => 30,
            'nro_vacantes_disponibles' => 30,
        ];
    }
}
