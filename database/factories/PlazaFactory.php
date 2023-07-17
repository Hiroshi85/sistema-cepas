<?php

namespace Database\Factories;

use App\Models\Plaza;
use App\Models\Puesto;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlazaFactory extends Factory
{
    protected $model = Plaza::class;

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
            'fecha_fin' => $this->faker->optional()->date(),
            'descripcion' => $this->faker->paragraph,
        ];
    }
}
