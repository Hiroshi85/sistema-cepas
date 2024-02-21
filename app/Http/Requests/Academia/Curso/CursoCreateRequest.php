<?php

namespace App\Http\Requests\Academia\Curso;

use Illuminate\Foundation\Http\FormRequest;

class CursoCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'areas' => 'required|array',
            'areas.*' => 'exists:areas_unt,id',
        ];
    }
}
