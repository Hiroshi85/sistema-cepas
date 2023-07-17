<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Alumno;
use App\Models\Asistencia;

class BuscarController extends Controller
{
    public function buscarAsistencia(Request $req){
        $fecha = $req->query('fecha');
        $alumno_id = $req->query('alumno');
        $asistencia = Asistencia::where('alumno_id',$alumno_id)->where('fecha', $fecha)->with('tipo')->get();
        error_log($asistencia);
        return ['tipo'=>$asistencia[0]->tipo->id, 'id_asistencia' => $asistencia[0]->id];
    }

    public function buscarAlumno(Request $req){
        $nom_alumno = $req->query('alumno');
        $alumnos = Alumno::where('nombre_apellidos', 'like',"%".$nom_alumno."%")
            ->where('eliminado', 0)
            ->select("nombre_apellidos","idalumno")->get();
        error_log($alumnos);
        return ['alumnos' => $alumnos];
    }
}
