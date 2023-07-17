<?php

namespace App\Http\Livewire\Icons;

use Livewire\Component;

class Cv extends Component
{
    public $height = 20;
    public $width = 20;
    public function render()
    {
        return view('livewire.icons.cv');
    }
}
