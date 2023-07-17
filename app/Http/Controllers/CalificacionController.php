<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\CursoAsignado;
use App\Models\Alumno;
use Barryvdh\DomPDF\Facade\Pdf;



class CalificacionController extends Controller
{
    //
    const PAGINATION = 25;
    
    public function calificacionesporalumno($id)
    {
        $al = Alumno::where('dni','=',$id)->first();
        $calificaciones=Calificacion::where('idalumno','=',$al->idalumno)->get();
        return view('calificaciones.miscalificaciones',compact('calificaciones'));
    }

    public function pdf($id)
    {
        $al = Alumno::where('dni','=',$id)->first();
        $calificaciones=Calificacion::where('idalumno','=',$al->idalumno)->get();
        $pdf = Pdf::loadView('calificaciones.miscalificacionespdf', compact('calificaciones','al'));
        return $pdf->stream();
    }

    public function registrar($id)
    {
        $calificaciones=Calificacion::where('idcurso','=',$id)->get();
        $c=CursoAsignado::findOrFail($id);
        return view('calificaciones.registro',compact('calificaciones','c'));
    }

    public function update(Request $request)
    {
        $idsc = $_POST['idcalificacion'];
        $s1s = $_POST['b1'];
        $s2s = $_POST['b2'];
        $s3s = $_POST['b3'];
        $s4s = $_POST['b4'];

        for($i = 0; $i<sizeof($idsc); ++$i){
            $calif = Calificacion::findOrFail($idsc[$i]);
            $calif->b1 =$s1s[$i];
            $calif->b2 =$s2s[$i];
            $calif->b3 =$s3s[$i];
            $calif->b4 =$s4s[$i];
            $calif->prom = (floatval($s1s[$i])+floatval($s2s[$i])+floatval($s3s[$i])+floatval($s4s[$i]))/4;
            // // // Guardar el registro en la base de datos
            $calif->save();
        }
        return redirect()->back()->with('mensaje','Calificaciones registradas correctamente.');
    }
    
}
