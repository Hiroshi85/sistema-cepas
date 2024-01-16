<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nomina extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id',
        'fecha_inicio',
        'fecha_fin',
        'sueldo_basico',
        'total_bruto',
        'total_neto',
        'estado_pago',
        'dias_laborados',
        'fecha_pago',
    ];

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class);
    }

    public function descuentos(): HasMany
    {
        return $this->hasMany(Descuento::class);
    }

    public function prestaciones(): HasMany
    {
        return $this->hasMany(Prestacion::class);
    }

    public function totoalDescuentos(): float
    {
        return $this->descuentos->sum('monto');
    }

    public function totalPrestaciones(): float
    {
        return $this->prestaciones->sum('monto');
    }

    public function totalNeto(): float
    {
        return $this->totalBruto() - $this->totoalDescuentos() + $this->totalPrestaciones();
    }

    public function totalBruto(): float
    {
        return $this->sueldo_basico + $this->totalPrestaciones();
    }

    public function sueldoBasicoFormat(): string
    {
        return number_format($this->sueldo_basico, 2, ',', '.');
    }

    public function totalPrestacionesFormat(): string
    {
        return number_format($this->totalPrestaciones(), 2, ',', '.');
    }

    public function totalDescuentosFormat(): string
    {
        return number_format($this->totoalDescuentos(), 2, ',', '.');
    }

    public function totalBrutoFormat(): string
    {
        return number_format($this->totalBruto(), 2, ',', '.');
    }

    public function totalNetoFormat(): string
    {
        return number_format($this->totalNeto(), 2, ',', '.');
    }

    public function fechaInicioFormat(): string
    {
        return date('d/m/Y', strtotime($this->fecha_inicio));
    }

    public function fechaFinFormat(): string
    {
        return date('d/m/Y', strtotime($this->fecha_fin));
    }


    // CRUD METHODS
    public static function listarNominas(
        string $search = '',
        string $sortBy = 'id',
        string $sortDirection = 'desc',
    )
    {
        return Nomina::where('id', 'like', '%' . $search . '%')
            ->orWhere('fecha_inicio', 'like', '%' . $search . '%')
            ->orWhere('fecha_fin', 'like', '%' . $search . '%')
            ->orWhere('sueldo_basico', 'like', '%' . $search . '%')
            ->orWhere('total_bruto', 'like', '%' . $search . '%')
            ->orWhere('total_neto', 'like', '%' . $search . '%')
            ->orWhere('estado_pago', 'like', '%' . $search . '%')
            ->orderBy($sortBy, $sortDirection)
            ->paginate(10);
    }

    // other methods
    public static function calcularGratificacion($mes, Empleado $empleado)
    {
        $ultimo_contrato = $empleado->obtenerUltimoContrato();
        $sueldo_basico = $ultimo_contrato->remuneracion;
        $meses_trabajados = $empleado->obtenerMesesTrabajados();
        $gratificacion = 0;

        $meses_aplicable = [7, 12];

        if (!in_array($mes, $meses_aplicable)) {
            return $gratificacion;
        }
        if ($meses_trabajados >= 6) {
            $gratificacion = $sueldo_basico;
        } else {
            $gratificacion = $sueldo_basico * ($meses_trabajados / 6);
        }
        return $gratificacion;
    }

    public static function calcularVacaciones(Empleado $empleado)
    {
        $ultimo_contrato = $empleado->obtenerUltimoContrato();
        return $ultimo_contrato ? $ultimo_contrato->remuneracion : 0;

    }

    public static function calcularAfiliacionAFP(Empleado $empleado)
    {
        $ultimo_contrato = $empleado->obtenerUltimoContrato();
        return $ultimo_contrato ? $ultimo_contrato->remuneracion * 0.1 : 0;
    }

    public static function calcularEssalud(Empleado $empleado)
    {
        $ultimo_contrato = $empleado->obtenerUltimoContrato();
        return $ultimo_contrato ? $ultimo_contrato->remuneracion * 0.09 : 0;
    }

    public static function calcularImpuestoRentaTotal(Empleado $empleado)
    {
        $renta_bruta_anual = Nomina::sumarTodosLosBeneficiosDelAnio($empleado);
        $uit = 4300;
        $renta_neta_anual = $renta_bruta_anual - ($uit * 7);
        $impuesto_renta = 0;

        if ($renta_neta_anual <= 0) {
            $impuesto_renta = 0;
        } else if ($renta_neta_anual <= (5 * $uit)) {
            $impuesto_renta = 0.8 * $renta_neta_anual;
        } else if ($renta_neta_anual <= (20 * $uit)) {
            $impuesto_renta = 0.14 * $renta_neta_anual;
        } else if ($renta_neta_anual <= (35 * $uit)) {
            $impuesto_renta = 0.17 * $renta_neta_anual;
        } else if ($renta_neta_anual <= (45 * $uit)) {
            $impuesto_renta = 0.2 * $renta_neta_anual;
        } else {
            $impuesto_renta = 0.3 * $renta_neta_anual;
        }

        return $impuesto_renta;
    }


    public static function calcularImpuestoRentaMensual(Empleado $empleado, $mes)
    {
        $impuesto_renta_anual = Nomina::calcularImpuestoRentaTotal($empleado);

        $enero_a_marzo = [1, 2, 3];
        $abril = [4];
        $mayo_a_julio = [5, 7];
        $agosto = [8];
        $setiembre_a_noviembre = [9, 10, 11];
        $diciembre = [12];

//        $impuesto_renta_acumulado_enero_a_marzo = $impuesto_renta_anual / 12 * 3;
//        $impuesto_renta_acumulado_abril =( $impuesto_renta_anual - $impuesto_renta_acumulado_enero_a_marzo ) / 9;
//        $impuesto_renta_acumulado_mayo_a_julio = ( $impuesto_renta_anual - $impuesto_renta_acumulado_abril - $impuesto_renta_acumulado_enero_a_marzo ) / 8 * 3 ;
//        $impuesto_renta_acumulado_agosto = ( $impuesto_renta_anual - $impuesto_renta_acumulado_mayo_a_julio - $impuesto_renta_acumulado_abril - $impuesto_renta_acumulado_enero_a_marzo) / 5 ;
//        $impuesto_renta_acumulado_setiembre_a_noviembre = ( $impuesto_renta_anual - $impuesto_renta_acumulado_agosto  - $impuesto_renta_acumulado_mayo_a_julio - $impuesto_renta_acumulado_abril - $impuesto_renta_acumulado_enero_a_marzo) / 4 * 3;
//        $impuesto_renta_acumulado_diciembre = ( $impuesto_renta_anual - $impuesto_renta_acumulado_setiembre_a_noviembre -  $impuesto_renta_acumulado_agosto  - $impuesto_renta_acumulado_mayo_a_julio - $impuesto_renta_acumulado_abril - $impuesto_renta_acumulado_enero_a_marzo) ;

        $impuesto_renta_acumulado_enero_a_marzo = $impuesto_renta_anual / 12 * 3;
        $impuesto_renta_enero_a_marzo = $impuesto_renta_acumulado_enero_a_marzo / 3;
        $impuesto_renta_acumulado_enero_a_abril = ($impuesto_renta_anual - $impuesto_renta_acumulado_enero_a_marzo);
        $impuesto_renta_abril = $impuesto_renta_acumulado_enero_a_abril / 9;
        $impuesto_renta_acumulado_enero_a_mayo = ($impuesto_renta_anual - $impuesto_renta_acumulado_enero_a_marzo - $impuesto_renta_abril);
        $impuesto_renta_mayo = $impuesto_renta_acumulado_enero_a_mayo / 8 * 3;
        $impuesto_renta_acumulado_enero_a_agosto = ($impuesto_renta_anual - $impuesto_renta_acumulado_enero_a_marzo - $impuesto_renta_abril - $impuesto_renta_mayo);
        $impuesto_renta_agosto = $impuesto_renta_acumulado_enero_a_agosto / 5;
        $impuesto_renta_acumulado_enero_a_setiembre = ($impuesto_renta_anual - $impuesto_renta_acumulado_enero_a_marzo - $impuesto_renta_abril - $impuesto_renta_mayo - $impuesto_renta_agosto);
        $impuesto_renta_setiembre = $impuesto_renta_acumulado_enero_a_setiembre / 4 * 3;
        $impuesto_renta_acumulado_enero_a_diciembre = ($impuesto_renta_anual - $impuesto_renta_acumulado_enero_a_marzo - $impuesto_renta_abril - $impuesto_renta_mayo - $impuesto_renta_agosto - $impuesto_renta_setiembre);
        $impuesto_renta_diciembre = $impuesto_renta_acumulado_enero_a_diciembre ;




        if (in_array($mes, $enero_a_marzo)) {
            $impuesto_renta_mensual = $impuesto_renta_enero_a_marzo;
        } else if (in_array($mes, $abril)) {
            $impuesto_renta_mensual = $impuesto_renta_abril;
        } else if (in_array($mes, $mayo_a_julio)) {
            $impuesto_renta_mensual = $impuesto_renta_mayo;
        } else if (in_array($mes, $agosto)) {
            $impuesto_renta_mensual = $impuesto_renta_agosto;
        } else if (in_array($mes, $setiembre_a_noviembre)) {
            $impuesto_renta_mensual = $impuesto_renta_setiembre;
        } else if (in_array($mes, $diciembre)) {
            $impuesto_renta_mensual = $impuesto_renta_diciembre;
        } else {
            $impuesto_renta_mensual = 0;
        }
        return $impuesto_renta_mensual;
    }


    public static function sumarTodosLosBeneficiosDelAnio(Empleado $empleado)
    {
        $beneficios = 0;
        $beneficios += Nomina::calcularGratificacion(7, $empleado);
        $beneficios += Nomina::calcularGratificacion(12, $empleado);
        $beneficios += Nomina::calcularVacaciones($empleado);
        $contrato = $empleado->obtenerUltimoContrato();
        for ($i = 1; $i <= 12; $i++) {
            $beneficios += $contrato->remuneracion;
        }
        return $beneficios;
    }


    public static function obtenerPeriodos()
    {
        $periodos = [];
        $anio_actual = date('Y');
        $periodos[] = [
            'nombre' => 'Enero ' . $anio_actual,
            'mes' => 1,
            'anio' => $anio_actual,
            'fecha_inicio' => $anio_actual . '-01-01',
            'fecha_fin' => $anio_actual . '-01-31',
            'id' => $anio_actual . '-01-01' . '/' . $anio_actual . '-01-31',

        ];
        $periodos[] = [
            'nombre' => 'Febrero ' . $anio_actual,
            'mes' => 2,
            'anio' => $anio_actual,
            'fecha_inicio' => $anio_actual . '-02-01',
            'fecha_fin' => $anio_actual . '-02-28',
            'id' => $anio_actual . '-02-01' . '/' . $anio_actual . '-02-28',

        ];
        $periodos[] = [
            'nombre' => 'Marzo ' . $anio_actual,
            'mes' => 3,
            'anio' => $anio_actual,
            'fecha_inicio' => $anio_actual . '-03-01',
            'fecha_fin' => $anio_actual . '-03-31',
            'id' => $anio_actual . '-03-01' . '/' . $anio_actual . '-03-31',
        ];
        $periodos[] = [
            'nombre' => 'Abril ' . $anio_actual,
            'mes' => 4,
            'anio' => $anio_actual,
            'fecha_inicio' => $anio_actual . '-04-01',
            'fecha_fin' => $anio_actual . '-04-30',
            'id' => $anio_actual . '-04-01' . '/' . $anio_actual . '-04-30',
        ];
        $periodos[] = [
            'nombre' => 'Mayo ' . $anio_actual,
            'mes' => 5,
            'anio' => $anio_actual,
            'fecha_inicio' => $anio_actual . '-05-01',
            'fecha_fin' => $anio_actual . '-05-31',
            'id' => $anio_actual . '-05-01' . '/' . $anio_actual . '-05-31',
        ];
        $periodos[] = [
            'nombre' => 'Junio ' . $anio_actual,
            'mes' => 6,
            'anio' => $anio_actual,
            'fecha_inicio' => $anio_actual . '-06-01',
            'fecha_fin' => $anio_actual . '-06-30',
            'id' => $anio_actual . '-06-01' . '/' . $anio_actual . '-06-30',
        ];
        $periodos[] = [
            'nombre' => 'Julio ' . $anio_actual,
            'mes' => 7,
            'anio' => $anio_actual,
            'fecha_inicio' => $anio_actual . '-07-01',
            'fecha_fin' => $anio_actual . '-07-31',
            'id' => $anio_actual . '-07-01' . '/' . $anio_actual . '-07-31',
        ];
        $periodos[] = [
            'nombre' => 'Agosto ' . $anio_actual,
            'mes' => 8,
            'anio' => $anio_actual,
            'fecha_inicio' => $anio_actual . '-08-01',
            'fecha_fin' => $anio_actual . '-08-31',
            'id' => $anio_actual . '-08-01' . '/' . $anio_actual . '-08-31',
        ];
        $periodos[] = [
            'nombre' => 'Setiembre ' . $anio_actual,
            'mes' => 9,
            'anio' => $anio_actual,
            'fecha_inicio' => $anio_actual . '-09-01',
            'fecha_fin' => $anio_actual . '-09-30',
            'id' => $anio_actual . '-09-01' . '/' . $anio_actual . '-09-30',
        ];
        $periodos[] = [
            'nombre' => 'Octubre ' . $anio_actual,
            'mes' => 10,
            'anio' => $anio_actual,
            'fecha_inicio' => $anio_actual . '-10-01',
            'fecha_fin' => $anio_actual . '-10-31',
            'id' => $anio_actual . '-10-01' . '/' . $anio_actual . '-10-31',
        ];
        $periodos[] = [
            'nombre' => 'Noviembre ' . $anio_actual,
            'mes' => 11,
            'anio' => $anio_actual,
            'fecha_inicio' => $anio_actual . '-11-01',
            'fecha_fin' => $anio_actual . '-11-30',
            'id' => $anio_actual . '-11-01' . '/' . $anio_actual . '-11-30',
        ];
        $periodos[] = [
            'nombre' => 'Diciembre ' . $anio_actual,
            'mes' => 12,
            'anio' => $anio_actual,
            'fecha_inicio' => $anio_actual . '-12-01',
            'fecha_fin' => $anio_actual . '-12-31',
            'id' => $anio_actual . '-12-01' . '/' . $anio_actual . '-12-31',
        ];

        return $periodos;
    }
}
