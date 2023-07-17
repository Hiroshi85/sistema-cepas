<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Silabo;
use App\Models\Evaluacion;

class SilaboController extends Controller
{
    //
    public function index($id)
    {
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'namefile' => 'required',
        ]);
        
        if ($request->hasFile('namefile')) {
            $archivo = $request->file('namefile'); // Obtiene el archivo del campo de entrada de archivo
            $rutaDestino = public_path('archivos'); // Define la ruta de la carpeta de destino
            $nombreArchivo = $archivo->getClientOriginalName(); // Obtiene el nombre original del archivo
            $archivo->move($rutaDestino, $nombreArchivo);
        }
        // // Crear una nueva instancia del modelo y asignar los valores

        $silabo = new Silabo();
        $silabo->namefile = $nombreArchivo;
        $silabo->idcurso = $request->idcurso;
        $silabo->estado = "REGISTRADO";
        // // // Guardar el registro en la base de datos
        $silabo->save();

        // // Redireccionar a la página deseada después de guardar los datos
        return redirect()->back()->with('mensaje','Silabo cargado correctamente.');
    }

    public function update(Request $request,$id)
    {
        // Validar los datos del formulario si es necesario
        $request->validate([
            'namefile' => 'required',
        ]);

        if ($request->hasFile('namefile')) {
            $archivo = $request->file('namefile'); // Obtiene el archivo del campo de entrada de archivo
            $rutaDestino = public_path('archivos'); // Define la ruta de la carpeta de destino
            $nombreArchivo = $archivo->getClientOriginalName(); // Obtiene el nombre original del archivo
            $archivo->move($rutaDestino, $nombreArchivo);
        }

        $silabo = Silabo::findOrFail($id);
        $silabo->namefile = $nombreArchivo;
        $silabo->idcurso = $request->idcurso;
        // // Guardar el registro en la base de datos
        $silabo->save();

        // Redireccionar a la página deseada después de guardar los datos
        return redirect()->back()->with('mensaje','Silabo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $silabo = Silabo::findOrFail($id); // Encuentra el usuario por su ID
        $silabo->delete(); // Elimina el usuario
        return redirect()->back()->with('mensaje','Silabo eliminado correctamente.');
    }

    public function mostrardocs()
    {
        $silabos = Silabo::all(); 
        $evaluaciones = Evaluacion::all(); 
        return view('sil-eva.aprobar',compact('silabos','evaluaciones'));
    }
    
}
