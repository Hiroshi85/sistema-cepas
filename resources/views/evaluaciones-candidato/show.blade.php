@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Evaluaciones') }}
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
                                {{ $evaluacion->postulacion->candidato->nombre }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Edad
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $evaluacion->postulacion->candidato->edad() }} años
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">DNI
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $evaluacion->postulacion->candidato->dni }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Email
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $evaluacion->postulacion->candidato->email }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Teléfono
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $evaluacion->postulacion->candidato->telefono }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100 hidden">Ver más
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                <a href="{{ route('candidatos.show', $evaluacion->postulacion->candidato->id) }}"
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
                                {{ $evaluacion->postulacion->plaza->puesto->nombre }}
                            </dd>
                        </div>

                    </dl>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="px-4 sm:px-0">
                    <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">Información de
                        Evaluación</h3>
                </div>
                <div class="mt-6 border-t border-gray-100 dark:border-gray-800">
                    <dl class="divide-y divide-gray-100 dark:divide-gray-800">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Años de
                                experiencia
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $evaluacion->experiencia_laboral }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Educación
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                @foreach ($evaluacion->educacion as $edu)
                                    {{ $edu }}<br>
                                @endforeach
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Habilidades
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                @foreach ($evaluacion->habilidades as $hab)
                                    {{ $hab }}<br>
                                @endforeach
                            </dd>
                        </div>
                        @if ($evaluacion->postulacion->plaza->puesto->equipo_id == '4')
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Conocimiento
                                    de
                                    materias
                                </dt>
                                <dd
                                    class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                    @foreach ($evaluacion->conocimiento_materias as $ma)
                                        {{ $ma }}<br>
                                    @endforeach
                                </dd>
                            </div>

                        @endif

                        @if (!$evaluacion->entrevista)
                            @can('programar entrevistas')
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dd
                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                        <a href="{{ route('rrhh.entrevistas.createForAEvaluacion', $evaluacion->id) }}"
                                            class="bg-indigo-700 hover:bg-indigo-800 ease-in-out text-white py-2 px-5 rounded-sm">Programar
                                            Entrevista</a>
                                    </dd>
                                </div>
                            @endcan
                            @cannot('programar entrevistas')
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">

                                    <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Entrevista
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                        <x-badge color="blue">No programada </x-badge>
                                    </dd>
                                </div>
                            @endcannot
                        @else
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Entrevista
                                </dt>
                                <dd
                                    class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                    @switch($evaluacion->entrevista->estado)
                                        @case('aprobada')
                                            <x-badge color="green">Aprobada </x-badge>
                                        @break

                                        @case('reprobada')
                                            <x-badge color="red">Reprobada </x-badge>
                                        @break

                                        @default
                                            <x-badge color="yellow">Pendiente </x-badge>
                                    @endswitch
                                </dd>
                            </div>
                            @if (!$evaluacion->haFinalizado())
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    @can('gestionar evaluaciones')
                                        <dd
                                            class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">

                                            @livewire('rrhh-evaluaciones.finalizar-evaluacion-modal', ['evaluacion' => $evaluacion], key($evaluacion->id))
                                        </dd>
                                    @endcan
                                </div>
                            @else
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Puntaje
                                        Total
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                        {{ $evaluacion->puntaje_total }}
                                    </dd>
                                </div>
                            @endif
                        @endif
                    </dl>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
