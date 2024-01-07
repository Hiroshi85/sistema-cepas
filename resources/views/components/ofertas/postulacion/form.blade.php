@props(['oferta' => null, 'postulacion' => null, 'ofertadores' => []])
@php
    use Carbon\Carbon;
    if (!$postulacion) {
        $postulacion = $oferta->postulacion;
    }
@endphp
<form method="POST" action="{{ $oferta ? route('ofertas.update', $oferta) : route('ofertas.store') }}"
    class="flex flex-col md:grid md:grid-cols-2 gap-5">
    @csrf
    {{ $oferta ? method_field('PUT') : '' }}


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
                        {{ $postulacion->candidato->nombre }} -
                        {{ $postulacion->candidato->edad() }} años
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Puesto aplicado
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                        {{ $postulacion->plaza->puesto->nombre }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100 col-span-full mt-6">
        Información de Oferta
    </h3>



    <x-input-group value="{{ $oferta ? $oferta->fecha_inicio : '' }}" label="Fecha de Inicio de la Oferta"
        name="fecha_inicio" type="date" required>
    </x-input-group>
    <x-input-group value="{{ $oferta ? $oferta->fecha_fin : '' }}" label="Fecha Fin de la Oferta" name="fecha_fin"
        type="date" required>
    </x-input-group>
    <x-input-group value="{{ $oferta ? $oferta->salario : '' }}" label="Salario Ofrecido" name="salario" type="text"
        placeholder="Ingrese el salario ofrececido en (S/.)" required>
    </x-input-group>
    <x-input-group value="{{ $oferta ? $oferta->meses_contrato : '' }}"
        placeholder="Ingrese el tiempo de contrato en meses" label="Tiempo de contrato " name="meses_contrato"
        type="number" min="0" max="99" required>
    </x-input-group>
    <x-input-group value="{{ $oferta ? $oferta->contrato_fecha_inicio : '' }}" label="Fecha inicio de labores "
        name="contrato_fecha_inicio" type="date" required>
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
