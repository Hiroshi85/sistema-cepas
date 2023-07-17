    <link href="/resources/css/styles.css" rel="stylesheet">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Evaluacion de docentes
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
    <div class="lg:px-20 p-15">
        <div class="mx-16 p-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m:8 p-4">
               <h4 class="text-3xl font-bold dark:text-white">Docentes</h4>
            </div><br>
            @foreach($evadoc as $d)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m:4 p-4 grid grid-cols-3">
                    <div class="flex justify-content" style="flex-direction: column">
                        <h4 class="text-2xl font-bold dark:text-white">Nombre: {{$d->docente->nombre}}</h4>
                        <p class="dark:text-white">Numero Telefono: {{$d->docente->telefono}}</p>
                        <?php
                        if ($d->calificacion != null) {
                            $x = $d->calificacion;
                        } else {
                            $x = 'Sin calificar';
                        }
                        ?>
                        <p class="dark:text-white">Calificacion: {{$x}} </p>
                    </div>
                    <div class="flex justify-content" style="flex-direction: column">
                        <br>
                        <a href="{{route('miscursos', $d->docente->dni ) }}"><p class="underline dark:text-white">Ver informacion de sus cursos</p></a>
                    </div>
                    <div class="flex justify-content" style="flex-direction: column">
                        <br>
                        <a href="#" data-modal-toggle="abrirEva{{$d->idevadoc}}" data-target="#abrirEva{{$d->idevadoc}}" class="px-6 font-medium text-blue-600 dark:text-blue-500 hover:underline">Calificar</a>
                                <div id="abrirEva{{$d->idevadoc}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                            <!-- Modal content -->
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <!-- Modal header -->
                                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Editar calificacion
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="abrirEva{{$d->idevadoc}}">
                                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form method="POST" action="{{route('evaluaciondocente.update',$d->idevadoc)}}">                                
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                                                                <div>
                                                                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Calificacion:</label>
                                                                    <input type="number" name="calificacion" id="calificacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ingresa calificacion" value="{{$d->calificacion}}" required="">
                                                                </div>
                                                                <div>
                                                                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Retroalimentacion:</label>
                                                                    <textarea name="retroalimentacion" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribir retroalimentacion">{{$d->retroalimentacion}}</textarea>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                                    Actualizar evaluacion
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                        </div>
                    </div>                    
                </div><br>
            @endforeach
        </div>
    </div>
    
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>




