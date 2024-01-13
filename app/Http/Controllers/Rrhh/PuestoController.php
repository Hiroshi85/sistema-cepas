<?php

namespace App\Http\Controllers\Rrhh;

use App\Http\Controllers\Controller;
use App\Models\Rrhh\Equipo;
use App\Models\Rrhh\Puesto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PuestoController extends Controller
{

    protected function rules($puesto = null)
    {
        return [
            'nombre' => [
                'required',
                'max:255',
                Rule::unique('puestos')->ignore($puesto),
            ],
            'equipo_id' => 'required|exists:equipos,id',
            'descripcion' => 'nullable|max:255'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es requerido.',
            'nombre.max' => 'El nombre debe tener máximo :max caracteres.',
            'nombre.unique' => 'El nombre ya está en uso.',
            'equipo_id.required' => 'El ID del equipo es requerido.',
            'equipo_id.exists' => 'El ID del equipo no existe.',
            'descripcion.max' => 'La descripción debe tener máximo :max caracteres.'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('puestos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'puestos.create',
            ['equipos' => Equipo::obtenerTodos()]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate(
            $request,
            $this->rules(),
            $this->messages()
        );

        $newPuesto = Puesto::crearPuesto($data);

        session()->flash(
            'toast',
            [
                'message' => "Puesto {$newPuesto->nombre} creado correctamente",
                'type' => 'success',
            ]

        );

        return redirect()->route('puestos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Puesto $puesto)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Puesto $puesto)
    {
        return view('puestos.edit', [
            'puesto' => $puesto,
            'equipos' => Equipo::obtenerTodos(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Puesto $puesto)
    {
        $data = $this->validate(
            $request,
            $this->rules($puesto),
            $this->messages()
        );

        $updatedPuesto = Puesto::actualizarPuesto($puesto, $data);
        session()->flash(
            'toast',
            [
                'message' => "Puesto {$updatedPuesto->nombre} actualizado correctamente",
                'type' => 'success',
            ]

        );

        return redirect()->route('puestos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Puesto $puesto)
    {
        $deletedPuesto = Puesto::eliminarPuesto($puesto);

        session()->flash(
            'toast',
            [
                'message' => "Puesto {$deletedPuesto->nombre} eliminado correctamente",
                'type' => 'success',
            ]

        );

        return redirect()->route('puestos.index');
    }
}
