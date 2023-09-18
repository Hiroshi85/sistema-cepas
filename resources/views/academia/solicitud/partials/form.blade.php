
@php
    $sol = null;
    if (isset($solicitud)) {
        $sol = $solicitud;
    }
@endphp


<form method="POST" action="{{ $sol ? route('solicitud.update', $sol) : route('solicitud.store') }}"
    class="flex flex-col gap-5">
    @csrf
    {{ $sol ? method_field('PUT') : '' }}

    <div class="flex flex-col gap-2">
        <label for="alumno" class='block font-medium text-sm text-gray-700 dark:text-gray-200'>
            Selecciona un alumno
        </label>
        <select id="idalumno" name="idalumno" data-te-select-init data-te-select-filter="true" data-te-select-option-height="52" required>
            @foreach ($alumnos as $alumno)
                <option value="{{$alumno->idalumno}}" data-te-select-secondary-text="{{$alumno->dni}}">{{$alumno->nombre_apellidos}}</option>
            @endforeach                                    
        </select>
    </div>

    <x-input-group value="{{ $sol ? $solicitud->fecha_solicitud : '' }}" label="Fecha de Solicitud"
        name="fecha_solicitud" type="date" required value="{{date('Y-m-d')}}"/>

    <x-input-group value="{{ $sol ? $solicitud->observaciones : '' }}" label="Observaciones" name="observaciones" type="textarea" required
        placeholder="Observaciones..." />

    <div class="flex flex-col gap-2">
        <label for="alumno" class='block font-medium text-sm text-gray-700 dark:text-gray-200'>
            Selecciona la carrera deseada
        </label>
        <select id="idcarrera" name="idcarrera" data-te-select-init data-te-select-filter="true" data-te-select-option-height="52" required>
            @foreach ($carreras as $carrera)
                <option value="{{$carrera->id}}" data-te-select-secondary-text="{{strtoupper($carrera->facultad->nombre).' - Area '.$carrera->area->nombre}}">{{ucfirst($carrera->nombre)}}</option>
            @endforeach                                    
        </select>
    </div>

    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>


</form>