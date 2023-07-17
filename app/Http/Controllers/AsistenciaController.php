<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Alumno;
use App\Models\Asistencia;
use App\Models\TipoAsistencia;

class AsistenciaController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('role:auxiliar');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now()->format('d-m-Y');
        $today_f = Carbon::now()->format('Y-m-d');
        $day = now()->dayName;
        $enable = Carbon::now()->isWeekday();
        $num = Asistencia::whereDate('fecha', Carbon::today())->with('tipo')->get()->count();
        if($num <= 0 && $enable){
            foreach($alumnos as $it){
                Asistencia::create([
                    'fecha' => $today_f,
                    'alumno_id' => $it->id,
                    'tipo_id' => 2,
                ]);
            }
        }
        return view('asistencia.index', ['today'=>$today, 'day'=>$day, 'enable'=>$enable]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = Carbon::now()->format('Y-m-d');
        error_log("estoy aqui");
        return view('asistencia.edit', ['today'=>$today]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $tipo = $req->input('tipo');
        
        Asistencia::where('alumno_id',$req->input("alumno"))
                    ->where('fecha', Carbon::parse($req->input("fecha"))->format('Y-m-d'))
                    ->update(['tipo_id'=>$tipo]);
        
        return redirect()->route('asistencias.index');
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
        $tipo = $req->input('tipo');
        
        $as = Asistencia::find($id);
        $as->tipo_id=$tipo;
        $as->save();
        
        return redirect()->route('asistencias.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
