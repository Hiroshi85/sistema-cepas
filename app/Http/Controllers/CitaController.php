<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Apoderado;
use App\Models\ApoderadoPostulante;
use Illuminate\Http\Request;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class CitaController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:auxiliar|psicologo|admin');
    }

    private array $ESTADOS = ['programado', 'realizado', 'cancelado', 'ausentado'];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        if(Auth::user()->hasRole('admin')){
            $id = 0;
        }
        $citas = Cita::listarCitas($id);
        return view('citas.index', ['citas' => $citas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('citas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $idalumno = $request->input('alumno');
        $alumno = Alumno::getAlumnoById($idalumno);
        $apoderado = ApoderadoPostulante::getItemPorIdPostulante($alumno->idpostulante)->idapoderado;
        $citador = Auth::user()->id;
        $fecha = $request->input('date');

        $motivo = $request->input('motivo');
        $horaInicio = $request->input('horaInicio');
        $duracion = $request->input('duracion');
        // dd($duracion);

        $fechaHoraIniTemp = $fecha . ' ' . $horaInicio;
        $fechaHoraInicio = Carbon::parse($fechaHoraIniTemp);
        $fechaHoraFin = Carbon::parse($fechaHoraIniTemp)->addMinutes($duracion);
        // dd(['inicio'=> $fechaHoraInicio, 'fin' => $fechaHoraFin]);

        $hayChoque = $this->validarHoraNuevaCita($fechaHoraInicio, $fechaHoraFin);
        if($hayChoque){
            return redirect()->route('citas.create')->with('error', 'Ya existe una cita en ese horario o hay cruce de horarios');
        }
        // dd($hayChoque);

        $cita = Cita::crearCita($idalumno, $apoderado, $citador, $motivo, $fechaHoraInicio, $fechaHoraFin, $duracion);

        return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente');
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
        $cita = Cita::getCitaById($id);
        return view('citas.edit', ['cita' => $cita, "estados" => $this->ESTADOS]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $cita = Cita::getCitaById($id);
        $fecha = $request->input('date');
        $motivo = $request->input('motivo');
        $horaInicio = $request->input('horaInicio');
        $duracion = $request->input('duracion');
        $estado = $request->input('estado');
        if(!in_array($estado, $this->ESTADOS)){
            $estado = $this->ESTADOS[0];
        }
        $fechaHoraIniTemp = $fecha . ' ' . $horaInicio;
        $fechaHoraInicio = Carbon::parse($fechaHoraIniTemp);
        $fechaHoraFin = Carbon::parse($fechaHoraIniTemp)->addMinutes($duracion);

        $hayChoque = $this->validarHoraNuevaCita($fechaHoraInicio, $fechaHoraFin, true, $id);
        if($hayChoque){
            return redirect()->route('citas.edit', $id)->with('error', 'Ya existe una cita en ese horario o hay cruce de horarios');
        }

        Cita::actualizarCita($id, $cita->alumno_id, $cita->apoderado_id, $cita->citador_id, $motivo, $estado, $fechaHoraInicio, $fechaHoraFin, $duracion);
        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $citador_id = Auth::user()->id;
        $cita = Cita::getCitaById($id);
        if(!Auth::user()->hasRole('admin') && $cita->citador_id != $citador_id){
            return redirect()->route('citas.index')->with('error', 'No puedes eliminar cita');
        }

        Cita::eliminarCita($id);
        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente');
    }

    public function getAlumnoApoderado(Request $request){
        $id = $request->query('alumno');
        $alumno = Alumno::getAlumnoById($id);
        $postulante = ApoderadoPostulante::getItemPorIdPostulante($alumno->idpostulante);

        $apoderado = Apoderado::getApoderadoById($postulante->idapoderado);
        return [
            'alumno' => $alumno,
            'apoderado' => $apoderado
        ];
    }

    private function validarHoraNuevaCita($fechaHoraInicio, $fechaHoraFin, $isUpdate = false, $cita_id = null) {
        // Filtrar las citas del mismo día
        $id = Auth::user()->id;
        $citas = Cita::listarCitas($id);

        $citasHoy = [];
        $hoy = Carbon::now();
        foreach($citas as $it){
            if($isUpdate){
                if($it->fechaHoraInicio->isSameDay($hoy) && $it->id != $cita_id && $it->estado != 'cancelado')
                array_push($citasHoy, $it);
            }else{
                if($it->fechaHoraInicio->isSameDay($hoy) && $it->estado != 'cancelado')
                array_push($citasHoy, $it);
            }
        }


        $hayChoque = false;
        foreach($citasHoy as $it){
            if(($fechaHoraInicio >= $it->fechaHoraInicio && $fechaHoraInicio < $it->fechaHoraFin) ||
               ($fechaHoraFin > $it->fechaHoraInicio && $fechaHoraFin <= $it->fechaHoraFin) ||
               ($fechaHoraInicio <= $it->fechaHoraInicio && $fechaHoraFin >= $it->fechaHoraFin)){
                $hayChoque = true;
                break;
            }
        }
        return $hayChoque;
      }
}
