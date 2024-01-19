<?php

namespace App\Http\Livewire\Nominas;

use App\Http\Traits\WithSorting;
use App\Models\Rrhh\Nomina;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $confirmingNominaDeletion = false;
    public $selectedNomina = null;
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

    public function confirmNominaDeletion(Nomina $nomina)
    {
        $this->confirmingNominaDeletion = true;
        $this->selectedNomina = $nomina;

        $this->emit('open-custom-modal', 'confirm-equipo-deletion');
    }

    public function cerrarModal()
    {
        $this->confirmingNominaDeletion = false;
        $this->selectedNomina = null;
    }

    public function render()
    {
        return view('livewire.nominas.list-table', [
            'nominas' => Nomina::listarNominas(
                $this->search,
                $this->sortBy,
                $this->sortDirection,
            ),
        ]);
    }
}
