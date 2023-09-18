<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apoderado>
 */
class ApoderadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // protected $fillable = ['idusuario','nombre_apellidos', 'dni', 'fecha_nacimiento', 'numero_celular', 'ocupacion', 'centro_trabajo', 'correo', 'eliminado'];
        return [
            'nombre_apellidos' => $this->faker->name(),
            'dni' => $this->faker->randomNumber(8),
            'fecha_nacimiento' => $this->faker->date(), 
            'numero_celular' => $this->faker->randomNumber(9), //only 9 numbers
            'ocupacion' => $this->faker->jobTitle(),
            'centro_trabajo' => $this->faker->company(),
            'correo' => $this->faker->email(),
            'eliminado' => false
        ];
    }
}
