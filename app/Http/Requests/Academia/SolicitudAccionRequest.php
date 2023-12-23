<?php

namespace App\Http\Requests\Academia;

use App\Validation\Academia\AlumnoActionValidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;

class SolicitudAccionRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'accion' => 'required|in:aceptar,rechazar',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $this->ValidateSolicitudStatus($validator);
            },
        ];
    }

    private function ValidateSolicitudStatus(Validator $validator) {
        $solicitud = $this->route('solicitud');
        $data = $validator->getData();

        $estado = $data['accion'] == 'aceptar' ? 'aceptado' : 'rechazado';

        if ($estado == $solicitud->estado) {
            $validator->errors()->add('accion', 'La solicitud ya se encuentra en este estado');
        }
    }


}
