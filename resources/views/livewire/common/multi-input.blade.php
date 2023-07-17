<div class="flex flex-col gap-2 w-full">
    <label class="block font-medium text-sm text-gray-700 dark:text-gray-200">
        {{ $label }}
    </label>
    @foreach ($items as $index => $item)
        <div class="flex mb-2 w-full gap-3">
            <input value="{{ old($name.'.'.$index, $item) }}" type="text" name="{{ $name }}[]"
                wire:model="items.{{ $index }}" placeholder="Item {{ $index + 1 }}"
                class="border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-transparent w-full">

            <button type="button" wire:click="eliminarItem({{ $index }})"
                class="font-medium bg-red-600 dark:bg-red-500 hover:underline text-white p-3 rounded">
                @livewire('icons.drop', [], key('drop-icon-' . $index))
            </button>
        </div>
    @endforeach

    <div>
        <x-primary-button type="button" wire:click="agregarItem">
            Agregar Item
        </x-primary-button>
    </div>
</div>
