<?php

namespace App\View\Components\Academia;

use App\Services\Academia\AcademiaService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CurrentCicleCard extends Component
{
    public $currCicle;
    /**
     * Create a new component instance.
     */
    public function __construct($currCicle)
    {
        $this->currCicle = $currCicle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.academia.current-cicle-card');
    }
}
