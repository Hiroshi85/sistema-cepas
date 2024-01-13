<?php

namespace App\Http\Controllers;

use App\Models\PruebaPsicologica;
use App\Models\Rrhh\Empleado;
use App\Models\TipoPrueba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $data= request()->validate([
            'nombre' => 'required',
            'tipo' => 'required|numeric|gt:0',
            'minima' => 'required|numeric|gte:10',
            'maxima' => 'required|numeric|gte:10',
        ],[
            'nombre.required' => 'Este campo es obligatorio',
            'minima.required' => 'Este campo es obligatorio',
            'tipo.required' => 'Este campo es obligatorio',
            'maxima.required' => 'Este campo es obligatorio',
        ]);

        $file_url=null;
        if($req->hasFile('archivo')){
            $file_url = $this->uploadFile($req);
        }
        $nombre = $req->input("nombre");
        $tipo_id = $req->input("tipo");
        $edad_minima = $req->input("minima");
        $edad_maxima = $req->input("maxima");
        $psicologo_id = Auth::id();
        $online_url = $req->input("p-online");
        PruebaPsicologica::crearPrueba($nombre, $tipo_id, $edad_minima, $edad_maxima, $psicologo_id, $online_url, $file_url);

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
        $pp = PruebaPsicologica::buscarPrueba($id);
        $psicologos = Empleado::select(['id', 'nombre'])->where('puesto_id', 24)->get();
        $tipos = TipoPrueba::listarTipoPrueba();
        return view('pruebas.edit', ['prueba'=>$pp, 'psicologos' => $psicologos, 'tipos'=>$tipos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $data= request()->validate([
            'nombre' => 'required',
            'tipo' => 'required|numeric|gt:0',
            'minima' => 'required|numeric|gte:10',
            'maxima' => 'required|numeric|gte:10',
        ],[
            'nombre.required' => 'Este campo es obligatorio',
            'minima.required' => 'Este campo es obligatorio',
            'tipo.required' => 'Este campo es obligatorio',
            'maxima.required' => 'Este campo es obligatorio',
        ]);

        $pp=PruebaPsicologica::buscarPrueba($id);

        $file_url=null;
        if($req->hasFile('archivo')){
            $file_url = $this->uploadFile($req);
        }
        if($file_url == null && $pp->file_url !=null){
            $file_url = $pp->file_url;
        }
        $nombre = $req->input("nombre");
        $tipo_id = $req->input("tipo");
        $edad_minima = $req->input("minima");
        $edad_maxima = $req->input("maxima");
        $online_url = $req->input("p-online");

        PruebaPsicologica::actualizarPrueba($id, $nombre, $tipo_id, $edad_minima, $edad_maxima, $online_url, $file_url);
        return redirect()->route('pruebas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PruebaPsicologica::eliminarPrueba($id);
        return redirect()->route('pruebas.index');
    }

    private function uploadFile(Request $req){
        $archivo = $req->file('archivo');
        $path = Storage::putFile('files', $archivo);
        error_log($path);
        return $path;
    }
}
