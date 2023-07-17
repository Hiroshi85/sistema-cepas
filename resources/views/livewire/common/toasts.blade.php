<div class="fixed top-0 right-0 overflow-x-hidden">
    @foreach ($toasts as $toast)
        <div x-data="{ visible: true }" x-init="setTimeout(() => visible = false, 10000)"
            class="mx-5 md:mx-12 lg:mx-24 my-10 bg-gradient-to-r text-white p-3 rounded mb-3 shadow-lg flex items-center"
            x-show="visible" x-transition:enter="transition ease-in duration-200"
            x-transition:enter-start="transform opacity-0 translate-y-2" x-transition:enter-end="transform opacity-100"
            x-transition:leave="transition ease-out duration-500"
            x-transition:leave-start="transform translate-x-0 opacity-100"
            x-transition:leave-end="transform translate-x-full opacity-0"
            :class="{
                'from-blue-500 to-blue-600': '{{ $toast['type'] }}' === 'info',
                'from-green-500 to-green-600': '{{ $toast['type'] }}' === 'success',
                'from-yellow-400 to-yellow-500': '{{ $toast['type'] }}' === 'warning',
                'from-red-500 to-pink-500': '{{ $toast['type'] }}' === 'error',
            }">
            @if ($toast['type'] === 'info')
                <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd" />
                </svg>
            @elseif ($toast['type'] === 'success')
                <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
            @elseif ($toast['type'] === 'warning')
                <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
            @elseif ($toast['type'] === 'error')
                <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
            @endif
            <div>{{ $toast['message'] }}</div>
            <button wire:click="dismissToast('{{ $toast['id'] }}')">
                @livewire('icons.x', [], key($toast['id']))
            </button>
        </div>
    @endforeach
</div>
