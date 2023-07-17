@props(['candidato' => null])

@php
    $options = [
        (object) [
            'value' => 'masculino',
            'label' => 'Masculino',
        ],
        (object) [
            'value' => 'femenino',
            'label' => 'Femenino',
        ],
    ];
@endphp


<form method="POST" action="{{ $candidato ? route('candidatos.update', $candidato) : route('candidatos.store') }}"
    class="flex flex-col md:grid md:grid-cols-2 gap-5">
    @csrf
    {{ $candidato ? method_field('PUT') : '' }}

    <x-input-group value="{{ $candidato ? $candidato->nombre : '' }}" label="Nombre" name="nombre" type="text"
        required placeholder="Ingrese nombre del candidato" />

    <x-input-group value="{{ $candidato ? $candidato->email : '' }}" label="Email" name="email" type="email"
        required placeholder="Ingrese email del candidato" />

    <x-input-group value="{{ $candidato ? $candidato->dni : '' }}" label="DNI" name="dni" type="text"
        required placeholder="Ingrese DNI del candidato" />

    <x-input-group value="{{ $candidato ? $candidato->fecha_nacimiento : '' }}" label="Fecha de Nacimiento"
        name="fecha_nacimiento" type="date" required />

    <x-input-group value="{{ $candidato ? $candidato->genero : '' }}" label="Género" name="genero" type="select"
        required :options="$options" />

    <x-input-group value="{{ $candidato ? $candidato->direccion : '' }}" label="Dirección" name="direccion"
        type="text" required placeholder="Ingrese dirección del candidato" />

    <x-input-group value="{{ $candidato ? $candidato->telefono : '' }}" label="Teléfono" name="telefono"
        type="text" required placeholder="Ingrese teléfono del candidato" />

    <x-input-group value="{{ $candidato ? $candidato->curriculum_url : '' }}" label="Enlace de Currículum"
        name="curriculum_url" type="text" required placeholder="Ingrese enlace de currículum del candidato" />


    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>


</form>
