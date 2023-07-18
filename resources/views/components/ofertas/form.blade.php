@props(['oferta' => null, 'evaluaciones' => []])
@php
    use Carbon\Carbon;
    $evaluaciones_options = [];
    foreach ($evaluaciones as $evaluacion) {
        $evaluaciones_options[] = (object) [
            'value' => $evaluacion->id,
            'label' => $evaluacion->postulacion->candidato->nombre . ' - ' . $evaluacion->postulacion->plaza->puesto->nombre,
        ];
    }
@endphp
@if ($evaluaciones->count() > 0)
    <form method="POST" action="{{ $oferta ? route('ofertas.update', $oferta) : route('ofertas.store') }}"
        class="flex flex-col md:grid md:grid-cols-2 gap-5">
        @csrf
        {{ $oferta ? method_field('PUT') : '' }}

        <x-input-group value="{{ $oferta ? $oferta->evaluacion->postulacion_id : '' }}"
            label="Candidato - Puesto Aplicado" name="postulacion_id" type="select" :options="$evaluaciones_options" required />

        <x-input-group value="{{ $oferta ? $oferta->fecha_inicio : '' }}" label="Fecha de Inicio de la Oferta"
            name="fecha_inicio" type="date" required>
        </x-input-group>
        <x-input-group value="{{ $oferta ? $oferta->fecha_fin : '' }}" label="Fecha Fin de la Oferta" name="fecha_fin"
            type="date" required>
        </x-input-group>
        <x-input-group value="{{ $oferta ? $oferta->salario : '' }}" label="Salario Ofrecido" name="salario"
            type="text" placeholder="Ingrese el salario ofrececido en (S/.)" required>
        </x-input-group>
        <x-input-group value="{{ $oferta ? $oferta->descripcion : '' }}" label="Descripcion" name="descripcion"
            type="textarea" placeholder="Ingrese la descripción de la oferta" required>
        </x-input-group>

        @livewire(
            'common.multi-input',
            [
                'items' => old('beneficios', $oferta ? $oferta->beneficios : []),
                'label' => 'Beneficios',
                'name' => 'beneficios',
                'wire:model' => 'beneficios',
            ],
            key('beneficios-' . $oferta->id)
        )

        <div class="col-span-2">
            <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
                {{ __('Guardar') }}
            </x-primary-button>
        </div>
    </form>
@else
    <p>
        No hay evaluaciones apropiadas para crear una oferta.
    </p>
@endif
