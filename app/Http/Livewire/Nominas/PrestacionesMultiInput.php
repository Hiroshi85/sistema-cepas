<?php

namespace App\Http\Livewire\Nominas;

use App\Models\Rrhh\Empleado;
use App\Models\Rrhh\Nomina;
use App\Models\TipoPrestacion;
use Livewire\Component;

class PrestacionesMultiInput extends Component
{

    public $tipos_prestacion = [];
    public $empleado = null;
    public $prestaciones = [];
    public $mes = null;

    protected $listeners = ['empleadoSelected', 'mesSelected'];


    public function mount($prestaciones, $tipos_prestacion)
    {
        $this->prestaciones = $prestaciones;
        $this->tipos_prestacion = $tipos_prestacion;

    }

    public function render()
    {
        return view('livewire.nominas.prestaciones-multi-input');
    }

    public function add()
    {
        if (count($this->prestaciones) == 2) {
            return;
        }
        $this->prestaciones[] = [
            'tipo_prestacion_id' => '',
            'monto' => '',
        ];
    }

    public function remove($index)
    {
        unset($this->prestaciones[$index]);
        $this->prestaciones = array_values($this->prestaciones);
    }

    public function empleadoSelected(Empleado $empleado)
    {
        $this->empleado = $empleado;
        // refresh prestaciones
        $this->prestaciones = [];
    }

    public function mesSelected($mes)
    {
        $this->mes = $mes;
        // refresh prestaciones
        $this->prestaciones = [];
    }

    public function updatePrestacion($index, TipoPrestacion $tipoPrestacion)
    {
        // si la prestacion ya existe, resetear la seleccion actual
        foreach ($this->prestaciones as $key => $prestacion) {
            if ($prestacion['tipo_prestacion_id'] == $tipoPrestacion->id) {
                $this->prestaciones[$index]['tipo_prestacion_id'] = '';
                $this->prestaciones[$index]['monto'] = '';
                return;
            }
        }


        $this->prestaciones[$index]['tipo_prestacion_id'] = $tipoPrestacion->id;


        if ($tipoPrestacion->id == 1) {
            // gratificacion
            $this->prestaciones[$index]['monto'] = Nomina::calcularGratificacion($this->mes, $this->empleado);
        } else if ($tipoPrestacion->id == 2) {
            // vacaciones
            $this->prestaciones[$index]['monto'] = Nomina::calcularVacaciones($this->empleado);
        }
    }

}
