<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\CursoAsignado;
use Barryvdh\DomPDF\Facade\Pdf;

class AsistenciaController extends Controller
{
    //
    const PAGINATION = 25;
    
    public function show($id)
    {
        //
    }

    public function asistenciaprofesor($id)
    {
        $c = CursoAsignado::findOrFail($id);
        return view('cursos.asistencia',compact('c'));
    }

    public function listaprofesor($id1,$id2)
    {
        $asistencias=Asistencia::where('idcurso','=',$id1)->where('bimestre','=',$id2)->get();
        $c=CursoAsignado::findOrFail($id1);
        $numbim=$id2;
        return view('asistencia.lista',compact('asistencias','c','numbim'));
    }

    public function pdf($id1,$id2)
    {
        $asistencias=Asistencia::where('idcurso','=',$id1)->where('bimestre','=',$id2)->get();
        $c=CursoAsignado::findOrFail($id1);
        $numbim=$id2;
        $pdf = Pdf::loadView('asistencia.listapdf', compact('asistencias','c','numbim'));
        return $pdf->stream();
    }

    public function nroasistencias($a)
    {
        $contador = 0;

        if($a->s1 == 'A')
            $contador++;
        if($a->s2 == 'A')
            $contador++;
        if($a->s3 == 'A')
            $contador++;
        if($a->s4 == 'A')
            $contador++;
        if($a->s5 == 'A')
            $contador++;
        if($a->s6 == 'A')
            $contador++;
        if($a->s7 == 'A')
            $contador++;
        if($a->s8 == 'A')
            $contador++;
        
        return $contador;
    }

    public function update(Request $request)
    {
        $idsa = $_POST['idasistencia'];
        $s1s = $_POST['s1'];
        $s2s = $_POST['s2'];
        $s3s = $_POST['s3'];
        $s4s = $_POST['s4'];
        $s5s = $_POST['s5'];
        $s6s = $_POST['s6'];
        $s7s = $_POST['s7'];
        $s8s = $_POST['s8'];

        for($i = 0; $i<sizeof($idsa); ++$i){
            $asis = Asistencia::findOrFail($idsa[$i]);
            $asis->s1 =$s1s[$i];
            $asis->s2 =$s2s[$i];
            $asis->s3 =$s3s[$i];
            $asis->s4 =$s4s[$i];
            $asis->s5 =$s5s[$i];
            $asis->s6 =$s6s[$i];
            $asis->s7 =$s7s[$i];
            $asis->s8 =$s8s[$i];
            // // // Guardar el registro en la base de datos
            $asis->save();
        }
        return redirect()->back()->with('mensaje','Asistencia guardada correctamente.');
    }
}
