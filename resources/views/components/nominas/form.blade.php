@props([
    'nomina' => null,
    'empleados' => null,
    'tipos_descuento' => null,
    'tipos_prestacion' => null,
    'periodos' => [],
])

@php

    $empleados_options = $empleados->map(function ($empleado) {
        return (object) [
            'value' => $empleado->id,
            'label' => $empleado->nombre,
        ];
    });

    $periodos_options = [];
    foreach ($periodos as $periodo) {
        $periodos_options[] = (object) [
            'value' => $periodo['id'],
            'label' => $periodo['nombre'],
        ];
    }


@endphp


<form method="POST" action="{{ $nomina ? route('nominas.update', $nomina) : route('nominas.store') }}"
      class="flex flex-col md:grid md:grid-cols-2 gap-5">
    @csrf
    {{ $nomina ? method_field('PUT') : '' }}

    <x-input-group value="{{ $nomina ? $nomina->empleado_id : '' }}" label="Empleado" name="empleado_id" type="select"
                   required
                   :options="$empleados_options"/>

    <x-input-group
        class="hidden"
        value="{{ $nomina ? $nomina->fecha_inicio : '' }}" label="Inicio de Periodo"
        name="fecha_inicio" type="date" required/>

    <x-input-group
        class="hidden"
        value="{{ $nomina ? $nomina->fecha_fin : '' }}" label="Fin de Periodo"
        name="fecha_fin" type="date" required/>

    <x-input-group label="Periodo"
                   type="select"
                   name="periodo"
                   :options="$periodos_options"
                   required
    />


    <x-input-group value="{{ $nomina ? $nomina->sueldo_basico : '' }}" label="Sueldo básico" name="sueldo_basico"
                   type="number"
                   placeholder="Ingrese el sueldo básico" readonly/>

    <x-input-group value="{{ $nomina ? $nomina->dias_trabajados : '' }}" label="Días trabajados"
                   name="dias_trabajados" type="number"
                   max="30" min="0"
                   placeholder="Ingrese los días trabajados" required/>

    {{-- PRESTACIONES --}}
    <div
        id="prestaciones-group" class="hidden col-span-1 col-start-1 "
    >
        <h2 class="text-md mb-2 ">Prestaciones</h2>

        @livewire('nominas.prestaciones-multi-input', [
        'prestaciones' => $nomina ? $nomina->prestaciones : [],
        'tipos_prestacion' => $tipos_prestacion,
        ])
    </div>
    {{-- DESCUENTOS --}}
    <div
        id="descuentos-group" class="hidden col-span-1 "
    >
        <h2 class="text-md mb-2 ">Descuentos</h2>

        @livewire('nominas.descuentos-multi-input', [
        'descuentos' => $nomina ? $nomina->descuentos : [],
        'tipos_descuento' => $tipos_descuento,
        ])
    </div>


    <div>
        @error('prestaciones')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>
    <div>
        @error('descuentos')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>

    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>


</form>

@push('scripts')
    <script>
        const empleados = @json($empleados);
        const periodos = @json($periodos);
        const empleado_id = document.getElementById('empleado_id');
        let empleado_id_value = null;

        const sueldo_basico = document.getElementById('sueldo_basico');

        const fecha_inicio = document.getElementById('fecha_inicio');
        const fecha_fin = document.getElementById('fecha_fin');

        const periodo = document.getElementById('periodo');

        const prestaciones_group = document.getElementById('prestaciones-group');

        const descuentos_group = document.getElementById('descuentos-group');

        empleado_id.addEventListener('change', (e) => {
            const empleadoId = e.target.value;
            const empleado = empleados.find((empleado) => empleado.id == empleadoId);
            sueldo_basico.value = empleado.remuneracion;
            Livewire.emit('empleadoSelected', empleadoId);
            empleado_id_value = empleadoId;

            showPrestacionesGroup();
            showDescuentosGroup();
        });

        periodo.addEventListener('change', (e) => {
            const periodoId = e.target.value;
            const periodo = periodos.find((periodo) => periodo.id == periodoId);
            fecha_inicio.value = periodo.fecha_inicio;
            fecha_fin.value = periodo.fecha_fin;

            Livewire.emit('mesSelected', periodo.mes);

            showPrestacionesGroup();
            showDescuentosGroup();
        });


        const showPrestacionesGroup = () => {
            if (empleado_id_value && periodo.value) {
                prestaciones_group.classList.remove('hidden');
            } else {
                prestaciones_group.classList.add('hidden');
            }
        }

        const showDescuentosGroup = () => {
            if (empleado_id_value && periodo.value) {
                descuentos_group.classList.remove('hidden');
            } else {
                descuentos_group.classList.add('hidden');
            }
        }


    </script
@endpush
