<?php

namespace Database\Factories\rrhh;

use App\Models\Rrhh\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    protected $model = Empleado::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'puesto_id' => 0,
            'nombre' => $this->faker->name,
            'dni' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'fecha_nacimiento' => $this->faker->date(),
            'genero' => $this->faker->randomElement(['masculino', 'femenino']),
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'esDocente' => $this->faker->boolean,
        ];
    }
}
