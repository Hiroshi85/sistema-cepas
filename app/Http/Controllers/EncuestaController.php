<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuesta;
use App\Models\Aula;
use Illuminate\Support\Facades\DB;
use App\Models\CursoAsignado;

class EncuestaController extends Controller
{
    //
    public function index(Request $request)
    {
        $idaula = $request->input('idaula');
        //dd($idaula);
        $cursosQuery = CursoAsignado::where('estado', '=', 1);
    
        // Aplicar filtro por idaula solo si $idaula tiene un valor
        if ($idaula) {
            $cursosQuery->where('idaula', '=', $idaula);
        }
    
        $cursos = $cursosQuery->get();
        $idaula = $request->input('idaula');
        $encuestas = Encuesta::all();
        $aulas = Aula::all();
        return view('encuesta.index', ['encuestas' => $encuestas,'cursos' => $cursos,'aulas' => $aulas]);
    }

    public function resultadosporcurso($id){
        $encuestas = Encuesta::where('idcurso', '=', $id)->where('estado','=',1)->get();
        $respondidas = $encuestas->count();
        $total = Encuesta::all()->count();
        return view('encuesta.resultadosporcurso', ['encuestas'=> $encuestas,'total' => $total, 'respondidas',$respondidas]);
    }

    public function crearEncuestas()
    {
        // Ejecutar el procedimiento almacenado
        DB::select('CALL registrar_encuestas()');

        $cursos = CursoAsignado::where('estado', '=', 1)->get();
        $aulas = Aula::all();
        // Puedes agregar lógica adicional o redireccionar a una vista con datos
        return redirect()->route('procesoEncuestas')->with('cursos',$cursos)->with('aulas',$aulas)->with('mensaje', 'Iniciado correctamente');
    }

    public function verMisEncuestas($id){
        $encuestas = Encuesta::where('idalumno', '=', $id)->get();
        return view('encuesta.misencuestas',compact('encuestas'));
    }

    public function accederEncuesta($id){
        $e = Encuesta::findOrFail($id);
        return view('encuesta.verencuesta',compact('e'));
    }

    public function update(Request $request,$id){
        $e = Encuesta::findOrFail($id);

        $e->fecha = date('Y-m-d');
        $e->estado = 1;
        $e->resultados = $request->p1.$request->p2.$request->p3.$request->p4.$request->p5.$request->p6.$request->p7.$request->p8.$request->p9.$request->p10;
        $e->save();
        //return Redirect::Back();
        return redirect()->route('vermisEncuestas', ['id' => '1'])->with('mensaje', 'La encuesta fue completada con exito');
    }
}
