<x-app-layout>
    <x-slot name="header">
        <h2 class="flex-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sesiones de Pruebas psicológicas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-end">
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('sesiones.create') }}">
                        Crear nueva sesión
                    </a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Tabla --}}
                    {{-- {{ __("Mantenedor de sesiones") }} --}}
                    <div class="w-full overflow-x-auto">
                        <table class="w-full divide-y divide-gray-700 dark:divide-gray-500">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Prueba</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Psicologo</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Aula</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Fecha Inicio</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Completado</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Opciones</th>

                                </tr>
                            </thead>
                            <tbody class=" divide-y divide-gray-700 dark:bg-gray-900 dark:divide-gray-500">
                                @foreach ($sesiones as $item)
                                <tr class="text-center">
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->id}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->prueba}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->psicologo}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->grado.$item->seccion}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->created_at->format('d-m-Y')}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">@if ($item->completado == 1) Si @else No @endif</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex">
                                            <a href="{{route('sesiones.show', $item->id)}}" class="flex-1 font-medium text-green-600 dark:text-green-500 hover:underline"> Ver</a>
                                            <a href="{{route('sesiones.edit', $item->id)}}" class="flex-1 font-medium text-blue-600 dark:text-blue-500 hover:underline"> Editar</a>
                                            <form class="flex-1" action="{{ route('sesiones.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esto?')" class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</button>
                                            </form>
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
