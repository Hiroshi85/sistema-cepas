
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Procesos de Encuestas - Por Curso') }}
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
    <div class="py-8">
    @if(count($encuestas) == 0)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-" id="active">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">                
                <div class="p-6 text-gray-900 dark:text-gray-100 flex">
                    <a href="{{route('iniciarEncuestas')}}" type="button" class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">INICIAR</a>
                    <p class="mx-10 my-3 text-sm text-center" >Iniciar proceso de encuestas. </p>
                </div>
            </div>
            <br>
        </div>
    @else
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-" id="results"> 
            <!-- <div>
                <form method="GET" action="{{ route('procesoEncuestas') }}">
                    <div class="text-align: right;" style="width: 300px;">
                        <label for="aula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Buscar por aula:</label>
                        <select id="aula" name="idaula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($aulas as $a)
                                <option value="{{$a->id}}">{{ $a->grado }} {{$a->seccion}}</option>
                            @endforeach
                        </select> 
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buscar</button>
                </form>
            </div> -->
            <!-- <br> -->
                <div class="text-gray-900 dark:text-gray-100 flex">
                    <p style="font-size: 25px;">Resultados</p>
                </div>
                <br>
                @foreach ($cursos as $c)
                    <div class="bg-white dark:bg-gray-800 dark:text-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                        <div>
                            <h1 class="mx-10 my-3" >Curso: {{$c->curso->nombre}}</h1>
                            <p class="mx-10 my-3" >Docente: {{$c->docente->nombre}}</p>
                            <p class="mx-10 my-3" >Aula: {{$c->aula->grado}} {{$c->aula->seccion}} </p>
                        </div>
                        <div>
                            <a href="{{route('resultadosPorCurso',$c->iddetalle)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                Ver resultados
                            </a>
                        </div>
                    </div><br>
                @endforeach
            <br>
        </div>
    @endif
    </div>

</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>


