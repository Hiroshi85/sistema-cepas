<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asignar Cursos') }}
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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> 
                <p class="px-6 py-5 text-3xl font-bold text-gray-900 dark:text-white">Seleccionar informacion:</p>               
                <form action="{{route('asignar.grabar')}}" method="POST">                                
                    @csrf
                    <div class="px-6 py-4 text-gray-900 dark:text-gray-100 grid grid-cols-2 gap-6"> 
                        <div>
                            <label for="idaula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccionar aula:</label>
                            <select id="idaula" name="idaula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($aulas as $a)
                                <option value="{{$a->idaula}}">{{$a->grado}} {{$a->seccion}}</option>
                            @endforeach
                            </select> 
                        </div>                   
                        <div>
                            <label for="idcurso" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccionar curso:</label>
                            <select id="idcurso" name="idcurso" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($cursos as $c)
                                <option value="{{$c->id}}">{{$c->nombre}}</option>
                            @endforeach
                            </select> 
                        </div> 
                        <div>
                            <label for="iddocente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccionar docente:</label>
                            <select id="iddocente" name="iddocente" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($docentes as $d)
                                    <option value="{{$d->id}}">{{$d->nombre}}</option>
                            @endforeach  
                            </select> 
                        </div>
                        <div>
                            <label for="horario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccionar horario:</label>
                            <select id="horario" name="horario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>Lunes</option>
                                <option>Martes</option>
                                <option>Miercoles</option>
                                <option>Jueves</option>
                                <option>Viernes</option>
                            </select> 
                        </div> 
                    </div>
                    <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-center"> 
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Asignar curso</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px- py-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <p class="px-6 py-5 text-3xl font-bold text-gray-900 dark:text-white">Cursos asignados</p>               
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100"> 
                    @if($asignados->count() > 0)
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg m-4">
                            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            CURSO
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            AULA
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            DOCENTE
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            HORARIO
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asignados as $c)
                                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                            <td class="px-6 py-4">{{$c->curso->nombre}}</td>
                                            <td class="px-6 py-4">{{$c->aula->grado}} {{$c->aula->seccion}}</td>
                                            <td class="px-6 py-4">{{$c->docente->nombre}}</td>
                                            <td class="px-6 py-4">{{$c->horario}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No se encontraron cursos asignados.</p>
                    @endif
                    <?php if ($asignados->count()>=20): ?>
                        <div class="mx-5  px-4 py-4 bg-white border-b dark:bg-gray-900 dark:border-gray-700">$asignados->links()</div>
                    <?php endif; ?> 
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>


