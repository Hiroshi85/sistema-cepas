<x-app-layout>
    <x-slot name="header">
        <h2 class="flex-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Prueba psicologica') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-end">
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('pruebas.create') }}">
                        Registrar prueba psicologica
                    </a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Tabla --}}
                    {{-- {{ __("Mantenedor de alumno") }} --}}
                    <div class="w-full overflow-x-auto">
                        <table class="w-full divide-y divide-gray-700 dark:divide-gray-500">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Tipo</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Rango de edad</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Registrado por</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Acceso</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="dark:bg-gray-800 divide-y divide-gray-700 dark:bg-gray-900 dark:divide-gray-500">
                                @foreach ($pruebas as $item)
                                <tr class="text-center">
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->id}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->nombre}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->tipo->tipo}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->edad_minima}} a {{$item->edad_maxima}} años</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->psicologo->name}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    @if(!is_null($item->online_url))
                                        <a href="{{$item->online_url}}" target="\blank" class="font-medium text-blue-600 dark:text-blue-800 hover:underline">Prueba Online</a><br>
                                    @endif
                                    @if(!is_null($item->file_url))
                                        <a href="{{route('files', $item->id)}}" class="font-medium text-blue-600 dark:text-blue-800 hover:underline">Archivo</a>
                                    @endif

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex">
                                            @if($item->psicologo_id == Auth::user()->id)
                                                <a href="{{route('pruebas.edit', $item->id)}}" class="flex-1 font-medium text-blue-600 dark:text-blue-500 hover:underline"> Editar</a>
                                                <form class="flex-1" action="{{ route('pruebas.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esto?')" class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</button>
                                                </form>
                                            @else
                                                -
                                            @endif
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
