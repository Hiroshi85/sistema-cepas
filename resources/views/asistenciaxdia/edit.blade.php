<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asistencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <p class="font-xl text-gray-800 dark:text-white font-semibold py-2 px-4">Editar asistencias</p>
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('asistenciaxdias.index') }}">
                        Atrás
                    </a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" class="max-w-7xl mx-auto" id="myForm">
                      @method('put')
                      @csrf
                        <input type="hidden" name="alumno" id="alumno">
                        <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">
                          <div>
                            <label for="fecha" class="block">Fecha asistencia</label>
                            <input required type="date" id="fecha" name="fecha" class="w-full" min="{{substr($today,0,4)}}-01-01" max="{{$today}}" value="{{$today}}">
                          </div>
                          <div>
                            <label for="alumno" class="block">Alumno: </label>
                            <input type="text" required readonly id="alumno_s" name="alumno_s" class="w-full">
                          </div>

                          <div class="col-span-2 lg:col-span-3">
                            <button type="button" id="buscarButton" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-blue-500 rounded shadow">
                              Buscar
                            </button>
                          </div>
                          <div>
                            <label for="tipo" class="block">Asistencia</label>
                              <select disabled required id="tipo" name="tipo" class="w-full dark:text-gray-800">
                              <option value="" disabled selected>Seleccionar</option>
                              <option value="1">Presente</option>
                              <option value="2">Falta</option>
                              <option value="3">Justificado</option>
                              <option value="4">Tarde</option>
                              </select>
                          </div>

                          <div class="col-span-2 lg:col-span-3">
                            <button id="actualizarButton" type="submit" disabled class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-blue-500 rounded shadow">
                              Actualizar
                            </button>
                          </div>
                        </div>
                      </form>
                    {{-- Fin tabla --}}
                    </div>
            </div>
        </div>
    </div>

    <x-modal.buscar-alumno id="buscarAlumnoModal" inputTrigger="alumno_s"/>
</x-app-layout>

<script>
  const fechaInput = document.getElementById('fecha');
  const alumnoIdInput = document.getElementById('alumno');
  const tipoInput = document.getElementById('tipo');
  const myForm = document.getElementById('myForm');
  const actualizarButton = document.getElementById("actualizarButton");

  // Función para realizar la solicitud Fetch
  function buscarDatos() {
  const fecha = fechaInput.value;
  const alumnoId = alumnoIdInput.value;

  // Realizar solicitud Fetch
  fetch("{{ route('asist.buscar') }}?fecha="+fecha+"&alumno="+alumnoId)
    .then(response => response.json())
    .then(data => {
      // Colocar el valor obtenido en el tercer input
      // Recorrer todas las opciones del dropdown
      console.log(data.id_asistencia);
      for (var i = 0; i < tipo.options.length; i++) {
          // Obtener el valor de la opción
          var optionValue = tipo.options[i].value;
          console.log(data.tipo)
          // Verificar si el valor coincide con el carácter
          if (optionValue == data.tipo) {
              // Establecer la opción como seleccionada
              // tipo.options[i].selected = true;
              tipo.selectedIndex = i;
              tipoInput.disabled = false;
              actualizarButton.disabled=false;
              break; // Salir del bucle
          }
      }

      myForm.action = "/seguimiento/asistenciaxdias/"+ data.id_asistencia
    })
    .catch(error => {
      tipoInput.disabled = true;
      tipo.selectedIndex = 0;
      actualizarButton.disabled=true;
      console.error('Error:', error);
    });
  }

  // Asociar la función al evento de clic del botón
  const buscarButton = document.getElementById('buscarButton');
  buscarButton.addEventListener('click', buscarDatos);
</script>

@stack("script")

