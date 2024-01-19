<x-modal
    name="edit-cicle"
    :show="$errors->any()"
>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Actualizar actual ciclo académico') }}
        </h2>
    </x-slot:header>

    @include('academia.partials.form', [
        'currCiclo' => $ciclo
     ])

</x-modal>
