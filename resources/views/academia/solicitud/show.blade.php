@php
    use Carbon\Carbon;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex flex-col">
            <span>
                {{ 'Solicitud de '.$solicitud->alumno->nombre_apellidos }}
            </span>
            <span class="text-sm text-gray-500">
                {{ 'Solicitud ID: '.$solicitud->id }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-950 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex">
                        <div class="flex-1 flex flex-col gap-3">

                            {{-- Solicitante --}}
                            <div class="">
                                <h4 class="font-extrabold text-2xl">Solicitante:</h4>
                                {{-- Nombre del solicitante --}}
                                <div class="ml-4">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <span class="font-bold">
                                                Nombre:
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <span class="text-sm">
                                                {{ $solicitud->alumno->nombre_apellidos }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="w-1/3">
                                            <span class="font-bold">
                                                DNI:
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <span class="text-sm">
                                                {{ $solicitud->alumno->dni }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- Carrera --}}
                            <div class="">
                                <h4 class="font-extrabold text-2xl">Carrera:</h4>
                                {{-- Nombre del solicitante --}}
                                <div class="ml-4">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <span class="font-bold">
                                                Nombre:
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <span class="text-sm">
                                                {{ ucfirst($solicitud->carrera->nombre) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="w-1/3">
                                            <span class="font-bold">
                                                Area:
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <span class="text-sm">
                                                {{ $solicitud->carrera->area->nombre }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="w-1/3">
                                            <span class="font-bold">
                                                Facultad:
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <span class="text-sm">
                                                {{ strtoupper($solicitud->carrera->facultad->nombre) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Datos --}}
                            <div class="">
                                <h4 class="font-extrabold text-2xl">Datos:</h4>
                                {{-- Nombre del solicitante --}}
                                <div class="ml-4">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <span class="font-bold">
                                                Fecha de solicitud:
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <span class="text-sm">
                                                {{ Carbon::parse($solicitud->fecha_solicitud)->locale('es_ES')->isoFormat('ll') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex">
                                        <div class="w-1/3">
                                            <span class="font-bold">
                                                Observaciones:
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            @if ($solicitud->observaciones == null || $solicitud->observaciones == '')
                                                <span class="text-sm italic">
                                                    Sin observaciones
                                                </span>
                                            @else
                                                <span class="text-sm">
                                                    {{ $solicitud->alumno->dni }}
                                                </span>

                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Detalles --}}
                        <div class="w-1/3 flex">
                            <form action=""></form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
