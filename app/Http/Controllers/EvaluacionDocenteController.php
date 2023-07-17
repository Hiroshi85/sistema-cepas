<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\CursoAsignado;
use App\Models\Docente;
use App\Models\Aula;
use App\Models\Silabo;
use App\Models\Evaluacion;
use App\Models\EvaluacionDocente;

class EvaluacionDocenteController extends Controller
{
    //
    const PAGINATION=10;

    public function mostrardocentes()
    {
        $evadoc=EvaluacionDocente::all();
        return view('docente.evaluaciones',compact('evadoc'));
    }
 
    public function update(Request $request,$id)
    {
      
        // Validar los datos del formulario si es necesario
        $request->validate([
            'calificacion' => 'required',
            'retroalimentacion' => 'required',
        ]);

        // Crear una nueva instancia del modelo y asignar los valores
        $eva = EvaluacionDocente::findOrFail($id);
        $eva->calificacion = $request->calificacion;
        $eva->retroalimentacion = $request->retroalimentacion;
        //$curso->estado = 1;

        // Guardar el registro en la base de datos
        $eva->save();

        //Redireccionar a la página deseada después de guardar los datos
        return redirect()->route('evaluardocentes')->with('mensaje','Evaluacion se actualizó correctamente.');
    }
  

}
