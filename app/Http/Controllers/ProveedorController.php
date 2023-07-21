<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Factura;
use App\Models\Factura_Detalle;
use App\Models\Material_Escolar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedor.index', compact('proveedores'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            'correo' => 'required|email',
            'direccion' => 'required',
            'nombre' => 'required',
            'telefono' => 'required|numeric|digits:9',
            'dni' => 'required|numeric|digits:8|unique:proveedor,dni'
        ]);
        // guardar
        $proveedor = new Proveedor();
        $proveedor->correo = $request->correo;
        $proveedor->direccion = $request->direccion;
        $proveedor->nombre = $request->nombre;
        $proveedor->telefono = $request->telefono;
        $proveedor->dni = $request->dni;
        $proveedor->save();
        return redirect()->route('proveedor.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'correo' => 'email',
            'telefono' => 'numeric|digits:9',
            'dni' => 'numeric|digits:8|unique:proveedor,dni,'.$proveedor->proveedor_id.',proveedor_id'
            
        ]); 
        if ($request->has('nombre')) {
            $proveedor->nombre = $request->nombre;
        }
        if ($request->has('apellido')) {
            $proveedor->apellido = $request->apellido;
        }
        if ($request->has('direccion')) {
            $proveedor->direccion = $request->direccion;
        }
        if ($request->has('telefono')) {
            $proveedor->telefono = $request->telefono;
        }
        if ($request->has('email')) {
            $proveedor->email = $request->email;
        }
        $proveedor->save();
        return redirect()->route('proveedor.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        //borrar las facturas
        $facturas = Factura::where('proveedor_id', $proveedor->proveedor_id)->get();
        foreach ($facturas as $factura) {
            $factura_detalles = Factura_Detalle::where('factura_id', $factura->factura_id)->get();
            foreach ($factura_detalles as $factura_detalle) {
                $material_escolar = Material_Escolar::find($factura_detalle->material_id);
                $material_escolar->stock -= $factura_detalle->cantidad;
                $factura_detalle->delete();
            }
        }
        Factura::where('proveedor_id', $proveedor->proveedor_id)->delete();
        //borrar el proveedor 
        Proveedor::destroy($proveedor->proveedor_id);
        return redirect()->route('proveedor.index');
    }
}
