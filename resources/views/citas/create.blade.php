<x-app-layout>
    <x-slot name="header">
        <h2 class="flex-1 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <p class="font-xl text-gray-800 dark:text-white font-semibold py-2 px-4">Formulario de Citas</p>
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('citas.index') }}">
                        Atrás
                    </a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Tabla --}}
                    {{-- {{ __("Mantenedor de prueba") }} --}}
                    <form method="POST" action="{{ route('citas.store') }}" class="max-w-7xl mx-auto">
                        @csrf
                        <input type="hidden" name="alumno" id="alumno">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:grid-cols-4">
                            <div class="lg:col-span-2">
                                <label for="alumno_s" class="block">Alumno: </label>
                                <input type="text" required readonly id="alumno_s" class="w-full">
                            </div>
                            <div>
                                <label for="apoderado" class="block">Apoderado: </label>
                                <input type="text" disabled readonly id="apoderado" class="w-full">
                            </div>
                            <div>
                                <label for="aula" class="block">Aula: </label>
                                <input type="text" disabled readonly id="aula" class="w-full">
                            </div>
                            <div class="md:col-span-2 lg:col-span-4">
                                <label for="motivo" class="block">Motivo: </label>
                                <input type="text" name="motivo" id="motivo" class="w-full">
                            </div>
                            <div class="col-span-1">
                                <label for="date" class="block">Fecha: </label>
                                <input type="date" name="date" id="date" class="w-full">
                            </div>
                            <div class="col-span-1">
                                <label for="horaInicio" class="block">Hora inicio: </label>
                                <input type="time" name="horaInicio" id="horaInicio" class="w-full">
                            </div>
                            <div class="col-span-1">
                                <label for="duracion" class="block">Duracion:</label>
                                    <select required id="duracion" name="duracion" class="w-full">
                                        <option selected value='30'>30 minutos</option>
                                        <option value='45'>45 minutos</option>
                                        <option value='60'>1 hora</option>
                                        <option value='90'>1 hora y 30 minutos</option>
                                        <option value='120'>2 horas</option>
                                        <option value='150'>2 horas y 30 minutos</option>
                                    </select>
                            </div>


                          <div class="col-span-1 lg:col-span-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-blue-500 rounded shadow">
                              Crear nueva cita
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

    <x-modal.buscar-alumno id="buscarAlumnoModal" inputTrigger="alumno_s"/>
</x-app-layout>
<script>
    const alInput = document.getElementById("alumno");
    alInput.addEventListener("change", (e) => {
        console.log(e.target.value);
        fetch(`{{route('citas.alumnoapoderado')}}?alumno=${e.target.value}`)
            .then(res => res.json())
            .then(data => {
                console.log(data);
                document.getElementById("apoderado").value = data.apoderado.nombre_apellidos;
                document.getElementById("aula").value = data.alumno.aula.grado + data.alumno.aula.seccion;
            })
            .catch(err => console.log(err));
    });
</script>
@stack("script")
