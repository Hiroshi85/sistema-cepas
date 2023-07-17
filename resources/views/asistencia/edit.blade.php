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
                    href="{{ route('asistencias.index') }}">
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
                            <input type="text" readonly id="alumno_s" name="alumno_s" class="w-full">
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

    <div id="buscarAlumnoModal" class="fixed z-10 inset-0 overflow-y-auto hidden w-full h-full bg-black bg-opacity-50 flex items-center justify-center">
      <div class="modal-container bg-white w-full max-w-3xl mx-auto rounded shadow-lg z-50 overflow-y-auto p-4">
          <div class="modal-content py-4 px-6">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-semibold">Buscar Alumno</h2>
              <button class="modal-close cursor-pointer z-50" onclick="closeModal()">&times;</button>
            </div>
            <div class="mb-4 grid grid-cols-6 gap-1">
              <input type="text" id="searchInput" class="col-span-5 border border-gray-400 rounded w-full px-3 py-2" placeholder="Buscar alumno...">
              <button id="searchButton" id="searchButton" class="col-span-1 bg-blue-500 text-white px-4 py-2 rounded ml-2">Buscar</button>
            </div>
            <table class="w-full">
              <thead>
                <tr>
                  <th class="px-4 py-2">Nombres y apellidos</th>
                  <th class="px-4 py-2">Opción</th>
                </tr>
              </thead>
              <tbody id="tableBody" class="divide-y divide-gray-700">
                <!-- Aquí se llenarán los datos de la tabla mediante JavaScript -->
              </tbody>
            </table>
          </div>
        </div>
    </div>
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
      
      myForm.action = "/seguimiento/asistencias/"+ data.id_asistencia
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

<script>
  const buscarModalButton = document.getElementById("searchButton");
  const buscarInput = document.getElementById("searchInput");
  const alumnoInputOg = document.getElementById("alumno_s");
  const hiddenAlumno = document.getElementById("alumno");
  // Función para abrir el modal
  function openModal() {
      document.getElementById("buscarAlumnoModal").classList.remove("hidden");
  }

  // Función para cerrar el modal
  function closeModal() {
      document.getElementById("buscarAlumnoModal").classList.add("hidden");
  }

  // Función para llenar la tabla con los resultados de búsqueda
  function fillTable(data) {
      const tableBody = document.getElementById("tableBody");
      tableBody.innerHTML = ""; // Limpiamos la tabla antes de llenarla

      data.forEach((alumno) => {
      const row = document.createElement("tr");
      const nombreApellidoCell = document.createElement("td");
      const opcionCell = document.createElement("td");
      const selectButton = document.createElement("p");

      nombreApellidoCell.textContent = alumno.nombre_apellidos;
      nombreApellidoCell.className = "p-1 whitespace-nowrap text-center";
      

      selectButton.textContent = "Seleccionar";
      selectButton.className = "cursor-pointer text-center p-1 whitespace-nowrap text-blue-600 dark:text-blue-500 hover:underline";
      selectButton.addEventListener("click", () => {
          hiddenAlumno.value = alumno.idalumno;
          alumnoInputOg.value = alumno.nombre_apellidos;
          closeModal();
      });

      opcionCell.appendChild(selectButton);
      row.appendChild(nombreApellidoCell);
      row.appendChild(opcionCell);

      tableBody.appendChild(row);
      });
  }
  
  var searchResults;
  // Evento click del botón "Buscar"
  buscarModalButton.addEventListener("click", () => {
      fetch("{{ route('alumn.buscar') }}?alumno="+buscarInput.value)
      .then(response => response.json())
      .then(data => {
          data["alumnos"].forEach(element =>{
              console.log(element.nombre_apellidos);
          })
          searchResults = data["alumnos"];
          console.log(searchResults);
          fillTable(searchResults);
      })
      // Aquí realizarías la búsqueda de datos según el término de búsqueda
      // y obtendrías un array de objetos con la estructura { nombreApellido: "Nombre Apellido" }
      // Por ejemplo, para este ejemplo, se simula una búsqueda vacía:
      
      
  });

  alumnoInputOg.addEventListener("click", (event)=>{
      openModal();
  })

  window.addEventListener("click", function(event) {
      if (event.target === document.getElementById("buscarAlumnoModal")) {
          closeModal();
      }
  });
</script>

