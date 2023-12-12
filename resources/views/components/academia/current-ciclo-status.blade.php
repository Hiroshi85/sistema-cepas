<div class="flex gap-x-5 mt-5">
    <div class="w-full sm:w-1/2 bg-white dark:bg-gray-900 shadow-sm sm:rounded-lg">
        <div class="p-5">
            <h5 class="text-gray-300 dark:text-gray-600 uppercase text-xs">
                Solicitudes pendientes
            </h5>

            <h3 class="text-black dark:text-white font-black text-3xl mt-2">
                {{ $currCicle->solicitudesPendientes->count() }} solicitud(es)
            </h3>

            <div class="flex justify-end">
                <x-primary-button :link="true" href="{{route('academia.ciclo.solicitud.index', $currCicle)}}">
                    Ver
                </x-primary-button>
            </div>
        </div>

    </div>
    <div class="w-full sm:w-1/2 bg-white dark:bg-gray-900 shadow-sm sm:rounded-lg">
        <div class="p-5">
            <h5 class="text-gray-300 dark:text-gray-600 uppercase text-xs">
                Alumnos Registrados
            </h5>
        </div>
    </div>
</div>
