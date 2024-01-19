<?php

namespace App\Services\Academia;

use App\Models\Academia\DocenteAcademia;

class DocenteAcademiaService {
    public function ListDocentes (
        $search = '',
        $sortBy = 'nombre',
        $sortDirection = 'asc',
        $paginate = 10,
    ) {
        return DocenteAcademia::
            with(
                [
                    'empleado',
                    'especialidad'
                ]
            )->
            whereHas(
                'empleado',
                function ($query) use ($search) {
                    $query->where('nombre', 'LIKE', "%{$search}%");
                }
            )->
            orderBy($sortBy, $sortDirection)
            ->paginate($paginate);
    }
}
