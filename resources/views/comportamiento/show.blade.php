<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comportamiento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <p class="font-xl text-gray-800 dark:text-white font-semibold py-2 px-4">Editar comportamiento</p>
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('comportamientos.index') }}">
                        Atrás
                    </a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-1">
                    <div class="px-6 py-2 text-gray-900 dark:text-gray-100">
                        <form class="max-w-7xl mx-auto" id="myForm">
                            <input type="hidden" name="alumno" id="alumno">
                            <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">
                                <div>
                                    <label for="alumno" class="block">Alumno: </label>
                                    <input type="text" required readonly id="alumno_s" name="alumno_s" class="w-full">
                                </div>
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
                    <div id="ctrl_reportes" class="hidden">
                        <p class="font-xl text-gray-800 dark:text-white font-semibold">Reportes: </p>
                        <a id="enlaceBimestralPdf" type="button" class="bg-blue-500 cursor-default hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-blue-500 rounded shadow" href="#"  target="_blank">
                            Bimestral
                        </a>
                        <a id="enlaceAnualPdf" type="button" class="bg-blue-500 cursor-default hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-blue-500 rounded shadow">
                            Anual
                        </a>
                    </div>
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
                            <tbody class=" divide-y divide-gray-700 dark:bg-gray-900 dark:divide-gray-500">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal.buscar-alumno id="buscarAlumnoModal" inputTrigger="alumno_s"/>
</x-app-layout>
<script>
  const alumnoHiddenIdInput = document.getElementById('alumno');
  const bimestre = document.getElementById('bimestre');
  const tabla = document.getElementById('myTable');
  const cuerpoTabla = tabla.getElementsByTagName("tbody")[0];
  const nota = document.getElementById('nota');
  const ctrl_reportes = document.getElementById('ctrl_reportes');

  function eliminarReg(id){
    fetch("/seguimiento/comportamientos/delete/"+id)
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

        ctrl_reportes.classList.remove('hidden');
        var enlaceBimestralPdf = document.getElementById('enlaceBimestralPdf');
        enlaceBimestralPdf.href = "/seguimiento/comportamientos/alumnos/"+alumnoId+"/pdfbimestral?bimestre="+bimestreValue;

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

@stack('script')


