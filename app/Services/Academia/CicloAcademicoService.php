<?php

namespace App\Services\Academia;

use App\Http\Requests\Academia\CicloAcademicoRequest;
use App\Models\Academia\CicloAcademico;
use Illuminate\Support\Str;

class CicloAcademicoService
{
    public function create($validated)
    {
        return CicloAcademico::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_fin' => $validated['fecha_fin'],
            'public_id' => $this->generateUniqueKey(),
        ]);
    }

    public function edit($id, $validated)
    {
        $cicloAcademico = CicloAcademico::findOrFail($id);
        $cicloAcademico->update([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_fin' => $validated['fecha_fin'],
        ]);
        $cicloAcademico->save();
        return $cicloAcademico;
    }

    protected function generateUniqueKey(): string
    {
        $key = Str::random(8);
        $cicloAcademico = CicloAcademico::where('public_id', $key)->first();
        if ($cicloAcademico) {
            return $this->generateUniqueKey();
        }
        return $key;
    }

    public function ListAlumnos (
        $cicle,
        $search = '',
        $sortBy = 'al.nombre_apellidos',
        $sortDirection = 'asc',
        $paginate = 10,
    ) {
        return $cicle->alumnos()->
            select('alumno_academia.*', 'al.nombre_apellidos as nombre', 'al.dni as dni', 'carreras_unt.nombre as carreraNombre')->
            join('carreras_unt', 'alumno_academia.idcarrera', '=', 'carreras_unt.id')->
            join('alumnos as al', 'alumno_academia.idalumno', '=', 'al.idalumno')->
            where('al.nombre_apellidos', 'LIKE', "%{$search}%")->
            orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }

}
