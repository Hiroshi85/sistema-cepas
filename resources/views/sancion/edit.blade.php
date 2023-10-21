<x-app-layout>
    <x-slot name="header">
        <h2 class="flex-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sanciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <p class="font-xl text-gray-800 dark:text-white font-semibold py-2 px-4">Editar sancion</p>
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('sanciones.index') }}" onclick="return confirm('¿Estás seguro de que deseas salir? No se guardarán los cambios')">
                        Atrás
                    </a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Tabla --}}
                    {{-- {{ __("Mantenedor de sancion") }} --}}
                    <form method="POST" action="{{ route('sanciones.update', $sancion->id) }}" class="max-w-7xl mx-auto">
                        @method('put')
                        @csrf
                        <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">
                          <div>
                            <label for="nombre" class="block">Nombre:</label>
                            <input required type="text" id="nombre" name="nombre" class="w-full dark:text-gray-800" value="{{$sancion->nombre}}">
                          </div>
                          <div class="col-span-3 lg:col-span-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-blue-500 rounded shadow">
                              Guardar
                            </button>
                          </div>
                        </div>
                      </form>
                    {{-- Fin tabla --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
