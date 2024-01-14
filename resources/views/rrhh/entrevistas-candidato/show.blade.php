@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Entrevistas') }}
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
                                {{ $entrevista->evaluacion->postulacion->candidato->nombre }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Edad
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $entrevista->evaluacion->postulacion->candidato->edad() }} años
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">DNI
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $entrevista->evaluacion->postulacion->candidato->dni }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">CV
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                <a href="{{ $entrevista->evaluacion->postulacion->candidato->curriculum_url }}"
                                    target="_blank"
                                    class="text-indigo-600 dark:text-indigo-200 hover:text-indigo-900 dark:hover:text-indigo-300">Ver
                                    CV</a>
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100 hidden">Ver más
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                <a href="{{ route('candidatos.show', $entrevista->evaluacion->postulacion->candidato->id) }}"
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
                                {{ $entrevista->evaluacion->postulacion->plaza->puesto->nombre }}
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
                                {{ $entrevista->evaluacion->experiencia_laboral }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Educación
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                @foreach ($entrevista->evaluacion->educacion as $edu)
                                    {{ $edu }}<br>
                                @endforeach
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Habilidades
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                @foreach ($entrevista->evaluacion->habilidades as $hab)
                                    {{ $hab }}<br>
                                @endforeach
                            </dd>
                        </div>
                        @if ($entrevista->evaluacion->postulacion->plaza->puesto->equipo_id == '4')
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Conocimiento
                                    de
                                    materias
                                </dt>
                                <dd
                                    class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                    @foreach ($entrevista->evaluacion->conocimiento_materias as $ma)
                                        {{ $ma }}<br>
                                    @endforeach
                                </dd>
                            </div>

                        @endif

                        @if (!$entrevista->evaluacion->entrevista)
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dd
                                    class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                    <a href="{{ route('rrhh.entrevistas.create', $entrevista->evaluacion->id) }}"
                                        class="bg-indigo-700 hover:bg-indigo-800 ease-in-out text-white py-2 px-5 rounded-sm">Programar
                                        Entrevista</a>
                                </dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="px-4 sm:px-0">
                    <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">Información de la
                        Entrevista</h3>
                </div>
                <div class="mt-6 border-t border-gray-100 dark:border-gray-800">
                    <dl class="divide-y divide-gray-100 dark:divide-gray-800">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Entrevistador
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $entrevista->entrevistador->nombre }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Fecha
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ Carbon::parse($entrevista->fecha)->locale('es_ES')->isoFormat('ll') }}
                                {{ Carbon::parse($entrevista->hora)->locale('es_ES')->isoFormat('LT') }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Estado
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                @switch($entrevista->estado)
                                    @case('aprobada')
                                        <x-badge color="green">Aprobada </x-badge>
                                    @break

                                    @case('rechazada')
                                        <x-badge color="red">Rechazada </x-badge>
                                    @break

                                    @default
                                        <x-badge color="yellow">Pendiente </x-badge>
                                @endswitch
                            </dd>
                        </div>
                        @if ($entrevista->enCurso())
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dd
                                    class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                    @livewire('rrhh-entrevistas.finalizar-entrevista-modal', ['entrevista' => $entrevista], key($entrevista->id))
                                </dd>
                            </div>
                        @endif
                        @if (!$entrevista->enCurso() && !$entrevista->evaluacion->haFinalizado())
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dd
                                    class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                    <a href="{{ route('rrhh.evaluaciones.show', $entrevista->evaluacion) }}"
                                        class="bg-indigo-700 hover:bg-indigo-800 ease-in-out text-white py-2 px-5 rounded-sm">
                                        Continuar con la evaluación
                                    </a>
                                </dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
