<?php

namespace App\Http\Livewire\RrhhEvaluaciones;

use Livewire\Component;

class FinalizarEvaluacionModal extends Component
{
    public $evaluacion;
    public $modalOpen = false;

    protected $listeners = ['finalizarEvaluacion' => 'cerrarModal', 'abrirModal'];

    public function cerrarModal()
    {
        $this->modalOpen = false;
    }

    public function abrirModal()
    {
        $this->modalOpen = true;
    }

    public function mount($evaluacion)
    {
        $this->evaluacion = $evaluacion;
    }

    public function render()
    {
        return view('livewire.rrhh-evaluaciones.finalizar-evaluacion-modal');
    }
}
