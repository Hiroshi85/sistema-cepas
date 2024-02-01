@php
    $cur = null;
    if (isset($curso)) {
        $cur = $curso;
    }
@endphp

<form
    action="{{ $cur
        ? route('academia.cursos.edit', [
            'curso' => $cur,
        ])
        : route('academia.cursos.store') }}"
    class="flex flex-col gap-5" method="POST">
    @csrf
    @method('POST')
    <div class="flex flex-col gap-2">
        <x-input-group value="{{ $cur ? $cur->nombre : '' }}" label="Nombre del curso" name="nombre" type="text"
            required />

        <x-input-group value="{{ $cur ? $cur->descripcion : '' }}" label="Observaciones" name="descripcion"
            type="textarea" required placeholder="Descripcion..." />

        <div class="">
            <label for="none">Areas</label>
            <div class="flex gap-5">
                @foreach ($areas as $area)
                    <label class="flex items-center gap-1">
                        <input type="checkbox" name="areas[]" value="{{ $area->id }}" class="rounded-md text-blue-800">
                        <span></span>
                        {{ $area->nombre }}
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-span-2">
        <x-primary-button type="submit" class="bg-green-500 hover:bg-green-700">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>

</form>
