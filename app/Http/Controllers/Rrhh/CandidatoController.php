<?php

namespace App\Http\Controllers\Rrhh;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public static function rules($candidato = null)
    {
        return [
            'nombre' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('candidatos')->ignore($candidato),
            ],
            'dni' => [
                'required',
                'numeric',
                'digits:8',
                Rule::unique('candidatos')->ignore($candidato),
            ],
            'genero' => 'required',
            'fecha_nacimiento' => 'required|date|before:2004-01-01|after:1940-01-01',
            'direccion' => 'required',
            'telefono' => [
                'required',
                'numeric',
                'digits:9',
                Rule::unique('candidatos')->ignore($candidato),
            ],
            'curriculum_url' => 'required|url',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public static function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo válida.',
            'email.unique' => 'El email ya está registrado.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.numeric' => 'El DNI debe ser numérico.',
            'dni.digits' => 'El DNI debe tener 8 dígitos.',
            'dni.unique' => 'El DNI ya está registrado.',
            'genero.required' => 'El género es obligatorio.',
            'fecha_nacimiento.required' => 'El fecha de nacimiento es obligatorio.',
            'fecha_nacimiento.date' => 'El fecha de nacimiento debe ser una fecha válida.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a 2004-01-01.',
            'fecha_nacimiento.after' => 'La fecha de nacimiento debe ser posterior a 1940-01-01.',
            'direccion.required' => 'El dirección es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe ser numérico.',
            'telefono.digits' => 'El teléfono debe tener 9 dígitos.',
            'telefono.unique' => 'El teléfono ya está registrado.',
            'curriculum_url.required' => 'El enlace de currículum es obligatorio.',
            'curriculum_url.url' => 'El enlace de currículum debe ser una URL válida.',
        ];
    }

    public function index()
    {
        return view('candidatos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('candidatos.create', ['title' => 'Nuevo candidato']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, $this->rules(), $this->messages());
        $newCandidato = Candidato::crearCandidato($data);
        session()->flash(
            'toast',
            [
                'message' => "Candidato {$newCandidato->nombre} creado correctamente",
                'type' => 'success',
            ]
        );
        return redirect()->route('candidatos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidato $candidato)
    {
        return view('candidatos.show', ['title' => 'Ver candidato', 'candidato' => $candidato]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidato $candidato)
    {
        return view('candidatos.edit', ['title' => 'Editar candidato', 'candidato' => $candidato]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidato $candidato)
    {
        $data = $this->validate($request, $this->rules($candidato), $this->messages());
        $updatedCandidato = Candidato::actualizarCandidato($candidato, $data);
        session()->flash(
            'toast',
            [
                'message' => "Candidato {$updatedCandidato->nombre} actualizado correctamente",
                'type' => 'success',
            ]
        );
        return redirect()->route('candidatos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidato $candidato)
    {
        $deletedCandidato = Candidato::eliminarCandidato($candidato);

        session()->flash(
            'toast',
            [
                'message' => "Candidato {$deletedCandidato->nombre} eliminado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('candidatos.index');
    }
}
