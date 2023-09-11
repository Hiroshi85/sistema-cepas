<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asistencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <p class="font-xl text-gray-800 dark:text-white font-semibold py-2 px-4">Toma de Asistencia</p>
                    <a class="text-gray-800 dark:text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-200 transition duration-300 ease-in-out"
                    href="{{ route('asistenciaxdias.create') }}">
                        Otros días
                    </a>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="py-5 text-gray-900 dark:text-gray-100 text-5xl">
                            <p>{{Str::title($day)}}, {{$today}}</p>
                        </div>
                        @if ($enable)
                            <form id="myForm" method="POST" action="{{ route('asistenciaxdias.store') }}" class="max-w-7xl mx-auto">
                                @csrf
                                <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">
                                    <input type="hidden" name="fecha" value="{{$today}}">
                                    <input type="hidden" name="alumno" id="alumno">
                                    <div class="col-span-2 lg:col-span-2">
                                        <label for="alumno_s" class="block">Alumno: </label>
                                        <input type="text" required readonly id="alumno_s" class="w-full">
                                    </div>

                                    <div class="col-span-2 lg:col-span-1">
                                        <label for="tipo" class="block">Asistencia</label>
                                        <select required id="tipo" name="tipo" class="w-full dark:text-gray-800" required>
                                        <option value="1" selected>Presente</option>
                                        <option value="2">Falta</option>
                                        <option value="3">Justificado</option>
                                        <option value="4">Tarde</option>
                                        </select>
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

    <x-modal.buscar-alumno id="buscarAlumnoModal" inputTrigger="alumno_s"/>
</x-app-layout>


@stack("script")
