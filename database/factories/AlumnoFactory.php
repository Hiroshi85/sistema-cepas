<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idaula' => $this->faker->numberBetween(1, 10),
            'nombre_apellidos' => $this->faker->name(),
            'fecha_nacimiento' => $this->faker->date(),
            'dni' => $this->faker->randomNumber(8),
            'domicilio' => $this->faker->address(),
            'numero_celular' => $this->faker->randomNumber(9),
            'nro_hermanos' => $this->faker->randomNumber(1),
            'estado' => $this->faker->randomElement(['Matrícula pendiente','Matriculado']),
            'eliminado' => 0
        ];
    }
}
