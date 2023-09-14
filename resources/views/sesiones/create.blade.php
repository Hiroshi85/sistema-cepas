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
                    href="{{ route('sesiones.index') }}">
                        Atrás
                    </a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Tabla --}}
                    {{-- {{ __("Mantenedor de prueba") }} --}}
                    <form method="POST" action="{{ route('sesiones.store') }}" class="max-w-7xl mx-auto">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:grid-cols-3">
                            <div>
                              <label for="prueba" class="block">Prueba:</label>
                              <select required id="prueba" name="prueba" class="w-full">
                                @foreach ($pruebas as $it )
                                <option value={{$it->id}}>{{$it->nombre}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div>
                                <label for="aula" class="block">Aula:</label>
                                <select required id="aula" name="aula" class="w-full">
                                  @foreach ($aulas as $it )
                                  <option value={{$it->idaula}}>{{$it->grado.$it->seccion}}</option>
                                  @endforeach
                                </select>
                              </div>

                          <div class="col-span-1 lg:col-span-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-blue-500 rounded shadow">
                              Iniciar nueva sesión
                            </button>
                            <button type="reset" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 border border-gray-300 rounded shadow">
                              Limpiar
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
