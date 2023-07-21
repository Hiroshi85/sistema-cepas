    <link href="/resources/css/styles.css" rel="stylesheet">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{$c->curso->nombre}}
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
    <div class="lg:px-20">
        <div class="mx-16 py-6 lg:pl-18 lg:px-12 grid grid-cols-4 gap-6">
            <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           
                <h3 class="text-3xl font-bold dark:text-white">Informacion</h3>
                <p class="font-normal text-gray-700 dark:text-gray-400">
                                   Informacion importante del curso. <br>
                                   <br>
                                   <br>
                                   Aula: {{$c->aula->grado}}
                                   <br>
                                   Numero de participantes: 
                                   <br>
                                   Horario: {{$c->horario}}</p>
            </div>
            <div class="col-span-3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">    
                <div class="grid grid-cols-2 justify-center">       
                    <h3 class="text-3xl font-bold dark:text-white">Silabo</h3> 
                    <!-- Modal toggle -->
                    <div class="flex justify-end">
                        @can('miscursos')
                            <button id="btncargar" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="w-64 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Cargar silabo del curso.
                            </button>
                        @endcan
                    </div>
                </div>
                <!-- Main modal -->
                <form action="{{route('silabos.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Subir silabo
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Cerrar</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <input hidden type="text" name="idcurso" value="{{$c->iddetalle}}">
                                <div class="p-6 space-y-6">    
                                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="namefile" id="namefile" type="file">
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cargar</button>
                                    <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @if($silabo->count()>0)
                    <div class="relative overflow-x-auto">
                        <table class="text-center w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Documento
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Estado
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Opciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($silabo as $s)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th class="px-6 py-4 w-5/8">
                                            {{$s->namefile}}
                                        </th>
                                        <th class="px-6 py-4 w-1/8">
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">Default</span>
                                            <!-- <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">Dark</span>
                                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Red</span>
                                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Green</span> -->
                                        </th>
                                        <th class="px-6 py-4 w-2/8">
                                            <a data-modal-toggle="editSilabo{{$s->idsilabo}}" data-target="#editSilabo{{$s->idsilabo}}">Actualizar</a>
                                            <!-- Main modal -->
                                            <form action="{{route('silabos.update',$s->idsilabo)}}" method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div id="editSilabo{{$s->idsilabo}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Actualizar silabo
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editSilabo{{$s->idsilabo}}">
                                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                                    <span class="sr-only">Cerrar</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <input hidden type="text" name="idcurso" value="{{$c->iddetalle}}">
                                                            <div class="p-6 space-y-6">    
                                                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="namefile" id="namefile" type="file"">
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <button data-modal-hide="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cargar</button>
                                                                <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <a data-modal-target="popup-modal" data-modal-toggle="popup-modal">Eliminar</a>
                                            <form action="{{route('silabos.destroy',$s->idsilabo)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-md max-h-full">
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                            <div class="p-6 text-center">
                                                                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Estas seguro de eliminar el documento cargado?</h3>
                                                                <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                                    Estoy seguro
                                                                </button>
                                                                <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="{{ asset('archivos/' . $s->namefile) }}" target="_blank">Ver</a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <br>
                    <p class="font-normal text-gray-700 dark:text-gray-400">No se hay un silabo registrado.</p>
                @endif
            </div>
        </div>
        <div class="mx-16 py-6 lg:pl-18 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m:4 p-4">
                <a href="{{route('asistencia',$c->iddetalle)}}"><h4 class="text-3xl font-bold dark:text-white">Asistencia</h4></a>
            </div>
            <br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m:4 p-4">
                <a href="{{route('registrarnotas',$c->iddetalle)}}"><h4 class="text-3xl font-bold dark:text-white">Calificaciones</h4></a>
            </div>
        </div>
        <!-- -- Evaluaciones -->
        <div class="mx-16 py-6 lg:pl-18 lg:px-12">
            <div class="col-span-3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">    
                    <div class="grid grid-cols-2 justify-center">       
                        <h3 class="text-3xl font-bold dark:text-white">Evaluaciones</h3> 
                        <!-- Modal toggle -->
                        @can('miscursos')
                            <div class="flex justify-end">
                                <button id="btncargar" data-modal-target="defaultModalEva" data-modal-toggle="defaultModalEva" class="w-64 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                Cargar evaluacion.
                                </button>
                            </div>
                        @endcan
                    </div>
                    <!-- Main modal -->
                    <form action="{{route('evaluaciones.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="defaultModalEva" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Cargar evaluacion
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModalEva">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Cerrar</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <input hidden type="text" name="idcurso" value="{{$c->iddetalle}}">
                                    <div class="p-6 space-y-6">    
                                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="namefile" id="namefile" type="file">
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button data-modal-hide="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cargar</button>
                                        <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if($evaluaciones->count()>0)
                        <div class="relative overflow-x-auto">
                            <table class="text-center w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Documento
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Estado
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Opciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($evaluaciones as $e)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th class="px-6 py-4 w-5/8">
                                                {{$e->namefile}}
                                            </th>
                                            <th class="px-6 py-4 w-1/8">
                                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{$e->estado}}</span>
                                                <!-- <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">Dark</span>
                                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Red</span>
                                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Green</span> -->
                                            </th>
                                            <th class="px-6 py-4 w-2/8">
                                                <a data-modal-toggle="editEvaluacion{{$e->idevaluacion}}" data-target="#editEvaluacion{{$e->idevaluacion}}">Actualizar</a>
                                                <!-- Main modal -->
                                             
                                                <form action="{{route('evaluaciones.update',$e->idevaluacion)}}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div id="editEvaluacion{{$e->idevaluacion}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative w-full max-w-2xl max-h-full">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                <!-- Modal header -->
                                                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                        Actualizar evaluacion
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editEvaluacion{{$e->idevaluacion}}">
                                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                                        <span class="sr-only">Cerrar</span>
                                                                    </button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <input hidden type="text" name="idcurso" value="{{$c->iddetalle}}">
                                                                <div class="p-6 space-y-6">    
                                                                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="namefile" id="namefile" type="file"">
                                                                </div>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                    <button data-modal-hide="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cargar</button>
                                                                    <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <a data-modal-target="deleteEvaluacion{{$e->idevaluacion}}" data-modal-toggle="deleteEvaluacion{{$e->idevaluacion}}">Eliminar</a>
                                                <form action="{{route('evaluaciones.destroy',$e->idevaluacion)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div id="deleteEvaluacion{{$e->idevaluacion}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative w-full max-w-md max-h-full">
                                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="deleteEvaluacion{{$e->idevaluacion}}">
                                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                                <div class="p-6 text-center">
                                                                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Estas seguro de eliminar el documento cargado?</h3>
                                                                    <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                                        Estoy seguro
                                                                    </button>
                                                                    <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <a href="{{ asset('evaluaciones/' . $e->namefile) }}" target="_blank">Ver</a>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <br>
                        <p class="font-normal text-gray-700 dark:text-gray-400">No se hay ninguna evaluacion registrada.</p>
                    @endif
                </div>
        </div>
        
    </div>
    
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script>
    if ({{$silabo->count()}} > 0) {
        document.getElementById("btncargar").style.display = "none"; // Oculta el botón si la condición se cumple
    }
</script>



