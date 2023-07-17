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
                    href="{{ route('comportamientos.index') }}">
                        Atrás
                    </a>                    
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-1">
                    <div class="px-6 py-2 text-gray-900 dark:text-gray-100">
                        <form method="POST" class="max-w-7xl mx-auto" id="myForm">
                        @method('put')
                        @csrf
                            <input type="hidden" name="alumno" id="alumno">
                            <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">
                                <div>
                                    <label for="alumno" class="block">Alumno: </label>
                                    <input type="text" readonly id="alumno_s" name="alumno_s" class="w-full">
                                </div>
                                {{-- <div>
                                    <label for="alumno" class="block">Alumno: </label>
                                    <select required id="alumno" name="alumno" class="w-full">
                                    @foreach ($alumnos as $al)
                                        <option value="{{$al->id}}">{{$al->nombres}} {{$al->apellidos}}</option>  
                                    @endforeach
                                    </select>
                                </div> --}}
                                <div>
                                    <label for="bimestre" class="block">Bimestre: </label>
                                    <select required id="bimestre" name="bimestre" class="w-full dark:text-gray-800">
                                        <option value="" selected disabled>Seleccionar</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="col-span-1 flex content-center py-5">
                                    <button type="button" id="buscarButton" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-blue-500 rounded shadow">
                                    Buscar
                                    </button>
                                </div>
                            </div>
                        </form>                      
                    </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <p class="font-xl text-gray-800 dark:text-white font-semibold py-2 px-4" id="nota">Nota conductual: </p>
                    {{-- <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('comportamientos.index') }}">
                        Atrás
                    </a>                     --}}
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-2 text-gray-900 dark:text-gray-100">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full divide-y divide-gray-700 dark:divide-gray-500" id="myTable">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Conducta</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Observación</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Puntos</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Fecha</th>
                                    <th class="px-6 py-3 text-center text-md font-semibold text-gray-500 uppercase tracking-wider">Opción</th>
                                </tr>
                            </thead>
                            <tbody class="dark:bg-gray-800 divide-y divide-gray-700 dark:bg-gray-900 dark:divide-gray-500">
                                
                            </tbody>
                        </table>
                    </div>                    
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
  const alumnoHiddenIdInput = document.getElementById('alumno');
  const bimestre = document.getElementById('bimestre');
  const tabla = document.getElementById('myTable');
  const cuerpoTabla = tabla.getElementsByTagName("tbody")[0];
  const nota = document.getElementById('nota');

  function eliminarReg(id){
    fetch("/dashboard/comportamientos/delete/"+id)
        .then(response => response.json())
        .then(data => buscarDatos())
        .catch(error => {
            console.log(error);
        });
  }
  
  function buscarDatos() {
    const alumnoId = alumnoHiddenIdInput.value;
    const bimestreValue = bimestre.value;

    // Realizar solicitud Fetch
    fetch("/seguimiento/comportamientos/alumnos/"+alumnoId+"?bimestre="+bimestreValue)
        .then(response => response.json())
        .then(data => {
        // Colocar el valor obtenido en el tercer input
        // Recorrer todas las opciones del dropdown
        while (cuerpoTabla.firstChild) {
            cuerpoTabla.removeChild(cuerpoTabla.firstChild);
        }

        data["comportamientos"].forEach(element => {
            var nuevaFila = cuerpoTabla.insertRow();

            var conducta = nuevaFila.insertCell();
            var observacion = nuevaFila.insertCell();
            var puntos = nuevaFila.insertCell();
            var fecha = nuevaFila.insertCell();
            var eliminar = nuevaFila.insertCell();

            nuevaFila.className = "text-center";
            conducta.className = "px-6 py-4 whitespace-nowrap";
            observacion.className = "px-6 py-4 whitespace-nowrap";
            puntos.className = "px-6 py-4 whitespace-nowrap";
            fecha.className = "px-6 py-4 whitespace-nowrap";
            eliminar.className = "px-6 py-4 whitespace-nowrap";

            conducta.innerHTML = element.nombre;
            observacion.innerHTML = element.observacion ?? "-";
            puntos.innerHTML = element.puntaje;
            fecha.innerHTML = element.fecha;
            eliminar.innerHTML = '<a class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer" onclick="eliminarReg('+element.id+')">Eliminar</a>';
        });
        nota.innerHTML = `Nota conductual: ${data.nota}`;

        
        })
        .catch(error => {
            console.log(error);
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

      // Exponer la función de abrir el modal globalmente
    //   window.openModal = openModal;
</script>

