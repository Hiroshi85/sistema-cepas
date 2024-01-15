@props([
    'nomina' => null,
    'empleados' => null,
])

@php


    $empleados_options = $empleados->map(function ($empleado) {
        return (object) [
            'value' => $empleado->id,
            'label' => $empleado->nombre,
        ];
    });
@endphp


<form method="POST" action="{{ $nomina ? route('nominas.update', $nomina) : route('nominas.store') }}"
      class="flex flex-col md:grid md:grid-cols-2 gap-5">
    @csrf
    {{ $nomina ? method_field('PUT') : '' }}

    <x-input-group value="{{ $nomina ? $nomina->empleado_id : '' }}" label="Empleado" name="empleado_id" type="select"
                   required
                   :options="$empleados_options"/>
    <x-input-group value="{{ $nomina ? $nomina->fecha_inicio : '' }}" label="Inicio de Periodo"
                   name="fecha_inicio" type="date" required/>

    <x-input-group value="{{ $nomina ? $nomina->fecha_fin : '' }}" label="Fin de Periodo"
                   name="fecha_fin" type="date" required/>


    <x-input-group value="{{ $nomina ? $nomina->sueldo_basico : '' }}" label="Sueldo básico" name="sueldo_basico"
                   type="number"
                   placeholder="Ingrese el sueldo básico" readonly/>

    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>


</form>

@push('scripts')
    <script>
        const empleados = @json($empleados);
        const empleado_id = document.getElementById('empleado_id');
        const sueldo_basico = document.getElementById('sueldo_basico');

        empleado_id.addEventListener('change', (e) => {
            const empleadoId = e.target.value;
            const empleado = empleados.find((empleado) => empleado.id == empleadoId);
            sueldo_basico.value = empleado.remuneracion;
        });
    </script
@endpush
