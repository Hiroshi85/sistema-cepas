<?php

namespace App\Services\Academia\Cursos;

use App\Models\Academia\Cursos\CursoAcademia;
use App\Models\Academia\DocenteAcademia;

class CursosAcademiaService {
    public function ListCursos (
        $search = '',
        $sortBy = 'nombre',
        $sortDirection = 'asc',
        $paginate = 10,
    ) {
        return CursoAcademia::
            where('nombre', 'LIKE', "%{$search}%")
            ->with('areas')
            ->orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }
}
