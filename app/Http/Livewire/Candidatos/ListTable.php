<?php

namespace App\Http\Livewire\Candidatos;

use App\Http\Traits\WithSorting;
use App\Models\Rrhh\Candidato;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $confirmingCandidatoDeletion = false;
    public $selectedCandidato = null;
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

    public function confirmCandidatoDeletion(Candidato $candidato)
    {
        $this->confirmingCandidatoDeletion = true;
        $this->selectedCandidato = $candidato;

        $this->emit('open-custom-modal', 'confirm-candidato-deletion');
    }

    public function cerrarModal()
    {
        $this->confirmingCandidatoDeletion = false;
        $this->selectedCandidato = null;
    }

    public function render()
    {
        return view('livewire.candidatos.list-table', [
            'candidatos' => Candidato::listarCandidatos(
                $this->search,
                $this->sortBy,
                $this->sortDirection
            ),
        ]);
    }
}
