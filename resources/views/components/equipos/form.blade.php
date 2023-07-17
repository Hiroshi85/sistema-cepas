@props(['equipo' => null])

<form method="POST" action="{{ $equipo ? route('equipos.update', $equipo) : route('equipos.store') }}"
    class="flex flex-col md:grid md:grid-cols-2 gap-5">
    @csrf
    {{ $equipo ? method_field('PUT') : '' }}

    <x-input-group value="{{ $equipo ? $equipo->nombre : '' }}" label="Nombre" name="nombre" type="text" required
        placeholder="Ingrese nombre del equipo" />

    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>


</form>
