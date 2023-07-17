<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class ThemeToggle extends Component
{
    public $theme;

    protected $listeners = ['themeLoad'];

    public function themeLoad($theme)
    {
        $this->theme = $theme;
        session(['theme' => $theme]); // Actualizar el tema en la sesión
    }

    public function mount()
    {
        $this->theme = session('theme', 'light');
    }

    public function toggle()
    {
        $this->theme = $this->theme == 'light' ? 'dark' : 'light';
        $this->dispatchBrowserEvent('theme-toggle', ['theme' => $this->theme]);
        session(['theme' => $this->theme]); // Actualizar el tema en la sesión
    }

    public function render()
    {
        return view('livewire.common.theme-toggle');
    }
}
