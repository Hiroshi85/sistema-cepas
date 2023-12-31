<?php

namespace App\Http\Controllers\AdmisionMatriculas;

use App\Http\Controllers\Controller;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class MatriculaController extends Controller
{
    private function validateMatricula(Request $request)
    {
        //$year = date('Y');
       // $startDate = "{$year}-01-01";
       // $endDate = "{$year}-12-31";

        return [
            'fecha_apertura' => [
                'required',
                'date',
                // function ($attribute, $value, $fail) use ($year, $startDate, $endDate) {
                //     if ($value < $startDate || $value > $endDate) {
                //         $fail("La fecha de apertura debe estar dentro del rango del año actual ({$year}).");
                //     }
                // },
            ],
            'fecha_cierre' => [
                'required',
                'date',
                // function ($attribute, $value, $fail) use ($request, $startDate, $endDate) {
                function ($attribute, $value, $fail) use ($request) {
                    // if ($value < $startDate || $value > $endDate) {
                    //     $fail("La fecha de cierre debe estar dentro del rango del año actual ({$year}).");
                    // }
                    $fechaApertura = $request->input('fecha_apertura');
                    if ($value < $fechaApertura) {
                        $fail("La fecha de cierre no puede ser menor a la fecha de apertura.");
                    }
                },
            ],
            'tarifa' => 'required|numeric|min:0', //floating numbers
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
        try {
            $data = $request->validate($this->validateMatricula($request));
        }catch(ValidationException $e){
            $this->returnErrorToast($e);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        $matriculaAnterior = Matricula::where('eliminado', 0)->orderBy('idmatricula', 'desc')->first();
        
        $matricula = new Matricula();
        
        $matricula->fecha_cierre = $request->fecha_cierre;
        $matricula->fecha_apertura = $request->fecha_apertura;
        $matricula->año = date('Y', strtotime($request->fecha_apertura));
        $matricula->tarifa = $request->tarifa;
        $matricula->estado = $request->estado;
        $matricula->total_alumnos = $matriculaAnterior != null ? $matriculaAnterior->total_alumnos : 0;
        $matricula->save();
    
        return redirect()->back()->with('datos', 'created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Matricula $matricula)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matricula $matricula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idmatricula)
    {
        try{
            $data = $request->validate($this->validateMatricula($request));
        }catch(ValidationException $e){
            $this->returnErrorToast($e);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        $matricula = Matricula::findOrFail($idmatricula);
       
        $matricula->fecha_cierre = $request->get('fecha_cierre');
        $matricula->fecha_apertura = $request->get('fecha_apertura');
        $matricula->año = date('Y', strtotime($request->fecha_apertura));
        $matricula->tarifa = $request->get('tarifa');
        $matricula->estado = $request->get('estado');
        $matricula->save();

        return redirect()->back()->with('datos','updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matricula $matricula)
    {
        //
    }

    private function returnErrorToast($e){
        session()->flash(
            'toast',
            [
                'message' => $e->getMessage(),
                'type' => 'error',
            ]
        );
    }
}
