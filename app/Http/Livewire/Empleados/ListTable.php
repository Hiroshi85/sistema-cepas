<?php

namespace App\Http\Livewire\Empleados;

use App\Http\Traits\WithSorting;
use App\Models\Rrhh\Empleado;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $confirmingEmpleadoDeletion = false;
    public $selectedEmpleado = null;
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

    public function confirmEmpleadoDeletion(Empleado $empleado)
    {
        $this->confirmingEmpleadoDeletion = true;
        $this->selectedEmpleado = $empleado;

        $this->emit('open-custom-modal', 'confirm-empleado-deletion');
    }

    public function cerrarModal()
    {
        $this->confirmingEmpleadoDeletion = false;
        $this->selectedEmpleado = null;
    }

    public function render()
    {
        return view('livewire.empleados.list-table', [
            'empleados' => Empleado::listarEmpleados(
                $this->search,
                $this->sortBy,
                $this->sortDirection,
            ),
        ]);
    }
}
