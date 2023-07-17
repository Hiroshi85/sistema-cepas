<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aulas = Aula::where('eliminado', 0)->orderBy('grado')->orderBy('seccion')->get();
        return view ('aula.index', compact('aulas'));
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
        $data= request()->validate([
            
        ],[
           
        ]);

        $aula = new Aula();
        //grado	seccion	nro_vacantes_total	nro_vacantes_disponibles	eliminado	
        $aula->grado = $request->get('grado');
        $aula->seccion = $request->get('seccion');
        $aula->nro_vacantes_total = $request->get('vacantes');
        $aula->nro_vacantes_disponibles = $request->get('vacantes');
        $aula->eliminado = 0;
        $aula->save();

        return redirect()->route('aula.index')->with('datos','stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aula $aula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $aula = Aula::findOrFail($id);
        return view('aula.edit',compact('aula'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data= request()->validate([
           
        ],[
          
        ]);

        $aula = Aula::findOrFail($id);
        $aula->grado = $request->get('grado');
        $aula->seccion = $request->get('seccion');
        $aula->nro_vacantes_total = $request->get('nro_vacantes_total');
        $aula->nro_vacantes_disponibles = $request->get('nro_vacantes_disponibles');
        $aula->save();

        session()->flash(
            'toast',
            [
                'message' => "Registro actualizado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('aula.index')->with('datos','updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idapoderado)
    {
        $aula = Aula::findOrFail($idapoderado);
        $aula->eliminado = 1;
        $aula->save();
        return redirect()->route('aula.index')->with('datos','deleted');
    }
}
