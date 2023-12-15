<?php

namespace App\Services\Academia;

use App\Models\Academia\AlumnoAcademia;
use App\Models\Academia\Solicitud;
use Illuminate\Support\Str;

class AlumnoAcademiaService
{
    protected function generateUniqueKey(): string
    {
        $key = Str::random(8);
        $solicitud = AlumnoAcademia::where('public_id', $key)->first();
        if ($solicitud) {
            return $this->generateUniqueKey();
        }
        return $key;
    }

    public function create(Solicitud $solicitud)
    {
        return AlumnoAcademia::firstOrCreate([
            'idalumno' => $solicitud->idalumno,
            'idciclo_academico' => $solicitud->idciclo_academico,
        ],[
            'public_id' => $this->generateUniqueKey(),
            'idalumno' => $solicitud->idalumno,
            'eliminado' => 0,
            'idcarrera' => $solicitud->idcarrera,
        ]);
    }

    public function UpdateStatusAlumnoSolicitudIfExists(Solicitud $solicitud, string $status) {
        $alumnoAcademia = AlumnoAcademia::where('idalumno', $solicitud->idalumno)
            ->where('idciclo_academico', $solicitud->idciclo_academico)->first();

        if ($alumnoAcademia && $status == 'rechazado') {
            $alumnoAcademia->eliminado = 1;
        }
    }
}
