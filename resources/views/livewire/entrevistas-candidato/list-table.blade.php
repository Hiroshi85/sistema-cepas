@php
    use Carbon\Carbon;
@endphp

<div class="flex flex-col gap-5 w-full">
    <div
        class="flex flex-col items-end sm:flex-row py-4 w-full sm:items-center justify-between  dark:border-gray-700 border-b border-gray-200 ">
        @livewire('common.search-box', ['placeholder' => 'Ingrese nombre del candidato'])
        <a href="{{ route('rrhh.entrevistas.create') }}"
            class="px-4 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md dark:bg-gray-800 hover:bg-blue-500 dark:hover:bg-gray-700 focus:outline-none focus:bg-blue-500 dark:focus:bg-gray-700">Nuevo</a>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg dark:bg-gray-700 bg-gray-300">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Candidato
                        @livewire('common.sort-button', ['field' => 'candidato_nombre'])
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Puesto al que postula
                        @livewire('common.sort-button', ['field' => 'puesto_nombre'])
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Entrevistador
                        @livewire('common.sort-button', ['field' => 'entrevistador_nombre'])
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha y hora
                        @livewire('common.sort-button', ['field' => 'Fecha'])
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entrevistas as $entrevista)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $entrevista->candidato_nombre }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $entrevista->puesto_nombre }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $entrevista->entrevistador_nombre }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Carbon::parse($entrevista->fecha)->locale('es_ES')->isoFormat('ll') }}
                            {{ Carbon::parse($entrevista->hora)->locale('es_ES')->isoFormat('LT') }}
                        </td>
                        <td class="px-6 py-4">
                            @switch($entrevista->estado)
                                @case('aprobada')
                                    <x-badge color="green">Aprobada </x-badge>
                                @break

                                @case('rechazada')
                                    <x-badge color="red">Rechazada </x-badge>
                                @break

                                @default
                                    <x-badge color="yellow">Pendiente </x-badge>
                            @endswitch
                        </td>
                        <td class="px-6 py-4 text-right inline-flex gap-2 items-center justify-center">
                            <a href="{{ route('rrhh.entrevistas.show', $entrevista->id) }}"
                                class="font-medium text-green-600 dark:text-green-500">
                                @livewire('icons.show', [], key('show-icon-' . $entrevista->id))
                            </a>
                            <a href="{{ route('rrhh.entrevistas.edit', $entrevista->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500">
                                @livewire('icons.edit', [], key('edit-icon-' . $entrevista->id))
                            </a>
                            <button wire:click="confirmEntrevistaDeletion({{ $entrevista }})"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                @livewire('icons.drop', [], key('drop-icon-' . $entrevista->id))
                            </button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div
            class="pagination-links px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
            {{ $entrevistas->links() }}
        </div>
        <div wire:loading.flex
            class="absolute top-0 left-0 flex items-center justify-center w-full h-full dark:bg-gray-700 bg-gray-300 opacity-75 z-20">
            <x-spinner></x-spinner>
        </div>
    </div>

    @if ($confirmingEntrevistaDeletion)
        <x-confirm-deletion-modal action="{{ route('rrhh.entrevistas.destroy', $selectedEntrevista->id) }}"
            title="Estas seguro de querer eliminar este entrevista?" confirmButtonText="Sí, eliminar"
            onClose="cerrarModal" cancelButtonText="No, cancelar" wire:click="deleteEntrevista">
            <x-slot name="description">
                <p class="mb-3">
                    <span class="font-semibold text-gray-500 dark:text-gray-400">Candidato:</span>
                    <span
                        class="text-gray-500 dark:text-gray-400">{{ $selectedEntrevista->evaluacion->postulacion->candidato->nombre }}
                    </span>
                    <br>
                    <span class="font-semibold text-gray-500 dark:text-gray-400">Puesto postulado:</span>
                    <span
                        class="text-gray-500 dark:text-gray-400">{{ $selectedEntrevista->evaluacion->postulacion->plaza->puesto->nombre }}
                    </span>
                    <br>
                    <span class="font-semibold text-gray-500 dark:text-gray-400">Entrevistador:</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $selectedEntrevista->entrevistador->nombre }}
                    </span>
                </p>
            </x-slot>
        </x-confirm-deletion-modal>
    @endif

</div>
