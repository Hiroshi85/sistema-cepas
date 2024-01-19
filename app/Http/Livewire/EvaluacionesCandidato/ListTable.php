<?php

namespace App\Http\Livewire\EvaluacionesCandidato;

use App\Http\Traits\WithSorting;
use App\Models\Rrhh\EvaluacionCandidato;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $confirmingEvaluacionDeletion = false;
    public $selectedEvaluacion = null;
    protected $listeners = ['sort', 'search'];
    protected $queryString = [

        'search' => ['except' => '', 'as' => 's'],

        'page' => ['except' => 1, 'as' => 'p'],

    ];

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

    public function confirmEvaluacionDeletion(EvaluacionCandidato $evaluacion)
    {
        $this->confirmingEvaluacionDeletion = true;
        $this->selectedEvaluacion = $evaluacion;

        $this->emit('open-custom-modal', 'confirm-evaluacion-deletion');
    }

    public function cerrarModal()
    {
        $this->confirmingEvaluacionDeletion = false;
        $this->selectedEvaluacion = null;
    }

    public function render()
    {
        return view('livewire.evaluaciones-candidato.list-table', [
            'evaluaciones' => EvaluacionCandidato::listarEvaluaciones(
                $this->search,
                $this->sortBy,
                $this->sortDirection,
            ),
        ]);
    }
}
