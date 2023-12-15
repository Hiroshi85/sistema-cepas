<?php

namespace App\Services\Academia;

use App\Models\Academia\CicloAcademico;

class AcademiaService
{
    public function getActiveCicle()
    {
        return CicloAcademico::all()->where('activo', true)->sortByDesc('fecha_inicio')->first();
    }
}
