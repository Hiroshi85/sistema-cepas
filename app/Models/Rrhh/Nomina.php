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
