<?php

namespace App\Http\Controllers;

use App\Models\Apoderado;
use App\Models\DocumentoApoderado;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;

class ApoderadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apoderados = Apoderado::where('eliminado', 0)->get();
        return view ('apoderado.index', compact('apoderados'));
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
        $data= request()->validate([
            'nombre_apellidos' => 'required',

        ],[
            'nombre_apellidos.required' => 'El campo apellidos y nombres es requerido',
        ]);

        $apoderado = new Apoderado();
        $apoderado->nombre_apellidos = $request->get('nombre_apellidos');
        $apoderado->fecha_nacimiento = $request->get('fecha_nacimiento');
        $apoderado->dni = $request->get('dni'); //8 digits only numbers
        $apoderado->numero_celular = $request->get('numero_celular');
        $apoderado->ocupacion = $request->get('ocupacion');  
        $apoderado->centro_trabajo = $request->get('centro_trabajo');
        $apoderado->correo = $request->get('correo');
        $apoderado->save();

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
        return view('apoderado.edit',compact('apoderado', 'documentos'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data= request()->validate([
           
        ],[
          
        ]);

        $apoderado = Apoderado::findOrFail($id);
        $apoderado->nombre_apellidos = $request->get('nombre_apellidos');
        $apoderado->fecha_nacimiento = $request->get('fecha_nacimiento');
        $apoderado->dni = $request->get('dni'); //8 digits only numbers
        $apoderado->numero_celular = $request->get('numero_celular');
        $apoderado->ocupacion = $request->get('ocupacion');  
        $apoderado->centro_trabajo = $request->get('centro_trabajo');
        $apoderado->correo = $request->get('correo');
        $apoderado->save();
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

        $role = Role::firstOrCreate(['name' => 'apoderado']); 
        $user->assignRole($role);
        
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

        return redirect(RouteServiceProvider::HOME);
    }
}
