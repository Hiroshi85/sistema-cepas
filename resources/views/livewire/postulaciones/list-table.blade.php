@php
    use Carbon\Carbon;
@endphp
<div class="flex flex-col gap-5 w-full">
    <div class="flex flex-col items-end sm:flex-row py-4 w-full sm:items-center justify-between  dark:border-gray-700 border-b border-gray-200 ">
        @livewire('common.search-box', ['placeholder' => 'Buscar por candidato o puesto postulado'])
        <a href="{{ route('postulaciones.create') }}"
            class="px-4 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md dark:bg-gray-800 hover:bg-blue-500 dark:hover:bg-gray-700 focus:outline-none focus:bg-blue-500 dark:focus:bg-gray-700">Nuevo</a>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg dark:bg-gray-700 bg-gray-300">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Candidato
                        @livewire('common.sort-button', ['field' => 'nombre_candidato'])
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Puesto Postulado
                            @livewire('common.sort-button', ['field' => 'puesto'])

                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Fecha de Postulación
                            @livewire('common.sort-button', ['field' => 'fecha_postulacion'])
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Estado de Postulación
                            @livewire('common.sort-button', ['field' => 'estado'])
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            CV
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postulaciones as $postulacion)
                    <tr
                        class="bg-white border-b dark:bg-black dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-opacity-75 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <th scope="row" class="px-6 py-4  dark:text-white">
                            {{ $postulacion->candidato->nombre }}
                            -
                            {{ $postulacion->candidato->dni }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $postulacion->plaza->puesto->nombre }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Carbon::parse($postulacion->fecha_postulacion)->locale('es_ES')->isoFormat('LL') }}
                        </td>
                        <td class="px-6 py-4">
                            @switch($postulacion->estado)
                                @case('en revision')
                                    <x-badge color="indigo">En revisión </x-badge>
                                @break

                                @case('aprobado')
                                    <x-badge color="green">Aprobado </x-badge>
                                @case('rechazado')
                                    <x-badge color="red">Rechazado </x-badge>
                                @break

                                @default
                                    <x-badge color="yellow">Pendiente </x-badge>
                            @endswitch
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ $postulacion->candidato->curriculum_url }}" target="_blank"
                                class="font-medium">
                                @livewire('icons.cv', [], key($postulacion->id))
                            </a>
                        </td>
                        <td class="px-6 py-4 text-right inline-flex gap-2 items-center justify-center">
                            <a href="{{ route('postulaciones.show', $postulacion->id) }}"
                                class="font-medium text-green-600 dark:text-green-500">
                                @livewire('icons.show', [], key('show-icon-' . $postulacion->id))
                            </a>
                            <a href="{{ route('postulaciones.edit', $postulacion->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500">
                                @livewire('icons.edit', [], key('edit-icon-' . $postulacion->id))
                            </a>
                            <button wire:click="confirmPostulacionDeletion({{ $postulacion }})"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                @livewire('icons.drop', [], key('drop-icon-' . $postulacion->id))
                            </button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div
            class="pagination-links px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
            {{ $postulaciones->links() }}
        </div>
        <div wire:loading.flex
            class="absolute top-0 left-0 flex items-center justify-center w-full h-full dark:bg-gray-700 bg-gray-300 opacity-75 z-20">
            <x-spinner></x-spinner>
        </div>

    </div>

    @if ($confirmingPostulacionDeletion)
        <x-confirm-deletion-modal modalName="confirm-postulacion-deletion"
            action="{{ route('postulaciones.destroy', $selectedPostulacion) }}"
            title="Estas seguro de querer eliminar esta postulación?" confirmButtonText="Sí, eliminar"
            onClose="cerrarModal" cancelButtonText="No, cancelar" wire:click="deletePostulaciones">
            <x-slot name="description">
                <p class="mb-3">

                    <span class="font-semibold text-gray-500 dark:text-gray-400">Candidato:</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $selectedPostulacion->candidato->nombre }}
                    </span>
                    <br>
                    <span class="font-semibold text-gray-500 dark:text-gray-400">Puesto postulado:</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $selectedPostulacion->plaza->puesto->nombre }}
                    </span>
                </p>
            </x-slot>
        </x-confirm-deletion-modal>
    @endif

</div>
