@props(['plaza' => null, 'puestos' => []])

@php
    foreach ($puestos as $puesto) {
        $options[] = (object) [
            'value' => $puesto->id,
            'label' => $puesto->nombre,
        ];
    }
@endphp


<form method="POST" action="{{ $plaza ? route('plazas.update', $plaza) : route('plazas.store') }}"
    class="flex flex-col md:grid md:grid-cols-2 gap-5">
    @csrf
    {{ $plaza ? method_field('PUT') : '' }}

    <x-input-group value="{{ $plaza ? $plaza->fecha_inicio : '' }}" label="Fecha de Inicio" name="fecha_inicio"
        type="date" required />
    <x-input-group value="{{ $plaza ? $plaza->fecha_fin : '' }}" label="Fecha fin" name="fecha_fin" type="date"
        required />

    <x-input-group value="{{ $plaza ? $plaza->puesto->id : '' }}" label="Puesto" name="puesto_id" type="select"
        required :options="$options" />


    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>


</form>
