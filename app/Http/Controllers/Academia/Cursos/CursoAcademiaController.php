<?php

namespace App\Http\Controllers\Academia\Cursos;

use App\Http\Controllers\Controller;
use App\Models\Academia\Cursos\Area;
use App\Models\Academia\Cursos\CursoAcademia;
use Illuminate\Http\Request;

class CursoAcademiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = CursoAcademia::all();
        return view('academia.cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::all();
        return view('academia.cursos.create', compact('areas'));
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
