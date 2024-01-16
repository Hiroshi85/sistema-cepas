<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'puesto_id',
        'nombre',
        'dni',
        'fecha_nacimiento',
        'genero',
        'direccion',
        'telefono',
        'email',
        'esDocente',
    ];
    protected $table = 'empleados';

    protected $casts = [
        'esDocente' => 'boolean',
    ];

    public function puesto(): BelongsTo
    {
        return $this->belongsTo(Puesto::class, 'puesto_id');
    }

    public function contratos(): HasMany
    {
        return $this->hasMany(Contrato::class, 'empleado_id');
    }

    public function nominas(): HasMany
    {
        return $this->hasMany(Nomina::class, 'empleado_id');
    }

    public function horarios(): HasMany
    {
        return $this->hasMany(Horario::class, 'empleado_id');
    }

    // crud methods
    public static function listarEmpleados(
        $search = '',
        $sortBy = 'nombre',
        $sortDirection = 'asc',
        $paginate = 10
    ) {
        return Empleado::select('empleados.*', 'puestos.nombre as puesto', 'equipos.nombre as equipo')
            ->where('empleados.nombre', 'LIKE', "%{$search}%")
            ->orderBy($sortBy, $sortDirection)
            ->join('puestos', 'puestos.id', '=', 'empleados.puesto_id')
            ->join('equipos', 'equipos.id', '=', 'puestos.equipo_id')
            ->paginate($paginate);
    }
    public static function obtenerTodos()
    {
        return Empleado::orderBy('nombre', 'asc')->get();
    }


    public static function obtenerEmpleadosSinContrato()
    {
        $empleadosSinContrato = Empleado::select('empleados.*')
            ->whereNotIn('empleados.id', function ($query) {
                $query->select('contratos.empleado_id')
                    ->from('contratos');
            });

        $empleadosContratoFinalizado = Empleado::select('empleados.*')
            ->join('contratos', 'contratos.empleado_id', '=', 'empleados.id')
            ->where('contratos.fecha_fin', '<', now());

        $empleados = $empleadosSinContrato->union($empleadosContratoFinalizado)->get();

        return $empleados;
    }
    public static function crearEmpleado($data)
    {
        $empleado = Empleado::create($data);
        return $empleado;
    }

    public static function actualizarEmpleado($empleado, $data)
    {
        $empleado->update($data);
        return $empleado;
    }

    public static function eliminarEmpleado($empleado)
    {
        $empleado->delete();
        return $empleado;
    }

    public static function obtenerEncargadosDeEvaluacion()
    {
        return Empleado::where('puesto_id', '=', '3')->get();
    }

    public static function obtenerCoordinadorRRHH()
    {
        return Empleado::where('puesto_id', '=', '1')->first();
    }

    public static function obtenerContratoVigente($empleado_id)
    {
        return Contrato::where('empleado_id', '=', $empleado_id)
            ->where('fecha_fin', '>=', now())
            ->where('fecha_inicio', '<=', now())
            ->first();
    }

    public static function obtenerEmpleadosVigentes()
    {
        $empleados = Empleado::select('empleados.*', 'contratos.remuneracion')
            ->join('contratos', 'contratos.empleado_id', '=', 'empleados.id')
            ->where('contratos.fecha_fin', '>=', now())
            ->where('contratos.fecha_inicio', '<=', now())
            ->get();

        return $empleados;
    }
    public function obtenerUltimoContrato()
    {
        return Contrato::where('empleado_id', '=', $this->id)
            ->orderBy('fecha_fin', 'desc')
            ->first();
    }

    public function obtenerMesesTrabajados()
    {
        $contrato = $this->obtenerUltimoContrato();
        $fecha_inicio = $contrato->fecha_inicio;
        $fecha_fin = $contrato->fecha_fin;
        $fecha_inicio = strtotime($fecha_inicio);
        $fecha_fin = strtotime($fecha_fin);
        $meses = 0;
        while ($fecha_inicio <= $fecha_fin) {
            $meses++;
            $fecha_inicio = strtotime('+1 month', $fecha_inicio);
        }
        return $meses;
    }
}
