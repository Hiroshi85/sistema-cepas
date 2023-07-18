<?php

namespace App\Http\Controllers;

use App\Models\Plaza;
use App\Models\Oferta;
use App\Models\Candidato;
use App\Models\Empleado;
use App\Models\EvaluacionCandidato;
use App\Models\Postulacion;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfertaController extends Controller
{

    use ValidatesRequests;
    public function rules()
    {
        return [
            'postulacion_id' => 'required|exists:postulaciones,id',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'descripcion' => 'required|string',
            'salario' => 'required|numeric|min:0',
            'beneficios' => 'nullable|array',
            'beneficios.*' => 'nullable|string',
        ];
    }
    public function rulesDecision()
    {
        return [
            'estado' => 'required|string|in:aceptada,rechazada',
        ];
    }

    public function messagesDecision()
    {
        return [
            'estado.required' => 'El Estado es obligatorio.',
            'estado.string' => 'El Estado debe ser una cadena de texto.',
            'estado.in' => 'El Estado debe ser aceptada o rechazada.',
        ];
    }

    public function messages()
    {
        return [
            'postulacion_id.required' => 'El campo Postulación es obligatorio.',
            'postulacion_id.exists' => 'La Postulación seleccionada no existe en el sistema.',
            'fecha_inicio.required' => 'El campo Fecha de Inicio es obligatorio.',
            'fecha_inicio.date' => 'El campo Fecha de Inicio debe ser una fecha válida.',
            'fecha_inicio.after_or_equal' => 'El campo Fecha de Inicio debe ser igual o posterior a la fecha actual.',
            'fecha_fin.required' => 'El campo Fecha Fin es obligatorio.',
            'fecha_fin.date' => 'El campo Fecha Fin debe ser una fecha válida.',
            'fecha_fin.after_or_equal' => 'El campo Fecha Fin debe ser igual o posterior a la Fecha de Inicio.',
            'descripcion.required' => 'El campo Descripción es obligatorio.',
            'descripcion.string' => 'El campo Descripción debe ser una cadena de texto.',
            'salario.required' => 'El campo Salario es obligatorio.',
            'salario.numeric' => 'El campo Salario debe ser numérico.',
            'salario.min' => 'El campo Salario debe ser igual o mayor que 0.',
            'beneficios.array' => 'El campo Beneficios debe ser una arreglo.',
            'beneficios.*.string' => 'El Beneficio debe ser una cadena de texto.',
        ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ofertas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ofertas.create', [
            'evaluaciones' => EvaluacionCandidato::obtenerFinalizadas()
        ]);
    }
    public function createForAPostulacion($id)
    {
        $postulacion = Postulacion::obtenerPostulacion($id);
        return view('ofertas.postulacion.create', compact('postulacion'));
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
        $oferta = Oferta::crearOferta($validator->validated());
        $oferta->postulacion->setEstadoAprobado();

        session()->flash('toast', [
            'message' => 'Oferta añadida correctamente',
            'type' => 'success',
        ]);

        return redirect()->route('ofertas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Oferta $oferta)
    {
        return view('ofertas.show', ['oferta' => $oferta]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Oferta $oferta)
    {
        // devolver solo las plazas cuya fecha de inicio ya haya pasado
        return view(
            'ofertas.edit',
            [
                'oferta' => $oferta,
                'candidatos' => Candidato::obtenerTodos(),
                'plazas' => Plaza::obtenerPlazasActivas()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Oferta $oferta)
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
        Oferta::actualizarOferta($oferta, $validator->validated());

        session()->flash('toast', [
            'message' => 'Oferta actualizada correctamente',
            'type' => 'success',
        ]);

        return redirect()->route('ofertas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oferta $oferta)
    {
        Oferta::eliminarOferta($oferta);
        session()->flash('toast', [
            'message' => 'Oferta eliminada correctamente',
            'type' => 'success',
        ]);

        return redirect()->route('ofertas.index');
    }

    public function decisionCandidato(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rulesDecision(), $this->messagesDecision());

        if ($validator->fails()) {

            foreach ($validator->errors()->all() as $error) {
                session()->flash('toast', [
                    'type' => 'error',
                    'message' => $error
                ]);
            }
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $oferta = Oferta::actualizarOferta($id, $validator->validated());
        if ($oferta->estado == 'aceptada') {
            // registrar empleado
            $candidato = $oferta->postulacion->candidato;
            $empleado = Empleado::crearEmpleado(
                [
                    'nombre' => $candidato->nombre,
                    'email' => $candidato->email,
                    'dni' => $candidato->dni,
                    'genero' => $candidato->genero,
                    'fecha_nacimiento' => $candidato->fecha_nacimiento,
                    'direccion' => $candidato->direccion,
                    'telefono' => $candidato->telefono,
                    'puesto_id' => $oferta->postulacion->plaza->puesto->id,
                    'esDocente' => $oferta->postulacion->plaza->puesto->esDocente(),
                ]
            );
            // crear usuario
            EmpleadoController::createUser($empleado);
            session()->flash('toast', [
                'message' => 'Oferta aceptada correctamente',
                'type' => 'success',
            ]);

            // cerrar plaza
            $oferta->postulacion->plaza->cerrar();
        } else {

            session()->flash('toast', [
                'message' => 'Oferta rechazada correctamente',
                'type' => 'success',
            ]);
        }

        return redirect()->route('ofertas.index');
    }
}
