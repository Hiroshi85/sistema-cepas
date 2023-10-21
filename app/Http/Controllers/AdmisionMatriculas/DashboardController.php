<?php

namespace App\Http\Controllers\AdmisionMatriculas;

use App\Http\Controllers\Controller;
use App\Models\Admision;
use App\Models\Alumno;
use App\Models\AlumnoMatricula;
use App\Models\Aula;
use App\Models\Entrevista;
use App\Models\Matricula;
use App\Models\Postulante;
use App\Models\PostulanteAdmision;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $matricula = Matricula::where('eliminado', 0)->orderBy('idmatricula', 'desc')->first();
        $admision = Admision::where('eliminado', 0)->orderBy('idadmision', 'desc')->first();
        // if matricula cierre == now america latina then close matricula
        if ($matricula != null)
            if ($matricula->fecha_cierre < now('America/Lima')->format('Y-m-d')) {
                $matricula->estado = "Cerrada";
                $matricula->save();
            }

        if ($admision != null)
            if ($admision->fecha_cierre < now('America/Lima')->format('Y-m-d')) {
                $admision->estado = "Cerrada";
                $admision->save();
            }
        


        //Calendario de entrevistas
        
        $entrevistas = Entrevista::select('postulantes.*', 'entrevistas.*')
            ->join('postulantes', 'postulantes.idpostulante', '=', 'entrevistas.idpostulante')
            ->where('postulantes.eliminado', 0)
            ->whereNot('entrevistas.estado', 'Evaluada')
            ->whereDate('fecha', '>=', now()->toDateString()) //  de hoy en adelante
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();
        
        $events = null;

        foreach ($entrevistas as $entrevista) {
            $events[] = [
                'title' => $entrevista->nombre_apellidos . ' (Cel. '.$entrevista->numero_celular.')',
                'start' => $entrevista->fecha . ' ' . $entrevista->hora,
                'description' => $entrevista
            ];
        }
        // Estadísticas - estudiantes matriculados
        $idaulaSelected = $request->get('idaula');
        $aulas = Aula::where('eliminado', 0)->orderBy('grado')->orderBy('seccion')->get();

        $alumnos = $idaulaSelected != null && $idaulaSelected != 0 ? Alumno::where('eliminado',0)
            ->where('idaula', $idaulaSelected) 
            ->get() : Alumno::where('eliminado',0)->get();
        // ------------------ 

        return session()->get('authUser')->hasAnyRole(['secretario(a)', 'admin']) ? 
            view('admision-dashboard', compact('matricula', 'admision', 'events', 'aulas', 'alumnos', 'idaulaSelected')) 
                : 
            view('admision-matriculas.apoderados.index',compact('matricula', 'admision'));
    }

    public function seriesMatriculados(Request $request){
        $id = $request->get('idaula');
        $alumnos = $id != null && $id != 0 ? Alumno::where('eliminado',0)
            ->where('idaula', $id) 
            ->get() : Alumno::where('eliminado',0)->get();
        $total = $alumnos->count();
        $matriculados = $alumnos->where('estado', 'Matriculado')->count();
        return response()->json([
            'total' => $total,
            'matriculados' => $matriculados,
            'porcentaje' => round($matriculados/$total*100 ,0),
            'idaula' => $id
        ]);
    }

    public function seriesAvancePagos(){
        $admisiones = Admision::where('eliminado', 0)->orderBy('año', 'desc')->get();        
        $matriculas = Matricula::where('eliminado', 0)->orderBy('año', 'desc')->get();
    
        $dataAdmisiones = [];
        foreach ($admisiones as $admision) {
            $pagadosPorAdmision = $admision->postulante_admisiones()->whereNot('resultado','En postulación')->count() * $admision->tarifa;
            $esperadoAdmision = $admision->postulante_admisiones()->count() * $admision->tarifa;
            $dataAdmisiones[] = 
                [
                    'x' => $admision->año,
                    'y' => $pagadosPorAdmision,
                    'goals' => [
                        [
                            'name' => 'Objetivo',
                            'value' => $esperadoAdmision,
                            'strokeWidth' => 5,
                            'strokeColor' => "#FFC964"
                        ]
                    ]
                ];
        }
        $dataMatriculas = []; 
        foreach ($matriculas as $matricula) {
            $pagadosPorMatricula = $matricula->alumno_matriculas()->count() * $matricula->tarifa;
            $esperadoMatriculas = $matricula->total_alumnos * $matricula->tarifa;
            $dataMatriculas[] = 
                [
                    'x' => $matricula->año,
                    'y' => $pagadosPorMatricula,
                    'goals' => [
                        [
                            'name' => 'Objetivo',
                            'value' => $esperadoMatriculas,
                            'strokeWidth' => 5,
                            'strokeColor' => "#FFC964"
                        ]
                    ]
                ];
        }   
        $series = [
            [
                'name' => 'Pagos por admisión',
                'data' => $dataAdmisiones
            ],[
                'name' => 'Pagos por matrículas',
                'data' => $dataMatriculas
            ]
        ];
        return response()->json([
            'series' => $series
        ]);
    }
}
