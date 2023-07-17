<button wire:click="toggle" class="w-full flex items-center justify-center h-full py-2">
    @if ($theme == 'dark')
        @livewire('icons.sun')
    @else
        @livewire('icons.moon')
    @endif

</button>
