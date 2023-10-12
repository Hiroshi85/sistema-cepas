<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Postulante>
 */
class PostulanteFactory extends Factory
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
            'dni' => $this->faker->randomNumber(8, true),
            'domicilio' => $this->faker->address(),
            'numero_celular' => $this->faker->randomNumber(9, true),
            'nro_hermanos' => $this->faker->randomNumber(1),
            'fecha_postulacion' => $this->faker->dateTimeBetween('2023-01-01', 'now'), // between 2023-01-01 - now
            'estado' => $this->faker->randomElement(['Registrado','Pendiente', 'Aceptado', 'Rechazado']),
            'eliminado' => 0
        ];
    }
}
