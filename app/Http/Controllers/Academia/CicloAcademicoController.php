<?php

namespace App\Http\Controllers\Academia;

use App\Http\Controllers\Controller;
use App\Http\Requests\Academia\CicloAcademicoRequest;
use App\Models\Academia\CicloAcademico;
use App\Services\Academia\CicloAcademicoService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CicloAcademicoController extends Controller
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
    public function store(CicloAcademicoRequest $request, CicloAcademicoService $cicloAcademicoService)
    {
        $validated = $request->validated();

        try {
            $cicloAcademicoService->create($validated);
            return redirect()->route('academia.dashboard')->with('success', 'Ciclo académico creado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al crear el ciclo académico');
        }
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
    public function update(CicloAcademicoRequest $request, CicloAcademico $ciclo, CicloAcademicoService $cicloAcademicoService)
    {
        $validated = $request->validated();

        try {
            $cicloAcademicoService->edit($ciclo->id, $validated);
            session()->flash(
                'toast',
                [
                    'message' => "Ciclo creado correctamente",
                    'type' => 'success',
                ]
            );

            return redirect()->route('academia.dashboard');
        } catch (\Exception $e) {
            Log::debug($e);

            session()->flash(
                'toast', [
                    'message' => "Ha ocurrido un error",
                    'type' => "error",
                ]
            );

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function loadSinglePdf($idciclo)
    {
        $ciclo = CicloAcademico::findOrFail($idciclo);         
        //  dd($ciclo->alumnos[0]->alumno->nombre_apellidos);
        $alumnos = $ciclo->alumnos->where('eliminado', 0)->sortBy('alumno.nombre_apellidos');

        $pdf = Pdf::loadView('academia.alumnos.pdf.show', compact('ciclo', 'alumnos'));
        return $pdf->stream('lista-'.$ciclo->nombre.'.pdf');
    }

}
