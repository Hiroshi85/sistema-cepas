<div class="flex flex-col gap-5 w-full">
    <div
        class="flex flex-col items-end sm:flex-row py-4 w-full sm:items-center justify-between  dark:border-gray-700 border-b border-gray-200 ">
        @livewire('common.search-box', ['placeholder' => 'Buscar docente'])

        <x-primary-button :link="true" href="{{ route('empleados.create', [
            'puesto' => 'docente-academia'
        ]) }}">
            Nuevo
        </x-primary-button>

    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg dark:bg-gray-700 bg-gray-300">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                        @livewire('common.sort-button', ['field' => 'alumnos.nombre'])
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Especialidad
                        @livewire('common.sort-button', ['field' => 'carreras_unt.nombre'])
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody wire:key="table-data">
                @foreach ($docentes as $docente)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white flex flex-col">
                            <span>
                                {{ $docente->empleado->nombre }}
                            </span>
                            <span class="text-gray-400 text-xs">
                                {{ $docente->empleado->dni }}
                            </span>
                        </th>
                        <td class="px-6 py-4 capitalize">
                            {{ $docente->especialidad_id ? $docente->especialidad->nombre : 'Sin especialidad' }}
                        </td>
                        <td class="px-6 py-4 text-right inline-flex gap-2 items-center justify-center">
                            <a href="{{ route('academia.docente.show', [
                                'docente' => $docente,
                            ]) }}"
                                class="font-medium text-green-600 dark:text-green-500">
                                @livewire('icons.show', [], key('show-icon-' . $docente->id))
                            </a>
                            <a href="{{ route('academia.docente.edit', [
                                'docente' => $docente,
                            ]) }}"
                                class="font-medium text-blue-600 dark:text-blue-500">
                                @livewire('icons.edit', [], key('edit-icon-' . $docente->id))
                            </a>
                            <button wire:click="confirmEmpleadoDeletion({{ $docente }})"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                @livewire('icons.drop', [], key('drop-icon-' . $docente->id))
                            </button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div
            class="pagination-links px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
            {{ $docentes->links() }}
        </div>
        <div wire:loading.flex
            class="absolute top-0 left-0 flex items-center justify-center w-full h-full dark:bg-gray-700 bg-gray-300 opacity-75 z-20">
            <x-spinner></x-spinner>
        </div>
    </div>
</div>
