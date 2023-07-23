<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conducta;

class ConductaController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        
        $this->middleware('role:auxiliar|psicologo|admin')->only(['index']);
        $this->middleware('role:auxiliar|admin')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $demeritos = Conducta::listarDemeritos();
        $meritos = Conducta::listarMeritos();
        return view('conducta.index', ['meritos' => $meritos, 'demeritos'=> $demeritos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('conducta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $data= request()->validate([
            'puntaje' => 'required|numeric',
            'nombre' => 'required|max:255',
        ],[
            'nombre.required' => 'Este campo es obligatorio',
            'puntaje.required' => 'Este campo es obligatorio',
            'nombre.max' => 'Se ha excedido el número máximo de caracteres',
        ]);
        $puntos = $req->input('puntaje');
        $nombres = $req->input('nombre');

        Conducta::crearConducta($nombres, $puntos);

        return redirect()->route('conductas.index');
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
        $conducta = Conducta::obtenerConducta($id);
        return view('conducta.edit', ['conducta'=>$conducta]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $data= request()->validate([
            'puntaje' => 'required|numeric',
            'nombre' => 'required|max:255',
        ],[
            'nombre.required' => 'Este campo es obligatorio',
            'puntaje.required' => 'Este campo es obligatorio',
            'nombre.max' => 'Se ha excedido el número máximo de caracteres',
        ]);
        $puntos = $req->input('puntaje');
        $nombres = $req->input('nombre');
        Conducta::actualizarConducta($id, $nombres, $puntos);
        return redirect()->route('conductas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Conducta::destroy($id);
        return redirect()->route('conductas.index');
    }
}
