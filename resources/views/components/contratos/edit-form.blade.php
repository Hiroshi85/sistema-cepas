@props(['contrato' => null])
@php
    $options_tipos_contratos = [
        (object) [
            'value' => 'tiempo completo',
            'label' => 'Tiempo Completo',
        ],
        (object) [
            'value' => 'tiempo parcial',
            'label' => 'Tiempo Parcial',
        ],
    ];
    
    $empleado = $contrato ? $contrato->empleado : null;
@endphp
@if ($contrato->estado() == 'finalizado')
    <p
        class="text-red-500 text-xs italic mt-4 bg-red-100 border border-red-400 rounded-sm px-4 py-3 dark:bg-red-900 dark:text-red-100 dark:border-red-900 my-5">
        El contrato ya finalizó, no se puede editar.
    </p>
@endif

<form method="POST" action="{{ $contrato ? route('contratos.update', $contrato) : route('contratos.store') }}"
    class="flex flex-col md:grid md:grid-cols-2 gap-5 {{ $contrato && $contrato->estado() == 'finalizado' ? 'pointer-events-none opacity-50' : '' }}">
    @csrf
    {{ $contrato ? method_field('PUT') : '' }}

    <input type="text" hidden name="empleado_id" value="{{ $empleado->id }}">
    <div class="flex flex-col col-span-full">
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">Información de
                Empleado</h3>
        </div>
        <div class="mt-6 border-t border-gray-100 dark:border-gray-800">
            <dl class="divide-y divide-gray-100 dark:divide-gray-800">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Nombre
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                        {{ $empleado->nombre }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Puesto
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                        {{ $empleado->puesto->nombre }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <x-input-group value="{{ $contrato ? $contrato->tipo_contrato : '' }}" label="Tipo de Contrato" name="tipo_contrato"
        type="select" :options="$options_tipos_contratos" required />
    <x-input-group value="{{ $contrato ? $contrato->fecha_inicio : '' }}" label="Inicio de Contrato" name="fecha_inicio"
        type="date" required />
    <x-input-group value="{{ $contrato ? $contrato->fecha_fin : '' }}" label="Fin de Contrato" name="fecha_fin"
        type="date" required />
    <x-input-group value="{{ $contrato ? $contrato->remuneracion : '' }}" label="Remuneración (mensual)"
        name="remuneracion" required placeholder="Ej: 1000.00" type="number" step="0.01" min="0"
        max="99999999999999999999" />
    <x-input-group value="{{ $contrato ? $contrato->descripcion : '' }}" label="Descripción" name="descripcion"
        required placeholder="Escriba la descripción del contrato" type="textarea" />


    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>


</form>
