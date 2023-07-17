@props(['candidato' => null, 'candidatos' => [], 'plazas' => []])

@php
    use Carbon\Carbon;
    $generos = [
        (object) [
            'value' => 'masculino',
            'label' => 'Masculino',
        ],
        (object) [
            'value' => 'femenino',
            'label' => 'Femenino',
        ],
    ];
    $candidatos_options = [];
    foreach ($candidatos as $p) {
        $candidatos_options[] = (object) [
            'value' => $p->id,
            'label' => $p->nombre . ' - ' . $p->dni,
        ];
    }
    $plazas_options = [];
    foreach ($plazas as $p) {
        $plazas_options[] = (object) [
            'value' => $p->id,
            'label' => $p->puesto->nombre,
        ];
    }
@endphp

@if (count($plazas) == 0)
    <div class="col-span-full">
        <div>
            No hay plazas disponibles
        </div>
    </div>
@else
    <form method="POST"
        action="{{ $candidato ? route('postulaciones.update', $candidato) : route('postulaciones.store') }}"
        class="flex flex-col md:grid md:grid-cols-2 gap-5">
        @csrf
        {{ $candidato ? method_field('PUT') : '' }}
        <div class="p-5 border dark:border-gray-800 col-span-full flex flex-col md:grid md:grid-cols-2 gap-5">
            <h2 class="col-span-full bold dark:text-white">
                Registrar candidato
            </h2>

            <x-input-group value="{{ $candidato ? $candidato->nombre : '' }}" label="Nombre" name="nombre" type="text"
                placeholder="Ingrese nombre del candidato" />

            <x-input-group value="{{ $candidato ? $candidato->email : '' }}" label="Email" name="email"
                type="email" placeholder="Ingrese email del candidato" />

            <x-input-group value="{{ $candidato ? $candidato->dni : '' }}" label="DNI" name="dni"
                type="text" placeholder="Ingrese DNI del candidato" />

            <x-input-group value="{{ $candidato ? $candidato->fecha_nacimiento : '' }}" label="Fecha de Nacimiento"
                name="fecha_nacimiento" type="date" />

            <x-input-group value="{{ $candidato ? $candidato->genero : '' }}" label="Género" name="genero"
                type="select" :options="$generos" />

            <x-input-group value="{{ $candidato ? $candidato->direccion : '' }}" label="Dirección" name="direccion"
                type="text" placeholder="Ingrese dirección del candidato" />

            <x-input-group value="{{ $candidato ? $candidato->telefono : '' }}" label="Teléfono" name="telefono"
                type="text" placeholder="Ingrese teléfono del candidato" />

            <x-input-group value="{{ $candidato ? $candidato->curriculum_url : '' }}" label="Enlace de Currículum"
                name="curriculum_url" type="text" placeholder="Ingrese enlace de currículum del candidato" />
        </div>
        <div class="capitalize bold flex items-center justify-center p-2 col-span-full">o</div>

        <div class="p-5 border dark:border-gray-800 col-span-full flex flex-col md:grid md:grid-cols-2 gap-5">

            <h2 class="col-span-full bold dark:text-white">Seleccionar un candidato</h2>
            <x-input-group label="Candidato" :options="$candidatos_options" name="candidato_id" type="select"
                class="col-span-full">
            </x-input-group>
        </div>
        <h2 class="col-span-full bold dark:text-white">
            {{ __('Datos de la postulación') }}
        </h2>
        <x-input-group label="Plaza" required :options="$plazas_options" name="plaza_id" type="select">
        </x-input-group>

        <x-input-group label="Fecha de Postulación" name="fecha_postulacion" type="date" required>
        </x-input-group>
        <div class="col-span-2">
            <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
                {{ __('Guardar') }}
            </x-primary-button>
        </div>


    </form>
@endif
