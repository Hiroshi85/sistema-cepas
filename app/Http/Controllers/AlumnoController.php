<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Aula;
use App\Models\DocumentoAlumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnoController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $autoridad = Auth::user()->hasRole('secretario(a)') || Auth::user()->hasRole('admin');
        $aulas = null; 
        $grado = null;
        if ($autoridad){
            $grado = $request->get('grado') ?? 1;
        
            $aulas = Aula::selectRaw('DISTINCT grado')->where('eliminado', 0)->get();  

            $alumnos = Alumno::join('aulas','aulas.idaula','=','alumnos.idaula')
            ->where('alumnos.eliminado', 0)
            ->where('aulas.grado', $grado)
            ->orderBy('alumnos.nombre_apellidos')
            ->get();
            
        }else{
            $alumnos = Alumno::select('alumnos.*', 'aulas.*')->join('aulas','aulas.idaula','=','alumnos.idaula')
            ->join('postulantes','postulantes.idpostulante','=','alumnos.idpostulante')
            ->join('apoderado_postulante','apoderado_postulante.idpostulante','=','postulantes.idpostulante')
            ->join('apoderados','apoderados.idapoderado','=','apoderado_postulante.idapoderado')
            ->where('alumnos.eliminado', 0)
            ->where('apoderados.idusuario', Auth::user()->id)
            ->orderBy('alumnos.nombre_apellidos')
            ->get();
        }
      
        return view('alumno.index', compact('alumnos', 'aulas', 'grado'));        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // PostulanteController -> createAlumno
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //PostulanteController -> createAlumno
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $aulas = Aula::where('nro_vacantes_disponibles', '>', 0)->orderBy('seccion')->orderBy('grado')->get();
        $alumno = Alumno::findOrFail($id);
        $documentos = DocumentoAlumno::where('eliminado', 0)
            ->where('idalumno', $alumno->idalumno)
            ->get();
        return view('alumno.edit',compact('alumno','aulas', 'documentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $data= request()->validate([
            
        ],[
           
        ]);

        $alumno = Alumno::findOrFail($id);
        $alumno->idaula = $request->get('idaula');
        $alumno->nombre_apellidos = $request->get('nombre_apellidos');
        $alumno->fecha_nacimiento = $request->get('fecha_nacimiento');
        $alumno->dni =  $request->get('dni');
        $alumno->domicilio = $request->get('domicilio');
        $alumno->numero_celular = $request->get('numero_celular');
        $alumno->nro_hermanos = $request->get('nro_hermanos');
        $alumno->estado = $request->get('estado');
        $alumno->save();
        
        return redirect()->route('alumno.index')->with('datos','updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->eliminado = 1;
        $alumno->save();
        // Libera vacante de aula
        $aula = Aula::findOrFail($alumno->idaula);
        $aula->nro_vacantes_disponibles = $aula->nro_vacantes_disponibles + 1;
        $aula->save();
        return redirect()->route('alumno.index')->with('datos','deleted');
    }
}
