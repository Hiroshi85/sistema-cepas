<?php

namespace App\Http\Controllers\Rrhh;

use App\Http\Controllers\Controller;
use App\Models\Rrhh\Equipo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EquipoController extends Controller
{


    protected function rules($equipo = null)
    {
        return [
            'nombre' => [
                'required',
                'max:255',
                Rule::unique('equipos')->ignore($equipo)
            ],
        ];
    }

    protected function messages()
    {
        return [
            'nombre.required' => 'El nombre del equipo es obligatorio',
            'nombre.max' => 'El nombre del equipo no puede superar los 255 caracteres',
            'nombre.unique' => 'El nombre del equipo ya existe',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rrhh.equipos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rrhh.equipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->messages());

        $newEquipo = Equipo::crearEquipo($data);

        session()->flash(
            'toast',
            [
                'message' => "Equipo {$newEquipo->nombre} creado correctamente",
                'type' => 'success',
            ]
        );
        return redirect()->route('equipos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
    {
        return view('rrhh.equipos.edit', compact('equipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipo $equipo)
    {
        $data = $request->validate($this->rules($equipo), $this->messages());

        $updatedEquipo = Equipo::actualizarEquipo($equipo, $data);

        session()->flash(
            'toast',
            [
                'message' => "Equipo {$updatedEquipo->nombre} actualizado correctamente",
                'type' => 'success',
            ]
        );
        return redirect()->route('equipos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        $deletedEquipo = Equipo::eliminarEquipo($equipo);

        session()->flash(
            'toast',
            [
                'message' => "Equipo {$deletedEquipo->nombre} eliminado correctamente",
                'type' => 'success',
            ]
        );
        return redirect()->route('equipos.index');
    }
}
