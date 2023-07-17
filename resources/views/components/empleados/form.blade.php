@props([
    'empleado' => null,
    'puestos' => null,
])

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
    
    $puestos_options = $puestos->map(function ($puesto) {
        return (object) [
            'value' => $puesto->id,
            'label' => $puesto->nombre,
        ];
    });
@endphp


<form method="POST" action="{{ $empleado ? route('empleados.update', $empleado) : route('empleados.store') }}"
    class="grid md:grid-cols-2 gap-5">
    @csrf
    {{ $empleado ? method_field('PUT') : '' }}

    <x-input-group value="{{ $empleado ? $empleado->nombre : '' }}" label="Nombre" name="nombre" type="text" required
        placeholder="Ingrese nombre del empleado" />

    <x-input-group value="{{ $empleado ? $empleado->email : '' }}" label="Email" name="email" type="email" required
        placeholder="Ingrese email del empleado" />

    <x-input-group value="{{ $empleado ? $empleado->dni : '' }}" label="DNI" name="dni" type="text" required
        placeholder="Ingrese DNI del empleado" />

    <x-input-group value="{{ $empleado ? $empleado->fecha_nacimiento : '' }}" label="Fecha de Nacimiento"
        name="fecha_nacimiento" type="date" required />

    <x-input-group value="{{ $empleado ? $empleado->genero : '' }}" label="Género" name="genero" type="select"
        required :options="$options" />

    <x-input-group value="{{ $empleado ? $empleado->direccion : '' }}" label="Dirección" name="direccion" type="text"
        required placeholder="Ingrese dirección del empleado" />

    <x-input-group value="{{ $empleado ? $empleado->telefono : '' }}" label="Teléfono" name="telefono" type="text"
        required placeholder="Ingrese teléfono del empleado" />

    <x-input-group value="{{ $empleado ? $empleado->puesto_id : '' }}" label="Puesto" name="puesto_id" type="select"
        required :options="$puestos_options" />

    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>


</form>
