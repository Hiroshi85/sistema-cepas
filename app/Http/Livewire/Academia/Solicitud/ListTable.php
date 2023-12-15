<?php

namespace App\Http\Livewire\Academia\Solicitud;

use App\Http\Traits\WithSorting;
use App\Models\Academia\Solicitud;
use App\Services\Academia\SolicitudService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $ciclo;
    public $status = 'pendiente';
    public $confirmingEmpleadoDeletion = false;
    public $selectedEmpleado = null;
    protected $listeners = ['sort', 'search'];

    protected $queryString = [

        'search' => ['except' => '', 'as' => 's'],

        'page' => ['except' => 1, 'as' => 'p'],

    ];

    public function __construct($ciclo)
    {
        $this->ciclo = $ciclo;
    }

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

    public function render(SolicitudService $solicitudService)
    {
        $solicitudes = $solicitudService->ListElements(
            $this->ciclo,
            $this->status,
            $this->search,
            $this->sortBy,
            $this->sortDirection,
        );

        return view('livewire.academia.solicitud.list-table', [
            'solicitudes' => $solicitudes,
            'ciclo' => $this->ciclo,
        ]);
    }
}
