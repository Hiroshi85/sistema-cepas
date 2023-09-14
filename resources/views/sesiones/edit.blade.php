<x-app-layout>
    <x-slot name="header">
        <h2 class="flex-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sesiones de Pruebas psicológicas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <p class="font-xl text-gray-800 dark:text-white font-semibold py-2 px-4">Formulario de Sesión de Prueba</p>
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('sesiones.index') }}"  onclick="return confirm('¿Estás seguro de que deseas salir? No se guardarán los cambios')">
                        Atrás
                    </a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Tabla --}}
                    {{-- {{ __("Mantenedor de prueba") }} --}}
                    <form method="POST" action="{{ route('sesiones.update', $sesion->id) }}" class="max-w-7xl mx-auto">
                        @method('put')
                        @csrf
                        <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">
                            <div>
                              <label for="prueba" class="block">Prueba:</label>
                              <select required id="prueba" name="prueba" class="w-full">
                                @foreach ($pruebas as $it )
                                <option value={{$it->id}} @if ($sesion->prueba_psicologica_id == $it->id)
                                    selected
                                @endif>{{$it->nombre}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div>
                                <label for="completado" class="block">Completado</label>
                                    <input type="checkbox" id="completado" name="completado" class="w-8 h-8 mt-1 dark:text-gray-800"
                                    @if ($sesion->completado == 1) checked @endif>
                            </div>

                          <div class="col-span-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-blue-500 rounded shadow">
                              Editar sesión
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
