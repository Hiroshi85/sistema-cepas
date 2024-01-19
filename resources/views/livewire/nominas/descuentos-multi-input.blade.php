<div class="flex flex-col gap-3">
    @foreach($descuentos as $descuento)
        <div
            class="flex flex-col md:grid md:grid-cols-12 justify-between items-center gap-3"
        >

            <div
                class="flex flex-col md:grid md:grid-cols-2 md:col-span-10 gap-5"
            >
                <select
                    name="descuentos[{{ $loop->index }}][tipo_descuento_id]"
                    class="border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-transparent capitalize"
                    wire:change="updateDescuento({{ $loop->index }}, $event.target.value)"
                >
                    <option value="">Seleccionar</option>
                    @foreach($tipos_descuento as $tipo_descuento)
                        <option
                            {{ $descuento['tipo_descuento_id'] == $tipo_descuento->id ? 'selected' : ''}}
                            value="{{ $tipo_descuento->id }}">{{ $tipo_descuento->nombre }}</option>
                    @endforeach
                </select>

                <input
                    type="number"
                    name="descuentos[{{ $loop->index }}][monto]"
                    readonly
                    class="border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-transparent"
                    wire:model="descuentos.{{ $loop->index }}.monto"
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
