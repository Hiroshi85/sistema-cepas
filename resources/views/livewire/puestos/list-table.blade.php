<div class="flex flex-col gap-5 w-full">
    <div class="flex py-4 w-full items-center justify-between  dark:border-gray-700 border-b border-gray-200 ">
        @livewire('common.search-box', ['placeholder' => 'Ingrese nombre del puesto'])
        <a href="{{ route('puestos.create') }}"
            class="px-4 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md dark:bg-gray-800 hover:bg-blue-500 dark:hover:bg-gray-700 focus:outline-none focus:bg-blue-500 dark:focus:bg-gray-700">Nuevo</a>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg dark:bg-gray-700 bg-gray-300">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                        @livewire('common.sort-button', ['field' => 'nombre'], key('sort-button-nombre'))
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Equipo
                            @livewire('common.sort-button', ['field' => 'equipo'], key('sort-button-equipos-nombre'))

                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($puestos as $puesto)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $puesto->nombre }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $puesto->equipo }}
                        </td>
                        <td class="px-6 py-4 text-right inline-flex gap-2 items-center justify-center">
                            <a href="{{ route('puestos.edit', $puesto->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500">
                                @livewire('icons.edit', [], key('edit-icon-' . $puesto->id))
                            </a>
                            {{-- open modal to delete --}}
                            <button wire:click="confirmPuestoDeletion({{ $puesto }})"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                @livewire('icons.drop', [], key('drop-icon-' . $puesto->id))
                            </button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div
            class="pagination-links px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
            {{ $puestos->links() }}
        </div>
        <div wire:loading.flex
            class="absolute top-0 left-0 flex items-center justify-center w-full h-full dark:bg-gray-700 bg-gray-300 opacity-75 z-20">
            <x-spinner></x-spinner>
        </div>
    </div>

    @if ($confirmingPuestoDeletion)
        <x-confirm-deletion-modal action="{{ route('puestos.destroy', $selectedPuesto) }}"
            title="Estas seguro de querer eliminar este puesto?" confirmButtonText="Sí, eliminar" onClose="cerrarModal"
            cancelButtonText="No, cancelar" wire:click="deletePuesto">
            <x-slot name="description">
                <p class="mb-3">

                    <span class="font-semibold text-gray-500 dark:text-gray-400">Nombre:</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $selectedPuesto->nombre }}</span>
                </p>
            </x-slot>
        </x-confirm-deletion-modal>
    @endif

</div>
