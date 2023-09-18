<?php

namespace App\Http\Controllers\Academia;

use App\Http\Controllers\Controller;
use App\Models\Academia\Cursos\Carrera;
use App\Models\Academia\Solicitud;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('academia.solicitud.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alumnos = Alumno::where('alumnos.eliminado', 0)
                    ->whereNotIn('alumnos.idalumno', function($query) {
                        $query->select('solicitud_academia.idalumno')
                            ->from('solicitud_academia')
                            ->whereRaw('solicitud_academia.idalumno = alumnos.idalumno');
                    })
                    ->orderBy('alumnos.nombre_apellidos')
                    ->get();

        $carreras = Carrera::where('eliminado', 0)
                            ->with('facultad')
                            ->with('area')
                            // ->orderBy('area.nombre')
                            ->get();
        return view('academia.solicitud.create',[
            'alumnos' => $alumnos,
            'carreras' => $carreras,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idalumno' => 'required|integer|exists:alumnos,idalumno',
        ],[
            'idalumno.required' => 'Seleccione un alumno',
            'idalumno.integer' => 'Seleccione un alumno',
            'idalumno.exists' => 'El alumno no existe',
        ]);

        $solicitud = Solicitud::create([
            'idalumno' => $request->idalumno,
            'observaciones' => $request->observaciones,
            'fecha_solicitud' => date('Y-m-d'),
            'estado' => 'Pendiente'
        ]);

        session()->flash(
            'toast',
            [
                'message' => "Registro creado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('solicitud.index');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
