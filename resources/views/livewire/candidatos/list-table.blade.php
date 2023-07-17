<div class="flex flex-col gap-5 w-full">
    <div class="flex py-4 w-full items-center justify-between  dark:border-gray-700 border-b border-gray-200 ">
        @livewire('common.search-box', ['placeholder' => 'Busque un candidato'])
        <a href="{{ route('candidatos.create') }}"
            class="px-4 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md dark:bg-gray-800 hover:bg-blue-500 dark:hover:bg-gray-700 focus:outline-none focus:bg-blue-500 dark:focus:bg-gray-700">Nuevo</a>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg dark:bg-gray-700 bg-gray-300">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                        @livewire('common.sort-button', ['field' => 'nombre'])
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            DNI
                            @livewire('common.sort-button', ['field' => 'dni'])

                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Email
                            @livewire('common.sort-button', ['field' => 'email'])

                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Telefono
                            @livewire('common.sort-button', ['field' => 'telefono'])

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
                @foreach ($candidatos as $candidato)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $candidato->nombre }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $candidato->dni }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $candidato->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $candidato->telefono }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ $candidato->curriculum_url }}" target="_blank" class="font-medium">
                                @livewire('icons.cv', [], key($candidato->id))
                            </a>
                        </td>
                        <td class="px-6 py-4 text-right inline-flex gap-2 items-center justify-center">
                            <a href="{{ route('candidatos.show', $candidato->id) }}"
                                class="font-medium text-green-600 dark:text-green-500">
                                @livewire('icons.show', [], key('show-icon-' . $candidato->id))
                            </a>
                            <a href="{{ route('candidatos.edit', $candidato->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500">
                                @livewire('icons.edit', [], key('edit-icon-' . $candidato->id))
                            </a>
                            {{-- open modal to delete --}}
                            <button wire:click="confirmCandidatoDeletion({{ $candidato }})"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                @livewire('icons.drop', [], key('drop-icon-' . $candidato->id))
                            </button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div
            class="pagination-links px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
            {{ $candidatos->links() }}
        </div>
        <div wire:loading.flex
            class="absolute top-0 left-0 flex items-center justify-center w-full h-full dark:bg-gray-700 bg-gray-300 opacity-75 z-20">
            <x-spinner></x-spinner>
        </div>
    </div>

    @if ($confirmingCandidatoDeletion)
        <x-confirm-deletion-modal action="{{ route('candidatos.destroy', $selectedCandidato) }}"
            title="Estas seguro de querer eliminar este candidato?" confirmButtonText="Sí, eliminar"
            onClose="cerrarModal" cancelButtonText="No, cancelar" wire:click="deleteCandidato">
            <x-slot name="description">
                <p class="mb-3">

                    <span class="font-semibold text-gray-500 dark:text-gray-400">Nombre:</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $selectedCandidato->nombre }}</span>
                </p>
            </x-slot>
        </x-confirm-deletion-modal>
    @endif

</div>
