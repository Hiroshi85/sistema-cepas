<?php

namespace Database\Factories\rrhh;

use App\Models\Rrhh\Equipo;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipoFactory extends Factory
{
    protected $model = Equipo::class;

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
        ];
    }
}
