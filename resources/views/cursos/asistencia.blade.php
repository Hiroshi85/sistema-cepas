    <link href="/resources/css/styles.css" rel="stylesheet">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asistencia') }}
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
            <div class="mx-16 py-6 lg:pl-18 lg:px-12">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m:4 p-4">
                    <a href="{{route('detalleasistencia',['id1'=> $c->iddetalle, 'id2'=> 1] ) }}"><h4 class="text-3xl font-bold dark:text-white">Bimestre 1</h4></a>
                </div>
                <br>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m:4 p-4">
                    <a href="{{route('detalleasistencia',['id1'=> $c->iddetalle, 'id2'=> 2] ) }}"><h4 class="text-3xl font-bold dark:text-white">Bimestre 2</h4></a>
                </div>
                <br>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m:4 p-4">
                    <a href="{{route('detalleasistencia',['id1'=> $c->iddetalle, 'id2'=> 3] ) }}"><h4 class="text-3xl font-bold dark:text-white">Bimestre 3</h4></a>
                </div>
                <br>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m:4 p-4">
                    <a href="{{route('detalleasistencia',['id1'=> $c->iddetalle, 'id2'=> 4] ) }}"><h4 class="text-3xl font-bold dark:text-white">Bimestre 4</h4></a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>


