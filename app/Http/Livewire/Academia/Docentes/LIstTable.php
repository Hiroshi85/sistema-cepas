<?php
namespace App\Http\Livewire\Academia\Docentes;

use App\Http\Traits\WithSorting;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\Academia\DocenteAcademiaService;

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

    public function render(DocenteAcademiaService $docenteAcademiaService)
    {
        $docentes = $docenteAcademiaService->ListDocentes(
            $this->search,
            $this->sortBy,
            $this->sortDirection,
        );


        return view('livewire.academia.docente-academia.list-table', [
            'docentes' => $docentes,
        ]);
    }
}
