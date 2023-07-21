<?php

namespace App\Http\Controllers;

use App\Models\Factura_Detalle;
use App\Models\Factura;
use App\Models\Material_Escolar;

use Illuminate\Http\Request;

class FacturaDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $factura = Factura::find($id);
        $factura_detalles = Factura_Detalle::where('factura_id', $id)->get();
        return view('factura_detalle.index', compact('factura_detalles', 'factura'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $factura = Factura::find($id);
        $materiales = Material_Escolar::all();
        return view('factura_detalle.create', compact('factura', 'materiales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $request->validate([
            'material_id' => 'required',
            'cantidad' => 'required|numeric|min:0',
            'precio' => 'required|numeric|min:0'
        ]);
        $factura_detalle = new Factura_Detalle([
            'factura_id' => $id,
            'material_id' => $request->get('material_id'),
            'cantidad' => $request->get('cantidad'),
            'precio_unitario' => $request->get('precio')
        ]);
        //Añadir la cantidad de material al stock
        $material = Material_Escolar::find($request->get('material_id'));
        $material->stock += $request->get('cantidad');
        $material->save();
        $factura_detalle->save();
        return redirect()->route('factura_detalle.index', $id)->with('success', 'Detalle de factura guardado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura_Detalle $factura_Detalle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,$detalle_id)
    {
        $factura = Factura::find($id);
        $factura_detalle = Factura_Detalle::find($detalle_id);
        $materiales = Material_Escolar::all();
        return view('factura_detalle.edit', compact('factura', 'factura_detalle', 'materiales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id,$detalle_id)
    {
        $request -> validate([
            'material_id' => 'required',
            'cantidad' => 'required|numeric|min:0',
            'precio' => 'required|numeric|min:0'
        ]);

        $factura_detalle = Factura_Detalle::find($detalle_id);
        //Restar la cantidad de material al stock
        $material_original = Material_Escolar::find($factura_detalle->material_id);
        $material_original->stock -= $factura_detalle->cantidad;
        $material_original->save();
        //Añadir la cantidad de material al stock
        $material = Material_Escolar::find($request->get('material_id'));
        $material->stock += $request->get('cantidad');
        $material->save();
        $factura_detalle->material_id = $request->get('material_id');
        $factura_detalle->cantidad = $request->get('cantidad');
        $factura_detalle->precio_unitario = $request->get('precio');
        $factura_detalle->save();
        return redirect()->route('factura_detalle.index', $id)->with('success', 'Detalle de factura actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,$detalle_id)
    {
        $factura_detalle = Factura_Detalle::find($detalle_id);
        //Restar la cantidad de material al stock
        $material = Material_Escolar::find($factura_detalle->material_id);
        $material->stock -= $factura_detalle->cantidad;
        $factura_detalle->delete();
        return redirect()->route('factura_detalle.index', $id)->with('success', 'Detalle de factura eliminado');
        
    }
}
