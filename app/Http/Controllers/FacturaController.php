<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Proveedor;
use App\Models\Factura_Detalle;
use App\Models\Material_Escolar;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = Factura::all();
        return view('factura.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        return view('factura.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'fecha' => 'required',
            'proveedor' => 'required'
        ]);
        $factura = new Factura();
        $factura->fecha = $request->fecha;
        $factura->proveedor_id = $request->proveedor;
        $factura->save();
        return redirect()->route('factura.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        //Borrar los detalles
        $factura_detalles = Factura_Detalle::where('factura_id', $factura->factura_id)->get();
        foreach ($factura_detalles as $factura_detalle) {
            //Restar la cantidad de material escolar
            $material_escolar = Material_Escolar::find($factura_detalle->material_id);
            $material_escolar->stock -= $factura_detalle->cantidad;

            $factura_detalle->delete();

        }
        $factura->delete();
        return redirect()->route('factura.index');
        
    }
}
