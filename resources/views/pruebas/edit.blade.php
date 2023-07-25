<x-app-layout>
    <x-slot name="header">
        <h2 class="flex-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pruebas psicológicas') }}
        </h2>                    
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <p class="font-xl text-gray-800 dark:text-white font-semibold py-2 px-4">Editar prueba</p>
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('pruebas.index') }}" onclick="return confirm('¿Estás seguro de que deseas salir? No se guardarán los cambios')">
                        Atrás
                    </a>                    
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Tabla --}}
                    {{-- {{ __("Mantenedor de prueba") }} --}}
                    <form method="POST" action="{{ route('pruebas.update', $prueba->id) }}" class="max-w-7xl mx-auto" enctype="multipart/form-data" id="frmEditarPrueba">
                        @method('put')
                        @csrf
                        <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">
                          <div>
                            <label for="nombre" class="block">Nombre:</label>
                            <input required type="text" id="nombre" name="nombre" class="w-full dark:text-gray-800" value="{{$prueba->nombre}}">
                          </div>
                          <div>
                            <label for="tipo" class="block">Tipo:</label>
                            <select required id="tipo" name="tipo" class="w-full">
                              @foreach ($tipos as $it )
                              <option value={{$it->id}} @if($prueba->tipo->id == $it->id) selected @endif>{{$it->tipo}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div>
                            <label for="minima" class="block">Edad mínima:</label>
                            <input required type="number" id="minima" name="minima" class="w-full dark:text-gray-800" max="40" min="10" value="{{$prueba->edad_minima}}">
                          </div>
                          <div>
                            <label for="maxima" class="block">Edad máxima:</label>
                            <input required type="number" id="maxima" name="maxima" class="w-full dark:text-gray-800" max="40" min="10" value="{{$prueba->edad_maxima}}">
                          </div>
                          <div>
                            <label for="p-online" class="block">URL prueba online</label>
                            <input type="text" id="p-online" name="p-online" class="w-full dark:text-gray-800" value="{{$prueba->online_url}}">
                          </div>
                          <div>
                            <label for="archivo" class="block">Archivo</label>
                            <input type="file" id="archivo" name="archivo" class="w-full dark:text-gray-800">
                          </div>
                          @if($prueba->file_url != null)
                          <div>
                            <label for="p-online" class="block">Archivo actual</label>
                            <a href="{{route('files',$prueba->id)}}" class="w-full text-blue-600 dark:text-blue-800 hover:underline">Descargar archivo</a> 
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