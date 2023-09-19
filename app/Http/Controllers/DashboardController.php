<?php

namespace App\Http\Controllers;

use App\Models\Admision;
use App\Models\Entrevista;
use App\Models\Matricula;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $matricula = Matricula::where('eliminado', 0)->orderBy('idmatricula', 'desc')->first();
        $admision = Admision::where('eliminado', 0)->orderBy('idadmision', 'desc')->first();
        // if matricula cierre == now america latina then close matricula
        if ($matricula->fecha_cierre < now('America/Lima')->format('Y-m-d')) {
            $matricula->estado = "Cerrada";
            $matricula->save();
        }

        if ($admision->fecha_cierre < now('America/Lima')->format('Y-m-d')) {
            $matricula->estado = "Cerrada";
            $matricula->save();
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

        foreach ($entrevistas as $entrevista) {
            $events[] = [
                'title' => $entrevista->nombre_apellidos . ' (Cel. '.$entrevista->numero_celular.')',
                'start' => $entrevista->fecha . ' ' . $entrevista->hora,
            ];
        }

        //dd($events);
        
        return Auth::user()->hasRole('secretario(a)') || Auth::user()->hasRole('admin') ? 
            view('admision-dashboard', compact('matricula', 'admision', 'events')) 
                : 
            view('apoderados.index',compact('matricula', 'admision'));
    }
}
