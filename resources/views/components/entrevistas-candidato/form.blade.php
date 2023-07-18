@props(['entrevista' => null, 'evaluaciones' => [], 'entrevistadores' => []])
@php
    use Carbon\Carbon;
    $evaluaciones_options = [];
    foreach ($evaluaciones as $evaluacion) {
        $evaluaciones_options[] = (object) [
            'value' => $evaluacion->id,
            'label' => $evaluacion->postulacion->candidato->nombre . ' - ' . $evaluacion->postulacion->plaza->puesto->nombre,
        ];
    }
    $entrevistadores_options = [];
    foreach ($entrevistadores as $entrevistador) {
        $entrevistadores_options[] = (object) [
            'value' => $entrevistador->id,
            'label' => $entrevistador->nombre,
        ];
    }
    
@endphp
@if ($evaluaciones->count() > 0)
    <form method="POST"
        action="{{ $entrevista ? route('rrhh.entrevistas.update', $entrevista) : route('rrhh.entrevistas.store') }}"
        class="flex flex-col md:grid md:grid-cols-2 gap-5">
        @csrf
        {{ $entrevista ? method_field('PUT') : '' }}

        <x-input-group value="{{ $entrevista ? $entrevista->evaluacion_id : '' }}" label="Candidato - Puesto Aplicado"
            name="evaluacion_id" type="select" :options="$evaluaciones_options" required />
        <x-input-group value="{{ $entrevista ? $entrevista->entrevistador_id : '' }}" label="Entrevistador"
            name="entrevistador_id" type="select" :options="$entrevistadores_options" required />

        <x-input-group value="{{ $entrevista ? $entrevista->fecha : '' }}" label="Fecha" name="fecha" type="date"
            required>
        </x-input-group>
        <x-input-group value="{{ $entrevista ? $entrevista->hora : '' }}" label="Fecha" name="hora" type="time"
            required>
        </x-input-group>


        <div class="col-span-2">
            <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
                {{ __('Guardar') }}
            </x-primary-button>
        </div>
    </form>
@else
    <p>
        No hay evaluaciones activas
    </p>
@endif
