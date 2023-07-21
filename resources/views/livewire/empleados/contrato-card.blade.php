@php
    use Carbon\Carbon;
@endphp
<a href="{{ route('contratos.show', $contrato) }}"
    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">
        {{ Carbon::parse($contrato->fecha_inicio)->locale('es_ES')->isoFormat('LL') }}
        -

        {{ Carbon::parse($contrato->fecha_fin)->locale('es_ES')->isoFormat('LL') }}

    </h5>


    @switch($contrato->
        tipo_contrato)
        @case('tiempo completo')
            <x-badge color="green">Tiempo Completo </x-badge>
        @break

        @default
            <x-badge color="blue">Tiempo Parcial </x-badge>
    @endswitch

    @switch($contrato->estado())
        @case('vigente')
            <x-badge color="green">Vigente </x-badge>
        @break

        @case('finalizado')
            <x-badge color="red">Finalizado </x-badge>
        @break

        @default
            <x-badge color="yellow">Próximo a iniciar </x-badge>
    @endswitch
</a>
