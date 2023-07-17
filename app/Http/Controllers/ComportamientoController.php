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
        $this->middleware('role:auxiliar');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $alumnos = Alumno::where('eliminado', 0)->select('idalumno','nombre_apellidos')->get();
        $demeritos = Conducta::where('puntaje', '<', 0)->get();
        $meritos = Conducta::where('puntaje', '>', 0)->get();
        $today = Carbon::now()->format('Y-m-d');
        $enable = Carbon::now()->isWeekday();
        return view('comportamiento.index', ['meritos' => $meritos, 'demeritos'=> $demeritos, 'hoy'=>$today, 'alumnos'=>$alumnos, 'enable'=>$enable]);
    }

    /**
     * Store
     */
    public function store(Request $req){
        Comportamiento::create([
            'alumno_id'=>$req->input('alumno'),
            'conducta_id'=>$req->input('asunto'),
            'observacion'=>$req->input('observacion'),
            'fecha'=>$req->input('fecha'),
            'bimestre'=>$req->input('bimestre'),
        ]);

        return redirect()->route('comportamientos.index');
    }

    public function show(){
        // $alumnos = Alumno::select('nombres', 'apellidos', 'id')->get();
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
        $comportamientos = $this->showComportamientoPorBimestre($id, $req->query('bimestre'));
        error_log($comportamientos);
        foreach($comportamientos as $it){
            $nota += $it['puntaje'];
        }
        if($nota > 20) $nota=20;
        if($nota < 0) $nota=0;
        return ['comportamientos'=>$comportamientos, 'nota'=>$nota];
    }

    private function showComportamientoPorBimestre(string $id, string $bimestre){
        $comportamientos = Comportamiento::join('alumnos', 'alumno_conducta.alumno_id', '=', 'alumnos.idalumno')
        ->join('conducta', 'alumno_conducta.conducta_id', '=', 'conducta.id')
        ->where('alumnos.idalumno', $id)
        ->where('alumno_conducta.bimestre', $bimestre)
        ->select('alumno_conducta.*','conducta.puntaje', 'conducta.nombre')
        ->get();
        return $comportamientos;
    }
}
