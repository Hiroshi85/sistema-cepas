<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conducta;
use App\Models\Comportamiento;
use App\Models\Alumno;
use Carbon\Carbon;

class ComportamientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:auxiliar|admin|Docente');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $alumnos = Alumno::where('eliminado', 0)->select('idalumno','nombre_apellidos')->get();
        $demeritos = Conducta::listarDemeritos();
        $meritos = Conducta::listarMeritos();;
        $today = Carbon::now()->format('Y-m-d');
        $enable = Carbon::now()->isWeekday();
        return view('comportamiento.index', ['meritos' => $meritos, 'demeritos'=> $demeritos, 'hoy'=>$today, 'enable'=>$enable]);
    }

    /**
     * Store
     */
    public function store(Request $req){
        $alumno = $req->input('alumno');
        $conducta = $req->input('asunto');
        $observacion=$req->input('observacion');
        $fecha=$req->input('fecha');
        $bimestre= $req->input('bimestre');
        Comportamiento::crearComportamiento($alumno, $conducta, $observacion, $fecha, $bimestre);

        return redirect()->route('comportamientos.index');
    }

    public function show(){
        return view('comportamiento.show');
    }

    /**
     * Delete
     */
    public function destroy(string $id){
        Comportamiento::destroy($id);
        return ["message"=>"ok"];
    }

    public function getByAlumno(Request $req, string $id){
        // $alumno = Alumno::find($id);
        $nota = 20;
        $bimestre = $req->query('bimestre');
        $comportamientos = Comportamiento::listarComportamientoDeAlumnoPorBimestre($id, $bimestre);
        error_log($comportamientos);
        foreach($comportamientos as $it){
            $nota += $it['puntaje'];
        }
        if($nota > 20) $nota=20;
        if($nota < 0) $nota=0;
        return ['comportamientos'=>$comportamientos, 'nota'=>$nota];
    }
}
