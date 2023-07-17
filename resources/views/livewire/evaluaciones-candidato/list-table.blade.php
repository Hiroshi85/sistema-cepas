<div class="flex flex-col gap-5 w-full">
    <div class="flex py-4 w-full items-center justify-between  dark:border-gray-700 border-b border-gray-200 ">
        @livewire('common.search-box', ['placeholder' => 'Ingrese nombre del candidato'])
        <a href="{{ route('rrhh.evaluaciones.create') }}"
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
                        Entrevista
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Puntaje obtenido
                        @livewire('common.sort-button', ['field' => 'puntaje_total'])
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluaciones as $evaluacion)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $evaluacion->candidato_nombre }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $evaluacion->puesto_nombre }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $evaluacion->entrevista ? $evaluacion->entrevista->estado : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $evaluacion->puntaje_total != 0 ? $evaluacion->puntaje_total : '-' }}
                        </td>
                        <td class="px-6 py-4 text-right inline-flex gap-2 items-center justify-center">
                            <a href="{{ route('rrhh.evaluaciones.edit', $evaluacion->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500">
                                @livewire('icons.edit', [], key('edit-icon-' . $evaluacion->id))
                            </a>
                            <button wire:click="confirmEvaluacionDeletion({{ $evaluacion }})"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                @livewire('icons.drop', [], key('drop-icon-' . $evaluacion->id))
                            </button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div
            class="pagination-links px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
            {{ $evaluaciones->links() }}
        </div>
        <div wire:loading.flex
            class="absolute top-0 left-0 flex items-center justify-center w-full h-full dark:bg-gray-700 bg-gray-300 opacity-75 z-20">
            <x-spinner></x-spinner>
        </div>
    </div>

    @if ($confirmingEvaluacionDeletion)
        <x-confirm-deletion-modal action="{{ route('rrhh.evaluaciones.destroy', $selectedEvaluacion->id) }}"
            title="Estas seguro de querer eliminar este evaluacion?" confirmButtonText="Sí, eliminar"
            onClose="cerrarModal" cancelButtonText="No, cancelar" wire:click="deleteEvaluacion">
            <x-slot name="description">
                <p class="mb-3">
                    <span class="font-semibold text-gray-500 dark:text-gray-400">Candidato:</span>
                    <span
                        class="text-gray-500 dark:text-gray-400">{{ $selectedEvaluacion->postulacion->candidato->nombre }}
                    </span>
                    <br>
                    <span class="font-semibold text-gray-500 dark:text-gray-400">Puesto postulado:</span>
                    <span
                        class="text-gray-500 dark:text-gray-400">{{ $selectedEvaluacion->postulacion->plaza->puesto->nombre }}
                    </span>
                </p>
            </x-slot>
        </x-confirm-deletion-modal>
    @endif

</div>
