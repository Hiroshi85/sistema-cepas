<x-modal
    name="new-cicle"
    :show="!$errors->isEmpty()"
>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear un ciclo académico') }}
        </h2>
    </x-slot:header>

    <form action={{route('academia.ciclo.store')}} method="post" class="" x-data="{
        fecha_inicio: new Date().toISOString().slice(0,10),
        fecha_fin: ''
    }">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 px-5 py-3 border-b border-gray-200 dark:bg-gray-900">
            <div class="col-span-2">
                <x-input-label for="nombre" :value="__('Nombre del ciclo')"></x-input-label>
                <x-text-input
                    id="nombre"
                    name="nombre"
                    type="text"
                    value="{{ old('nombre') }}"
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
                    value="{{ old('fecha_inicio') }}"
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
                    value="{{ old('fecha_fin') }}"
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
                {{ __('Registrar') }}
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

</x-modal>
