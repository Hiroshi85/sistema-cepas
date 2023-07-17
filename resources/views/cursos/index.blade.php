
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mantenedor cursos') }}
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">                
                <div class="p-6 text-gray-900 dark:text-gray-100 flex">
                    <a href="{{route('asignar')}}" type="button" class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Realizar la asignacion de cursos</a>
                    <p class="mx-10 my-3 text-sm text-center" >Asignar los cursos disponibles en las aulas y con los docentes. Datos adiconales
                        como el horario de enseñanza. </p>
                </div>
            </div>
            <br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if($cursos->count() > 0)
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg m-4">
                        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID CURSO
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        NOMBRE
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cursos as $c)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">CUR{{$c->id}}</th>
                                        <td class="px-6 py-4">{{$c->nombre}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No se encontraron cursos.</p>
                @endif
                <div class="px-4 py-4 bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    {{$cursos->links()}}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script>
  function buscarCursos(palabra) {
    // Hacer la llamada a la ruta y enviar el valor de la palabra
    window.location.href = "{{ route('cursos.index') }}?buscarpor=" + palabra;
  }
</script>

