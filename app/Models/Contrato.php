<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_contrato',
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
        'remuneracion',
        'empleado_id'
    ];


    public function estado()
    {
        // if the current date is between the start and end date
        if (now()->between($this->fecha_inicio, $this->fecha_fin)) {
            return 'vigente';
        }
        // if the current date is after the end date
        if (now()->gt($this->fecha_fin)) {
            return 'finalizado';
        }
        // if the current date is before the start date
        if (now()->lt($this->fecha_inicio)) {
            return 'proxima';
        }
    }


    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    // crud methods

    public static function crearContrato($data)
    {
        $contrato = Contrato::create($data);
        return $contrato;
    }

    public static function actualizarContrato($contrato, $data)
    {
        $contrato->update($data);
        return $contrato;
    }

    public static function eliminarContrato($contrato)
    {
        $contrato->delete();
        return $contrato;
    }

    public static function obtenerContrato($id)
    {
        $contrato = Contrato::find($id);
        return $contrato;
    }

    public static function obtenerTodos()
    {
        $contratos = Contrato::all();
        return $contratos;
    }

    public static function obtenerContratosVigentes()
    {
        $contratos = Contrato::where('fecha_fin', '>=', now())->where('fecha_inicio', '<=', now())->get();
        return $contratos;
    }

    public static function listarContratos(
        $search = '',
        $sortBy = 'fecha_inicio',
        $sortDirection = 'desc',
        $estado = null,
        $paginate = 10
    ) {

        if ($estado == 'vigente') {

            return Contrato::select(
                'contratos.*',
                'empleados.nombre as empleado_nombre',
                'puestos.nombre as puesto'
            )
                ->join('empleados', 'empleados.id', '=', 'contratos.empleado_id')
                ->join('puestos', 'puestos.id', '=', 'empleados.puesto_id')
                ->where('fecha_fin', '>=', now())->where('fecha_inicio', '<=', now())
                ->where('empleados.nombre', 'like', '%' . $search . '%')
                ->orderBy($sortBy, $sortDirection)
                ->paginate($paginate);
        }

        if ($estado == 'finalizado') {

            return Contrato::select(
                'contratos.*',
                'empleados.nombre as empleado_nombre',
                'puestos.nombre as puesto'
            )
                ->join('empleados', 'empleados.id', '=', 'contratos.empleado_id')
                ->join('puestos', 'puestos.id', '=', 'empleados.puesto_id')
                ->where('fecha_fin', '<', now())
                ->where('empleados.nombre', 'like', '%' . $search . '%')
                ->orderBy($sortBy, $sortDirection)
                ->paginate($paginate);
        }

        if ($estado == 'proxima') {

            return Contrato::select(
                'contratos.*',
                'empleados.nombre as empleado_nombre',
                'puestos.nombre as puesto'
            )
                ->join('empleados', 'empleados.id', '=', 'contratos.empleado_id')
                ->join('puestos', 'puestos.id', '=', 'empleados.puesto_id')
                ->where('fecha_inicio', '>', now())
                ->where('empleados.nombre', 'like', '%' . $search . '%')
                ->orderBy($sortBy, $sortDirection)
                ->paginate($paginate);
        }

        return Contrato::select(
            'contratos.*',
            'empleados.nombre as empleado_nombre',
            'puestos.nombre as puesto'
        )
            ->join('empleados', 'empleados.id', '=', 'contratos.empleado_id')
            ->join('puestos', 'puestos.id', '=', 'empleados.puesto_id')
            ->where('empleados.nombre', 'like', '%' . $search . '%')
            ->orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }
}
