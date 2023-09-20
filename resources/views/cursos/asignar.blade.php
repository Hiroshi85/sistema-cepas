<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
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
            var flashMessage = document.querySelector('.flash-message');
            if (flashMessage) {
                flashMessage.remove();
            }

        }, 3000);
    </script>
    <div class="py-12">    
        <div class="max-w-7xl mx-auto sm:px-6 lg:px- py-4">            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">                
                <div class="p-6 text-gray-900 dark:text-gray-100 flex">
                    <button href="#" data-modal-toggle="crearAsignatura" data-target="#crearAsignatura" type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Realizar nueva asignacion.</button>
                    <div id="crearAsignatura" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                <!-- Modal content -->
                                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                    <!-- Modal header -->
                                    <div class="flex-direction items-center  pb-2 mb-2 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Asignar curso
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="crearAsignatura">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div><br>
                                        <form action="{{route('asignar.grabar')}}" method="POST">                                
                                            @csrf
                                            <div class="px-6 py-4 text-gray-900 dark:text-gray-100 grid grid-cols-2 gap-6"> 
                                                <div>
                                                    <label for="idaula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccionar aula:</label>
                                                    <select id="idaula" name="idaula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    @foreach($aulas as $a)
                                                        <option value="{{$a->idaula}}" data-descripcion="{{$a->grado}}">{{$a->grado}} {{$a->seccion}}</option>
                                                    @endforeach
                                                    </select> 
                                                </div>                   
                                                <div>
                                                    <label for="idcurso" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccionar curso:</label>
                                                    <select id="idcurso" name="idcurso" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    @foreach($cursos as $c)
                                                        <option value="{{$c->id}}">{{ $c->nombre }}</option>
                                                        <!-- <option value="{{$c->id}}" <data-descripcion> </data-descripcion>{{$c->nombre}}</option> -->
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
                            </div>
                    </div>
                </div>   
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
                                        <th scope="col" class="px-4 py-3">
                                            OPCIONES
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
                                            <td class="px-6 py-4 flex justify-center">
                                            <button href="#" data-modal-toggle="editarAsignacion{{$c->iddetalle}}" data-target="#editarAsignacion{{$c->iddetalle}}" type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Editar</button>
                                            <div id="editarAsignacion{{$c->iddetalle}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                                        <!-- Modal content -->
                                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                            <!-- Modal header -->
                                                            <div class="flex-direction items-center  pb-2 mb-2 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                        Actualizar asignacion
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editarAsignacion{{$c->iddetalle}}">
                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div><br>
                                                                    <form action="{{route('asignar.actualizar',$c->iddetalle)}}" method="POST">                                
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="px-6 py-4 text-gray-900 dark:text-gray-100 grid grid-cols-2 gap-6"> 
                                                                            <div>
                                                                                <label for="idaula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccionar aula:</label>
                                                                                <select id="idaula" name="idaula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                                @foreach($aulas as $au)
                                                                                    <option value="{{$au->idaula}}"  <?php if ($c->idaula == $au->idaula) echo "selected"; ?>>{{$au->grado}} {{$au->seccion}}</option>
                                                                                    
                                                                                @endforeach
                                                                                </select> 
                                                                            </div>                   
                                                                            <div>
                                                                                <label for="idcurso" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccionar curso:</label>
                                                                                <select id="idcurso" name="idcurso" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                                @foreach($cursos as $cu)
                                                                                    <option value="{{$cu->id}}"  <?php if ($c->idcurso == $cu->id) echo "selected"; ?>>{{ $cu->nombre }}</option>
                                                                                    <!-- <option value="{{$c->id}}" <data-descripcion> </data-descripcion>{{$c->nombre}}</option> -->
                                                                                @endforeach
                                                                                </select> 
                                                                            </div> 
                                                                            <div>
                                                                                <label for="iddocente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccionar docente:</label>
                                                                                <select id="iddocente" name="iddocente" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                                @foreach($docentes as $d)
                                                                                        <option value="{{$d->id}}"  <?php if ($c->iddocente == $d->id) echo "selected"; ?>>{{$d->nombre}}</option>
                                                                                @endforeach  
                                                                                </select> 
                                                                            </div>
                                                                            <div>
                                                                                <label for="horario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccionar horario:</label>
                                                                                <select id="horario" name="horario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                                    <option  <?php if ($c->horario == "Lunes") echo "selected"; ?>>Lunes</option>
                                                                                    <option  <?php if ($c->horario == "Martes") echo "selected"; ?>>Martes</option>
                                                                                    <option  <?php if ($c->horario == "Miercoles") echo "selected"; ?>>Miercoles</option>
                                                                                    <option  <?php if ($c->horario == "Jueves") echo "selected"; ?>>Jueves</option>
                                                                                    <option  <?php if ($c->horario == "Viernes") echo "selected"; ?>>Viernes</option>
                                                                                </select> 
                                                                            </div> 
                                                                        </div>
                                                                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                            <button data-modal-hide="editarAsignacion" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
                                                                            <button data-modal-hide="editarAsignacion" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                                                                        </div>
                                                                    </form>
                                                                    
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"  class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" type="button">
                                                Eliminar
                                                </button>
                                                <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-md max-h-full">
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                            <div class="p-6 text-center">
                                                                <form action="{{route('asignar.eliminar',$c->iddetalle)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                                    </svg>
                                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Estas seguro de eliminar este curso?</h3>
                                                                    <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar</button>
                                                                    <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancelar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
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


