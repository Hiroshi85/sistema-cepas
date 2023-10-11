{{-- Matrícula edit--}}
<x-modal-edit :id="$admision->idadmision" :entity="'Admision'">
    <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-gray-800">
    <div
        class="flex  items-center justify-between  rounded-t-md border-b-2 border-gray-100 border-opacity-100 p-4 dark:border-opacity-50">
        <!--Modal title-->
        <span class="text-xl mx-auto uppercase dark:text-white">Actualizar Admisión</span>
        <!--Close button-->
        <button
        type="button"
        class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
        data-te-modal-dismiss
        aria-label="Close">
        <i class="fa-solid fa-x text-xl self-end"></i>
        </button>
    </div>
    <form  method="POST" action="{{ route('admision.update',$admision->idadmision) }}">
        @method('PUT')
        @csrf
        <!--Modal body-->
        {{-- <div class="mx-4 my-2">
            <x-input-label for="año" :value="__('Año')" />
            <x-text-input id="año" class="block mt-1 w-full" type="text" name="año" :value="$admision->año"/>
            
        </div> --}}
        
        <div class="mx-4 mb-2 flex gap-2">
            <div class="w-[50%]">
                <x-input-label for="fecha_apertura" :value="__('Fecha de apertura')" />
                <x-text-input id="fecha_apertura" class="block mt-1 w-full" type="date" name="fecha_apertura" required autofocus :value="$admision->fecha_apertura"/>
                <x-input-error :messages="$errors->get('fecha_apertura')" class="mt-2" />
            </div>
            <div class="w-[50%]">
                <x-input-label for="fecha_cierre" :value="__('Fecha de cierre')" />
                <x-text-input id="fecha_cierre" class="block mt-1 w-full" type="date" name="fecha_cierre" required autofocus :value="$admision->fecha_cierre"/>
                <x-input-error :messages="$errors->get('fecha_cierre')" class="mt-2" />
            </div>   
        </div>
        
        <div class="mx-4 mb-2 flex gap-2">
            <div class="w-[50%]">
                <x-input-label for="tarifa" :value="__('Tarifa')" />
                <x-text-input id="tarifa" class="block mt-1 w-full dark:text-white" type="text" name="tarifa" required autofocus :value="$admision->tarifa"/>
                <x-input-error :messages="$errors->get('tarifa')" class="mt-2" />
                </div>
            <div class="w-[50%]">
                <x-input-label for="estado" :value="__('Estado')" class="mb-1"/>
                {{-- <x-text-input id="estado" class="block mt-1 w-full dark:text-white" type="text" name="estado" required autofocus :value="$admision->estado"/> --}}
                    <select name="estado" id="estado" data-te-select-init>
                        <option 
                            @if ($admision->estado == "Aperturada")
                                selected
                            @endif
                            value="Aperturada">Aperturada
                        </option>
                            <option 
                                @if ($admision->estado == "Cerrada")
                                    selected
                                @endif
                                value="Cerrada">Cerrada
                            </option>
                    </select>    
                <x-input-error :messages="$errors->get('estado')" class="mt-2" />
            </div>
        </div>
        
        <!--Modal footer-->
            <div
            class="gap-2 flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md p-4 dark:border-opacity-50">
            <x-secondary-button
                data-te-modal-dismiss
                data-te-ripple-init
                data-te-ripple-color="light">
                Cancelar
            </x-secondary-button>
            
                
                <x-primary-button
                    data-te-ripple-init
                    data-te-ripple-color="light">
                    Actualizar
                </x-primary-button>
    </form>
    </div>
    </div>
</x-modal-edit>
