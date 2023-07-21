@props(['contrato' => null, 'empleados' => []])

@php
    $options_empleados = [];
    foreach ($empleados as $empleado) {
        $options_empleados[] = (object) [
            'value' => $empleado->id,
            'label' => $empleado->nombre,
        ];
    }
    
    $options_tipos_contratos = [
        (object) [
            'value' => 'tiempo completo',
            'label' => 'Tiempo Completo',
        ],
        (object) [
            'value' => 'tiempo parcial',
            'label' => 'Tiempo Parcial',
        ],
    ];
@endphp


<form method="POST" action="{{ $contrato ? route('contratos.update', $contrato) : route('contratos.store') }}"
    class="flex flex-col md:grid md:grid-cols-2 gap-5">
    @csrf
    {{ $contrato ? method_field('PUT') : '' }}

    <x-input-group value="{{ $contrato ? $contrato->empleado->id : '' }}" label="Empleado" name="empleado_id" type="select"
        required :options="$options_empleados" />

    <x-input-group value="{{ $contrato ? $contrato->tipo_contrato : '' }}" label="Tipo de Contrato" name="tipo_contrato"
        type="select" :options="$options_tipos_contratos" required />
    <x-input-group value="{{ $contrato ? $contrato->fecha_inicio : '' }}" label="Inicio de Contrato" name="fecha_inicio"
        type="date" required />
    <x-input-group value="{{ $contrato ? $contrato->fecha_fin : '' }}" label="Fin de Contrato" name="fecha_fin"
        type="date" required />
    <x-input-group value="{{ $contrato ? $contrato->remuneracion : '' }}" label="Remuneración (mensual)"
        name="remuneracion" required placeholder="Ej: 1000.00" type="number" step="0.01" min="0"
        max="99999999999999999999" />
    <x-input-group value="{{ $contrato ? $contrato->descripcion : '' }}" label="Descripción" name="descripcion" required
        placeholder="Escriba la descripción del contrato" type="textarea" />


    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>


</form>
