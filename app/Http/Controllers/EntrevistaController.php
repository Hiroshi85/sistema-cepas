<?php

namespace App\Http\Controllers;

use App\Models\Admision;
use App\Models\Alumno;
use App\Models\Entrevista;
use App\Models\Postulante;
use App\Models\PostulanteAdmision;
use DateTime;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;

class EntrevistaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:secretario(a)|admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $year = date('Y');
        //Where postulantes.eliminado = 0 and entrevistas.eliminado = 0
        $entrevistas = Entrevista::select('postulantes.nombre_apellidos', 'entrevistas.*')
            ->join('postulantes', 'postulantes.idpostulante', '=', 'entrevistas.idpostulante')
            ->where('postulantes.eliminado', 0)
            ->whereNot('entrevistas.estado', 'Evaluada')
            ->whereDate('fecha', '>=', now()->toDateString()) //  de hoy en adelante
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();


        $postulantes = Postulante::select('postulantes.*')
            ->leftJoin('entrevistas', 'postulantes.idpostulante', '=', 'entrevistas.idpostulante')
            ->where('postulantes.estado', 'Pendiente')
            ->where('postulantes.eliminado', 0)
            ->where(function ($query) {
                $query->where('entrevistas.idpostulante', null)
                    ->orWhereNot('entrevistas.estado', 'Programada')
                    ->whereNot('entrevistas.resultado', 'Aprobado');
            })
            ->whereRaw("YEAR(fecha_postulacion) = {$year}")
            ->get();

        return view('entrevista.index', compact('entrevistas', 'postulantes'));
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
        $data = request()->validate([], []);

        $postulantes = $request->input('postulantes');

        // protected $fillable = ['idpostulante', 'idapoderado', 'fecha', 'hora', 'resultado', 'estado', 'eliminado'];
        $hora = DateTime::createFromFormat('H:i', $request->get('hora'));

        foreach ($postulantes as $postulante) {
            $entrevista  = new Entrevista();
            $entrevista->idpostulante = $postulante;
            $entrevista->fecha = $request->get('fecha');
            $entrevista->hora = $hora->format('H:i');
            $entrevista->estado = "Programada";
            $entrevista->save();
            $hora->modify('+' . $request->get('tiempo') . ' minutes'); //Sumarle el tiempo en minutos a la hora 
        }

        session()->flash(
            'toast',
            [
                'message' => "Entrevistas programadas correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('entrevista.index')->with('datos', 'stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrevista $entrevista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrevista $entrevista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $entrevista  = Entrevista::findOrFail($id);
        //$entrevista->idpostulante = $request->get('postulante');

        $entrevista->fecha = $request->get('fecha');
        $entrevista->hora = $request->get('hora');
        $entrevista->estado = $request->get('estado');
        $entrevista->resultado = $request->get('resultado');
        $entrevista->save();

        $postulante = Postulante::findOrFail($entrevista->idpostulante);
        if($request->get('estado') == "Evaluada"){
             if ($entrevista->resultado == "Aprobado") {
                //Actualizar postulante aceptado
                $postulante->estado = "Aceptado";
                $postulante->save();
                $this->createAlumno($postulante);
            }else{
                $postulante->estado = "Rechazado";
                $postulante->save();
            }
            $this->registrarHistoriaPostulacion($postulante);
        }

        session()->flash(
            'toast',
            [
                'message' => "Entrevista actualizada correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('entrevista.index')->with('datos', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $entrevista = Entrevista::findOrFail($id);
        $entrevista->delete();

        session()->flash(
            'toast',
            [
                'message' => "Entrevista eliminada correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('entrevista.index')->with('datos', 'deleted');
    }

    protected function createAlumno($postulante){
       
        $alumno = Alumno::where('idpostulante',$postulante->idpostulante)->first(); 
              
        if( $alumno != null) return;
       
        $alumno = new Alumno();
        $alumno->idpostulante = $postulante->idpostulante;
        $alumno->idaula = $postulante->idaula;
        $alumno->nombre_apellidos = $postulante->nombre_apellidos;
        $alumno->fecha_nacimiento = $postulante->fecha_nacimiento;
        $alumno->dni = $postulante->dni;
        $alumno->domicilio = $postulante->domicilio;
        $alumno->numero_celular = $postulante->numero_celular;
        $alumno->nro_hermanos = $postulante->nro_hermanos;
        $alumno->estado = "No matriculado";
        $alumno->save();


        \App\Models\User::factory()->create([
            'name' => $postulante->nombre_apellidos,
             'dni' => $postulante->dni,
             'email' => 'a'. $postulante->dni . '@gmail.com',
             'password' => bcrypt('password'),
        ])->assignRole('Alumno');
    }

    protected function registrarHistoriaPostulacion($postulante){
        $admision = Admision::where('eliminado', 0)->orderBy('idadmision', 'desc')->first();
        //if it is registered return
        if (
            PostulanteAdmision::where('idpostulante', $postulante->idpostulante)
            ->where('idadmision', $admision->idadmision)
            ->first() != null            
        ) return;
      
        $postulante_admision = new PostulanteAdmision();
        $postulante_admision->idpostulante = $postulante->idpostulante;
        $postulante_admision->idadmision = $admision->idadmision;
        $postulante_admision->fecha_registro = now('America/Lima')->toDateString();
        $postulante_admision->resultado = $postulante->estado;
        $postulante_admision->save();
    }
}
