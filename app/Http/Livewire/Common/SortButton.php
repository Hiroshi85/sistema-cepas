<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class SortButton extends Component
{

    public $field;

    public function sort()
    {
        $this->emit('sort', $this->field);
    }

    public function render()
    {
        return view('livewire.common.sort-button');
    }
}
