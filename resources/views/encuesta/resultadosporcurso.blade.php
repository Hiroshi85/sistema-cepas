
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resultados de la Encuesta') }}
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
                    @foreach($encuestas as $e)
                        <div class="bg-white dark:bg-gray-800 dark:text-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                            <div>
                                <h1 class="mx-10 my-3" >Resultado: {{$e->resultados}}</h1>
                                <h1 class="mx-10 my-3" >Alumno: {{$e->alumno->nombre_apellidos}}</h1>
                            </div>
                        </div>
                    @endforeach
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


