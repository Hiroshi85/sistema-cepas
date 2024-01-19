<?php

namespace App\Http\Livewire\EntrevistasCandidato;

use App\Http\Traits\WithSorting;
use App\Models\Rrhh\EntrevistaCandidato;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $confirmingEntrevistaDeletion = false;
    public $selectedEntrevista = null;
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

    public function confirmEntrevistaDeletion(EntrevistaCandidato $entrevista)
    {
        $this->confirmingEntrevistaDeletion = true;
        $this->selectedEntrevista = $entrevista;

        $this->emit('open-custom-modal', 'confirm-entrevista-deletion');
    }

    public function cerrarModal()
    {
        $this->confirmingEntrevistaDeletion = false;
        $this->selectedEntrevista = null;
    }

    public function render()
    {
        return view('livewire.entrevistas-candidato.list-table', [
            'entrevistas' => EntrevistaCandidato::listarEntrevistas(
                $this->search,
                $this->sortBy,
                $this->sortDirection,
            ),
        ]);
    }
}
