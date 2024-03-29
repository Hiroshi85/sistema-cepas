<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Seguimiento escolar CEPAS') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex flex-col">
                    <div class="grid grid-cols-1 lg:grid-cols-5">
                        <div class="col-span-1 lg:col-span-4">
                            <div class="p-4">
                                <h3 class="text-xl font-bold"> Citas de hoy, {{Carbon\Carbon::now()->dayName.', '.Carbon\Carbon::now()->format('d').' de '.Carbon\Carbon::now()->monthName}} </h3>
                                @if($citasHoy->isEmpty())
                                    <p class="text-gray-800 dark:text-gray-300">No hay programadas</p>
                                @endif
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">

                                    @foreach ( $citasHoy as $it )
                                        <div class="max-w-md m-2 border-2 bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden py-1">
                                        <!-- Sección superior con nombre del alumno -->
                                            <div class="pt-6 px-6">
                                                <p class="text-2xl font-bold text-gray-800 dark:text-gray-300 mb-2">{{$it->fechaHoraInicio->format('H:i')." - ". $it->fechaHoraFin->format('H:i')}}</p>
                                                <p class="text-lg font-medium text-gray-800 dark:text-white mb-2">{{$it->alumno}}</p>
                                                <p class="text-sm">{{'('.$it->duracionMinutos." minutos)"}}</p>
                                            </div>
                                            <!-- Sección central con hora de inicio grande y hora de fin y detalles abajo -->
                                            <div class="py-1 px-6">

                                                @switch($it->estado)
                                                    @case("programado")
                                                        <p class="text-sm text-sky-700 dark:text-gray-300 font-semibold mb-1"> {{Str::ucfirst($it->estado)}} </p>
                                                        @break
                                                    @case("realizado")
                                                        <p class="text-sm text-green-700 dark:text-gray-300 font-semibold mb-1"> {{Str::ucfirst($it->estado)}} </p>
                                                        @break
                                                    @case("ausentado")
                                                        <p class="text-sm text-fuchsia-700 dark:text-gray-300 font-semibold mb-1"> {{Str::ucfirst($it->estado)}} </p>
                                                        @break
                                                @endswitch
                                                <p class="text text-gray-800 dark:text-gray-300">Apoderado: {{$it->apoderado}}</p>
                                                <p class="text text-gray-800 dark:text-gray-300">Contacto: {{$it->numero_celular}}</p>
                                                <hr class="my-1">
                                                <p class="text text-gray-800 dark:text-gray-300">Motivo: {{$it->motivo}}</p>
                                                <p class="text text-gray-800 dark:text-gray-300">Aula: {{$it->grado.$it->seccion}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-xl font-bold"> Citas de esta semana</h3>
                                @if($citasSemana->isEmpty())
                                    <p class="text-gray-800 dark:text-gray-300">No hay programadas</p>
                                @endif
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">

                                    @foreach ( $citasSemana as $it )
                                        <div class="max-w-md m-2 border-2 bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden py-1">
                                        <!-- Sección superior con nombre del alumno -->
                                            <div class="pt-3 px-6">
                                                <h3 class="text font-semibold text-gray-800 dark:text-white mb-2">{{Str::ucfirst($it->fechaHoraInicio->dayName).', '.$it->fechaHoraInicio->format('d').' de '.$it->fechaHoraInicio->monthName}}</h3>
                                                <h2 class="text font-medium text-gray-800 dark:text-white mb-2">{{$it->alumno}}</h2>
                                                <h2 class="text-sm text-gray-800 dark:text-gray-300 mb-2">{{$it->fechaHoraInicio->format('H:i')." - ". $it->fechaHoraFin->format('H:i')}}</h2>
                                            </div>
                                            <!-- Sección central con hora de inicio grande y hora de fin y detalles abajo -->
                                            <div class="pb-1 px-6">

                                                @switch($it->estado)
                                                    @case("programado")
                                                        <p class="text-sm text-sky-700 dark:text-gray-300 font-semibold mb-1"> {{Str::ucfirst($it->estado)}} </p>
                                                        @break
                                                    @case("realizado")
                                                        <p class="text-sm text-green-700 dark:text-gray-300 font-semibold mb-1"> {{Str::ucfirst($it->estado)}} </p>
                                                        @break
                                                    @case("ausentado")
                                                        <p class="text-sm text-fuchsia-700 dark:text-gray-300 font-semibold mb-1"> {{Str::ucfirst($it->estado)}} </p>
                                                        @break
                                                @endswitch
                                                <p class="text-sm text-gray-800 dark:text-gray-300">Apoderado: {{$it->apoderado}}</p>
                                                <p class="text-sm text-gray-800 dark:text-gray-300">Contacto: {{$it->numero_celular}}</p>
                                                <hr class="my-1">
                                                <p class="text-sm text-gray-800 dark:text-gray-300">Motivo: {{$it->motivo}}</p>
                                                <p class="text-sm text-gray-800 dark:text-gray-300">Aula: {{$it->grado.$it->seccion}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1">
                            @role('admin|psicologo')
                            <div class="px-1 py-4">
                                <h3 class="text-xl font-bold"> Sesiones a evaluar</h3>
                                @if($sesiones->isEmpty())
                                    <p class="text-gray-800 dark:text-gray-300">Todas las sesiones evaluadas</p>
                                @endif
                                <div class="flex flex-col gap-1">
                                    @foreach ( $sesiones as $it )
                                        <div class="w-full my-2 border-2 bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden py-2 px-2">
                                            <p class="text font-semibold text-gray-800 dark:text-white">{{$it->prueba}}</p>
                                            <p class="text-small font text-gray-800 dark:text-white mb-2">Aula: {{$it->grado.$it->seccion}}</p>
                                                <div class="font-medium dark:text-white flex justify-between gap-2">
                                                    <span>{{$it->total_evaluados}}/{{$it->total}}</span>
                                                    <a href="{{route('sesiones.show', $it->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Evaluar</a>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4 dark:bg-gray-700">
                                                    <div class="@if($it->completado) bg-green-500 dark:bg-green-500 @else bg-blue-600 dark:bg-blue-500 @endif h-2.5 rounded-full "
                                                    style="width: {{$it->progresoPorcentaje}}%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endrole
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
