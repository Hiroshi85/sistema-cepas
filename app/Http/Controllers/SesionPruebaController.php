<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesionPrueba;

class SesionPruebaController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('role:psicologo|admin');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sesiones = SesionPrueba::listarSesiones();
        return view('sesiones.index', ['sesiones' => $sesiones]);
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
        //
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
