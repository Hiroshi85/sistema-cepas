<?php

namespace App\Http\Controllers\Rrhh;

use App\Http\Controllers\Controller;
use App\Models\Rrhh\Empleado;
use App\Models\Rrhh\Puesto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{

    public static function rules($empleado = null)
    {
        return [
            'nombre' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('empleados')->ignore($empleado),
            ],
            'dni' => [
                'required',
                'numeric',
                'digits:8',
                Rule::unique('empleados')->ignore($empleado),
            ],
            'genero' => 'required',
            'fecha_nacimiento' => 'required|date|before:2004-01-01|after:1940-01-01',
            'direccion' => 'required',
            'telefono' => [
                'required',
                'numeric',
                'digits:9',
                Rule::unique('empleados')->ignore($empleado),
            ],
            'puesto_id' => 'required|exists:puestos,id'
        ];
    }

    public static function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Por favor, ingresa una dirección de correo electrónico válida.',
            'email.unique' => 'El email ya está en uso.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.numeric' => 'El DNI debe contener solo números.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'El DNI ya está en uso.',
            'genero.required' => 'Por favor, selecciona el género.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'Por favor, ingresa una fecha de nacimiento válida.',
            'fecha_nacimiento.before' => 'Debes haber nacido antes del 2004-01-01.',
            'fecha_nacimiento.after' => 'Debes haber nacido después del 1940-01-01.',
            'direccion.required' => 'La dirección es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe contener solo números.',
            'telefono.digits' => 'El teléfono debe tener exactamente 9 dígitos.',
            'telefono.unique' => 'El teléfono ya está en uso.',
            'puesto_id.required' => 'Por favor, selecciona el puesto.',
            'puesto_id.exists' => 'El puesto seleccionado no es válido.',
        ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rrhh.empleados.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rrhh.empleados.create', [
            'puestos' => Puesto::obtenerTodos(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, $this->rules(), $this->messages());

        // if the equipo is docentes, then the esDocente field is true
        if ($data['puesto_id'] >= 10 && $data['puesto_id'] <= 19) {
            $data['esDocente'] = 1;
        } else {
            $data['esDocente'] = 0;
        }

        $newEmpleado = Empleado::crearEmpleado($data);
        $this->createUser($newEmpleado);
        session()->flash(
            'toast',
            [
                'message' => "Empleado {$newEmpleado->nombre} creado correctamente",
                'type' => 'success',
            ]
        );
        return redirect()->route('rrhh.empleados.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        return view('rrhh.empleados.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        return view('rrhh.empleados.edit', [
            'empleado' => $empleado,
            'puestos' => Puesto::obtenerTodos(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $data = $this->validate($request, $this->rules($empleado), $this->messages());

        // if the equipo is docentes, then the esDocente field is true
        $data['esDocente'] = $data['puesto_id'] == 4;

        $updatedEmpleado = Empleado::actualizarEmpleado($empleado, $data);
        session()->flash(
            'toast',
            [
                'message' => "Empleado {$updatedEmpleado->nombre} actualizado correctamente",
                'type' => 'success',
            ]
        );
        return redirect()->route('rrhh.empleados.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $deletedEmpleado = Empleado::eliminarEmpleado($empleado);
        session()->flash(
            'toast',
            [
                'message' => "Empleado {$deletedEmpleado->nombre} eliminado correctamente",
                'type' => 'success',
            ]
        );
        return redirect()->route('rrhh.empleados.index');
    }

    //

    public static function createUser(Empleado $empleado): void
    {
        $idp = $empleado->puesto_id;

        $roles = [
            1 => 'Coordinador de Recursos Humanos',
            2 => 'Especialista en Reclutamiento',
            3 => 'Encargado de Evaluación',
            5 => 'secretario(a)',
            6 => 'auxiliar',
            9 => 'Coordinador Academico',
            24 => 'psicologo',
        ];

        if (($idp <= 3) || ($idp >= 9 && $idp <= 19) || in_array($idp, [5, 6, 24])) {
            $user = User::create([
                'name' => $empleado->nombre,
                'dni' => $empleado->dni,
                'email' => $empleado->email,
                'password' => Hash::make("password"),
            ]);

            if (array_key_exists($idp, $roles)) {
                $user->assignRole($roles[$idp]);
            }

            if (($idp >= 10 && $idp <= 19)) {
                $user->assignRole('Docente');
            }
        }
    }
}
