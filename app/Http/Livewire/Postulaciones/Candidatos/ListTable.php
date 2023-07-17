<?php

namespace App\Http\Livewire\Postulaciones\Candidatos;

use App\Http\Traits\WithSorting;
use App\Models\Postulacion;
use App\Models\Candidato;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $confirmingPostulacionesDeletion = false;
    public $confirmingPostulacionDeletion = false;
    public $selectedCandidato = null;
    public $selectedPostulacion = null;
    public $expandedRows = [];

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

    public function toggleExpanded($id)
    {
        if (isset($this->expandedRows[$id])) {
            unset($this->expandedRows[$id]);
        } else {
            $this->expandedRows[$id] = true;
        }
    }

    public function confirmPostulacionesDeletion(Candidato $candidato)
    {
        $this->confirmingPostulacionesDeletion = true;
        $this->selectedCandidato = $candidato;

        $this->emit('open-custom-modal', 'confirm-postulaciones-deletion');
    }

    public function confirmPostulacionDeletion(Postulacion $postulacion)
    {
        $this->selectedPostulacion = $postulacion;
        $this->confirmingPostulacionDeletion = true;
    }
    public function cerrarModal()
    {
        $this->confirmingPostulacionesDeletion = false;
        $this->selectedCandidato = null;
        $this->confirmingPostulacionDeletion = false;
        $this->selectedPostulacion = null;
    }


    public function render()
    {
        $candidatos = Candidato::listarCandidatosConPostulaciones(
            $this->search,
            $this->sortBy,
            $this->sortDirection,
        );
        return view(
            'livewire.postulaciones.candidatos.list-table',
            [
                'candidatos' => $candidatos,
            ]

        );
    }
}
