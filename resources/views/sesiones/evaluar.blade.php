<x-app-layout>
    <x-slot name="header">
        <h2 class="flex-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if($resultado->fecha_evaluacion != null)
                Editar resultado
                @else
                Evaluar alumno
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <p class="font-xl text-gray-800 dark:text-white font-semibold py-2 px-4 underline">
                        {{$sesion->prueba}}
                    </p>
                    <p class="text-3xl text-gray-800 dark:text-white font-semibold py-2 px-4">
                        {{$resultado->alumno->nombre_apellidos}}
                    </p>
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('sesiones.show', $resultado->sesion_prueba_id) }}" onclick="return confirm('¿Estás seguro de que deseas salir? No se guardarán los cambios')">
                        Atrás
                    </a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Tabla --}}
                    {{-- {{ __("Mantenedor de prueba") }} --}}
                    <form method="POST" action="{{ route('sesiones.evaluarPut', ['id'=>$resultado->sesion_prueba_id, 'alumno_id'=>$resultado->alumno_id]) }}" class="max-w-7xl mx-auto">
                        @method('put')
                        @csrf
                        <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">

                          <div>
                            <label for="estado" class="block">Estado:</label>
                            <select required id="estado" name="estado" class="w-full">
                              @if ($resultado->estado == null)
                                <option value="" disabled>Seleccionar</option>
                              @endif
                              @foreach ($estados as $it)
                              <option value={{$it->id}} @if($resultado->estado != null) @if($resultado->estado->id == $it->id) selected @endif @endif >{{$it->estado}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div>
                            <label for="puntaje" class="block">Puntaje:</label>
                            <input required type="number" id="puntaje" name="puntaje" class="w-full dark:text-gray-800" value="{{$resultado->puntaje}}">
                          </div>
                          <div>
                            <label for="observacion" class="block">Observación:</label>
                            <input required type="text" id="observacion" name="observacion" class="w-full dark:text-gray-800"
                            @if ($resultado->observacion != null) value="{{$resultado->observacion}}" @endif >
                          </div>
                          <div>
                            <label for="recomendacion" class="block">Recomendación</label>
                            <input type="text" id="recomendacion" name="recomendacion" class="w-full dark:text-gray-800"
                            @if ($resultado->recomendacion != null) value="{{$resultado->recomendacion}}" @endif>
                          </div>
                          @if ($resultado->fecha_evaluacion != null)
                            <div>
                                <p class="w-full dark:text-gray-800">{{$resultado->fecha_evaluacion}}</p>
                            </div>
                          @endif
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
