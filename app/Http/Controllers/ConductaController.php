<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conducta;

class ConductaController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        
        $this->middleware('role:auxiliar|psicologo')->only(['index']);
        $this->middleware('role:auxiliar')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $demeritos = Conducta::where('puntaje', '<', 0)->get();
        $meritos = Conducta::where('puntaje', '>', 0)->get();
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
        $puntos = $req->input('puntaje');
        if($puntos<-20) $puntos=-20;
        if($puntos>20) $puntos=20;
        Conducta::create([
            'nombre' => $req->input('nombre'),
            'puntaje' => $puntos,
        ]);
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
        $conducta = Conducta::find($id);
        return view('conducta.edit', ['conducta'=>$conducta]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $puntos = $req->input('puntaje');
        if($puntos<-20) $puntos=-20;
        if($puntos>20) $puntos=20;
        Conducta::where('id', $id)
        ->update([
            'nombre'=>$req->input('nombre'),
            'puntaje'=>$puntos,
        ]);
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
