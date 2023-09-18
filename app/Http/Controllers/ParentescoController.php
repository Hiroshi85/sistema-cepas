<?php

namespace App\Http\Controllers;

use App\Models\ApoderadoPostulante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParentescoController extends Controller
{
    protected function validateFields($request)
    {
        return $this->validate($request, [
 
        ]);
    }
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
        $data = $this->validateFields($request);
       
        $parentesco = new ApoderadoPostulante();
        $parentesco->idpostulante = $request->get('idpostul');
        $parentesco->idapoderado = $request->get('idapoderado');
        $parentesco->parentesco = $request->get('parentesco');
        if ($request->has('convivencia'))
            $parentesco->convivencia = 'si';
        else   
            $parentesco->convivencia = 'no';

        $parentesco->save();

        session()->flash(
            'toast',
            [
                'message' => "Parentesco registrado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $parentesco = ApoderadoPostulante::whereRaw('idpostulante = ? AND idapoderado = ?', [$request->get('idpostul'), $id])->first();
        
        if ($parentesco) {
            $updateData = [
                'parentesco' => $request->get('parentesco'),
                'convivencia' => $request->has('convivencia') ? 'si' : 'no',
            ];
        
            DB::table('apoderado_postulante')
                ->where('idpostulante', $request->get('idpostul'))
                ->where('idapoderado', $id)
                ->update($updateData);
        }

        session()->flash(
            'toast',
            [
                'message' => "Registro actualizado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $parentesco = ApoderadoPostulante::whereRaw('idpostulante = ? AND idapoderado = ?', [$request->get('Parent'), $id]);
        $parentesco->delete();
        session()->flash(
            'toast',
            [
                'message' => "Registro eliminado correctamente",
                'type' => 'success',
            ]
        );
      
        return redirect()->back();
    }
}
