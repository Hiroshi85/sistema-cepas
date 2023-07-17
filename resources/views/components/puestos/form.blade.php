@props(['puesto' => null, 'equipos' => []])

@php
    foreach ($equipos as $equipo) {
        $options[] = (object) [
            'value' => $equipo->id,
            'label' => $equipo->nombre,
        ];
    }
@endphp


<form method="POST" action="{{ $puesto ? route('puestos.update', $puesto) : route('puestos.store') }}"
    class="flex flex-col md:grid md:grid-cols-2 gap-5">
    @csrf
    {{ $puesto ? method_field('PUT') : '' }}

    <x-input-group value="{{ $puesto ? $puesto->nombre : '' }}" label="Nombre" name="nombre" type="text" required
        placeholder="Ingrese nombre del puesto" />
    <x-input-group value="{{ $puesto ? $puesto->descripcion : '' }}" label="Descripcion" name="descripcion"
        type="textarea" required placeholder="Ingrese descripcion del puesto" />

    <x-input-group value="{{ $puesto ? $puesto->equipo->id : '' }}" label="Equipo" name="equipo_id" type="select" required
        :options="$options" />


    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>


</form>
