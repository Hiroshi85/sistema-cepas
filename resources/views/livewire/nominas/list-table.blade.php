<div class="flex flex-col gap-5 w-full">
    <div class="flex flex-col items-end sm:flex-row py-4 w-full sm:items-center justify-between  dark:border-gray-700 border-b border-gray-200 ">
        @livewire('common.search-box', ['placeholder' => 'Ingrese nombre del nomina'])
        <a href="{{ route('nominas.create') }}"
           class="px-4 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md dark:bg-gray-800 hover:bg-blue-500 dark:hover:bg-gray-700 focus:outline-none focus:bg-blue-500 dark:focus:bg-gray-700">Nuevo</a>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg dark:bg-gray-700 bg-gray-300">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Empleado
                </th>
                <th scope="col" class="px-6 py-3">
                    Inicio Periodo
                </th>
                <th scope="col" class="px-6 py-3">
                    Fin Periodo
                </th>
                <th scope="col" class="px-6 py-3">
                    Sueldo
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Descuentos
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Prestaciones
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Bruto
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Neto
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($nominas as $nomina)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $nomina->empleado->nombre }}
                    </th>
                    <td
                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $nomina->fecha_inicio }}
                    </td>
                    <td
                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $nomina->fecha_fin }}

                    </td>

                    <td
                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $nomina->sueldoBasicoFormat() }}

                    </td>

                    <td
                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $nomina->totalDescuentosFormat()}}

                    </td>

                    <td
                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $nomina->totalPrestacionesFormat() }}

                    </td>

                    <td
                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $nomina->totalBrutoFormat() }}

                    </td>

                    <td
                        class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $nomina->totalNetoFormat() }}

                    </td>
                    <td class="px-6 py-4 text-right inline-flex gap-2 items-center justify-center">
                        <a href="{{ route('nominas.edit', $nomina->id) }}"
                           class="font-medium text-blue-600 dark:text-blue-500">
                            @livewire('icons.edit', [], key('edit-icon-' . $nomina->id))
                        </a>
                        {{-- open modal to delete --}}
                        <button wire:click="confirmNominaDeletion({{ $nomina }})"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                            @livewire('icons.drop', [], key('drop-icon-' . $nomina->id))
                        </button>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div
            class="pagination-links px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
            {{ $nominas->links() }}
        </div>
        <div wire:loading.flex
             class="absolute top-0 left-0 flex items-center justify-center w-full h-full dark:bg-gray-700 bg-gray-300 opacity-75 z-20">
            <x-spinner></x-spinner>
        </div>
    </div>

    @if ($confirmingNominaDeletion)
        <x-confirm-deletion-modal action="{{ route('nominas.destroy', $selectedNomina) }}"
                                  title="Estas seguro de querer eliminar este nomina?" confirmButtonText="Sí, eliminar" onClose="cerrarModal"
                                  cancelButtonText="No, cancelar" wire:click="deleteNomina">
            <x-slot name="description">
                <p class="mb-3">

                    <span class="font-semibold text-gray-500 dark:text-gray-400">Nombre:</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $selectedNomina->nombre }}</span>
                </p>
            </x-slot>
        </x-confirm-deletion-modal>
    @endif

</div>
