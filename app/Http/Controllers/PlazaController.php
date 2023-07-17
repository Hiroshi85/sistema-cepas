<?php

namespace App\Http\Controllers;

use App\Models\Plaza;
use App\Models\Puesto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlazaController extends Controller
{

    protected function rules()
    {
        return [
            'puesto_id' => 'required|exists:puestos,id',
            'fecha_inicio' => [
                'required',
                'date',
                'before_or_equal:fecha_fin',
                'after_or_equal:today'
            ],
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ];
    }
    protected function rulesOnUpdate()
    {
        return [
            'puesto_id' => 'required|exists:puestos,id',
            'fecha_inicio' => [
                'required',
                'date',
                'before_or_equal:fecha_fin',
            ],
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ];
    }



    protected function messages()
    {
        return [
            'puesto_id.required' => 'El puesto es requerido',
            'puesto_id.exists' => 'El puesto no existe',
            'fecha_inicio.required' => 'La fecha de inicio es requerida',
            'fecha_inicio.date' => 'La fecha de inicio no es válida',
            'fecha_inicio.unique' => 'Ya existe una plaza con el mismo puesto y fecha de inicio',
            'fecha_inicio.before_or_equal' => 'La fecha de inicio debe ser menor o igual a la fecha de fin',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser mayor o igual a la fecha actual',
            'fecha_fin.required' => 'La fecha de fin es requerida',
            'fecha_fin.date' => 'La fecha de fin no es válida',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser mayor o igual a la fecha de inicio',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('plazas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plazas.create', [
            'puestos' => Puesto::obtenerTodos(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        date_default_timezone_set('America/Lima');
        $data = $this->validate($request, $this->rules(), $this->messages());

        if (Plaza::existeUnaPlazaConElMismoPuestoYPlazo($data)) {
            session()->flash(
                'toast',
                [
                    'type' => 'error',
                    'message' => 'Ya existe una plaza con el mismo puesto y en el plazo de tiempo indicado.'
                ]
            );
            return redirect()->route('plazas.create')->withInput();
        }

        Plaza::crearPlaza($data);

        session()->flash(
            'toast',
            [
                'type' => 'success',
                'message' => 'La plaza fue creada correctamente.'
            ]
        );

        return redirect()->route('plazas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plaza $plaza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plaza $plaza)
    {
        return view('plazas.edit', [
            'plaza' => $plaza,
            'puestos' => Puesto::orderBy('nombre')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plaza $plaza)
    {
        date_default_timezone_set('America/Lima');

        $data = $this->validate($request, $this->rulesOnUpdate(), $this->messages());


        // verificar que no exista una plaza con el mismo puesto y en el plazo de tiempo indicado (excepto la plaza actual)

        if (Plaza::existeUnaPlazaConElMismoPuestoYPlazo(
            $data,
            $plaza->id
        )) {
            session()->flash(
                'toast',
                [
                    'type' => 'error',
                    'message' => 'Ya existe una plaza con el mismo puesto y en el plazo de tiempo indicado.'
                ]
            );

            return redirect()->route('plazas.edit', $plaza)->withInput();
        }

        Plaza::actualizarPlaza($plaza, $data);

        session()->flash(
            'toast',
            [
                'type' => 'success',
                'message' => 'La plaza fue actualizada correctamente.'
            ]
        );

        return redirect()->route('plazas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plaza $plaza)
    {
        Plaza::eliminarPlaza($plaza);

        session()->flash(
            'toast',
            [
                'type' => 'success',
                'message' => 'La plaza fue eliminada correctamente.'
            ]
        );

        return redirect()->route('plazas.index');
    }
}
