<?php

namespace App\Http\Livewire\Academia\AlumnosAcademia;

use App\Http\Traits\WithSorting;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    use WithSorting;
    public $search = '';
    public $ciclo;

    protected $listeners = ['sort', 'search'];

    protected $queryString = [

        'search' => ['except' => '', 'as' => 's'],

        'page' => ['except' => 1, 'as' => 'p'],

    ];

    public function render()
    {
        return view('livewire.academia.alumnos-academia.list-table');
    }
}
