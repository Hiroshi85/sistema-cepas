<?php

namespace Database\Factories;

use App\Models\Rrhh\Equipo;
use App\Models\Rrhh\Puesto;
use Illuminate\Database\Eloquent\Factories\Factory;

class PuestoFactory extends Factory
{
    protected $model = Puesto::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word,
            'descripcion' => $this->faker->paragraph,
            'equipo_id' => Equipo::inRandomOrder()->first()->id,
        ];
    }
}
