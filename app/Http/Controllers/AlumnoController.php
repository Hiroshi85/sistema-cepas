<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\AlumnoMatricula;
use App\Models\Aula;
use App\Models\DocumentoAlumno;
use App\Models\Matricula;
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
        $seccion = null;

        if ($autoridad){
            $grado = $request->get('grado');
            $grado != null ? explode('|',$grado) : $grado = ['1','|', 'A'];
         
            $aulas = Aula::where('eliminado', 0)->get();  

            $alumnos = Alumno::join('aulas','aulas.idaula','=','alumnos.idaula')
            ->where('alumnos.eliminado', 0)
            ->whereRaw('aulas.grado = ? AND aulas.seccion = ?', [$grado[0], $grado[2]])
            ->orderBy('alumnos.nombre_apellidos')
            ->paginate(30);
            
        }else{
            $alumnos = Alumno::select('alumnos.*', 'aulas.*')->join('aulas','aulas.idaula','=','alumnos.idaula')
            ->join('postulantes','postulantes.idpostulante','=','alumnos.idpostulante')
            ->join('apoderado_postulante','apoderado_postulante.idpostulante','=','postulantes.idpostulante')
            ->join('apoderados','apoderados.idapoderado','=','apoderado_postulante.idapoderado')
            ->where('alumnos.eliminado', 0)
            ->where('apoderados.idusuario', Auth::user()->id)
            ->orderBy('aulas.grado')
            ->orderBy('aulas.seccion')
            ->orderBy('alumnos.nombre_apellidos')
            ->paginate(30);
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

        $historial = AlumnoMatricula::where('idalumno', $alumno->idalumno)
            ->join('matriculas', 'matriculas.idmatricula', 'alumno_matriculas.idmatricula')
            ->get();
        return view('alumno.edit',compact('alumno','aulas', 'documentos', 'historial'));
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
        
        if($alumno->estado == 'Matriculado') $this->registrarHistoriaMatricula($alumno);
      

        session()->flash(
            'toast',
            [
                'message' => "Alumno actualizado correctamente",
                'type' => 'success',
            ]
        );

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

        session()->flash(
            'toast',
            [
                'message' => "Alumno eliminado correctamente",
                'type' => 'success',
            ]
        );
        return redirect()->route('alumno.index')->with('datos','deleted');
    }

    protected function registrarHistoriaMatricula($alumno){
        $matricula = Matricula::where('eliminado', 0)->orderBy('idmatricula', 'desc')->first();
        //if it is registered return
        if (
            AlumnoMatricula::where('idalumno', $alumno->idalumno)
            ->where('idmatricula', $matricula->idmatricula)
            ->first() != null            
        ) return;
        
        $aula = Aula::findOrFail($alumno->idaula);

        $alumno_matricula = new AlumnoMatricula();
        $alumno_matricula->idalumno = $alumno->idalumno;
        $alumno_matricula->idmatricula = $matricula->idmatricula;
        $alumno_matricula->fecha_registro = now('America/Lima')->toDateString();
        $alumno_matricula->aula = $aula->grado.''.$aula->seccion;
        $alumno_matricula->save();
    }
}
