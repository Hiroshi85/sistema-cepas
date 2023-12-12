<?php

namespace App\Services\Academia;

use App\Models\Academia\Solicitud;

class SolicitudService
{
    public function ListElements(
        $cicle,
        $search = '',
        $sortBy = 'nombre',
        $sortDirection = 'asc',
        $paginate = 10,
    )
    {
        return Solicitud::
            select('solicitud_academia.*', 'alumnos.nombre_apellidos as alumnoNombre', 'alumnos.dni as alumnoDni', 'carreras_unt.nombre as carreraNombre')->
            join('alumnos', 'solicitud_academia.idalumno', '=', 'alumnos.idalumno')->
            join('carreras_unt', 'solicitud_academia.idcarrera', '=', 'carreras_unt.id')->
            where('alumnos.nombre_apellidos', 'LIKE', "%{$search}%")->
            where('solicitud_academia.idciclo_academico', $cicle->id)->
            orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }
}
