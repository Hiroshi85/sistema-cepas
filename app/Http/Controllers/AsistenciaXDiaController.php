<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Alumno;
use App\Models\AsistenciaXDia;
use App\Models\TipoAsistencia;

class AsistenciaXDiaController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('role:auxiliar|admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::select('idalumno')->get();
        $today = Carbon::now()->format('d-m-Y');
        $today_f = Carbon::now()->format('Y-m-d');
        $day = now()->dayName;
        $enable = Carbon::now()->isWeekday();
        $num = AsistenciaXDia::obtenerNumeroAsistenciaHoy();
        if($num <= 0 && $enable){
            foreach($alumnos as $it){
                try {
                    AsistenciaXDia::crearAsistencia($today_f, $it->idalumno, 2);
                } catch (\Throwable $th) {
                    //throw $th;
                }

            }
        }
        return view('asistenciaxdia.index', ['today'=>$today, 'day'=>$day, 'enable'=>$enable]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = Carbon::now()->format('Y-m-d');
        return view('asistenciaxdia.edit', ['today'=>$today]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $data= request()->validate([
            'tipo' => 'required|numeric|gt:0',
            'alumno' => 'required|numeric|gt:0',
        ],[
            'alumno.required' => 'Este campo es obligatorio',
            'tipo.required' => 'Este campo es obligatorio',
        ]);

        $tipo = $req->input('tipo');
        $alumno_id = $req->input('alumno');

        AsistenciaXDia::marcarAsistenciaHoy($alumno_id, $tipo);

        return redirect()->route('asistenciaxdias.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $data= request()->validate([
            'tipo' => 'required|numeric|gt:0',
        ],[
            'tipo.required' => 'Este campo es obligatorio',
        ]);

        $tipo = $req->input('tipo');
        AsistenciaXDia::editarAsistencia($id, $tipo);

        return redirect()->route('asistenciaxdias.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
