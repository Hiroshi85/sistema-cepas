@php
    use Carbon\Carbon;
@endphp

<div class="flex flex-col gap-5 w-full">
    <div class="flex py-4 w-full items-center justify-between  dark:border-gray-700 border-b border-gray-200 ">
        @livewire('common.search-box', ['placeholder' => 'Ingrese nombre del puesto'])
        <a href="{{ route('plazas.create') }}"
            class="px-4 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md dark:bg-gray-800 hover:bg-blue-500 dark:hover:bg-gray-700 focus:outline-none focus:bg-blue-500 dark:focus:bg-gray-700">Nuevo</a>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg dark:bg-gray-700 bg-gray-300">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Puesto
                        @livewire('common.sort-button', ['field' => 'puesto'], key('sort-button-puesto'))
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Fecha de Inicio
                            @livewire('common.sort-button', ['field' => 'fecha_inicio'], key('sort-button-fecha_inicio'))
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Fecha Fin
                            @livewire('common.sort-button', ['field' => 'fecha_fin'], key('sort-button-fecha_fin'))
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plazas as $plaza)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $plaza->puesto }}
                        </th>
                        <td class="px-6 py-4">
                            {{ Carbon::parse($plaza->fecha_inicio)->locale('es_ES')->isoFormat('ll') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Carbon::parse($plaza->fecha_fin)->locale('es_ES')->isoFormat('ll') }}
                        </td>
                        <td class="px-6 py-4 text-right inline-flex gap-2 items-center justify-center">
                            <a href="{{ route('plazas.edit', $plaza->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500">
                                @livewire('icons.edit', [], key('edit-icon-' . $plaza->id))
                            </a>
                            {{-- open modal to delete --}}
                            <button wire:click="confirmPlazaDeletion({{ $plaza }})"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                @livewire('icons.drop', [], key('drop-icon-' . $plaza->id))
                            </button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div
            class="pagination-links px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
            {{ $plazas->links() }}
        </div>
        <div wire:loading.flex
            class="absolute top-0 left-0 flex items-center justify-center w-full h-full dark:bg-gray-700 bg-gray-300 opacity-75 z-20">
            <x-spinner></x-spinner>
        </div>
    </div>

    @if ($confirmingPlazaDeletion)
        <x-confirm-deletion-modal action="{{ route('plazas.destroy', $selectedPlaza) }}"
            title="Estas seguro de querer eliminar esta plaza?" confirmButtonText="Sí, eliminar" onClose="cerrarModal"
            cancelButtonText="No, cancelar" wire:click="deletePlaza">
            <x-slot name="description">
                <p class="mb-3">

                    <span class="font-semibold text-gray-500 dark:text-gray-400">Nombre:</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $selectedPlaza->puesto }}
                        Del {{ $selectedPlaza->fecha_inicio }} al {{ $selectedPlaza->fecha_fin }}
                    </span>
                </p>
            </x-slot>
        </x-confirm-deletion-modal>
    @endif

</div>
