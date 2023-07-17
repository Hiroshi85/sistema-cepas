<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'puesto_id',
        'contrato_id',
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
}
