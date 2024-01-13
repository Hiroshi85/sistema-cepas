<?php

namespace App\Http\Livewire\Equipos;

use App\Http\Traits\WithSorting;
use App\Models\Rrhh\Equipo;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $confirmingEquipoDeletion = false;
    public $selectedEquipo = null;
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

    public function confirmEquipoDeletion(Equipo $equipo)
    {
        $this->confirmingEquipoDeletion = true;
        $this->selectedEquipo = $equipo;

        $this->emit('open-custom-modal', 'confirm-equipo-deletion');
    }

    public function cerrarModal()
    {
        $this->confirmingEquipoDeletion = false;
        $this->selectedEquipo = null;
    }

    public function render()
    {
        return view('livewire.equipos.list-table', [
            'equipos' => Equipo::listarEquipos(
                $this->search,
                $this->sortBy,
                $this->sortDirection,
            ),
        ]);
    }
}
