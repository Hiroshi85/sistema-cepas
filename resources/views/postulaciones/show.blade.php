@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Postulaciones') }}
        </h2>

    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-gray-950 overflow-hidden shadow-sm sm:rounded-lg p-5">
            <div class="flex flex-col">
                <div class="px-4 sm:px-0">
                    <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">Información del
                        Candidato</h3>
                </div>
                <div class="mt-6 border-t border-gray-100 dark:border-gray-800">
                    <dl class="divide-y divide-gray-100 dark:divide-gray-800">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Nombre
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $postulacion->candidato->nombre }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">DNI
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $postulacion->candidato->dni }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Email
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $postulacion->candidato->email }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Teléfono
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $postulacion->candidato->telefono }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100 hidden">Ver más
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                <a href="{{ route('candidatos.show', $postulacion->candidato->id) }}"
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
                        Postulación</h3>
                </div>
                <div class="mt-6 border-t border-gray-100 dark:border-gray-800">
                    <dl class="divide-y divide-gray-100 dark:divide-gray-800">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Puesto aplicado
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $postulacion->plaza->puesto->nombre }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Fecha de
                                postulación
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ Carbon::parse($postulacion->fecha_postulacion)->locale('es_ES')->isoFormat('LL') }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Estado
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                @switch($postulacion->estado)
                                    @case('en revision')
                                        <x-badge color="indigo">En revisión </x-badge>
                                    @break

                                    @case('aprobado')
                                        <x-badge color="green">Aprobado </x-badge>
                                    @case('rechazado')
                                        <x-badge color="red">Rechazado </x-badge>
                                    @break

                                    @default
                                        <x-badge color="yellow">Pendiente </x-badge>
                                @endswitch
                            </dd>
                        </div>
                        @if ($postulacion->estado == 'pendiente')
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100 hidden">Ver
                                    más
                                </dt>
                                <dd
                                    class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                    <a href="{{ route('rrhh.evaluaciones.createForAPostulacion', $postulacion->id) }}"
                                        class="bg-indigo-700 hover:bg-indigo-800 ease-in-out text-white py-2 px-5 rounded-sm">Evaluar</a>
                                </dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
