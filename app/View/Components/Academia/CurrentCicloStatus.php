<?php

namespace App\View\Components\Academia;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CurrentCicloStatus extends Component
{
    public $currCicle;
    public function __construct($currCicle)
    {
        $this->currCicle = $currCicle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.academia.current-ciclo-status');
    }
}
