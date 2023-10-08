<div>
    <div id={{$id}} class="fixed z-10 inset-0 overflow-y-auto hidden w-full h-full bg-black bg-opacity-50 flex items-center justify-center">
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
                <div class="max-h-[400px] overflow-y-auto">
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
    </div>
</div>


@push("script")
<script>
    const buscarModalButton = document.getElementById("searchButton");
    const buscarInput = document.getElementById("searchInput");
    const alumnoInputOg = document.getElementById(@json($inputTrigger));
    const hiddenAlumno = document.getElementById("alumno");
    // Función para abrir el modal
    function openModal() {
        document.getElementById(@json($id)).classList.remove("hidden");
    }

    // Función para cerrar el modal
    function closeModal() {
        document.getElementById(@json($id)).classList.add("hidden");
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
        fetch(@json(route('alumn.buscar'))+"?alumno="+buscarInput.value)
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
        if (event.target === document.getElementById(@json($id))) {
            closeModal();
        }
    });
</script>
@endpush
