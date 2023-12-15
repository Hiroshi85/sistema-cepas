<?php

namespace App\Http\Controllers\AdmisionMatriculas;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\AlumnoMatricula;
use App\Models\Apoderado;
use App\Models\ApoderadoPostulante;
use App\Models\Aula;
use App\Models\DocumentoAlumno;
use App\Models\Matricula;
use App\Models\Postulante;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AlumnoController extends Controller
{
   private function validateAlumno(Request $request, $thisIdPostulante, $update = false){
        $rules = [
            'nombre_apellidos' => 'required|string|max:100|regex:/^[\pL\s\-áéíóúÁÉÍÓÚ.]+$/u',
            'fecha_nacimiento' => 'required|date|before:today',
            'dni' => 'required|numeric|digits:8|unique:alumnos,dni,' .$thisIdPostulante. ',idalumno',
            'numero_celular' => 'required|numeric|digits:9|unique:alumnos,numero_celular,' .$thisIdPostulante. ',idalumno',
            'nro_hermanos' => 'required|integer|min:0',
            'domicilio' => 'required|string|max:100',
        ];

        $messages = [
            'unique' => 'El campo :attribute debe ser único',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a la actual',
            'required' => 'El campo :attribute es obligatorio.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'min' => 'El campo :attribute debe ser mayor o igual a cero.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'max' => 'El campo :attribute no debe tener más de 100 caracteres.',
            'regex' => 'El formato del campo :attribute no es válido.'
        ];

        $attributes = [
            'nombre_apellidos' => 'nombre completo',
            'dni' => 'DNI',
            'fecha_nacimiento' => 'fecha de nacimiento',
            'numero_celular' => 'celular',
            'domicilio' => 'domicilio',
            'nro_hermanos' => 'número de hermanos'
         ];
        return $this->validate($request, $rules, $messages, $attributes);
   }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $autoridad = session()->get('authUser')->hasAnyRole(['secretario(a)', 'director(a)','admin']);
    
        $aulas = null; 
        $grado = null; 
        $seccion = null;
        
        $search = $request->get('search');

        if ($autoridad){
            $grado = $request->get('grado');
            $grado = $grado != null ? Aula::findOrFail($grado) : Aula::orderBy('grado')->first(); 

            $aulas = Aula::where('eliminado', 0)
                ->orderby('grado')->orderby('seccion')
                ->get();  

            $alumnos = Alumno::join('aulas','aulas.idaula','=','alumnos.idaula')
            ->where('alumnos.eliminado', 0)
            ->where('alumnos.idaula', $grado->idaula)
            ->where('alumnos.nombre_apellidos', 'LIKE', '%' . $search . '%')
            ->orderBy('alumnos.nombre_apellidos')
            ->paginate(30);
            
        }else{
            $alumnos = Alumno::select('alumnos.*', 'aulas.*')->join('aulas','aulas.idaula','=','alumnos.idaula')
            ->join('postulantes','postulantes.idpostulante','=','alumnos.idpostulante')
            ->join('apoderado_postulante','apoderado_postulante.idpostulante','=','postulantes.idpostulante')
            ->join('apoderados','apoderados.idapoderado','=','apoderado_postulante.idapoderado')
            ->where('alumnos.eliminado', 0)
            ->where('apoderados.idusuario', Auth::user()->id)
            ->where('alumnos.nombre_apellidos', 'LIKE', '%' . $search . '%')
            ->orderBy('aulas.grado')
            ->orderBy('aulas.seccion')
            ->orderBy('alumnos.nombre_apellidos')
            ->paginate(30);
        }
      
        return view('admision-matriculas.alumno.index', compact('alumnos', 'aulas', 'grado', 'search'));        
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

          //Parentesco
          $parentescos = ApoderadoPostulante::where('idpostulante', $alumno->idpostulante)
          ->join('apoderados','apoderados.idapoderado','=','apoderado_postulante.idapoderado')
          ->get();
          $postulante = Postulante::findOrFail($alumno->idpostulante);
          $apoderados = Apoderado::where('eliminado','0')->get();

        //Matrícula
        $matricula = Matricula::where('eliminado', 0)->orderBy('idmatricula', 'desc')->first();

        return view('admision-matriculas.alumno.edit',compact('alumno','aulas', 'documentos', 'historial', 'parentescos', 'postulante', 'apoderados', 'matricula'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $data = $this->validateAlumno($request, $id, true);
        } catch(ValidationException $e){
            session()->flash(
                'toast',
                [
                    'message' => $e->getMessage(),
                    'type' => 'error',
                ]
                );
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
        $alumno = Alumno::findOrFail($id);
        // $alumno->update($data);
        
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

        return redirect()->back()->with('datos','updated');
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
        //Resta total de alumnos
        $matricula = Matricula::where('eliminado', 0)->orderBy('idmatricula', 'desc')->first();
        $matricula->total_alumnos--; //total alumnos entre matriculados y no matriculados
        $matricula->save();

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

    public function loadSinglePdf($idaula)
    {
        $aula = Aula::findOrFail($idaula);         
        $alumnos = $aula->alumnos->where('eliminado', 0)->sortBy('nombre_apellidos');
            
        $pdf = Pdf::loadView('admision-matriculas.alumno.pdf.show', compact('aula','alumnos'));
        return $pdf->stream('lista-'.$aula->grado.$aula->seccion.'.pdf');
    }
}
