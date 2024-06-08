<?php

namespace Database\Factories\Rrhh;

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
            $contrato = $random_employee->obtenerUltimoContrato();
        }
        $nomina = new Nomina([
            'empleado_id' => $random_employee->id,
            'fecha_inicio' => $inicio,
            'fecha_fin' => $fin,
            'sueldo_basico' => $contrato->remuneracion,
            'estado_pago' => 'pagado',
            'dias_laborados' => $this->faker->numberBetween(25, 30),
            'fecha_pago' => $this->faker->dateTimeBetween($fin, 'now'),
        ]);
        return [
            'empleado_id' => $nomina->empleado_id,
            'fecha_inicio' => $nomina->fecha_inicio,
            'fecha_fin' => $nomina->fecha_fin,
            'sueldo_basico' => $nomina->sueldo_basico,
            'total_bruto' => $nomina->totalBruto(),
            'total_neto' => $nomina->totalNeto(),
            'estado_pago' => $nomina->estado_pago,
            'dias_laborados' => $nomina->dias_laborados,
            'fecha_pago' => $nomina->fecha_pago,
        ];
    }
}
