<x-app-layout>
    <x-slot name="header">
        <h2 class="flex-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Conductas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">

            @role('admin|auxiliar')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-end">
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('conductas.create') }}">
                        Registrar conductas
                    </a>
                </div>
            </div>
            @endrole

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full flex flex-col md:flex-row">
                <div class="p-6 text-gray-900 dark:text-gray-100  md:w-1/2">
                    {{-- Tabla --}}
                    {{-- {{ __("Mantenedor de alumno") }} --}}
                    <h2 class="px-6 py-3 text-center text-lg font-semibold text-gray-700 uppercase tracking-wider">DEMÉRITOS</h2>
                    <div class="w-full overflow-x-auto">
                        <table class="w-full divide-y divide-gray-700 dark:divide-gray-500">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Asunto</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Puntaje</th>
                                    @role('admin|auxiliar')
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Opciones</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody class=" divide-y divide-gray-700 dark:bg-gray-900 dark:divide-gray-500">
                                @foreach ($demeritos as $item)
                                <tr class="text-center">
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->id}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->nombre}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->puntaje}}</td>
                                    @role('admin|auxiliar')
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex">
                                            <a href="{{route('conductas.edit', $item->id)}}" class="flex-1 font-medium text-blue-600 dark:text-blue-500 hover:underline"> Editar</a>
                                            <form class="flex-1" action="{{ route('conductas.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esto?')" class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                    @endrole
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Fin tabla --}}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 md:w-1/2">
                    {{-- Tabla --}}
                    {{-- {{ __("Mantenedor de alumno") }} --}}
                    <div class="w-full overflow-x-auto">
                        <h2 class="px-6 py-3 text-center text-lg font-semibold text-gray-700 uppercase tracking-wider">Méritos</h2>
                        <table class="w-full divide-y divide-gray-700 dark:divide-gray-500">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Asunto</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Puntaje</th>
                                    @role('admin|auxiliar')
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Opciones</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700 dark:bg-gray-900 dark:divide-gray-500">
                                @foreach ($meritos as $item)
                                <tr class="text-center">
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->id}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->nombre}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$item->puntaje}}</td>
                                    @role('admin|auxiliar')
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex">
                                            <a href="{{route('conductas.edit', $item->id)}}" class="flex-1 font-medium text-blue-600 dark:text-blue-500 hover:underline"> Editar</a>
                                            <form class="flex-1" action="{{ route('conductas.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esto?')" class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                    @endrole
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
