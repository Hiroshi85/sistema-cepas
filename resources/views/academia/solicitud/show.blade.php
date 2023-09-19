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
                    <a href={{route('solicitud.index')}} class="bg-blue-500 px-3 py-2 rounded-md mb-5">Volver</a>
                    <div class="flex mt-5">
                        <div class="flex-1 flex flex-col gap-3">
                            {{-- Datos --}}
                            <div class="">
                                <div class="flex gap-3 items-center">
                                    <h4 class="font-extrabold text-2xl">Datos:</h4>
                                    <div class="text-sm">
                                        @if ($solicitud->estado == 'pendiente')
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100">
                                                Pendiente
                                            </span>
                                            
                                        @elseif ($solicitud->estado == 'aceptado')
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                Aceptada
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                                Rechazada
                                            </span>
                                            
                                        @endif
                                    </div>
                                </div>
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

                            

                        </div>

                        {{-- Detalles --}}
                        <div class="w-[40%]">
                            <h4 class="font-bold text-2xl">Decisión</h4>

                            @if ($solicitud->estado == 'pendiente')
                                <form action={{route('solicitud.accionSolicitud', $solicitud->id)}} method="POST">
                                    @csrf
                                    @method('PUT')

                                    <x-input-group value="{{ old('observaciones') }}" label="Observaciones" name="observaciones" type="textarea"
                                        class="mb-2"
                                        placeholder="Observaciones..." />

                                    <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700" name="accion" value="aceptar">
                                        {{ __('Aprobar') }}
                                    </x-primary-button>

                                    <x-primary-button type="submit" class="bg-red-500 hover:bg-red-700" name="accion" value="rechazar">
                                        {{ __('Rechazar') }}
                                    </x-primary-button>
                                </form> 
                            @else
                                <span class="font-bold">
                                    Desisión:
                                </span>
                                <p class="ml-5">
                                    {{ $solicitud->documento->estado}}
                                </p>
                                <span class="font-bold">
                                    Obsercaciones:
                                </span>
                                <p class="ml-5">
                                    {{ $solicitud->documento->observaciones}}
                                </p>

                                <div class="h-[1px] w-full bg-gray-500 my-5"></div>

                                <h4 class="font-bold text-2xl">Cambiar decisión</h4>
                                <form action={{route('solicitud.accionSolicitud', $solicitud->id)}} method="POST">
                                    @csrf
                                    @method('PUT')

                                    <x-input-group value="{{ old('observaciones') }}" label="Observaciones" name="observaciones" type="textarea"
                                        class="mb-2"
                                        placeholder="Observaciones..." />

                                    @if ($solicitud->estado == 'aceptado')
                                        <x-primary-button type="submit" class="bg-red-500 hover:bg-red-700" name="accion" value="rechazar">
                                            {{ __('Rechazar') }}
                                        </x-primary-button>
                                    @else
                                        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700" name="accion" value="aceptar">
                                            {{ __('Aprobar') }}
                                        </x-primary-button>
                                    @endif


                                </form> 

                            @endif

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
