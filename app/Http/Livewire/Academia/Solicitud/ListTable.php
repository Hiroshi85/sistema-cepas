<?php

namespace App\Http\Livewire\Academia\Solicitud;

use App\Http\Traits\WithSorting;
use App\Models\Academia\Solicitud;
use Illuminate\Support\Facades\Log;
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

    public function render()
    {
        $solicitudes = Solicitud::listarSolicitudes(
            $this->search,
            $this->sortBy,
            $this->sortDirection,
        );

        Log::debug($solicitudes);

        return view('livewire.academia.solicitud.list-table', [
            'solicitudes' => $solicitudes
        ]);
    }
}