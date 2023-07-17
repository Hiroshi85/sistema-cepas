<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionCandidato;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EvaluacionCandidatoController extends Controller
{

    private function rules()
    {
        return [
            'postulacion_id' => 'required|exists:postulaciones,id',
            'experiencia_laboral' => 'required|numeric|min:0|max:50',
            'educacion' => 'array|present',
            'educacion.*' => 'required|string|max:25',
            'habilidades' => 'array|present',
            'habilidades.*' => 'required|string|max:25',
            'conocimiento_materias' => 'array|nullable',
            'conocimiento_materias.*' => 'string|max:25',
        ];
    }

    private function messages()
    {
        return [
            'postulacion_id.required' => 'El campo Postulación es obligatorio.',
            'postulacion_id.exists' => 'La Postulación seleccionada no es válida.',

            'experiencia_laboral.required' => 'El campo Años de Experiencia Laboral es obligatorio.',
            'experiencia_laboral.numeric' => 'El campo Años de Experiencia Laboral debe ser numérico.',
            'experiencia_laboral.min' => 'El campo Años de Experiencia Laboral debe ser mayor o igual a 0.',
            'experiencia_laboral.max' => 'El campo Años de Experiencia Laboral debe ser menor o igual a 50.',

            'educacion.array' => 'El campo Estudios debe ser un arreglo.',
            'educacion.present' => 'El campo Estudios es obligatorio.',
            'educacion.*.required' => 'El campo Estudios es obligatorio para todos los elementos.',
            'educacion.*.string' => 'El campo Estudios debe ser una cadena de caracteres.',
            'educacion.*.max' => 'El campo Estudios debe tener como máximo 25 caracteres.',

            'habilidades.array' => 'El campo Habilidades debe ser un arreglo.',
            'habilidades.present' => 'El campo Habilidades es obligotorio.',
            'habilidades.*.required' => 'El campo Habilidades es obligatorio para todos los elementos.',
            'habilidades.*.string' => 'El campo Habilidades debe ser una cadena de caracteres.',
            'habilidades.*.max' => 'El campo Habilidades debe tener como máximo 25 caracteres.',

            'conocimiento_materias.array' => 'El campo Materias que domina debe ser un arreglo.',
            'conocimiento_materias.*.required' => 'El campo Materias que domina es obligatorio para todos los elementos.',
            'conocimiento_materias.*.string' => 'El campo Materias que domina debe ser una cadena de caracteres.',
            'conocimiento_materias.*.max' => 'El campo Materias que domina debe tener como máximo 25 caracteres.',
        ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('evaluaciones-candidato.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $postulaciones = Postulacion::obtenerTodos();
        return view('evaluaciones-candidato.create', compact('postulaciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

        $evaluacion = EvaluacionCandidato::crearEvaluacion($validator->validated());

        $evaluacion->postulacion->setEstadoEnRevision();
        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Evaluación registrada correctamente.'
        ]);

        return redirect()->route('rrhh.evaluaciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluacionCandidato $evaluacionCandidato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EvaluacionCandidato $evaluacionCandidato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EvaluacionCandidato $evaluacionCandidato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        EvaluacionCandidato::eliminarEvaluacion($id);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Evaluación eliminada correctamente.'
        ]);

        return redirect()->route('rrhh.evaluaciones.index');
    }
}
