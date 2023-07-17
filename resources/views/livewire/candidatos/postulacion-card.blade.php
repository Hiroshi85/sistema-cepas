@php
    use Carbon\Carbon;
@endphp
<a href="{{ route('postulaciones.show', $postulacion) }}"
    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
        {{ $postulacion->plaza->puesto->nombre }}

    </h5>

    <p class="font-normal text-gray-700 dark:text-gray-400 text-sm flex flex-col">
        <span>Fecha de Postulación</span>
        <span class="text-gray-900 dark:text-gray-100">
            {{ Carbon::parse($postulacion->fecha_postulacion)->locale('es_ES')->isoFormat('LL') }}
        </span>
    </p>
    @switch($postulacion->estado)
        @case('en revision')
            <x-badge color="indigo">En revisión </x-badge>
        @break

        @case('aprobado')
            <x-badge color="green">Aprobado </x-badge>
        @case('rechazado')
            <x-badge color="red">Rechazado </x-badge>
        @break

        @default
            <x-badge color="yellow">Pendiente </x-badge>
    @endswitch
</a>
