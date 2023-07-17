<?php

namespace App\Http\Controllers;

use App\Models\DocumentoApoderado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentoApoderadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     
        $documento = new DocumentoApoderado();
        $documento->idapoderado = $request->get('idapoderado');
        $documento->descripcion = $request->get('descripcion');
        $documento->fecha_registro = now('America/Lima')->toDateString();
        // $documento->observacion = $request->get('observacion');
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = "assets/img/docs/";
            $time = time().'-'.$file->getClientOriginalName();
            $upload = $request->file('imagen')->move($path, $time);
            $documento->imagen = $path.$time;
        }

        $documento->estado = "Registrado";
        $documento->save();

        session()->flash(
            'toast',
            [
                'message' => "Documento registrado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->back()->with('datos','stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentoApoderado $documentoApoderado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentoApoderado $documentoApoderado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      
        $data= request()->validate([
             
        ],[
            
        ]);
        $documento = DocumentoApoderado::findOrFail($id);
        
        $documento->descripcion = $request->get('descripcion');
        
        
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = "assets/img/docs/";
            $time = time().'-'.$file->getClientOriginalName();
            $upload = $request->file('imagen')->move($path, $time);
            $documento->imagen = $path.$time;
            $documento->fecha_registro = now('America/Lima')->toDateString();
        }
        if(Auth::user()->hasRole('secretario(a)') || Auth::user()->hasRole('admin')){
            $documento->estado = $request->get('estado');
            $documento->observacion = $request->get('observacion');
        }
        $documento->save();

        session()->flash(
            'toast',
            [
                'message' => "Documento actualizado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->back()->with('datos','updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req, $id)
    {
        $document = DocumentoApoderado::findOrFail($id);
        $document->delete();

        session()->flash(
            'toast',
            [
                'message' => "Documento eliminado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->back()->with('datos','deleted');
    }
}
