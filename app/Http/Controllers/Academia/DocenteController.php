<?php

namespace App\Http\Controllers\Academia;

use App\Http\Controllers\Controller;
use App\Http\Requests\Academia\DocenteEditRequest;
use App\Models\Academia\CicloAcademico;
use App\Models\Academia\Cursos\Carrera;
use App\Models\Academia\DocenteAcademia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('academia.docentes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carreras = Carrera::all();
        return view('academia.docentes.create', compact('carreras'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(DocenteAcademia $docente)
    {
        $carreras = Carrera::all();
        return view('academia.docentes.edit', compact('carreras', 'docente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DocenteEditRequest $request, DocenteAcademia $docente)
    {
        $docente->update(
            [
                'especialidad_id' => $request->idcarrera,
            ]
        );
        return redirect()->route('academia.docente.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
