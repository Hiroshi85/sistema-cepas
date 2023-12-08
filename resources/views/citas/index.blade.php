<x-app-layout>
    <x-slot name="header">
        <h2 class="flex-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-end gap-2	">
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('citas.create') }}">
                        Crear nueva cita
                    </a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 w-full text-gray-900 dark:text-gray-100">
                    {{-- Tabla --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-5">
                        @foreach ( $citas as $it )
                        <div class="max-w-md m-2 bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden">
                            <!-- Sección superior con nombre del alumno -->
                                <div class="pt-6 px-6">
                                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{$it->alumno}}</h2>
                                </div>

                                <!-- Sección central con hora de inicio grande y hora de fin y detalles abajo -->
                                <div class="py-2 px-6">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">{{Str::ucfirst($it->fechaHoraInicio->dayName).', '.$it->fechaHoraInicio->format('d/m/Y')}}</h3>
                                    <p class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">{{$it->fechaHoraInicio->format('H:i')." - ". $it->fechaHoraFin->format('H:i')." (".$it->duracionMinutos." minutos)"}}</p>
                                    @switch($it->estado)
                                        @case("programado")
                                            <p class="text text-sky-700 dark:text-gray-300 font-semibold mb-1"> {{Str::ucfirst($it->estado)}} </p>
                                            @break
                                        @case("realizado")
                                            <p class="text text-green-700 dark:text-gray-300 font-semibold mb-1"> {{Str::ucfirst($it->estado)}} </p>
                                            @break
                                        @case("cancelado")
                                            <p class="text text-red-700 dark:text-gray-300 font-semibold mb-1"> {{Str::ucfirst($it->estado)}} </p>
                                            @break
                                        @case("ausentado")
                                            <p class="text text-fuchsia-700 dark:text-gray-300 font-semibold mb-1"> {{Str::ucfirst($it->estado)}} </p>
                                            @break
                                    @endswitch
                                    <p class="text text-gray-800 dark:text-gray-300">Aula: {{$it->grado.$it->seccion}}</p>
                                    <p class="text text-gray-800 dark:text-gray-300">Apoderado: {{$it->apoderado}}</p>
                                    <p class="text text-gray-800 dark:text-gray-300">Contacto: {{$it->numero_celular}}</p>
                                    <hr class="my-1">
                                    <p class="text text-gray-800 dark:text-gray-300">Motivo: {{$it->motivo}}</p>
                                </div>

                                <!-- Sección inferior con botones de editar y eliminar -->
                                <div class="p-4 flex justify-between items-center">
                                    <a href="{{route('citas.edit', $it->id)}}" class="text-blue-500 hover:underline">Editar</a>
                                    <form action="{{ route('citas.destroy', $it->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esto?')" class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</button>
                                    </form>
                                </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Fin tabla --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
