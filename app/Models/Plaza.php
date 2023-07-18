<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plaza extends Model
{
    use HasFactory;

    protected $fillable = [
        'puesto_id',
        'fecha_inicio',
        'fecha_fin',
        'abierta',
        'descripcion',
    ];

    protected $casts = [
        'abierta' => 'boolean',
    ];

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'puesto_id');
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class, 'plaza_id');
    }

    public function cerrar()
    {
        $this->abierta = false;
        $this->save();
    }

    // crud methods
    public static function listarPlazas(
        $search = '',
        $sortBy = 'puestos.nombre',
        $sortDirection = 'asc',
        $paginate = 10
    ) {
        return Plaza::select('plazas.*', 'puestos.nombre as puesto')
            ->where('puestos.nombre', 'LIKE', "%{$search}%")
            ->join('puestos', 'plazas.puesto_id', '=', 'puestos.id')
            ->orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }

    public static function listarPlazasConPostulaciones(
        $search = '',
        $sortBy = 'puestos.nombre',
        $sortDirection = 'asc',
        $paginate = 10
    ) {
        return Plaza::select('plazas.*', 'puestos.nombre as puesto')
            ->has('postulaciones')
            ->with(['postulaciones' => function ($query) {
                $query->orderBy('fecha_postulacion', 'desc');
            }])
            ->join('puestos', 'plazas.puesto_id', '=', 'puestos.id')
            ->where('puestos.nombre', 'LIKE', "%{$search}%")
            ->orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }

    public static function obtenerPlazasActivas()
    {
        return Plaza::where('fecha_inicio', '<=', date('Y-m-d'))
            ->where('fecha_fin', '>=', date('Y-m-d'))
            ->where('abierta', true)
            ->get();
    }

    public static function crearPlaza($data)
    {
        $plaza = Plaza::create($data);
        return $plaza;
    }

    public static function actualizarPlaza($plaza, $data)
    {
        $plaza->update($data);
        return $plaza;
    }

    public static function eliminarPlaza($plaza)
    {
        $plaza->delete();
        return $plaza;
    }

    public static function existeUnaPlazaConElMismoPuestoYPlazo($data, $plaza_id = null)
    {
        if ($plaza_id) {
            return Plaza::where('puesto_id', $data['puesto_id'])
                ->where('fecha_inicio', '<=', $data['fecha_inicio'])
                ->where('fecha_fin', '>=', $data['fecha_inicio'])
                ->where('id', '!=', $plaza_id)
                ->exists();
        }
        return Plaza::where('puesto_id', $data['puesto_id'])
            ->where('fecha_inicio', '<=', $data['fecha_inicio'])
            ->where('fecha_fin', '>=', $data['fecha_inicio'])
            ->exists();
    }
}
