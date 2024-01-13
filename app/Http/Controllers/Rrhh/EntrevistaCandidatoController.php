<?php

namespace App\Http\Controllers\Rrhh;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\EntrevistaCandidato;
use App\Models\EvaluacionCandidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EntrevistaCandidatoController extends Controller
{
    public function rules()
    {
        return [
            'evaluacion_id' => 'required|exists:rrhh_evaluaciones,id',
            'fecha' => 'required|date',
            'hora' => 'required',
            'estado' => 'in:pendiente', 'aprobada', 'reprobada',
            'observaciones' => 'nullable|string',
            'entrevistador_id' => 'required|exists:empleados,id',
        ];
    }
    public function rulesFinalizar()
    {
        return [
            'estado' => 'in:aprobada', 'reprobada',
            'observaciones' => 'present|required|string',
        ];
    }

    public function messagesFinalizar()
    {
        return [
            'estado.required' => 'El campo Estado es obligatorio.',
            'estado.in' => 'El campo Estado debe ser uno de los siguientes valores: aprobada, reprobada.',
            'observaciones.string' => 'El campo Observaciones debe ser una cadena de texto.',
            'observaciones.required' => 'El campo Observaciones es obligatorio.',
            'observaciones.present' => 'El campo Observaciones es obligatorio.'
        ];
    }
    public function messages()
    {
        return [
            'evaluacion_id.required' => 'El campo Evaluación es obligatorio.',
            'evaluacion_id.exists' => 'La Evaluación seleccionada no existe en el sistema.',
            'fecha.required' => 'El campo Fecha es obligatorio.',
            'fecha.date' => 'El campo Fecha debe ser una fecha válida.',
            'hora.required' => 'El campo Hora es obligatorio.',
            'estado.in' => 'El campo Estado debe ser uno de los siguientes valores: pendiente, aprobada, reprobada.',
            'observaciones.string' => 'El campo Observaciones debe ser una cadena de texto.',
            'entrevistador_id.required' => 'El campo Entrevistador es obligatorio.',
            'entrevistador_id.exists' => 'El Entrevistador seleccionado no existe en el sistema.',
        ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('entrevistas-candidato.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $evaluaciones = EvaluacionCandidato::obtenerTodos();
        $entrevistadores = Empleado::obtenerEncargadosDeEvaluacion();
        return view('entrevistas-candidato.create', compact('evaluaciones', 'entrevistadores'));
    }
    public function createForAEvaluacion(EvaluacionCandidato $evaluacion)
    {
        $entrevistadores = Empleado::obtenerEncargadosDeEvaluacion();
        return view('entrevistas-candidato.evaluacion.create', compact('evaluacion', 'entrevistadores'));
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

        $entre = EntrevistaCandidato::crearEntrevista($validator->validated());

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Entrevista registrada correctamente.'
        ]);

        return redirect()->route('rrhh.entrevistas.show', $entre->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view(
            'entrevistas-candidato.show',
            [
                'entrevista' => EntrevistaCandidato::obtenerEntrevista($id),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view(
            'entrevistas-candidato.edit',
            [
                'entrevista' => EntrevistaCandidato::obtenerEntrevista($id),
                'entrevistadores' => Empleado::obtenerEncargadosDeEvaluacion(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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

        EntrevistaCandidato::actualizarEntrevista($id, $validator->validated());
        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Entrevista actualizada correctamente.'
        ]);

        return redirect()->route('rrhh.entrevistas.index');
    }


    public function finalizarEntrevista(Request $request, $id)
    {
        $validated = $request->validate($this->rulesFinalizar(), $this->messagesFinalizar());

        EntrevistaCandidato::actualizarEntrevista($id, $validated);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Entrevista finalizada correctamente.'
        ]);
        session()->flash('finalizarEntrevista');

        return redirect()->route('rrhh.entrevistas.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        EntrevistaCandidato::eliminarEntrevista($id);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Entrevista eliminada correctamente.'
        ]);

        return redirect()->route('rrhh.entrevistas.index');
    }
}
