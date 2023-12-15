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
            <th scope="col" class="px-6 py-3">
                <div class="flex items-center">
                    Fecha de solicitud
                    @livewire('common.sort-button', ['field' => 'fecha_solicitud'])

                </div>
            </th>
            <th scope="col" class="px-6 py-3">
                <div class="flex items-center">
                    Estado
                    @livewire('common.sort-button', ['field' => 'estado'])

                </div>
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Actions</span>
            </th>
        </tr>
        </thead>
        <tbody wire:key="table-data">
        @foreach ($solicitudes as $solicitud)
            <tr
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                x-data="{
                            fecha: {{"new Date('$solicitud->fecha_solicitud')"}}
                        }"
            >
                <th scope="row"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white flex flex-col">
                            <span>
                                {{ $solicitud->alumnoNombre }}
                            </span>
                    <span class="text-gray-400">
                                {{ $solicitud->alumnoDni }}
                            </span>
                </th>
                <td class="px-6 py-4 capitalize">
                    {{ $solicitud->carreraNombre }}
                </td>
                <td class="px-6 py-4" x-html="dfns.format(fecha, 'PPP', {locale: esdfns})">
                    {{-- Carbon::parse($solicitud->fecha_solicitud)->locale('es_ES')->isoFormat('ll') --}}
                </td>
                <td class="px-6 py-4">
                    @if ($solicitud->estado == 'pendiente')
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100">
                                    Pendiente
                                </span>

                    @elseif ($solicitud->estado == 'aceptado')
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    Aceptada
                                </span>
                    @else
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                    Rechazada
                                </span>

                    @endif
                </td>

                <td class="px-6 py-4 text-right inline-flex gap-2 items-center justify-center">
                    <a href="{{ route('academia.ciclo.solicitud.show', [
                                        'ciclo' => $ciclo,
                                        'solicitud' => $solicitud
                                    ])}}"
                       class="font-medium text-green-600 dark:text-green-500">
                        @livewire('icons.show', [], key('show-icon-' . $solicitud->id))
                    </a>
                    <a href="{{ route('academia.ciclo.solicitud.edit', [
                                        'ciclo' => $ciclo,
                                        'solicitud' => $solicitud
                                    ])}}"
                       class="font-medium text-blue-600 dark:text-blue-500">
                        @livewire('icons.edit', [], key('edit-icon-' . $solicitud->id))
                    </a>
                    <button wire:click="confirmEmpleadoDeletion({{ $solicitud }})"
                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
                        @livewire('icons.drop', [], key('drop-icon-' . $solicitud->id))
                    </button>

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div
        class="pagination-links px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
        {{ $solicitudes->links() }}
    </div>
    <div wire:loading.flex
         class="absolute top-0 left-0 flex items-center justify-center w-full h-full dark:bg-gray-700 bg-gray-300 opacity-75 z-20">
        <x-spinner></x-spinner>
    </div>
</div>
