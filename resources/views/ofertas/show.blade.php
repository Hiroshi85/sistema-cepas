@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ofertas') }}
        </h2>

    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-gray-950 overflow-hidden shadow-sm sm:rounded-lg p-5">
            <div class="flex flex-col">
                <div class="px-4 sm:px-0  flex justify-between items-center">
                    <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">Información de
                        Postulación</h3>
                    <a href="{{ route('ofertas.pdf.show', ['oferta' => $oferta->id]) }}"
                        class="bg-emerald-500 p-2 rounded text-center text-slate-100 dark:text-slate-900">
                        @livewire('icons.pdf')
                    </a>
                </div>
                <div class="mt-6 border-t border-gray-100 dark:border-gray-800">
                    <dl class="divide-y divide-gray-100 dark:divide-gray-800">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Candidato
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $oferta->postulacion->candidato->nombre }}
                                -
                                {{ $oferta->postulacion->candidato->edad() }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Puesto aplicado
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $oferta->postulacion->plaza->puesto->nombre }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100 hidden">Ver más
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                <a href="{{ route('postulaciones.show', $oferta->postulacion->id) }}"
                                    class="text-indigo-600 dark:text-indigo-200 hover:text-indigo-900 dark:hover:text-indigo-300">Ver
                                    más</a>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="px-4 sm:px-0">
                    <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">Información de
                        la Oferta</h3>
                </div>
                <div class="mt-6 border-t border-gray-100 dark:border-gray-800">
                    <dl class="divide-y divide-gray-100 dark:divide-gray-800">

                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Fecha Inicio de
                                Oferta
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ Carbon::parse($oferta->fecha_inicio)->locale('es_ES')->isoFormat('LL') }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Fecha Fin de
                                Oferta
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ Carbon::parse($oferta->fecha_fin)->locale('es_ES')->isoFormat('LL') }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Salario Ofrecido
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                S/. {{ $oferta->salario }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100"> Tiempo de
                                contrato
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $oferta->meses_contrato }} meses
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100"> Fecha inicio de
                                labores
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{Carbon::parse($oferta->contrato_fecha_inicio)->locale('es_ES')->isoFormat('LL')}}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Descripción
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $oferta->descripcion }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Beneficios
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                @foreach ($oferta->beneficios as $beneficio)
                                    <x-badge color="green">{{ $beneficio }}</x-badge>
                                @endforeach
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Estado
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                @switch($oferta->estado)
                                    @case('aceptada')
                                        <x-badge color="green">Aceptada </x-badge>
                                    @break

                                    @case('rechazada')
                                        <x-badge color="red">Rechazada </x-badge>
                                    @break

                                    @default
                                        <x-badge color="yellow">Pendiente </x-badge>
                                @endswitch
                            </dd>
                        </div>
                        @if ($oferta->estado == 'pendiente')
                            @can('gestionar ofertas')
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">

                                    <dd
                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                        @livewire('ofertas.decision-candidato-modal', ['oferta' => $oferta], key($oferta->id))
                                    </dd>
                                </div>
                            @endcan
                        @endif
                        @if ($oferta->estado == 'aceptada')
                            @can('gestionar contratos')
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">

                                    <dd
                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                        <a href="{{ route('ofertas.firmarContratoPdf', $oferta) }}"
                                            class="bg-indigo-700 hover:bg-indigo-800 ease-in-out text-white py-2 px-5 rounded-sm">Documento
                                            Contrato </a>
                                    </dd>
                                </div>
                            @endcan
                        @endif
                    </dl>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
