<?php

namespace App\Services\Academia;

use App\Models\Academia\CicloAcademico;
use App\Models\Academia\DocumentoSolicitud;
use App\Models\Academia\Solicitud;
use App\Models\Alumno;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SolicitudService
{
    protected AlumnoAcademiaService $academiaService;

    public function __construct(AlumnoAcademiaService $academiaService)
    {
        $this->academiaService = $academiaService;
    }


    public function ListElements(
        $cicle,
        $status = 'all',
        $search = '',
        $sortBy = 'solicitud_academia.fecha_solicitud',
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
            where(function ($query) use ($status) {
                if ($status != 'all') {
                    $query->where('solicitud_academia.estado', $status);
                }
            })->
            orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }

    protected function generateUniqueKey(): string
    {
        $key = Str::random(8);
        $solicitud = Solicitud::where('public_id', $key)->first();
        if ($solicitud) {
            return $this->generateUniqueKey();
        }
        return $key;
    }

    public function create(array $validated, $ciclo)
    {
        $observaciones = null;
        if (isset($validated['observaciones'])){
            $observaciones = $validated['observaciones'];
        }

        return Solicitud::create([
            'idalumno' => $validated['idalumno'],
            'observaciones' => $observaciones,
            'fecha_solicitud' => date('Y-m-d'),
            'estado' => 'Pendiente',
            'idcarrera' => $validated['idcarrera'],
            'idciclo_academico' => $ciclo->id,
            'public_id' => $this->generateUniqueKey()
        ]);
    }

    public function GetAlumnosThatNotHaveRequest(CicloAcademico $cicloAcademico)
    {
       return Alumno::where('alumnos.eliminado', 0)
           ->whereNotIn('alumnos.idalumno', function($query) use ($cicloAcademico) {
               $query->select('solicitud_academia.idalumno')
                   ->from('solicitud_academia')
                   ->where('solicitud_academia.idciclo_academico', $cicloAcademico->id)
                   ->whereRaw('solicitud_academia.idalumno = alumnos.idalumno');
           })
           ->orderBy('alumnos.nombre_apellidos')
           ->get();
    }

    public function handleAction($request, Solicitud $solicitud) {
        $estado = $request->accion == 'aceptar' ? 'aceptado' : 'rechazado';

        DB::transaction(
            function () use ($solicitud, $request, $estado) {
                if ($estado == 'aceptado'){
                    $this->Aceptar($solicitud);
                } else {
                    $this->Rechazar($solicitud);
                }

                $this->handleDocumentacion($request, $solicitud);
            }
        );

    }

    public function Aceptar(Solicitud $solicitud)
    {
        DB::transaction(
            function () use ($solicitud) {
                $this->academiaService->create($solicitud);
                $solicitud->update([
                    'estado' => 'aceptado'
                ]);
            }
        );
    }

    public function Rechazar(Solicitud $solicitud)
    {
        DB::transaction(
            function () use ($solicitud) {
                $solicitud->update([
                    'estado' => 'rechazado'
                ]);

                $this->academiaService->UpdateStatusAlumnoSolicitudIfExists($solicitud, 'rechazado');
            }
        );
    }

    public function handleDocumentacion($request, Solicitud $solicitud){
        $estado = $request->accion == 'aceptar' ? 'aceptado' : 'rechazado';

        if ($solicitud->documento) {
            $solicitud->documento->update([
                'estado' => $estado,
                'observaciones' => $request->observaciones,
            ]);
        }else{
            DocumentoSolicitud::create([
                'estado' => $estado,
                'idsolicitud' => $solicitud->id,
                'observaciones' => $request->observaciones,
            ]);
        }
    }

}
