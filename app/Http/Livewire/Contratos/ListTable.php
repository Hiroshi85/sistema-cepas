<?php

namespace App\Http\Livewire\Contratos;

use App\Http\Traits\WithSorting;
use App\Models\Rrhh\Contrato;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $confirmingContratoDeletion = false;
    public $selectedContrato = null;
    public $estado = 'vigente';

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

    public function confirmContratoDeletion(Contrato $contrato)
    {
        $this->selectedContrato = $contrato;
        $this->confirmingContratoDeletion = true;
    }
    public function cerrarModal()
    {
        $this->selectedContrato = null;
        $this->confirmingContratoDeletion = false;
    }


    public function render()
    {
        $contratos = Contrato::listarContratos(
            $this->search,
            $this->sortBy,
            $this->sortDirection,
            $this->estado
        );
        return view(
            'livewire.contratos.list-table',
            [
                'contratos' => $contratos,
            ]
        );
    }
}
