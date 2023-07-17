<?php

namespace App\Http\Livewire\Postulaciones\Plazas;

use App\Http\Traits\WithSorting;
use App\Models\Plaza;
use App\Models\Postulacion;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $confirmingPostulacionesDeletion = false;
    public $confirmingPostulacionDeletion = false;
    public $selectedPlaza = null;
    public $selectedPostulacion = null;

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


    public function confirmPostulacionesDeletion(Plaza $plaza)
    {
        $this->confirmingPostulacionesDeletion = true;
        $this->selectedPlaza = $plaza;

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
        $this->selectedPlaza = null;
        $this->confirmingPostulacionDeletion = false;
        $this->selectedPostulacion = null;
    }


    public function render()
    {
        $plazas = Plaza::listarPlazasConPostulaciones(
            $this->search,
            $this->sortBy,
            $this->sortDirection,
        );
        return view(
            'livewire.postulaciones.plazas.list-table',
            [
                'plazas' => $plazas,
            ]

        );
    }
}
