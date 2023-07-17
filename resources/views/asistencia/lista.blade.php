    <link href="/resources/css/styles.css" rel="stylesheet">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$c->curso->nombre}} - {{$c->aula->grado}} > Bimestre {{$numbim}} > {{ __('Registrar asistencia') }}
        </h2>
    </x-slot>
    @if (session('mensaje'))
        <div class="bg-green-200 text-green-800 p-4 mb-4 flash-message">
            {{ session('mensaje') }}
        </div>
    @endif
    <script>
        setTimeout(function() {
            document.querySelector('.flash-message').remove();
        }, 3000);
    </script>
    <div class="py-12 pl-18 px-12"> 
                <div class="flex justify-between">
                    <br>
                    <a href="{{route('listaasistencia.pdf', ['id1' => $c->iddetalle, 'id2' => $numbim])}}" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-yellow-900">
                        Generar reporte de notas
                    </a>
                </div>              
                <div class="relative overflow-x-auto">
                    <form action="{{route('asistencias.update',1)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <table class="text-center w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 w-4/12">
                                            Alumno
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            S1
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            S2
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            S3
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            S4
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            S5
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            S6
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            S7
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            S8
                                        </th>
                                    </tr>
                            </thead>
                            <tbody>
                                    @php
                                        $norden = 0;
                                    @endphp
                                    @foreach($asistencias as $as)
                                    @php    
                                        $norden += 1;
                                    @endphp
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="col" class="px-6 py-3 w-4/12">
                                        {{$norden}}.- {{$as->alumno->nombre}}
                                        <input value="{{$as->idasistencia}}" id="idalumno" name="idasistencia[]" hidden>
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            <select id="s1" name="s1[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="F"  {{$as->s1 == "F" ? 'selected' :'' }}>F</option>
                                                <option value="A"  {{$as->s1 == "A" ? 'selected' :'' }}>A</option>
                                                <option value="T"  {{$as->s1 == "T" ? 'selected' :'' }}>T</option>
                                            </select> 
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            <select id="s2" name="s2[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="F"  {{$as->s2 == "F" ? 'selected' :'' }}>F</option>
                                                <option value="A"  {{$as->s2 == "A" ? 'selected' :'' }}>A</option>
                                                <option value="T"  {{$as->s2 == "T" ? 'selected' :'' }}>T</option>
                                            </select> 
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            <select id="s3" name="s3[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="F"  {{$as->s3 == "F" ? 'selected' :'' }}>F</option>
                                                <option value="A"  {{$as->s3 == "A" ? 'selected' :'' }}>A</option>
                                                <option value="T"  {{$as->s3 == "T" ? 'selected' :'' }}>T</option>
                                            </select> 
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            <select id="s4" name="s4[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="F"  {{$as->s4 == "F" ? 'selected' :'' }}>F</option>
                                                <option value="A"  {{$as->s4 == "A" ? 'selected' :'' }}>A</option>
                                                <option value="T"  {{$as->s4 == "T" ? 'selected' :'' }}>T</option>
                                            </select> 
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            <select id="s5" name="s5[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="F"  {{$as->s5 == "F" ? 'selected' :'' }}>F</option>
                                                <option value="A"  {{$as->s5 == "A" ? 'selected' :'' }}>A</option>
                                                <option value="T"  {{$as->s5 == "T" ? 'selected' :'' }}>T</option>
                                            </select> 
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            <select id="s6" name="s6[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="F"  {{$as->s6 == "F" ? 'selected' :'' }}>F</option>
                                                <option value="A"  {{$as->s6 == "A" ? 'selected' :'' }}>A</option>
                                                <option value="T"  {{$as->s6 == "T" ? 'selected' :'' }}>T</option>
                                            </select> 
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            <select id="s7" name="s7[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="F"  {{$as->s7 == "F" ? 'selected' :'' }}>F</option>
                                                <option value="A"  {{$as->s7 == "A" ? 'selected' :'' }}>A</option>
                                                <option value="T"  {{$as->s7 == "T" ? 'selected' :'' }}>T</option>
                                            </select> 
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            <select id="s8" name="s8[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="F"  {{$as->s8 == "F" ? 'selected' :'' }}>F</option>
                                                <option value="A"  {{$as->s8 == "A" ? 'selected' :'' }}>A</option>
                                                <option value="T"  {{$as->s8 == "T" ? 'selected' :'' }}>T</option>
                                            </select> 
                                        </th>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        @can('miscursos')
                            <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-center"> 
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Guardar asistencia</button>
                            </div>
                        @endcan
                    </form>
                </div>
    </div>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>


