<?php

namespace Database\Factories;

use App\Models\candidato;
use App\Models\postulacion;
use App\Models\Plaza;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostulacionFactory extends Factory
{
    protected $model = Postulacion::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'candidato_id' => candidato::inRandomOrder()->first()->id,
            'plaza_id' => Plaza::inRandomOrder()->first()->id,
            'estado' => $this->faker->randomElement(['pendiente', 'en revision', 'aprobado', 'rechazado']),
            'fecha_postulacion' => $this->faker->date(),
        ];
    }
}
