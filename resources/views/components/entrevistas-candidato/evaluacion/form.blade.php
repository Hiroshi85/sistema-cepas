@props(['entrevista' => null, 'evaluacion' => null, 'entrevistadores' => []])
@php
    use Carbon\Carbon;
    if (!$evaluacion) {
        $evaluacion = $entrevista->evaluacion;
    }
    $entrevistadores_options = [];
    foreach ($entrevistadores as $entrevistador) {
        $entrevistadores_options[] = (object) [
            'value' => $entrevistador->id,
            'label' => $entrevistador->nombre,
        ];
    }
@endphp
<form method="POST"
    action="{{ $entrevista ? route('rrhh.entrevistas.update', $entrevista) : route('rrhh.entrevistas.store') }}"
    class="flex flex-col md:grid md:grid-cols-2 gap-5">
    @csrf
    {{ $entrevista ? method_field('PUT') : '' }}


    <input type="text" hidden name="evaluacion_id" value="{{ $evaluacion->id }}">
    <div class="flex flex-col col-span-full">
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">Información de
                Evaluación</h3>
        </div>
        <div class="mt-6 border-t border-gray-100 dark:border-gray-800">
            <dl class="divide-y divide-gray-100 dark:divide-gray-800">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Candidato
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                        {{ $evaluacion->postulacion->candidato->nombre }} -
                        {{ $evaluacion->postulacion->candidato->edad() }} años
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Puesto aplicado
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                        {{ $evaluacion->postulacion->plaza->puesto->nombre }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Años de Experiencia
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                        {{ $evaluacion->experiencia_laboral }} años
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100 col-span-full mt-6">
        Información de Entrevista
    </h3>


    <x-input-group value="{{ $entrevista ? $entrevista->entrevistador_id : '' }}" label="Entrevistador"
        name="entrevistador_id" type="select" :options="$entrevistadores_options" required />

    <x-input-group value="{{ $entrevista ? $entrevista->fecha : '' }}" label="Fecha" name="fecha" type="date"
        required>
    </x-input-group>
    <x-input-group value="{{ $entrevista ? $entrevista->hora : '' }}" label="Hora" name="hora" type="time"
        required>
    </x-input-group>


    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>
</form>
