<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comportamientos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <p class="font-xl text-gray-800 dark:text-white font-semibold py-2 px-4">Toma de comportamiento</p>
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('comportamientos.show') }}">
                        Por alumno
                    </a>                    
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="py-5 text-gray-900 dark:text-gray-100 text-5xl">
                            <p>{{Str::title("Comportamientos")}}</p>
                        </div>
                        @if (true)
                            <form id="myForm" method="POST" action="{{ route('comportamientos.store') }}" class="max-w-7xl mx-auto">
                                @csrf
                                <input type="hidden" name="alumno" id="alumno">
                                <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
                                    <div class="col-span-2">
                                        <label for="alumno" class="block">Alumno: </label>
                                        <input type="text" required readonly id="alumno_s" name="alumno_s" class="w-full">
                                    </div>
                                    <div class="col-span-1">
                                        <label for="fecha" class="block">Fecha:</label>
                                        <input required type="date" id="fecha" name="fecha" class="w-full dark:text-gray-800" value="{{$hoy}}">
                                    </div>
                                    <div class="col-span-2 lg:col-span-1">
                                        <label for="tipo" class="block">Tipo:</label>
                                        <select required id="tipo" class="w-full dark:text-gray-800" required onchange="populateAsuntosDropdown()">
                                        <option value="" selected disabled>Seleccionar</option>
                                        <option value="D">Demérito</option>
                                        <option value="M">Mérito</option>
                                        </select>
                                    </div>
                                    <div class="col-span-2 lg:col-span-1">
                                        <label for="tipo" class="block">Asuntos: </label>
                                        <select required id="asunto" name="asunto" class="w-full dark:text-gray-800" disabled>
                                        <option value="" selected disabled>Seleccionar</option>
                                        </select>
                                    </div>
                                    <div class="col-span-1 lg:col-span-1">
                                        <label for="bimestre" class="block">Bimestre: </label>
                                        <select required id="bimestre" name="bimestre" class="w-full dark:text-gray-800">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected>3</option>
                                        <option value="4">4</option>
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="tipo" class="block">Observacion </label>
                                        <input type="text" id="observacion" name="observacion" class="w-full dark:text-gray-800">
                                    </div>
                                    <div class="col-span-2 lg:col-span-3">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-blue-500 rounded shadow">
                                        Guardar
                                        </button>
                                    </div>
                                </div>
                            </form>         
                        @else
                        <div class="p-5 text-gray-900 dark:text-gray-100 text-xl">
                            <p>Día no habilitado</p>
                        </div>
                        @endif
                                         
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
    const dropDownTipo = document.getElementById("tipo");
    const dropDownAsunto = document.getElementById("asunto");
    // const puntosText = document.getElementById("puntos");

    function populateAsuntosDropdown(){
        const demeritos = @json($demeritos);
        const meritos = @json($meritos);
        
        dropDownAsunto.disabled = false;
        // opcion.text="Seleccionar"
        // opcion.value="";
        // dropdown.add(opcion);
        switch(dropDownTipo.value){
            case 'D':
                vaciarDropdown();
                demeritos.forEach(element => {
                    const opcion = document.createElement("option");
                    opcion.text=element.nombre + ' ('+element.puntaje+')';
                    opcion.value=element.id;
                    dropDownAsunto.add(opcion);
                }); break;
            case 'M':
                vaciarDropdown();
                meritos.forEach(element => {
                    const opcion = document.createElement("option");
                    opcion.text=element.nombre + ' (+'+element.puntaje+')';
                    opcion.value=element.id;
                    dropDownAsunto.add(opcion);
                }); break;
            default: vaciarDropdown(); dropDownAsunto.disabled = true;break;
        }
        
    }

    function vaciarDropdown(){
        while(dropDownAsunto.options.length > 1){
            dropDownAsunto.remove(1);
        }
        dropDownAsunto.selectedIndex=0;
    }
    
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
</script>
