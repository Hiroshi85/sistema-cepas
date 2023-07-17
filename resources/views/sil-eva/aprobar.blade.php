    <link href="/resources/css/styles.css" rel="stylesheet">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Revision y Aprobacion de Documentos Importantes de Curso
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
        <div class="mx-16 py-6 lg:pl-18 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m:4 p-4">
               <h4 class="text-3xl font-bold dark:text-white">Silabos</h4>
               <br>
               <div class="relative overflow-x-auto">
                    @if($silabos->count()>0)
                            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 w-1/5">
                                            Nombre
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-3/8">
                                            Curso
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/8">
                                            Aula
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/8">
                                            Ver
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-3/8">
                                            Estado
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($silabos as $s)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                               {{$s->namefile}}
                                            </th>
                                            <td class="px-6 py-4">
                                               {{$s->cursoasignado->curso->nombre}}
                                            </td>
                                            <td class="px-6 py-4">
                                               {{$s->cursoasignado->aula->grado}}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="#" data-modal-toggle="verDocumento{{$s->namefile}}" data-target="#verDocumento{{$s->namefile}}" class="px-6 font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
                                                <div id="verDocumento{{$s->namefile}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                                        <!-- Modal content -->
                                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                            <!-- Modal header -->
                                                            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                                    Ver silabo
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="verDocumento{{$s->namefile}}">
                                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <!-- <iframe src="/silabos/{{$s->namefile}}" width="100%" height="600px"></iframe> -->
                                                            {{$s->namefile}}
                                                            <embed src="/archivos/{{$s->namefile}}" type="application/pdf" width="100%" height="600px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                            <select id="estado" name="estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="REGISTRADO"  {{$s->estado == "REGISTRADO" ? 'selected' :'' }}>REGISTRADO</option>
                                                <option value="OBSERVADO"  {{$s->estado == "OBSERVADO" ? 'selected' :'' }}>OBSERVADO</option>
                                                <option value="RECHAZADO"  {{$s->estado== "RECHAZADO" ? 'selected' :'' }}>RECHAZADO</option>
                                            </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    @else
                        <p class="font-normal text-gray-700 dark:text-gray-400">No existen silabos registrados.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="mx-16 py-6 lg:pl-18 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m:4 p-4">
               <h4 class="text-3xl font-bold dark:text-white">Evaluaciones</h4>
               <br>
               <div class="relative overflow-x-auto">
                    @if($evaluaciones->count()>0)
                            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 w-1/5">
                                            Nombre
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/5">
                                            Curso
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/5">
                                            Aula
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/5">
                                            Ver
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/5">
                                            Estado
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($evaluaciones as $e)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                               {{$e->namefile}}
                                            </th>
                                            <td class="px-6 py-4">
                                               {{$e->cursoasignado->curso->nombre}}
                                            </td>
                                            <td class="px-6 py-4">
                                               {{$e->cursoasignado->aula->grado}}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="#" data-modal-toggle="xverDocumento{{$e->namefile}}" data-target="#xverDocumento{{$e->namefile}}" class="px-6 font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
                                                <div id="xverDocumento{{$e->namefile}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                                        <!-- Modal content -->
                                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                            <!-- Modal header -->
                                                            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                                    Ver evaluacion
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="xverDocumento{{$e->namefile}}">
                                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <embed src="/evaluaciones/{{$e->namefile}}" type="application/pdf" width="100%" height="600px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <select id="estado" name="estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="REGISTRADA"  {{$e->estado == "REGISTRADA" ? 'selected' :'' }}>REGISTRADA</option>
                                                    <option value="OBSERVADA"  {{$e->estado == "OBSERVADA" ? 'selected' :'' }}>OBSERVADA</option>
                                                    <option value="RECHAZADA"  {{$e->estado== "RECHAZADA" ? 'selected' :'' }}>RECHAZADA</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    @else
                        <p class="font-normal text-gray-700 dark:text-gray-400">No existen evaluaciones registrados.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>




