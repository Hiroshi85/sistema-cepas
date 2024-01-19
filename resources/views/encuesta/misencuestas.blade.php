
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Encuestas') }}
        </h2>
    </x-slot>
    @if (session('mensaje'))
        <div class="bg-green-200 text-green-800 p-4 mb-4 flash-message">
            {{ session('mensaje') }}
        </div>
        <script>
            setTimeout(function() {
                document.querySelector('.flash-message').remove();
            }, 3000);
        </script>
    @endif
    <div class="py-12">
    @if(count($encuestas) > 0)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-" id="active">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">  
                <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           

                    <p class="font-normal text-gray-700 dark:text-gray-400">sss</p>
                </div>              
                <div class="p-6 text-gray-900 dark:text-gray-100 flex">
                @if($encuestas->count() > 0)
                        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">
                                        CURSO
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        DOCENTE
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        ESTADO
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        ACCION
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($encuestas as $e)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-8">{{$e->cursoasignado->curso->nombre}}</th>
                                        <td class="px-6 py-4">{{$e->cursoasignado->docente->nombre}}</td>
                                        <td class="px-6 py-4">
                                            <?php
                                                $mensaje = ($e->estado == 0) ? 'Pendiente' : 'Completada';
                                                echo $mensaje;
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 ">
                                            @if($e->estado == 0)
                                                <a href="{{route('verEncuesta',$e->idencuesta)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                                    Completar encuesta
                                                </a>
                                            @else
                                                Hecho
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                @else
                    <p>No se encontraron cursos.</p>
                @endif
                </div>
            </div>
            <br>
        </div>
    @else
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-" id="results">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">                
                <div class="p-6 text-gray-900 dark:text-gray-100 flex">
                    <p class="mx-10 my-3 text-sm text-center" >No hay encuestas disponibles.</p>
                </div>
            </div>
            <br>
        </div>
    @endif
    </div>

</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>


