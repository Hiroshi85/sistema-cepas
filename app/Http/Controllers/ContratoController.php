<?php

namespace App\Http\Controllers;

use App\Models\Plaza;
use App\Models\Contrato;
use App\Models\Candidato;
use App\Models\Empleado;
use App\Models\EvaluacionCandidato;
use App\Models\Oferta;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContratoController extends Controller
{

    use ValidatesRequests;
    public function rules()
    {
        return [
            'tipo_contrato' => 'required|string|max:255',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'descripcion' => 'nullable|string',
            'remuneracion' => 'required|numeric|min:0',
            'empleado_id' => 'required|exists:empleados,id',
        ];
    }

    public function messages()
    {
        return [
            'tipo_contrato.required' => 'El tipo de contrato es obligatorio.',
            'tipo_contrato.string' => 'El tipo de contrato debe ser un texto.',
            'tipo_contrato.max' => 'El tipo de contrato no debe exceder los :max caracteres.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser igual o posterior a la fecha actual.',
            'fecha_fin.required' => 'La fecha de fin es obligatoria.',
            'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'descripcion.string' => 'La descripción debe ser un texto.',
            'remuneracion.required' => 'La remuneración es obligatoria.',
            'remuneracion.numeric' => 'La remuneración debe ser un valor numérico.',
            'remuneracion.min' => 'La remuneración no debe ser inferior a :min.',
            'empleado_id.required' => 'El ID del empleado es obligatorio.',
            'empleado_id.exists' => 'El ID del empleado seleccionado no existe en la tabla "empleados".',
        ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contratos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contratos.create', [
            'empleados' => Empleado::obtenerEmpleadosSinContrato()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        date_default_timezone_set('America/Lima');

        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        if ($validator->fails()) {

            foreach ($validator->errors()->all() as $error) {
                session()->flash('toast', [
                    'type' => 'error',
                    'message' => $error
                ]);
            }
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        Contrato::crearContrato($validator->validated());

        session()->flash('toast', [
            'message' => 'Contrato creado correctamente',
            'type' => 'success',
        ]);

        return redirect()->route('contratos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contrato $contrato)
    {
        return view('contratos.show', ['contrato' => $contrato]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrato $contrato)
    {
        // devolver solo las plazas cuya fecha de inicio ya haya pasado
        return view(
            'contratos.edit',
            [
                'contrato' => $contrato,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contrato $contrato)
    {
        date_default_timezone_set('America/Lima');
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        if ($validator->fails()) {

            foreach ($validator->errors()->all() as $error) {
                session()->flash('toast', [
                    'type' => 'error',
                    'message' => $error
                ]);
            }
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        Contrato::actualizarContrato($contrato, $validator->validated());

        session()->flash('toast', [
            'message' => 'Contrato actualizado correctamente',
            'type' => 'success',
        ]);

        return redirect()->route('contratos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrato $contrato)
    {
        Contrato::eliminarContrato($contrato);
        session()->flash('toast', [
            'message' => 'Contrato eliminado correctamente',
            'type' => 'success',
        ]);

        return redirect()->route('contratos.index');
    }
}
