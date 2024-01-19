<?php

namespace App\Http\Livewire\Nominas;

use App\Models\Rrhh\Empleado;
use App\Models\Rrhh\Nomina;
use App\Models\TipoDescuento;
use Livewire\Component;

class DescuentosMultiInput extends Component
{

    public $tipos_descuento = [];
    public $empleado = null;
    public $descuentos = [];
    public $mes = null;

    protected $listeners = ['empleadoSelected', 'mesSelected'];


    public function mount($descuentos, $tipos_descuento)
    {
        $this->descuentos = $descuentos;
        $this->tipos_descuento = $tipos_descuento;

    }

    public function render()
    {
        return view('livewire.nominas.descuentos-multi-input');
    }

    public function add()
    {
        if (count($this->descuentos) == 3) {
            return;
        }
        $this->descuentos[] = [
            'tipo_descuento_id' => '',
            'monto' => '',
        ];
    }

    public function remove($index)
    {
        unset($this->descuentos[$index]);
        $this->descuentos = array_values($this->descuentos);
    }

    public function empleadoSelected(Empleado $empleado)
    {
        $this->empleado = $empleado;
        // refresh descuentos
        $this->descuentos = [];
    }

    public function mesSelected($mes)
    {
        $this->mes = $mes;
        // refresh descuentos
        $this->descuentos = [];
    }

    public function updateDescuento($index, TipoDescuento $tipoDescuento)
    {
        // si la descuento ya existe, resetear la seleccion actual
        foreach ($this->descuentos as $key => $descuento) {
            if ($descuento['tipo_descuento_id'] == $tipoDescuento->id) {
                $this->descuentos[$index]['tipo_descuento_id'] = '';
                $this->descuentos[$index]['monto'] = '';
                return;
            }
        }


        $this->descuentos[$index]['tipo_descuento_id'] = $tipoDescuento->id;


        if ($tipoDescuento->id == 1) {
            // afp
            $this->descuentos[$index]['monto'] = Nomina::calcularAfiliacionAFP($this->empleado);
        } else if ($tipoDescuento->id == 2) {
            // impuesto
            $this->descuentos[$index]['monto'] = Nomina::calcularImpuestoRentaMensual($this->empleado, $this->mes);
        } else if ($tipoDescuento->id == 3) {
            //  essalud
            $this->descuentos[$index]['monto'] = Nomina::calcularEssalud($this->empleado);
        }

    }

}
