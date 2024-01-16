<div class="flex flex-col gap-3">
    @foreach($prestaciones as $prestacion)
        <div
            class="flex flex-col md:grid md:grid-cols-12 justify-between items-center gap-3"
        >

            <div
                class="flex flex-col md:grid md:grid-cols-2 md:col-span-10 gap-5"
            >
                <select
                    name="prestaciones[{{ $loop->index }}][tipo_prestacion_id]"
                    class="border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-transparent capitalize"
                    wire:change="updatePrestacion({{ $loop->index }}, $event.target.value)"
                >
                    <option value="">Seleccionar</option>
                    @foreach($tipos_prestacion as $tipo_prestacion)
                        <option
                            {{ $prestacion['tipo_prestacion_id'] == $tipo_prestacion->id ? 'selected' : ''}}
                            value="{{ $tipo_prestacion->id }}">{{ $tipo_prestacion->nombre }}</option>
                    @endforeach
                </select>

                <input
                    type="number"
                    name="prestaciones[{{ $loop->index }}][monto]"
                    readonly
                    class="border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-transparent"
                    wire:model="prestaciones.{{ $loop->index }}.monto"
                    placeholder="Monto"
                    min="0"
                >
            </div>

            <div
                class="md:col-span-2 flex items-center justify-center"
            >
                <button
                    wire:click.prevent="remove({{ $loop->index }})"
                    class="bg-red-500 hover:bg-red-700 text-white p-2 rounded text-sm "
                >
                    @livewire('icons.x', [
                    ], key($loop->index))
                </button>
            </div>
        </div>
    @endforeach
    <button
        wire:click.prevent="add"
        class="bg-gray-800 hover:bg-gray-900 text-white py-1 px-4 rounded text-sm"
    >
        Agregar
    </button>

</div>
