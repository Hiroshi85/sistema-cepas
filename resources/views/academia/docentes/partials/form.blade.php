
@php
    $doc = null;
    if (isset($docente)) {
        $sol = $docente;
    }
@endphp

<form
    action="{{route('academia.docente.update', [
        'docente' => $docente
    ])}}"
    class="flex flex-col gap-5"
    method="POST"
>
    @csrf
    @method('PUT')
    <div class="flex flex-col gap-2">
        <label for="alumno" class='block font-medium text-sm text-gray-700 dark:text-gray-200'>
            Selecciona la especialidad
        </label>
        <select id="idcarrera" name="idcarrera" data-te-select-init data-te-select-filter="true" data-te-select-option-height="52" required>
            @foreach ($carreras as $carrera)
                <option {{ $docente->especialidad_id ? ($docente->especialidad_id == $carrera->id ? "selected" : "") : "" }}
                    value="{{$carrera->id}}"
                    data-te-select-secondary-text="{{strtoupper($carrera->facultad->nombre).' - Area '.$carrera->area->nombre}}">
                    {{ucfirst($carrera->nombre)}}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>

</form>
