<?php

namespace App\Http\Livewire\Empleados;

use Livewire\Component;

class ContratoCard extends Component
{
    public $contrato;

    public function mount($contrato)
    {
        $this->contrato = $contrato;
    }
    public function render()
    {
        return view('livewire.empleados.contrato-card');
    }
}
