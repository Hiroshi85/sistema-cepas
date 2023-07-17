<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class SearchBox extends Component
{
    public $placeholder = 'Search...';
    public $search = '';


    public function mount($placeholder = null, $search = null)
    {
        $this->placeholder = $placeholder ?? $this->placeholder;
        $this->search = $search ?? $this->search;
    }

    public function updatedSearch($search)
    {
        $this->emit('search', $search);
    }


    public function render()
    {
        return view('livewire.common.search-box');
    }
}
