<?php

namespace App\Http\Controllers\Academia;

use App\Http\Controllers\Controller;
use App\Models\Academia\Cursos\Carrera;
use App\Models\Academia\DocumentoSolicitud;
use App\Models\Academia\Solicitud;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            'idcarrera' => 'required|integer|exists:carreras_unt,id',
        ],[
            'idalumno.required' => 'Seleccione un alumno',
            'idalumno.integer' => 'Seleccione un alumno',
            'idalumno.exists' => 'El alumno no existe',
            'idcarrera.required' => 'Seleccione una carrera',
            'idcarrera.integer' => 'Seleccione una carrera',
            'idcarrera.exists' => 'La carrera no existe',
        ]);

        $solicitud = Solicitud::create([
            'idalumno' => $request->idalumno,
            'observaciones' => $request->observaciones,
            'fecha_solicitud' => date('Y-m-d'),
            'estado' => 'Pendiente',
            'idcarrera' => $request->idcarrera,
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
        $solicitud = Solicitud::findOrFail($id);
        return view('academia.solicitud.show',[
            'solicitud' => $solicitud,
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

    public function accionSolicitud(string $id, Request $request)
    {
        Log::debug($request->all());
        $request->validate([
            'accion' => 'required|in:aceptar,rechazar',
        ],[
            'accion.required' => 'Seleccione una acción',
            'accion.in' => 'Seleccione una acción',
        ]);

        $solicitud = Solicitud::findOrFail($id);

        $estado = $request->accion == 'aceptar' ? 'aceptado' : 'rechazado';

        DocumentoSolicitud::create([
            'estado' => $estado,
            'idsolicitud' => $solicitud->id,
            'observaciones' => $request->observaciones,
        ]);

        $solicitud->estado = $estado;
        $solicitud->save();

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
