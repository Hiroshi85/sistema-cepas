    <link href="/resources/css/styles.css" rel="stylesheet">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Cursos') }}
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto">           
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100 grid grid-cols-3 gap-6"> 
                    @if($miscursos->count() > 0)
                        @foreach($miscursos as $mc)   
                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="rounded-t-lg" src="/images/card.jpg" alt="cardcurrso" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$mc->curso->nombre}} - {{$mc->aula->grado}} {{$mc->aula->seccion}}</h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                   Horario: {{$mc->horario}}</p>
                                <a href="{{route('micurso',$mc->iddetalle)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Ver detalle
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p>No se encontraron cursos asginados.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>


