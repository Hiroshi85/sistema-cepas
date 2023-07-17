    <link href="/resources/css/styles.css" rel="stylesheet">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$c->curso->nombre}} - {{$c->aula->grado}} > {{ __('Registrar Calificaciones') }}
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
                <div class="relative overflow-x-auto">
                    <form action="{{route('calificaciones.update')}}" method="POST">
                        @method('PUT')
                        @csrf
                        <table class="text-center w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 w-4/12">
                                            Alumno
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            1° BIMESTRE
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            2° BIMESTRE
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            3° BIMESTRE
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            4° BIMESTRE
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1/12">
                                            PROM FINAL
                                        </th>
                                    </tr>
                            </thead>
                            <tbody>
                                    @php
                                        $norden = 0;
                                    @endphp
                                    @foreach($calificaciones as $cs)
                                        @php    
                                            $norden += 1;
                                        @endphp
                                        <tr class=" border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="col" class="px-6 py-3 w-2/7">
                                                {{$norden}}.- {{$cs->alumno->nombre}}
                                                <input value="{{$cs->idcalificacion}}" id="idcalificacion" name="idcalificacion[]" hidden>
                                            </th>
                                            <th scope="col" class="px-6 py-3 w-1/7">
                                                <input id="b1" name="b1[]" type="number" step="any" value="{{$cs->b1}}" class="text-red-500 text-center text-white peer block min-h-[auto] w-full rounded  bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0">
                                            </th>
                                            <th scope="col" class="px-6 py-3 w-1/7">
                                                <input id="b2" name="b2[]" type="number" step="any" value="{{$cs->b2}}" class="text-center text-white peer block min-h-[auto] w-full rounded bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0">
                                            </th>
                                            <th scope="col" class="px-6 py-3 w-1/7">
                                                <input id="b3" name="b3[]" type="number" step="any" value="{{$cs->b3}}" class="text-center text-white peer block min-h-[auto] w-full rounded bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0">
                                            </th>
                                            <th scope="col" class="px-6 py-3 w-1/7">
                                                <input id="b4" name="b4[]" type="number" step="any" value="{{$cs->b4}}" class="text-center text-white peer block min-h-[auto] w-full rounded bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0">
                                            </th>
                                            <th scope="col" class="px-6 py-3 w-1/7">
                                                <input disabled value="{{$cs->prom}}" type="number" step="any" value="{{$cs->prom}}" class="bg-blue-500 text-center border border-white peer block min-h-[auto] w-full rounded bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0">
                                            </th>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        @can('miscursos')
                            <div class="px-6 py-4 text-gray-900 dark:text-gray-100 flex justify-center"> 
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Actualizar notas</button>
                            </div>
                        @endcan
                    </form>
                </div>
    </div>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script>
    
</script>


