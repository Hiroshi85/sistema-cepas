<?php

namespace App\Http\Controllers\AdmisionMatriculas;

use App\Http\Controllers\Controller;
use App\Models\Admision;
use Illuminate\Http\Request;

class AdmisionController extends Controller
{
    private function validateAdmision(Request $request)
    {
        $year = date('Y');
        $startDate = "{$year}-01-01";
        $endDate = "{$year}-12-31";

        return [
            'fecha_apertura' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($year, $startDate, $endDate) {
                    if ($value < $startDate || $value > $endDate) {
                        $fail("La fecha de apertura debe estar dentro del rango del año actual ({$year}).");
                    }
                },
            ],
            'fecha_cierre' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request, $year, $startDate, $endDate) {
                    if ($value < $startDate || $value > $endDate) {
                        $fail("La fecha de cierre debe estar dentro del rango del año actual ({$year}).");
                    }

                    $fechaApertura = $request->input('fecha_apertura');
                    if ($value < $fechaApertura) {
                        $fail("La fecha de cierre no puede ser menor a la fecha de apertura.");
                    }
                },
            ],
            'tarifa' => 'required',
            'estado' => 'required',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validateAdmision($request));
        $admision = new Admision();
       
        $admision->fecha_cierre = $request->get('fecha_cierre');
        $admision->fecha_apertura = $request->get('fecha_apertura');
        $admision->año = date('Y', strtotime($request->get('fecha_apertura')));
        $admision->tarifa = $request->get('tarifa');
        $admision->estado = $request->get('estado');
        $admision->save();

        return redirect()->back()->with('datos','created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admision $admision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admision $admision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idadmision)
    {
        //
        $data = $request->validate($this->validateAdmision($request));
        $admision = Admision::findOrFail($idadmision);
       
        $admision->fecha_cierre = $request->get('fecha_cierre');
        $admision->fecha_apertura = $request->get('fecha_apertura');
        $admision->año = date('Y', strtotime($request->get('fecha_apertura')));
        $admision->tarifa = $request->get('tarifa');
        $admision->estado = $request->get('estado');
        $admision->save();

        return redirect()->back()->with('datos','updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admision $admision)
    {
        //
    }
}
