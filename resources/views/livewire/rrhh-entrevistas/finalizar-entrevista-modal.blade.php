@php
    $options = [
        (object) [
            'value' => 'aprobada',
            'label' => 'Aprobado',
        ],
        (object) [
            'value' => 'rechazada',
            'label' => 'Rechazado',
        ],
    ];
@endphp

<div>
    <button wire:click="$set('modalOpen', true)"
        class="bg-indigo-700 hover:bg-indigo-800 ease-in-out text-white py-2 px-5 rounded-sm">Finalizar
        Entrevista</button>

    @if ($modalOpen)
        <x-modal width="md" name="finalizar-entrevista-modal" :show="true">
            <form method="post" action="{{ route('rrhh.entrevistas.finalizarEntrevista', $entrevista->id) }}">
                @csrf
                @method('put')
                <div class="relative w-full h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" @click="show = false" wire:click="$set('modalOpen', false)"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                            @livewire('icons.x')
                        </button>
                        <div class="p-6 flex flex-col gap-5">
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                Finalizar Entrevista
                            </h3>
                            <x-input-group name='observaciones' label='Observaciones'
                                placeholder='Ingrese las observaciones' type='textarea'></x-input-group>
                            <x-input-group name='estado' label='Decisión' type='select' :options="$options">
                            </x-input-group>
                            <div class="flex-gap-3">

                                <x-danger-button type="submit">
                                    Guardar
                                </x-danger-button>
                                <x-secondary-button type="button" @click="show = false"
                                    wire:click="$set('modalOpen', false)">
                                    Cancelar
                                </x-secondary-button>
                            </div>
                        </div>
                    </div>
                </div>
        </x-modal>
    @endif

</div>
