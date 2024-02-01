<?php
namespace App\Http\Livewire\Academia\Cursos;

use App\Http\Traits\WithSorting;
use App\Services\Academia\Cursos\CursosAcademiaService;
use Livewire\Component;
use Livewire\WithPagination;

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

    public function render(CursosAcademiaService $cursosAcademiaService)
    {
        $cursos = $cursosAcademiaService->ListCursos(
            $this->search,
            $this->sortBy,
            $this->sortDirection,
        );


        return view('livewire.Academia.cursos-academia.list-table', [
            'cursos' => $cursos,
        ]);
    }
}
