<?php

namespace App\Http\Controllers\AdmisionMatriculas;

use App\Http\Controllers\Controller;
use App\Models\Admision;
use App\Models\Alumno;
use App\Models\Apoderado;
use App\Models\ApoderadoPostulante;
use App\Models\Aula;
use App\Models\DocumentoPostulante;
use App\Models\Matricula;
use App\Models\Postulante;
use App\Models\PostulanteAdmision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostulanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected function validateFields($request, $idpostulante = null)
     {
        $rules = [
            'nombre_apellidos' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date',
            'domicilio' => 'required|string|max:100',
            'numero_celular' => 'required|numeric|digits:9|unique:postulantes,numero_celular,' . $idpostulante . ',idpostulante',
            'dni' => 'required|numeric|digits:8|unique:postulantes,dni,' . $idpostulante . ',idpostulante',
            'nro_hermanos' => 'required|integer|min:0',
        ];

        return $this->validate($request, $rules);    
     }


    public function index(Request $request)
    {   
        $autoridad = session()->get('authUser')->hasAnyRole(['secretario(a)', 'director(a)', 'admin']);
        $aulas = Aula::where('nro_vacantes_disponibles', '>', 0)->orderBy('seccion')->orderBy('grado')->get();
        $apoderados = null;

        $search = $request->get('search');
        if($autoridad){
            $postulantes = Postulante::whereRaw('eliminado = 0')
                ->orderByRaw("CASE estado 
                        WHEN 'Entrevista pendiente' THEN 1
                        WHEN 'En postulación' THEN 2
                        WHEN 'Aceptado' THEN 3
                        WHEN 'Rechazado' THEN 4
                        ELSE 5 END")
                ->orderBy('fecha_postulacion')
                ->where('nombre_apellidos', 'LIKE', '%' . $search . '%')
                ->paginate(15);
            $apoderados = Apoderado::where('eliminado',0)->get();
        }else{
            $postulantes = Postulante::select('postulantes.*')
            ->join('apoderado_postulante','apoderado_postulante.idpostulante','=','postulantes.idpostulante')
            ->join('apoderados','apoderados.idapoderado','=','apoderado_postulante.idapoderado')
            ->whereRaw('postulantes.eliminado = 0 AND apoderado_postulante.eliminado = 0')
            ->where('apoderados.idusuario', Auth::user()->id)
            ->orderByRaw("CASE estado 
                        WHEN 'Entrevista pendiente' THEN 1
                        WHEN 'En postulación' THEN 2
                        WHEN 'Rechazado' THEN 3
                        ELSE 5 END")
                ->orderBy('fecha_postulacion')
            ->where('postulantes.nombre_apellidos', 'LIKE', '%' . $search . '%')
            ->paginate(15);    
        }

        $admision = Admision::where('eliminado', 0)->orderBy('idadmision', 'desc')->first();

        return view ('admision-matriculas.postulante.index', compact('postulantes', 'apoderados', 'aulas', 'search', 'admision'));
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $autoridad = session()->get('authUser')->hasAnyRole(['secretario(a)', 'admin']);

        $data = $this->validateFields($request);
       
        $postulante = new Postulante();
        $postulante->nombre_apellidos = $request->get('nombre_apellidos');
        $postulante->fecha_nacimiento = $request->get('fecha_nacimiento');
        $postulante->dni = $request->get('dni'); //8 digits only numbers
        $postulante->domicilio = $request->get('domicilio');
        $postulante->numero_celular = $request->get('numero_celular');  
        $postulante->nro_hermanos = $request->get('nro_hermanos');
        $postulante->fecha_postulacion = now('America/Lima')->toDateString();
        $postulante->estado = "Registrado";
        $postulante->idaula = $request->get('idaula');
        $postulante->save();
        
        $aula = Aula::findOrFail($postulante->idaula);
        $aula->nro_vacantes_disponibles --;
        $aula->save();
        if ($autoridad){
            $apoderados = $request->input('apoderados');
            array_shift($apoderados); //remove first element 
            
            foreach ($apoderados as $apoderado) {
                $apoderado_postulante = new ApoderadoPostulante();
                $apoderado_postulante->idapoderado = $apoderado;
                $apoderado_postulante->idpostulante = $postulante->idpostulante;
                $apoderado_postulante->parentesco = $request->get('parentesco:'.$apoderado);

                if ($request->has('convivencia:'.$apoderado))
                    $apoderado_postulante->convivencia = 'si';
                else   
                    $apoderado_postulante->convivencia = 'no';

                $apoderado_postulante->save();
            }
        }else{
            $apoderado = Apoderado::where('idusuario', Auth::user()->id)->first();
            $apoderado_postulante = new ApoderadoPostulante();
            $apoderado_postulante->idapoderado = $apoderado->idapoderado;
            $apoderado_postulante->idpostulante = $postulante->idpostulante;
            $apoderado_postulante->parentesco = $request->get('parentesco');
            if ($request->has('convivencia'))
                $apoderado_postulante->convivencia = 'si';
            else   
                $apoderado_postulante->convivencia = 'no';
            $apoderado_postulante->save();
        }

        session()->flash(
            'toast',
            [
                'message' => "Registro creado correctamente",
                'type' => 'success',
            ]);

        return redirect()->route('postulante.index')->with('datos','stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(Postulante $postulante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // if(!Auth::user()->hasRole('secretario(a)')) return abort(403, 'Acceso denegado');
        
        $aulas = Aula::where('nro_vacantes_disponibles', '>', 0)->orderBy('seccion')->orderBy('grado')->get();
        $postulante = Postulante::findOrFail($id);
        $documentos = DocumentoPostulante::where('eliminado', 0)
        ->where('idpostulante', $postulante->idpostulante)
        ->get();
        $historial = PostulanteAdmision::where('idpostulante', $postulante->idpostulante)
            ->join('admisions', 'admisions.idadmision', 'postulante_admision.idadmision')
            ->get();

        // validar si el postulante ya fue evaluado como rechazado o aceptado en el proceso de admisión actual
        $admision = Admision::where('eliminado', 0)->orderBy('idadmision', 'desc')->first();
        $blockstate = true; 
        if ($admision != null ){
            $postulante_admision = PostulanteAdmision::where('idpostulante', $postulante->idpostulante)
            ->where('idadmision', $admision->idadmision)
            ->first();
            if ($postulante_admision == null )
                $blockstate = false;
            else if ($postulante_admision->resultado != "Aceptado" && $postulante_admision->resultado != "Rechazado")
                $blockstate = false;
        }
        
        //Parentesco
        $parentescos = ApoderadoPostulante::where('idpostulante', $postulante->idpostulante)
            ->join('apoderados','apoderados.idapoderado','=','apoderado_postulante.idapoderado')
            ->get();
        //Apoderados
        $apoderados = Apoderado::where('eliminado','0')->get();
        return view('admision-matriculas.postulante.edit',compact('postulante', 'aulas','documentos','historial', 'parentescos', 'blockstate', 'apoderados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $autoridad = session()->get('authUser')->hasAnyRole(['secretario(a)', 'admin']);
        
        $postulante = Postulante::findOrFail($id);
        
        $data = $this->validateFields($request, $postulante->idpostulante);

        $postulante->nombre_apellidos = $request->get('nombre_apellidos');
        $postulante->fecha_nacimiento = $request->get('fecha_nacimiento');
        $postulante->dni = $request->get('dni'); //8 digits only numbers
        $postulante->domicilio = $request->get('domicilio');
        $postulante->numero_celular = $request->get('numero_celular');  
        $postulante->nro_hermanos = $request->get('nro_hermanos');
       
        if ($autoridad){
            $postulante->estado = $request->get('estado');
            
            $flag = false;
            if($postulante->idaula != $request->get('idaula')) {
                $flag = true;
                $lastAula = Aula::findOrFail($postulante->idaula);
                $lastAula->nro_vacantes_disponibles ++;
                $lastAula->save();
            }

            $postulante->idaula = $request->get('idaula');
           

            if ($flag){
                $aula = Aula::findOrFail($postulante->idaula);
                $aula->nro_vacantes_disponibles --;
                $aula->save();
            }
            if ($request->get('estado') == 'Aceptado') $this->createAlumno($postulante);
        }   
        $postulante->save();

        if($postulante->estado == 'Aceptado' || $postulante->estado == 'Rechazado' || $postulante->estado == 'Entrevista pendiente' || $postulante->estado == 'En postulación') $this->registrarHistoriaPostulacion($postulante);

        session()->flash(
            'toast',
            [
                'message' => "Registro actualizado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('postulante.index')->with('datos','updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idpostulante)
    {
        $postulante = Postulante::findOrFail($idpostulante);
        $postulante->eliminado = 1;
        $postulante->save();

        session()->flash(
            'toast',
            [
                'message' => "Registro eliminado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('postulante.index')->with('datos','deleted');
    }

    protected function createAlumno($postulante){
        $matricula = Matricula::where('eliminado', 0)->orderBy('idmatricula', 'desc')->first();
        $matricula->total_alumnos++; //total alumnos entre matriculados y no matriculados
        $matricula->save();

        $alumno = Alumno::where('idpostulante',$postulante->idpostulante)->first(); 
              
        if( $alumno != null) return;
       
        $alumno = new Alumno();
        $alumno->idpostulante = $postulante->idpostulante;
        $alumno->idaula = $postulante->idaula;
        $alumno->nombre_apellidos = $postulante->nombre_apellidos;
        $alumno->fecha_nacimiento = $postulante->fecha_nacimiento;
        $alumno->dni = $postulante->dni;
        $alumno->domicilio = $postulante->domicilio;
        $alumno->numero_celular = $postulante->numero_celular;
        $alumno->nro_hermanos = $postulante->nro_hermanos;
        $alumno->estado = "No matriculado";
        $alumno->save();


        \App\Models\User::factory()->create([
            'name' => $postulante->nombre_apellidos,
             'dni' => $postulante->dni,
             'email' => 'a'. $postulante->dni . '@gmail.com',
             'password' => bcrypt('password'),
        ])->assignRole('Alumno');

        // $tabla = DB::table('users');
        // $tabla->insert([
        //     'name' => $postulante->nombre_apellidos,
        //     'dni' => $postulante->dni,
        //     'email' => 'a'. $postulante->dni . '@gmail.com',
        //     'password' => bcrypt($postulante->dni),
        // ]);
    }

    protected function registrarHistoriaPostulacion($postulante){
        $admision = Admision::where('eliminado', 0)->orderBy('idadmision', 'desc')->first();
        //if it is registered update
        $postulante_admision = PostulanteAdmision::where('idpostulante', $postulante->idpostulante)
        ->where('idadmision', $admision->idadmision)
        ->first();
        if (
            $postulante_admision != null            
        ) {
            DB::table('postulante_admision')->whereRaw('idpostulante='.$postulante->idpostulante.' AND idadmision='.$admision->idadmision.'')->update([
                'resultado' => $postulante->estado
            ]);
        }else {
            $postulante_admision = new PostulanteAdmision();
            $postulante_admision->idpostulante = $postulante->idpostulante;
            $postulante_admision->idadmision = $admision->idadmision;
            $postulante_admision->fecha_registro = now('America/Lima')->toDateString();
            $postulante_admision->resultado = $postulante->estado;
            $postulante_admision->save();
        }
    }
}
