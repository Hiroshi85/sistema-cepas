<div class="relative overflow-x-auto shadow-md sm:rounded-lg dark:bg-gray-700 bg-gray-300">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Estudiante
                @livewire('common.sort-button', ['field' => 'alumnos.nombre'])
            </th>
            <th scope="col" class="px-6 py-3">
                Carrera
                @livewire('common.sort-button', ['field' => 'carreras_unt.nombre'])
            </th>
        </tr>
        </thead>
        <tbody wire:key="table-data">
        @foreach ($alumnos as $alumno)
            <tr
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
            >
                <th scope="row"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white flex flex-col">
                    <span>
                        {{ $alumno->nombre }}
                    </span>
                    <span class="text-gray-400">
                        {{ $alumno->dni }}
                    </span>
                </th>
                <td class="px-6 py-4 capitalize">
                    {{ $alumno->carreraNombre }}
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div
        class="pagination-links px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
        {{ $alumnos->links() }}
    </div>
    <div wire:loading.flex
         class="absolute top-0 left-0 flex items-center justify-center w-full h-full dark:bg-gray-700 bg-gray-300 opacity-75 z-20">
        <x-spinner></x-spinner>
    </div>
</div>
