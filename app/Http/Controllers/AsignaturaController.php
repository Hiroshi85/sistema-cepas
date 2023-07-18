<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;
use App\Models\CursoAsignado;
use App\Models\Aula;
use App\Models\Empleado;
use App\Models\Silabo;
use App\Models\Evaluacion;

class AsignaturaController extends Controller
{
    const PAGINATION=10;

    public function index(Request $request)
    {
        $buscarpor=$request->get('buscarpor');
        $cursos=Asignatura::where('nombre','like','%'.$buscarpor.'%')->paginate($this::PAGINATION);
        return view('cursos.index',compact('cursos','buscarpor'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario si es necesario
        $request->validate([
            'nombre' => 'required',
        ]);

        // Crear una nueva instancia del modelo y asignar los valores
        $curso = new Asignatura();
        $curso->nombre = $request->nombre;
        $curso->estado = 1;

        // Guardar el registro en la base de datos
        $curso->save();

        // Redireccionar a la página deseada después de guardar los datos
        return redirect()->route('cursos.index')->with('mensaje','Curso registrado correctamente.');
    }
 
    public function destroy($id)
    {
        $curso=Asignatura::findorfail($id);
        $curso->estado='0';
        $curso->save();
        return redirect()->route('cursos.index')->with('datos','Curso eliminado');
    }

    public function update(Request $request,$id)
    {
        // Validar los datos del formulario si es necesario
        $request->validate([
            'nombre' => 'required',
        ]);

        // Crear una nueva instancia del modelo y asignar los valores
        $curso = Asignatura::findorfail($id);
        $curso->nombre = $request->nombre;
        //$curso->estado = 1;

        // Guardar el registro en la base de datos
        $curso->save();

        // Redireccionar a la página deseada después de guardar los datos
        return redirect()->route('cursos.index')->with('mensaje','El curso se actualizó correctamente.');
    }

    public function show($id)
    {
        //
    }

    public function indexasignar()
    {
        $asignados=CursoAsignado::where('estado','=','1')->paginate($this::PAGINATION);
        $cursos=Asignatura::all();
        $aulas=Aula::where('eliminado','=',0)->get();
        $docentes=Empleado::where('esDocente','=','1')->get();
        return view('cursos.asignar',compact('asignados','aulas','docentes','cursos'));
    }

    public function storeasignar(Request $request)
    {
        // Validar los datos del formulario si es necesario

        $request->validate([
            'idcurso' => 'required',
            'idaula' => 'required',
            'iddocente' => 'required',
            'horario' => 'required',
        ]);
    
        // Crear una nueva instancia del modelo y asignar los valores
        $curso = new CursoAsignado();
        $curso->idcurso = $request->idcurso;
        $curso->idaula = $request->idaula;
        $curso->iddocente = $request->iddocente;
        $curso->horario = $request->horario;
        $curso->estado = 1;

        // Guardar el registro en la base de datos
        $curso->save();

        // Redireccionar a la página deseada después de guardar los datos
        return redirect()->route('asignar')->with('mensaje','Curso asignado correctamente.');
    }

    public function miscursosprofesor($id)
    {
        $doc = Empleado::where('dni','=',$id)->first();
        // $doc = Empleado::where('dni','=',37773668)->first();
        $miscursos=CursoAsignado::where('iddocente','=',$doc->id)->get();
        return view('cursos.miscursos',compact('miscursos'));
    }

    public function micurso($id)
    {
        $c=CursoAsignado::findOrFail($id);
        $silabo=Silabo::where('idcurso','=',$id)->get();
        $evaluaciones=Evaluacion::where('idcurso','=',$id)->get();
        return view('cursos.micurso',compact('c','silabo','evaluaciones'));
    }
}
