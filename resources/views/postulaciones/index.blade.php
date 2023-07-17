<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Postulaciones') }}
            </h2>
            <div class="flex items-center sm:px-6 lg:px-8">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-200 bg-white dark:bg-gray-900 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>Ver</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('postulaciones.index')">
                            Normal
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('postulaciones.index', ['mode' => 'candidatos'])">
                            Por Candidatos
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('postulaciones.index', ['mode' => 'plazas'])">
                            Por Plazas
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>

            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-950 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @switch($mode)
                        @case('plazas')
                            @livewire('postulaciones.plazas.list-table')
                        @break

                        @case('candidatos')
                            @livewire('postulaciones.candidatos.list-table')
                        @break

                        @default
                            @livewire('postulaciones.list-table')
                    @endswitch

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
