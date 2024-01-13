<?php

namespace App\Http\Livewire\Plazas;

use App\Http\Traits\WithSorting;
use App\Models\Rrhh\Plaza;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $confirmingPlazaDeletion = false;
    public $selectedPlaza = null;
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

    public function confirmPlazaDeletion(Plaza $plaza)
    {
        $this->confirmingPlazaDeletion = true;
        $this->selectedPlaza = $plaza;

        $this->emit('open-custom-modal', 'confirm-plaza-deletion');
    }

    public function cerrarModal()
    {
        $this->confirmingPlazaDeletion = false;
        $this->selectedPlaza = null;
    }

    public function render()
    {
        return view('livewire.plazas.list-table', [
            'plazas' => Plaza::listarPlazas($this->search, $this->sortBy, $this->sortDirection)
        ]);
    }
}
