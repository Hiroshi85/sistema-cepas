<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Alumno;
use App\Models\AsistenciaXDia;

class BuscarController extends Controller
{
    public function buscarAsistencia(Request $req){
        $fecha = $req->query('fecha');
        $alumno_id = $req->query('alumno');
        $num = AsistenciaXDia::obtenerNumeroAsistenciaDeAlumno($alumno_id, $fecha);
        $enable = Carbon::now()->isWeekday();
        if($num <= 0 && $enable){
            AsistenciaXDia::crearAsistencia($fecha, 2, $alumno_id);
        }
        
        $asistencia =  AsistenciaXDia::obtenerAsistenciaDeAlumno($alumno_id, $fecha);
        error_log($asistencia);
        return ['tipo'=>$asistencia[0]->tipo->id, 'id_asistencia' => $asistencia[0]->id];
    }

    public function buscarAlumno(Request $req){
        $nom_alumno = $req->query('alumno');
        $alumnos = Alumno::buscarAlumnoPorString($nom_alumno);
        error_log($alumnos);
        return ['alumnos' => $alumnos];
    }
}
