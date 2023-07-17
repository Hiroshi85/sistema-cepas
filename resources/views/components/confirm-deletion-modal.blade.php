@props(['action', 'modalName' => 'confirm-deletion', 'title' => 'Estas seguro de querer eliminar este registro?', 'confirmButtonText' => 'Sí, eliminar', 'cancelButtonText' => 'No, cancelar', 'onClose' => ''])

<x-modal name="{{ $modalName }}" :show="true">
    <form method="post" action="{{ $action }}">
        @csrf
        @method('delete')
        <div class="relative w-full h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" @click="show = false" wire:click="{{ $onClose }}"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                    @livewire('icons.x')
                </button>
                <div class="p-6 text-center">
                    @livewire('icons.exclamation-down')
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                        {{ $title }}
                    </h3>
                    {{ $description }}
                    <x-danger-button type="submit">
                        {{ $confirmButtonText }}
                    </x-danger-button>
                    <x-secondary-button type="button"
                        @click="show = false"
                        wire:click="{{ $onClose }}"
                        >
                        {{ $cancelButtonText }}
                    </x-secondary-button>
                </div>
            </div>
        </div>
</x-modal>
