<x-app-layout>
    <x-slot name="header">
        <h2 class="flex-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Conducta') }}
        </h2>                    
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <p class="font-xl text-gray-800 dark:text-white font-semibold py-2 px-4">Editar conducta</p>
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('conductas.index') }}" onclick="return confirm('¿Estás seguro de que deseas salir? No se guardarán los cambios')">
                        Atrás
                    </a>                    
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Tabla --}}
                    {{-- {{ __("Mantenedor de conducta") }} --}}
                    <form method="POST" action="{{ route('conductas.update', $conducta->id) }}" class="max-w-7xl mx-auto">
                      @method('put')
                        @csrf
                        <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">
                          <div>
                            <label for="nombre" class="block">Asunto</label>
                            <input required type="text" id="nombre" name="nombre" class="w-full" value="{{$conducta->nombre}}">
                          </div>
                          <div>
                            <label for="puntaje" class="block" id="puntaje-label">Puntos</label>
                            <input required type="number" id="puntaje" name="puntaje" class="w-full" value="{{$conducta->puntaje}}">
                            {{-- <p id="puntaje-tipo" class="text-red-700">Puntaje negativo</p> --}}
                          </div>
                          <div>
                            <fieldset>
                              <legend>Tipo</legend>
                              <label for="demerito" class="block"> Demérito
                                <input @if($conducta->positivo == 0) checked @endif type="radio" id="demerito" name="tipo" value="0" onchange="cambiarTexto()">
                              </label>
                              <label for="merito" class="block"> Mérito
                                <input @if($conducta->positivo == 1) checked @endif type="radio" id="merito" name="tipo" value="1" onchange="cambiarTexto()">
                              </label>
                            </fieldset>
                          </div>
                          
                          <div class="col-span-2 lg:col-span-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-blue-500 rounded shadow">
                              Guardar
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
<script>
  function cambiarTexto() {
    const demerito = document.getElementById("demerito");
    const merito = document.getElementById("merito");
    const label = document.getElementById("puntaje-label");
    const puntaje = document.getElementById("puntaje");
    let puntos = puntaje.value;

    if (demerito.checked) {
      if(puntaje.value>0) puntaje.value = puntos*-1
      puntaje.min = -20;
      puntaje.max = -1;
      // label.textContent ="Puntos (-)"
      // resultado.textContent = "Puntaje negativo";
      // resultado.className = "text-red-700"
    } else{
      if(puntaje.value<0) puntaje.value = puntos*-1
      puntaje.min = 1;
      puntaje.max = 20;
      // label.textContent ="Puntos (+)"
      // resultado.textContent = "Puntaje positivo";
      // resultado.className = "text-green-800"
    }
  }

  document.addEventListener('DOMContentLoaded', ()=>{
    cambiarTexto();
  })
</script>