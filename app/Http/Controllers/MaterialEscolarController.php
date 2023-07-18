<?php

namespace App\Http\Controllers;

use App\Models\Material_Escolar;
use Illuminate\Http\Request;

class MaterialEscolarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materiales = Material_Escolar::all();
        return view('material_escolar.index', compact('materiales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('material_escolar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);
        $material_Escolar = new Material_Escolar();
        $material_Escolar->nombre = $request->nombre;
        $material_Escolar->descripcion = $request->descripcion;
        $material_Escolar->stock = 0;
        $material_Escolar->save();
        return redirect()->route('material_escolar.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material_Escolar $material_Escolar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $material = Material_Escolar::findOrFail($id);
        return view('material_escolar.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);
        $material_Escolar = Material_Escolar::find($id);
        $material_Escolar->nombre = $request->nombre;
        $material_Escolar->descripcion = $request->descripcion;
        $material_Escolar->save();
        return redirect()->route('material_escolar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Material_Escolar::destroy($id);
        return redirect()->route('material_escolar.index');
    }
}
