<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SeguimientoDashboard extends Controller
{
    public function index(){

        $citasHoy = Cita::getCitasHoy(Auth::id());
        $citasSemana = Cita::getCitasSemana(Auth::id());
        return view('seguimiento-dashboard', ['citasHoy' => $citasHoy, 'citasSemana' => $citasSemana]);
    }
}
