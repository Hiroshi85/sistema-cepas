<?php

namespace App\Services\Academia;

use App\Models\Academia\Cursos\Carrera;

class CarreraService
{
    public function GetCarreras()
    {
        return Carrera::where('eliminado', 0)
            ->with('facultad')
            ->with('area')
            ->get();
    }
}
