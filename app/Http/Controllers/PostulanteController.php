<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Apoderado;
use App\Models\ApoderadoPostulante;
use App\Models\Aula;
use App\Models\DocumentoPostulante;
use App\Models\Postulante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostulanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $autoridad = Auth::user()->hasRole('secretario(a)') || Auth::user()->hasRole('admin');
        $aulas = Aula::where('nro_vacantes_disponibles', '>', 0)->orderBy('seccion')->orderBy('grado')->get();
        $apoderados = null;

        if($autoridad){
            $postulantes = Postulante::whereRaw('eliminado = 0 AND estado <> "Aceptado"')
                ->orderByRaw("CASE estado 
                        WHEN 'Pendiente' THEN 1
                        WHEN 'Registrado' THEN 2
                        WHEN 'Rechazado' THEN 3
                        ELSE 4 END")
                ->orderBy('fecha_postulacion')
                ->get();
            $apoderados = Apoderado::where('eliminado',0)->get();
        }else{
            $postulantes = Postulante::select('postulantes.*')
            ->join('apoderado_postulante','apoderado_postulante.idpostulante','=','postulantes.idpostulante')
            ->join('apoderados','apoderados.idapoderado','=','apoderado_postulante.idapoderado')
            ->whereRaw('postulantes.eliminado = 0 AND apoderado_postulante.eliminado = 0')
            ->where('apoderados.idusuario', Auth::user()->id)
            ->orderByRaw("CASE estado 
                        WHEN 'Pendiente' THEN 1
                        WHEN 'Registrado' THEN 2
                        WHEN 'Rechazado' THEN 3
                        ELSE 4 END")
                ->orderBy('fecha_postulacion')
            ->get();
        }

        return view ('postulante.index', compact('postulantes', 'apoderados', 'aulas'));
       
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
        $autoridad = Auth::user()->hasRole('secretario(a)') || Auth::user()->hasRole('admin');

        $data= request()->validate([
            'nombre_apellidos' => 'required',
            
        ],[
            'nombre_apellidos.required' => 'El campo apellidos y nombres es requerido',
        ]);
       
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
            ]
        );

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
        return view('postulante.edit',compact('postulante', 'aulas','documentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $autoridad = Auth::user()->hasRole('secretario(a)') || Auth::user()->hasRole('admin');
        $data= request()->validate([
           
        ],[
          
        ]);
        $postulante = Postulante::findOrFail($id);
        
        $postulante->nombre_apellidos = $request->get('nombre_apellidos');
        $postulante->fecha_nacimiento = $request->get('fecha_nacimiento');
        $postulante->dni = $request->get('dni'); //8 digits only numbers
        $postulante->domicilio = $request->get('domicilio');
        $postulante->numero_celular = $request->get('numero_celular');  
        $postulante->nro_hermanos = $request->get('nro_hermanos');
        // $postulante->fecha_postulacion = now('America/Lima')->toDateString();
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
    }
}
