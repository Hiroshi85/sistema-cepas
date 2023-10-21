<?php

namespace App\Http\Controllers\AdmisionMatriculas;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Apoderado;
use App\Models\DocumentoApoderado;
use App\Models\Postulante;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;
use App\Providers\AppServiceProvider;
use Illuminate\Validation\ValidationException;

class ApoderadoController extends Controller
{
    private function validateApoderado($request, $thisApoderado = null, $update = false){
    
        $rules = [
            'nombre_apellidos' => 'required|string|max:100|regex:/^[\pL\s\-áéíóúÁÉÍÓÚ]+$/u',
            'dni' => 'required|numeric|integer|digits:8|unique:apoderados,dni,'.$thisApoderado.',idapoderado',
            'fecha_nacimiento' => 'required|date|before:today',
            'numero_celular' => 'required|numeric|digits:9|unique:apoderados,numero_celular,'.$thisApoderado.',idapoderado',
            'ocupacion' => 'required|string|max:100',
            'centro_trabajo' => 'required|string|max:100',
            'correo' => 'required|email|string|max:100|unique:apoderados,correo,'.$thisApoderado.',idapoderado',
        ];

        $customMessages = [
            'required' => 'El campo :attribute es obligatorio.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'min' => 'El campo :attribute debe ser mayor o igual a cero.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'unique' => 'El valor del campo :attribute ya existe en la base de datos.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'max' => 'El campo :attribute no debe tener más de 100 caracteres.',
            'email' => 'El campo :attribute debe ser un email válido.',
            'digits' => 'El campo :attribute debe tener :digits dígitos.',
            'before' => 'El campo :attribute debe ser una fecha anterior a la actual.',
            'regex' => 'El formato del campo :attribute no es válido.'
        ];
        $attributes = [
            'nombre_apellidos' => 'nombre completo',
            'dni' => 'DNI',
            'fecha_nacimiento' => 'fecha de nacimiento',
            'numero_celular' => 'celular',
            'ocupacion' => 'ocupación',
            'centro_trabajo' => 'centro de trabajo',
            'correo' => 'email'
        ];

        return $this->validate($request, $rules, $customMessages, $attributes);    
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search'); //search by name
        $apoderados = Apoderado::where('eliminado', 0)
            ->where('nombre_apellidos', 'LIKE', '%' . $search . '%')
            ->paginate(10);

        return view ('admision-matriculas.apoderado.index', compact('apoderados','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view('apoderados.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data= $this->validateApoderado($request);
        } catch (ValidationException $e) {
            session()->flash(
                'toast',
                [
                  'message' => $e->getMessage(),
                  'type' => 'error',
                ]
            );
            return redirect()->back()->withErrors($e->errors())->withInput();

        }

        $user = new User();
        $user->name = $request->get('nombre_apellidos');
        $user->email = $request->get('correo');
        $user->password = Hash::make($request->get('dni'));
        $user->assignRole('apoderado');
        $user->save();

        $data['idusuario'] = $user->id;
        Apoderado::create($data);

        session()->flash(
            'toast',
            [
                'message' => "Apoderado registrado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('apoderado.index')->with('datos','stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apoderado $apoderado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $apoderado = Apoderado::findOrFail($id);
        $documentos = DocumentoApoderado::where('eliminado', 0)
            ->where('idapoderado', $apoderado->idapoderado)
            ->get();

        //Parentesco postulantes
        $postulantes = Postulante::select('postulantes.*', 'apoderado_postulante.*')
            ->join('apoderado_postulante','apoderado_postulante.idpostulante','=','postulantes.idpostulante')
            ->join('apoderados','apoderados.idapoderado','=','apoderado_postulante.idapoderado')
            ->whereRaw('postulantes.eliminado = 0 AND apoderado_postulante.eliminado = 0')
            ->where('apoderados.idapoderado', $id)
            ->orderByRaw("CASE estado 
                        WHEN 'Pendiente' THEN 1
                        WHEN 'Registrado' THEN 2
                        WHEN 'Rechazado' THEN 3
                        ELSE 4 END")
                ->orderBy('fecha_postulacion')
            ->get();
        //Parentesco estudiantes

        $alumnos = Alumno::select('alumnos.*', 'aulas.*','apoderado_postulante.*')->join('aulas','aulas.idaula','=','alumnos.idaula')
        ->join('postulantes','postulantes.idpostulante','=','alumnos.idpostulante')
        ->join('apoderado_postulante','apoderado_postulante.idpostulante','=','postulantes.idpostulante')
        ->join('apoderados','apoderados.idapoderado','=','apoderado_postulante.idapoderado')
        ->where('alumnos.eliminado', 0)
        ->where('apoderados.idapoderado', $id)
        ->orderBy('alumnos.nombre_apellidos')
        ->get();
        
        return view('admision-matriculas.apoderado.edit',compact('apoderado', 'documentos', 'postulantes', 'alumnos'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data= $this->validateApoderado($request, $id, true);

        $apoderado = Apoderado::findOrFail($id);
        $apoderado->nombre_apellidos = $request->get('nombre_apellidos');
        $apoderado->fecha_nacimiento = $request->get('fecha_nacimiento');
        $apoderado->dni = $request->get('dni'); //8 digits only numbers
        $apoderado->numero_celular = $request->get('numero_celular');
        $apoderado->ocupacion = $request->get('ocupacion');  
        $apoderado->centro_trabajo = $request->get('centro_trabajo');
        $apoderado->correo = $request->get('correo');
        $apoderado->save();
        session()->flash(
            'toast',
            [
                'message' => "Apoderado actualizado correctamente",
                'type' => 'success',
            ]
        );
        return redirect()->route('apoderado.index')->with('datos','updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idapoderado)
    {
        $apoderado = Apoderado::findOrFail($idapoderado);
        $apoderado->eliminado = 1;
        $apoderado->save();

        session()->flash(
            'toast',
            [
                'message' => "Apoderado eliminado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('apoderado.index')->with('datos','deleted');
    }

    public function crear(){
        return view('apoderados.auth.register');
    }

    public function registerApoderado(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'dni' => [
                'required',
                'numeric',
                'digits:8',
                'unique:'.Apoderado::class
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // $role = Role::firstOrCreate(['name' => 'apoderado']); 
        $user->assignRole('apoderado');
        
        $apoderado = new Apoderado();
        $apoderado->nombre_apellidos = $request->get('name');
        $apoderado->fecha_nacimiento = $request->get('fecha_nacimiento');
        $apoderado->dni = $request->get('dni');
        $apoderado->numero_celular = $request->get('numero_celular');
        $apoderado->ocupacion = $request->get('ocupacion');  
        $apoderado->centro_trabajo = $request->get('centro_trabajo');
        $apoderado->correo = $request->get('email');
        $apoderado->idusuario = $user->id;
        $apoderado->save();

        

        event(new Registered($user));

        Auth::login($user);

        return redirect('/admision-matriculas');
    }
}
