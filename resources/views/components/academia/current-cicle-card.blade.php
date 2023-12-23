@push('styles')
    @vite(['resources/css/academia/current-cicle-card.css'])
@endpush

@if($currCicle != null)

    <div class="flex justify-center">
        <div class="max-w-xl w-full bg-white dark:bg-gray-900 shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-white">
                <div class="">
                    {{-- header --}}
                    <div class="flex justify-between items-center">
                        <h5 class="text-gray-300 dark:text-gray-600 uppercase text-xs">
                            Ciclo académico actual
                        </h5>

                        <x-dropdown align="right" width='48'>
                            <x-slot:trigger>
                                <x-primary-button type-button="outline">
                                    ...
                                </x-primary-button>
                            </x-slot:trigger>

                            <x-slot:content>
                                <x-dropdown-button
                                    x-on:click.prevent="$dispatch('open-modal', 'edit-cicle')"
                                >
                                    {{ __('Editar') }}
                                </x-dropdown-button>
                                <x-dropdown-link href="{{ route('academia.ciclo.create') }}">
                                    {{ __('Crear un ciclo académico') }}
                                </x-dropdown-link>
                            </x-slot:content>

                        </x-dropdown>

                    </div>

                    <h3 class="text-black dark:text-white font-black text-3xl">
                        {{ $currCicle->nombre }}
                    </h3>

                    <p class="text-gray-600">
                        {{ $currCicle->descripcion }}
                    </p>
                    <div class="time"  x-data="{
                        fechaInicio: new Date('{{$currCicle->fecha_inicio}}'),
                        fechaFin: new Date('{{$currCicle->fecha_fin}}')
                    }">


                        <div class="flex sm:hidden justify-between items-center">
                            <span class="time-l" x-html="dfns.format(fechaInicio, 'PP', {locale: esdfns})"></span>
                            <div class="line"></div>
                            <span class="time-r" x-html="dfns.format(fechaFin, 'PP', {locale: esdfns})"></span>
                        </div>

                        <div class="hidden sm:flex justify-between items-center">
                            <span class="time-l" x-html="dfns.format(fechaInicio, 'PPP', {locale: esdfns})"></span>
                            <div class="line"></div>
                            <span class="time-r" x-html="dfns.format(fechaFin, 'PPP', {locale: esdfns})"></span>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-white">
            <div class="flex justify-between items-center">
                <div>
                    {{ __("No hay un ciclo académico activo") }}
                </div>
                <ul class="flex flex-col gap-y-3">
                    <li>
                        <a href="" class="text-blue-500 hover:text-blue-700">
                            {{ __("Ver ciclos académicos") }}
                        </a>
                    </li>
                    <li>
                        <button
                            class="text-blue-500 hover:text-blue-700"
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'new-cicle')"
                        >
                            {{ __("Crear un ciclo académico") }}
                        </button>
                    </li>

                </ul>
            </div>
        </div>
    </div>
@endif

