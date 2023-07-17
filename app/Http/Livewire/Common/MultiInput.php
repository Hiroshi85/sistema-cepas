<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class MultiInput extends Component
{
    public $items = [];
    public $label = '';
    public $name = '';

    public function mount($items = [], $label = '', $name = '')
    {
        $this->items = $items;
        $this->label = $label;
        $this->name = $name;
    }

    public function agregarItem()
    {
        if (count($this->items) >= 5) {
            return;
        }
        $this->items[] = '';
    }

    public function eliminarItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function render()
    {
        return view('livewire.common.multi-input');
    }
}
