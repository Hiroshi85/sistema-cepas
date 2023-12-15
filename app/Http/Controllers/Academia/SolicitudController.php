<?php

namespace App\Http\Controllers\Academia;

use App\Http\Controllers\Controller;
use App\Http\Requests\Academia\SolicitudAccionRequest;
use App\Http\Requests\Academia\SolicitudRequest;
use App\Models\Academia\CicloAcademico;
use App\Models\Academia\DocumentoSolicitud;
use App\Models\Academia\Solicitud;
use App\Services\Academia\CarreraService;
use App\Services\Academia\SolicitudService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CicloAcademico $ciclo)
    {
        return view('academia.solicitud.index', compact('ciclo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CicloAcademico $ciclo, SolicitudService $solicitudService, CarreraService $carreraService)
    {
        $alumnos = $solicitudService->GetAlumnosThatNotHaveRequest($ciclo);

        $carreras = $carreraService->GetCarreras();

        return view('academia.solicitud.create',[
            'alumnos' => $alumnos,
            'carreras' => $carreras,
            'ciclo' => $ciclo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SolicitudRequest $request, CicloAcademico $ciclo, SolicitudService $solicitudService)
    {
        $validated = $request->validated();

        Log::debug($validated);

        $solicitudService->create($validated, $ciclo);

        session()->flash(
            'toast',
            [
                'message' => "Registro creado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('academia.ciclo.solicitud.index', $ciclo);

    }

    /**
     * Display the specified resource.
     */
    public function show(CicloAcademico $ciclo, Solicitud $solicitud)
    {
        return view('academia.solicitud.show',[
            'solicitud' => $solicitud,
            'ciclo' => $ciclo
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function accionSolicitud(SolicitudAccionRequest $request, CicloAcademico $ciclo, Solicitud $solicitud, SolicitudService $solicitudService)
    {
        $request->validated();

        $solicitudService->handleAction($request, $solicitud);

        $estado = $request->accion == 'aceptar' ? 'aceptado' : 'rechazado';

        session()->flash(
            'toast',
            [
                'message' => "Solicitud {$estado} correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->back();
    }
}
