@php
    $ciclo = null;

    if (isset($currCiclo)) {
        $ciclo = $currCiclo;
    }

@endphp

<form
    action="{{  $ciclo == null
    ? route('academia.ciclo.store')
    : route('academia.ciclo.update', $ciclo)}}"

    method="post"
    class=""
    x-data="{
        fecha_inicio: {{ old('fecha_inicio') ?? "dfns.format(new Date('$ciclo->fecha_inicio'), 'yyyy-MM-dd')" ?? 'new Date().toISOString().slice(0,10)' }},
        fecha_fin: {{ old('fecha_fin') ?? "dfns.format(new Date('$ciclo->fecha_fin'), 'yyyy-MM-dd')" ?? '' }}
    }">
    @csrf

    @if ($ciclo != null)
        @method('PATCH')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 px-5 py-3 border-b border-gray-200 dark:bg-gray-900">
        <div class="col-span-2">
            <x-input-label for="nombre" :value="__('Nombre del ciclo')"></x-input-label>
            <x-text-input
                id="nombre"
                name="nombre"
                type="text"
                value="{{ old('nombre') ?? $ciclo->nombre ?? '' }}"
                class="mt-1 block w-full"
                placeholder="{{ __('Nombre del ciclo') }}"
                required
                autofocus
            />
            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>

        <div class="col-span-2">
            <x-input-group
                name="descripcion"
                type="textarea"
                label="Descripción"
                value="{{ old('descripcion') ?? $ciclo->descripcion ?? '' }}"
                placeholder="Descripción del ciclo académico"></x-input-group>
            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="fecha_inicio" :value="__('Fecha de inicio')"></x-input-label>
            <x-text-input
                id="fecha_inicio"
                name="fecha_inicio"
                type="date"
                class="mt-1 block w-full"
                x-model="fecha_inicio"
                x-on:change="(fecha_inicio > fecha_fin) ? fecha_fin = fecha_inicio : ''"
                placeholder="{{ __('Fecha de inicio') }}"
                required
            />
            <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="fecha_fin" :value="__('Fecha de fin')"></x-input-label>
            <x-text-input
                id="fecha_fin"
                name="fecha_fin"
                type="date"
                class="mt-1 block w-full"
                x-model="fecha_fin"
                x-on:change="(fecha_fin < fecha_inicio) ? fecha_inicio = fecha_fin : ''"
                placeholder="{{ __('Fecha de fin') }}"
                required
            />
            <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
        </div>
    </div>

    <div class="flex justify-end px-5 py-3 gap-3">
        <x-primary-button type="submit">
            {{ $ciclo ? __('Actualizar') : __('Registrar') }}
        </x-primary-button>
        <x-primary-button
            x-on:click="$dispatch('close')"
            type="button"
            type-button="outline"
        >
            {{ __('Cancelar') }}
        </x-primary-button>
    </div>
</form>
