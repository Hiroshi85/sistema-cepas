<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reporte Anual psicología') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-between gap-2">
                    <p class="font-xl text-gray-800 dark:text-white font-semibold py-2 px-4">Toma de comportamiento</p>
                    <a class=" text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('sesiones.index') }}">
                        Atrás
                    </a>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="py-5 text-gray-900 dark:text-gray-100 text-5xl">
                            <p>{{Str::title("Reporte Anual de Alumno")}}</p>
                        </div>
                        <form id="myForm" class="max-w-7xl mx-auto">
                            <input type="hidden" name="alumno" id="alumno">
                            <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
                                <div class="col-span-2">
                                    <label for="alumno" class="block">Alumno: </label>
                                    <input type="text" required readonly id="alumno_s" name="alumno_s" class="w-full">
                                </div>
                                <div class="col-span-1">
                                    <label for="año" class="block">Año:</label>
                                    <input required type="number" id="año" name="año" class="w-full dark:text-gray-800" value="{{$año}}" min="1990" max="{{$año}}">
                                </div>
                                <div class="col-span-2 lg:col-span-3">
                                    <a id="generar" type="button" class="cursor-not-allowed bg-blue-500 text-white font-semibold py-2 px-4 border border-blue-500 rounded shadow" href="#" target="_blank">
                                        Generar
                                    </a>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal.buscar-alumno id="buscarAlumnoModal" inputTrigger="alumno_s"/>
</x-app-layout>

<script>
    const generar = document.getElementById('generar');
    const alumno = document.getElementById('alumno');

    alumno.addEventListener('change', (e) => {
        generar.classList.remove('cursor-not-allowed');
        generar.classList.add('cursor-pointer');
        generar.classList.add('hover:bg-blue-600');
        generar.href="/seguimiento/sesiones/alumno/"+alumno.value+"/pdf?año="+año.value;
    });
    // generar.classList.remove('cursor-not-allowed');
    // generar.classList.add('cursor-pointer');
    // generar.href="/seguimiento/sesiones/alumno/"+alumno.value+"/pdf?año="+año.value;


</script>

@stack("script")
