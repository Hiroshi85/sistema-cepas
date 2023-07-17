@props(['evaluacion' => null, 'postulacion' => null])
@php
    use Carbon\Carbon;
    if (!$postulacion) {
        $postulacion = $evaluacion->postulacion;
    }
@endphp
<form method="POST"
    action="{{ $evaluacion ? route('rrhh.evaluaciones.update', $evaluacion) : route('rrhh.evaluaciones.store') }}"
    class="flex flex-col md:grid md:grid-cols-2 gap-5">
    @csrf
    {{ $evaluacion ? method_field('PUT') : '' }}


    <input type="text" hidden name="postulacion_id" value="{{ $postulacion->id }}">
    <div class="flex flex-col col-span-full">
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">Información de
                Postulación</h3>
        </div>
        <div class="mt-6 border-t border-gray-100 dark:border-gray-800">
            <dl class="divide-y divide-gray-100 dark:divide-gray-800">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Candidato
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                        {{ $postulacion->candidato->nombre }} - {{ $postulacion->candidato->edad() }} años
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Puesto aplicado
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                        {{ $postulacion->plaza->puesto->nombre }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Fecha de
                        postulación
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                        {{ Carbon::parse($postulacion->fecha_postulacion)->locale('es_ES')->isoFormat('LL') }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100 col-span-full mt-6">
        Información de Evaluación
    </h3>

    <x-input-group value="{{ $evaluacion ? $evaluacion->experiencia_laboral : '' }}" label="Años de Experiencia Laboral"
        name="experiencia_laboral" type="text" required placeholder="Ingrese experiencia laboral (años)">
    </x-input-group>

    @livewire(
        'common.multi-input',
        [
            'items' => old('educacion', $evaluacion ? $evaluacion->educacion : []),
            'label' => 'Estudios',
            'name' => 'educacion',
            'wire:model' => 'educacion',
        ],
        key('educacion-' . $evaluacion->id)
    )

    @livewire(
        'common.multi-input',
        [
            'items' => old('habilidades', $evaluacion ? $evaluacion->habilidades : []),
            'label' => 'Habilidades',
            'name' => 'habilidades',
            'wire:model' => 'habilidades',
        ],
        key('habilidades-' . $evaluacion->id)
    )
    @if ($postulacion->plaza->puesto->equipo_id == '4')
        @livewire(
            'common.multi-input',
            [
                'items' => old('conocimiento_materias', $evaluacion ? $evaluacion->conocimiento_materias : []),
                'label' => 'Materias que domina',
                'name' => 'conocimiento_materias',
                'wire:model' => 'conocimiento_materias',
            ],
            key('conocimiento-materias-' . $evaluacion->id)
        )
    @endif



    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>
</form>
