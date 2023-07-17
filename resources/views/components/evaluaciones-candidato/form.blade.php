@props(['evaluacion' => null, 'postulaciones' => []])
@php
    use Carbon\Carbon;
    $postulaciones_options = [];
    foreach ($postulaciones as $postulacion) {
        $postulaciones_options[] = (object) [
            'value' => $postulacion->id,
            'label' => $postulacion->candidato->nombre . ' - ' . $postulacion->plaza->puesto->nombre . ' - ' . Carbon::parse($postulacion->created_at)->format('d/m/Y'),
        ];
    }
@endphp
@if ($postulaciones->count() > 0)
    <form method="POST"
        action="{{ $evaluacion ? route('rrhh.evaluaciones.update', $evaluacion) : route('rrhh.evaluaciones.store') }}"
        class="flex flex-col md:grid md:grid-cols-2 gap-5">
        @csrf
        {{ $evaluacion ? method_field('PUT') : '' }}

        <x-input-group value="{{ $evaluacion ? $evaluacion->postulacion_id : '' }}" label="Postulación"
            name="postulacion_id" type="select" :options="$postulaciones_options" required />

        <x-input-group value="{{ $evaluacion ? $evaluacion->experiencia_laboral : '' }}"
            label="Años de Experiencia Laboral" name="experiencia_laboral" type="text" required
            placeholder="Ingrese experiencia laboral (años)">
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


        <div class="col-span-2">
            <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
                {{ __('Guardar') }}
            </x-primary-button>
        </div>
    </form>
@else
    <p>
        No hay postulaciones activas
    </p>
@endif
