<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sancion;

class SancionController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:auxiliar|psicologo|Docente|admin')->only('index');
        $this->middleware('role:auxiliar|admin')->except('index');

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sanciones = Sancion::listarSanciones();

        return view('sancion.index', compact('sanciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sancion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nombre = $request->input("nombre");
        Sancion::crearSancion($nombre);
        return redirect()->route('sanciones.index');
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
        $sancion = Sancion::getSancion($id);
        return view('sancion.edit', compact('sancion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nombre = $request->input("nombre");
        Sancion::actualizarSancion($id, $nombre);
        return redirect()->route('sanciones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Sancion::eliminarSancion($id);
        return redirect()->route('sanciones.index');
    }
}
