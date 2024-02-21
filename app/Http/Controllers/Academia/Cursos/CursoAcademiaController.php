<?php

namespace App\Http\Controllers\Academia\Cursos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Academia\Curso\CursoCreateRequest;
use App\Models\Academia\Cursos\Area;
use App\Models\Academia\Cursos\CursoAcademia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
    public function store(CursoCreateRequest $request)
    {
        try{
            DB::beginTransaction();

            $curso = CursoAcademia::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);

            $curso->areas()->attach($request->areas);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();

            session()->flash(
                'toast',
                [
                  'message' => $e->getMessage(),
                  'type' => 'error',
                ]
            );
            return back()->withInput();
        }

        session()->flash(
            'toast',
            [
                'message' => "Curso registrado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('academia.cursos.index');

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
    public function edit(CursoAcademia $curso)
    {
        $areas = Area::all();
        return view('academia.cursos.edit', compact('curso', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CursoCreateRequest $request, CursoAcademia $curso)
    {
        try{
            DB::beginTransaction();
            $curso->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);

            $curso->areas()->sync($request->areas);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();

            session()->flash(
                'toast',
                [
                  'message' => $e->getMessage(),
                  'type' => 'error',
                ]
            );
            return back()->withInput();
        }

        session()->flash(
            'toast',
            [
                'message' => "Curso actualizado correctamente",
                'type' => 'success',
            ]
        );

        return redirect()->route('academia.cursos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
