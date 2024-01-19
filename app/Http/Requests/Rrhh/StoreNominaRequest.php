<?php

namespace App\Http\Requests\Rrhh;

use App\Models\Rrhh\Empleado;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreNominaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'empleado_id' => 'required',
            'periodo' => 'required',
            'prestaciones' => 'array',
            'prestaciones.*.tipo_prestacion_id' => 'required|exists:tipos_prestacion,id',
            'prestaciones.*.monto' => 'required',
            'descuentos' => 'array',
            'descuentos.*.tipo_descuento_id' => 'required|exists:tipos_descuento,id',
            'descuentos.*.monto' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'empleado_id.required' => 'El empleado es requerido',
            'periodo.required' => 'El periodo es requerido',
            'prestaciones.*.tipo_prestacion_id.required' => 'El tipo de prestación es requerido',
            'prestaciones.*.tipo_prestacion_id.exists' => 'El tipo de prestación no existe',
            'prestaciones.*.monto.required' => 'El monto es requerido',
            'descuentos.*.tipo_descuento_id.required' => 'El tipo de descuento es requerido',
            'descuentos.*.tipo_descuento_id.exists' => 'El tipo de descuento no existe',
            'descuentos.*.monto.required' => 'El monto es requerido',
        ];
    }

    public function after(): array
    {
        if(is_null($this->prestaciones)) {
            $this->prestaciones = [];
        }
        if(is_null($this->descuentos)) {
            $this->descuentos = [];
        }

        return [
            function (Validator $validator) {
                $empleado = Empleado::find($this->empleado_id);
                if ($empleado->yaRecibioNominaElPeriodo($this->fecha_inicio, $this->fecha_fin)) {
                    $validator->errors()->add('periodo', 'El empleado ya recibió una nómina en este periodo');
                }
            }
        ];
    }


}
