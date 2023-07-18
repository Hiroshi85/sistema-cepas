<?php

namespace App\Http\Livewire\Ofertas;

use App\Http\Traits\WithSorting;
use App\Models\Oferta;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $confirmingOfertaDeletion = false;
    public $selectedOferta = null;

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

    public function confirmOfertaDeletion(Oferta $oferta)
    {
        $oferta->load('postulacion');
        $this->selectedOferta = $oferta;
        $this->confirmingOfertaDeletion = true;
    }
    public function cerrarModal()
    {
        $this->selectedOferta = null;
        $this->confirmingOfertaDeletion = false;
    }


    public function render()
    {
        $ofertas = Oferta::listarOfertas(
            $this->search,
            $this->sortBy,
            $this->sortDirection,
        );
        return view(
            'livewire.ofertas.list-table',
            [
                'ofertas' => $ofertas,
            ]
        );
    }
}
