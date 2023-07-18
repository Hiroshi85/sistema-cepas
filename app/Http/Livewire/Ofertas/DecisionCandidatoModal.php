<?php

namespace App\Http\Livewire\Ofertas;

use Livewire\Component;

class DecisionCandidatoModal extends Component
{
    public $oferta;
    public $modalOpen = false;


    public function mount($oferta)
    {
        $this->oferta = $oferta;
    }

    public function render()
    {
        return view('livewire.ofertas.decision-candidato-modal');
    }
}
