<?php

namespace App\Http\Livewire\Postulaciones;

use App\Http\Traits\WithSorting;
use App\Models\Postulacion;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $confirmingPostulacionDeletion = false;
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
    public function confirmPostulacionDeletion(Postulacion $postulacion)
    {
        $postulacion->load('candidato', 'plaza');
        $this->selectedPostulacion = $postulacion;
        $this->confirmingPostulacionDeletion = true;
    }
    public function cerrarModal()
    {
        $this->selectedPostulacion = null;
        $this->confirmingPostulacionDeletion = false;
    }


    public function render()
    {
        $postulaciones = Postulacion::listarPostulaciones(
            $this->search,
            $this->sortBy,
            $this->sortDirection,
        );
        return view(
            'livewire.postulaciones.list-table',
            [
                'postulaciones' => $postulaciones,
            ]
        );
    }
}
