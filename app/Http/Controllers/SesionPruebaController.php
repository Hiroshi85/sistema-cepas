<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesionPrueba;
use App\Models\Empleado;
use App\Models\PruebaPsicologica;
use App\Models\Aula;
use App\Models\Alumno;
use App\Models\ResultadoPrueba;
use App\Models\EstadoPrueba;
use Illuminate\Support\Facades\Auth;

class SesionPruebaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:psicologo|admin');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sesiones = SesionPrueba::listarSesiones();
        return view('sesiones.index', ['sesiones' => $sesiones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $psicologos = Empleado::where('puesto_id', '=', '24')->get();
        $pruebas = PruebaPsicologica::all();
        $aulas = Aula::all();

        return view('sesiones.create', ['pruebas' => $pruebas, 'aulas' => $aulas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $prueba_id = $req->prueba;
        $psicologo_id = Auth::id();
        $aula_id = $req->aula;

        $sesion = SesionPrueba::crearSesion($psicologo_id, $prueba_id, $aula_id);
        $alumnos = Alumno::select('idalumno')->where('idaula', $aula_id)->get();

        foreach($alumnos as $alumno){
            ResultadoPrueba::crearResultado($sesion->id, $alumno->idalumno);
        }

        return redirect()->route('sesiones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resultados = ResultadoPrueba::listarResultadosDeSesion($id);
        $sesion = SesionPrueba::obtenerSesion($id);
        error_log($resultados);
        // error_log($sesion);
        return view('sesiones.show', ['resultados' => $resultados, 'sesion' => $sesion]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $sesion = SesionPrueba::buscarSesion($id);
        $pruebas = PruebaPsicologica::all();

        return view('sesiones.edit', ['pruebas' => $pruebas, 'sesion' => $sesion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $sesion = SesionPrueba::buscarSesion($id);
        if($sesion->psicologo_id != Auth::id()){
            return redirect()->route('sesiones.index');
        }
        if(isset($req->completado)){
            $req->completado = 1;
        } else {
            $req->completado = 0;
        }

        SesionPrueba::actualizarSesion($id, $req->completado, $sesion->psicologo_id, $req->prueba);
        return redirect()->route('sesiones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SesionPrueba::eliminarSesion($id);
        return redirect()->route('sesiones.index');
    }

    public function evaluar(string $id, string $alumno_id){
        $resultado = ResultadoPrueba::obtenerResultado($id, $alumno_id);
    }
}
