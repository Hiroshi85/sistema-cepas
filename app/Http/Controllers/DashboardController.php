<?php

namespace App\Http\Controllers;

use App\Models\Admision;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $matricula = Matricula::where('eliminado', 0)->orderBy('idmatricula', 'desc')->first();
        $admision = Admision::where('eliminado', 0)->orderBy('idadmision', 'desc')->first();
        return Auth::user()->hasRole('secretario(a)') || Auth::user()->hasRole('admin') ? 
            view('admision-dashboard', compact('matricula', 'admision')) 
                : 
            view('apoderados.index',compact('matricula', 'admision'));
    }
}
