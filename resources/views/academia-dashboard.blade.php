<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Academia Cepas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-academia.current-cicle-card :curr-cicle="$currCicle"  />

            @if($currCicle)
                <x-academia.current-ciclo-status :curr-cicle="$currCicle" />

            @endif

        </div>
    </div>

    @if($currCicle)
        @include('academia.partials.edit', [
            'ciclo' => $currCicle
        ])
    @else
        @include('academia.partials.new')
    @endif



</x-app-layout>
