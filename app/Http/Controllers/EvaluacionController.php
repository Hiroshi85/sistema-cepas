<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Evaluacion;

class EvaluacionController extends Controller
{
    //
    public function index($id)
    {
        
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario si es necesario
        $request->validate([
            'namefile' => 'required',
        ]);
        
        if ($request->hasFile('namefile')) {
            $archivo = $request->file('namefile'); // Obtiene el archivo del campo de entrada de archivo
            $rutaDestino = public_path('evaluaciones'); // Define la ruta de la carpeta de destino
            $nombreArchivo = $archivo->getClientOriginalName(); // Obtiene el nombre original del archivo
            $archivo->move($rutaDestino, $nombreArchivo);
        }
        // // Crear una nueva instancia del modelo y asignar los valores

        $evaluacion = new Evaluacion();
        $evaluacion->namefile = $nombreArchivo;
        $evaluacion->idcurso = $request->idcurso;
        $evaluacion->estado = "REGISTRADA";
        // // // Guardar el registro en la base de datos
        $evaluacion->save();

        // // Redireccionar a la página deseada después de guardar los datos
        return redirect()->back()->with('mensaje','Evaluacion cargada correctamente.');
    }

    public function update(Request $request,$id)
    {
        // Validar los datos del formulario si es necesario
        $request->validate([
            'namefile' => 'required',
        ]);

        if ($request->hasFile('namefile')) {
            $archivo = $request->file('namefile'); // Obtiene el archivo del campo de entrada de archivo
            $rutaDestino = public_path('evaluaciones'); // Define la ruta de la carpeta de destino
            $nombreArchivo = $archivo->getClientOriginalName(); // Obtiene el nombre original del archivo
            $archivo->move($rutaDestino, $nombreArchivo);
        }

        $evaluacion = evaluacion::findOrFail($id);
        $evaluacion->namefile = $nombreArchivo;
        $evaluacion->idcurso = $request->idcurso;
        // // Guardar el registro en la base de datos
        $evaluacion->save();

        // Redireccionar a la página deseada después de guardar los datos
        return redirect()->back()->with('mensaje','Evaluacion actualizada correctamente.');
    }

    public function destroy($id)
    {
        $evaluacion = Evaluacion::findOrFail($id); // Encuentra el usuario por su ID
        $evaluacion->delete(); // Elimina el usuario
        return redirect()->back()->with('mensaje','Evaluacion eliminada correctamente.');
    }
    
}
