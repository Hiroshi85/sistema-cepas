<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __("Lista de alumnos en el ciclo: ") }}
            <span class="py-1 px-1 rounded-md bg-blue-950 text-white">{{$ciclo->nombre}}</span>
        </h2>
    </x-slot>

    <div class="p-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-sm overflow-hidden sm:rounded-lg w-full">
                <div class="px-6 py-2 flex justify-end w-full">
                    <a href={{ route('academia.ciclo.pdf.show', ['ciclo'=>1]) }}
                        target="_blank"
                        class="bg-emerald-500 rounded-lg p-2 pl-3 text-center text-slate-100 dark:text-slate-900 hover:scale-105">
                        @livewire('icons.pdf')
                    </a>
                </div>
                <div class="p-6 text-gray-900 dark:text-white flex flex-col gap-2 ">
                    @livewire('academia.alumnos-academia.list-table', [
                        'ciclo' => $ciclo
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
