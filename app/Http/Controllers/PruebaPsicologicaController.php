<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PruebaPsicologica;
use App\Models\TipoPrueba;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;

class PruebaPsicologicaController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('role:psicologo|admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pruebaps = PruebaPsicologica::with('psicologo')->with('tipo')->get();
        
        return view('pruebas.index', ['pruebas' => $pruebaps]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $psicologos = Empleado::select(['id', 'nombre'])->where('puesto_id', 24)->get();
        // $psicologos = Psicologo::get(['id', 'nombres', 'apellidos']);
        $tipos = TipoPrueba::all();
        return view('pruebas.create', ['psicologos' => $psicologos, 'tipos'=>$tipos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $pp = new PruebaPsicologica;
        $pp->nombre = $req->input("nombre");
        $pp->tipo_id = $req->input("tipo");
        $pp->edad_minima = $req->input("minima");
        $pp->edad_maxima = $req->input("maxima");
        $pp->psicologo_id = Auth::id();
        $pp->online_url = $req->input("p-online");
        if($req->hasFile('archivo')){
            $pp->file_url = $this->uploadFile($req);
        }
        // $pp->correo = $req->input("correo");

        $pp->save();
        return redirect()->route('pruebas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pp = PruebaPsicologica::find($id);
        $psicologos = Empleado::select(['id', 'nombre'])->where('puesto_id', 24)->get();
        $tipos = TipoPrueba::all();
        return view('pruebas.edit', ['prueba'=>$pp, 'psicologos' => $psicologos, 'tipos'=>$tipos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $pp = PruebaPsicologica::find($id);
        $pp->nombre = $req->input("nombre");
        $pp->tipo_id = $req->input("tipo");
        $pp->edad_minima = $req->input("minima");
        $pp->edad_maxima = $req->input("maxima");
        // $psico = Psicologo::where('user_id',Auth::id())->first();
        // $pp->psicologo_id = $psico->id;
        $pp->online_url = $req->input("p-online");
        if($req->hasFile('archivo')){
            $pp->file_url = $this->uploadFile($req);
        }
        $pp->save();
        return redirect()->route('pruebas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PruebaPsicologica::destroy($id);
        return redirect()->route('pruebas.index');
    }

    private function uploadFile(Request $req){
        $archivo = $req->file('archivo');
        $path = Storage::putFile('files', $archivo);
        error_log($path);
        return $path;
    }
}
