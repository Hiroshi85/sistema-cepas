@php
    use Carbon\Carbon;
@endphp
<div class="flex flex-col gap-5 w-full">
    <div
        class="flex flex-col items-end sm:flex-row py-4 w-full sm:items-center justify-between  dark:border-gray-700 border-b border-gray-200 ">
        @livewire('common.search-box', ['placeholder' => 'Buscar por empleado o puesto'])
        <a href="{{ route('contratos.create') }}"
            class="px-4 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md dark:bg-gray-800 hover:bg-blue-500 dark:hover:bg-gray-700 focus:outline-none focus:bg-blue-500 dark:focus:bg-gray-700">Nuevo</a>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg dark:bg-gray-700 bg-gray-300">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Empleado
                        @livewire('common.sort-button', ['field' => 'nombre_empleado'])
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Puesto
                            @livewire('common.sort-button', ['field' => 'puesto'])

                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Tipo de Contrato
                            @livewire('common.sort-button', ['field' => 'tipo_contrato'])

                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Inicio Contrato
                            @livewire('common.sort-button', ['field' => 'fecha_inicio'])
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Fin Contrato
                            @livewire('common.sort-button', ['field' => 'fecha_fin'])
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 flex gap-3 items-center">
                        <select wire:model="estado"
                            class="text-xs uppercase border-none bg-white focus:outline-none focus:ring-0">
                            <option value="">Ver todos</option>
                            <option value="proxima">Ver Próximos a iniciar</option>
                            <option value="vigente">Ver Vigentes</option>
                            <option value="finalizado">Ver Finalizados</option>
                        </select>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contratos as $contrato)
                    <tr
                        class="bg-white border-b dark:bg-black dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-opacity-75 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <th scope="row" class="px-6 py-4  dark:text-white">
                            {{ $contrato->empleado_nombre }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $contrato->puesto }}
                        </td>
                        <td class="px-6 py-4">
                            @switch($contrato->
                                tipo_contrato)
                                @case('tiempo completo')
                                    <x-badge color="green">Tiempo Completo </x-badge>
                                @break

                                @default
                                    <x-badge color="blue">Tiempo Parcial </x-badge>
                            @endswitch
                        </td>
                        <td class="px-6 py-4">
                            {{ Carbon::parse($contrato->fecha_inicio)->locale('es_ES')->isoFormat('LL') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Carbon::parse($contrato->fecha_fin)->locale('es_ES')->isoFormat('LL') }}
                        </td>
                        <td class="px-6 py-4">
                            @switch($contrato->estado())
                                @case('vigente')
                                    <x-badge color="green">Vigente </x-badge>
                                @break

                                @case('finalizado')
                                    <x-badge color="red">Finalizado </x-badge>
                                @break

                                @default
                                    <x-badge color="yellow">Próximo a iniciar </x-badge>
                            @endswitch
                        </td>
                        <td class="px-6 py-4 text-right inline-flex gap-2 items-center justify-center">
                            <a href="{{ route('contratos.show', $contrato->id) }}"
                                class="font-medium text-green-600 dark:text-green-500">
                                @livewire('icons.show', [], key('show-icon-' . $contrato->id))
                            </a>
                            <a href="{{ route('contratos.edit', $contrato->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500">
                                @livewire('icons.edit', [], key('edit-icon-' . $contrato->id))
                            </a>
                            <button wire:click="confirmContratoDeletion({{ $contrato }})"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                @livewire('icons.drop', [], key('drop-icon-' . $contrato->id))
                            </button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div
            class="pagination-links px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
            {{ $contratos->links() }}
        </div>
        <div wire:loading.flex
            class="absolute top-0 left-0 flex items-center justify-center w-full h-full dark:bg-gray-700 bg-gray-300 opacity-75 z-20">
            <x-spinner></x-spinner>
        </div>

    </div>

    @if ($confirmingContratoDeletion)
        <x-confirm-deletion-modal modalName="confirm-contratos-deletion"
            action="{{ route('contratos.destroy', $selectedContrato) }}"
            title="Estas seguro de querer eliminar este contrato?" confirmButtonText="Sí, eliminar"
            onClose="cerrarModal" cancelButtonText="No, cancelar" wire:click="deleteContratos">
            <x-slot name="description">
                <p class="mb-3">

                    <span class="font-semibold text-gray-500 dark:text-gray-400">Empleado:</span>
                    <span class="text-gray-500 dark:text-gray-400">{{ $selectedContrato->empleado->nombre }}
                    </span>
                    <br>
                    <span class="font-semibold text-gray-500 dark:text-gray-400">Inicio de Contrato:</span>
                    <span class="text-gray-500 dark:text-gray-400">
                        {{ Carbon::parse($selectedContrato->fecha_inicio)->locale('es_ES')->isoFormat('LL') }}
                    </span>
                    <br>
                    <span class="font-semibold text-gray-500 dark:text-gray-400">Fin de Contrato:</span>
                    <span class="text-gray-500 dark:text-gray-400">
                        {{ Carbon::parse($selectedContrato->fecha_fin)->locale('es_ES')->isoFormat('LL') }}
                    </span>
                </p>
            </x-slot>
        </x-confirm-deletion-modal>
    @endif

</div>
