<?php

namespace App\Http\Controllers\Rrhh;

use App\Http\Controllers\Controller;
use App\Models\Rrhh\Empleado;
use App\Models\Rrhh\Nomina;
use Illuminate\Http\Request;

class NominaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nominas = Nomina::orderBy('id', 'desc')->paginate(10);
        return view('rrhh.nominas.index', [
            'nominas' => $nominas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empleados = Empleado::obtenerEmpleadosVigentes();
        return view('rrhh.nominas.create'
            , [
                'empleados' => $empleados,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Nomina $nomina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nomina $nomina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nomina $nomina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nomina $nomina)
    {
        //
    }
}