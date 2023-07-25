<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-950 overflow-hidden shadow-sm sm:rounded-lg">
                @if (Auth::user()->roles->count() > 0)
                    <div class="p-6 text-gray-900 dark:text-white">
                        Bienvenido al módulo de RRHH,  {{ Auth::user()->roles->first()->name }}!
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
