<?php

namespace App\Http\Livewire\Academia\AlumnosAcademia;

use App\Http\Traits\WithSorting;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\Academia\CicloAcademicoService;


class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $ciclo;

    protected $listeners = ['sort', 'search'];

    protected $queryString = [

        'search' => ['except' => '', 'as' => 's'],

        'page' => ['except' => 1, 'as' => 'p'],

    ];

    public function __construct($ciclo)
    {
        $this->ciclo = $ciclo;
    }

    public function sort($field)
    {
        $this->sortBy($field);
        $this->resetPage();
    }

    public function search($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    public function render(CicloAcademicoService $cicloService)
    {
        $alumnos = $cicloService->ListAlumnos(
            $this->ciclo,
            $this->search,
            $this->sortBy,
            $this->sortDirection,
        );

        return view('livewire.academia.alumnos-academia.list-table', [
            'alumnos' => $alumnos,
            'ciclo' => $this->ciclo,
        ]);
    }
}
