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

}
