<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\SesionPrueba;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SeguimientoDashboard extends Controller
{
    public function index(){

        $citasHoy = Cita::getCitasHoy(Auth::id());
        $citasSemana = Cita::getCitasSemana(Auth::id());
        $sesionesFaltantes = SesionPrueba::listarSesionesNoCompletadas();
        foreach($sesionesFaltantes as &$sesion){
            $sesion->total = $sesion->total_no_evaluados+$sesion->total_evaluados;
            $sesion->progresoPorcentaje = round($sesion->total_evaluados*100/$sesion->total, 2);
        }

        unset($sesion);
        return view('seguimiento-dashboard', ['citasHoy' => $citasHoy, 'citasSemana' => $citasSemana, 'sesiones'=>$sesionesFaltantes]);
    }
}
