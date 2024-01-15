<?php

namespace Database\Factories\rrhh;

use App\Models\Rrhh\Empleado;
use App\Models\Rrhh\Nomina;
use Illuminate\Database\Eloquent\Factories\Factory;

class NominaFactory extends Factory
{
    protected $model = Nomina::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $random_employee = Empleado::InRandomOrder()->first();
        $inicio = $this->faker->dateTimeBetween('-1 years', 'now');
        $fin = $this->faker->dateTimeBetween($inicio, 'now');
        $contrato= Empleado::obtenerContratoVigente($random_employee->id);
        if ($contrato == null) {
            $contrato = Empleado::obtenerUltimoContrato($random_employee->id);
        }
        $nomina = new Nomina([
            'empleado_id' => $random_employee->id,
            'fecha_inicio' => $inicio,
            'fecha_fin' => $fin,
            'sueldo_basico' => $contrato->remuneracion,
            'estado_pago' => $this->faker->randomElement(['pendiente', 'pagado']),
        ]);
        return [
            'empleado_id' => $nomina->empleado_id,
            'fecha_inicio' => $nomina->fecha_inicio,
            'fecha_fin' => $nomina->fecha_fin,
            'sueldo_basico' => $nomina->sueldo_basico,
            'total_bruto' => $nomina->totalBruto(),
            'total_neto' => $nomina->totalNeto(),
            'estado_pago' => $nomina->estado_pago,
        ];
    }
}
