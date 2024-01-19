<x-app-layout>
    <x-slot name="header">
        <h2 class="flex-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $sesion->prueba.' - '.$sesion->grado.$sesion->seccion }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-start">
                    <p class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200"
                    >
                        Crear nueva sesión
                    </p>
                </div>
            </div> --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Tabla --}}
                    {{-- {{ __("Mantenedor de sesiones") }} --}}
                    <div class="w-full overflow-x-auto">
                        <table class="w-full divide-y divide-gray-700 dark:divide-gray-500">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Alumno</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Fecha evaluado</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Acción</th>

                                </tr>
                            </thead>
                            <tbody class=" divide-y divide-gray-700 dark:bg-gray-900 dark:divide-gray-500">
                                @foreach ($resultados as $item)
                                <tr class="text-center">
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->alumno->nombre_apellidos}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($item->estado != null)
                                            {{$item->estado->estado}}
                                        @else
                                            -
                                        @endif

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">@if ($item->fecha_evaluado != null)
                                        {{$item->fecha_evaluado}}
                                    @else
                                        -
                                    @endif</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex">
                                            <a href="{{route('sesiones.evaluar', ['id'=>$sesion->id, 'alumno_id' => $item->alumno_id])}}" class="flex-1 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                @if ($item->fecha_evaluado != null)
                                                    Editar
                                                @else
                                                    Evaluar
                                                @endif
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Fin tabla --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
