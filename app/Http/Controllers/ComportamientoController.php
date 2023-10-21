<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conducta;
use App\Models\Comportamiento;
use App\Models\Alumno;
use App\Models\Sancion;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ComportamientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:auxiliar|admin|Docente')->except(['generarReporteBimestral']);
        $this->middleware('role:auxiliar|admin')->only(['generarReporteBimestral']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $alumnos = Alumno::where('eliminado', 0)->select('idalumno','nombre_apellidos')->get();
        $demeritos = Conducta::listarDemeritos();
        $meritos = Conducta::listarMeritos();
        $sanciones = Sancion::listarSanciones();
        $today = Carbon::now()->format('Y-m-d');
        $enable = Carbon::now()->isWeekday();
        return view('comportamiento.index', ['meritos' => $meritos, 'demeritos'=> $demeritos, 'hoy'=>$today, 'sanciones' => $sanciones,'enable'=>$enable]);
    }

    /**
     * Store
     */
    public function store(Request $req){
        $alumno = $req->input('alumno');
        $conducta = $req->input('asunto');
        $observacion=$req->input('observacion');
        $sancion=$req->input('sancion') == 0 ? null : $req->input('sancion');
        $fecha=$req->input('fecha');
        $bimestre= $req->input('bimestre');
        Comportamiento::crearComportamiento($alumno, $conducta, $observacion, $fecha, $bimestre, $sancion);

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

    public function buscarAlumno(Request $req){
        $nom_alumno = $req->query('alumno');
        $alumnos = Alumno::buscarAlumnoPorString($nom_alumno);
        error_log($alumnos);
        return ['alumnos' => $alumnos];
    }

    public function generarReporteBimestral(Request $req, string $id){
        $conglomerado = $this->getByAlumno($req, $id);
        $bimestre = $req->query('bimestre');
        $comportamientos = $conglomerado['comportamientos'];
        $nota = $conglomerado['nota'];
        $alumno = Alumno::getAlumnoById($id);
        $auxiliar = Auth::user()->name;

        $pdf = Pdf::loadView('comportamiento.pdf.bimestral', compact('comportamientos', 'nota', 'alumno', 'auxiliar', 'bimestre'));
        $nombre_archivo = $alumno->nombre_apellidos.' - B'.$bimestre.'.pdf';
        return $pdf->stream($nombre_archivo);
    }

    public function generarReporteAnual(string $id){
        $comportamientosAnual = Comportamiento::listarComportamientoDeAlumnoAnual($id);
        $comportamientosAnual = $comportamientosAnual->jsonserialize();
        foreach ($comportamientosAnual as &$bimestre) {
            $nota = 20;
            $resultados = $bimestre['resultados'];
            $sumaPuntaje = $bimestre['sumaPuntaje'];
            $nota += $sumaPuntaje;
            if($nota > 20) $nota=20;
            if($nota < 0) $nota=0;
            $bimestre['nota'] = $nota;
        }
        unset($bimestre);
        $alumno = Alumno::getAlumnoById($id);
        $auxiliar = Auth::user()->name;
        $pdf = Pdf::loadView('comportamiento.pdf.anual', compact('comportamientosAnual', 'alumno', 'auxiliar'));
        $nombre_archivo = $alumno->nombre_apellidos.' - Anual.pdf';
        return $pdf->stream($nombre_archivo);
    }
}
