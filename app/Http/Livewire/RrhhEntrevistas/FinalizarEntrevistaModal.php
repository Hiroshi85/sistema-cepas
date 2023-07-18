<?php

namespace App\Http\Livewire\RrhhEntrevistas;

use Livewire\Component;

class FinalizarEntrevistaModal extends Component
{
    public $entrevista;
    public $modalOpen = false;

    protected $listeners = ['finalizarEntrevista' => 'cerrarModal'];

    public function cerrarModal()
    {
        $this->modalOpen = false;
    }

    public function mount($entrevista)
    {
        $this->entrevista = $entrevista;
    }

    public function render()
    {
        return view('livewire.rrhh-entrevistas.finalizar-entrevista-modal');
    }
}
