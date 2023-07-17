<?php

namespace App\Http\Livewire\Candidatos;

use Livewire\Component;

class PostulacionCard extends Component
{
    public $postulacion;

    public function mount($postulacion)
    {
        $this->postulacion = $postulacion;
    }
    public function render()
    {
        return view('livewire.candidatos.postulacion-card');
    }
}
