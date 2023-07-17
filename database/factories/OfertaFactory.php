<?php

namespace Database\Factories;

use App\Models\Oferta;
use App\Models\Puesto;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfertaFactory extends Factory
{
    protected $model = Oferta::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'puesto_id' => Puesto::inRandomOrder()->first()->id,
            'fecha_inicio' => $this->faker->date(),
            'fecha_fin' => $this->faker->optional(0.3)->date(),
            'descripcion' => $this->faker->text,
            'salario' => $this->faker->randomFloat(2, 1000, 10000),
            'beneficios' => $this->faker->optional(0.5)->text,
        ];
    }
}
