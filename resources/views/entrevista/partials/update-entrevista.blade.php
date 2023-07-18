<x-modal-edit :id="$item->identrevista">
    <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-gray-800">
    <div
        class="flex  items-center justify-between  rounded-t-md border-b-2 border-gray-100 border-opacity-100 p-4 dark:border-opacity-50">
        <!--Modal title-->
        <span class="text-xl mx-auto uppercase">Actualizar entrevista</span>
        <!--Close button-->
        <button
        type="button"
        class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
        data-te-modal-dismiss
        aria-label="Close">
        <i class="fa-solid fa-x text-xl self-end"></i>
        </button>
    </div>
    <form  method="POST" action="{{ route('entrevista.update',$item->identrevista) }}">
        @method('PUT')
        @csrf
        <!--Modal body-->
        <div class="mx-4 my-2">
            <x-input-label for="postulante" :value="__('Postulante')" />
            <x-text-input id="postulante" class="block mt-1 w-full" type="text" name="postulante" disabled :value="$item->nombre_apellidos"/>
            
        </div>
        
        <div class="mx-4 mb-2">
            <x-input-label for="fecha" :value="__('Fecha')" />
            <x-text-input id="fecha" class="block mt-1 w-full" type="date" name="fecha" required autofocus :value="$item->fecha"/>
            <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
        </div>
        <div class="mx-4 mb-2">
            <x-input-label for="hora" :value="__('Hora')" />
            <x-text-input id="hora" class="block mt-1 w-full dark:text-white" type="time" name="hora" required autofocus :value="$item->hora"/>
            <x-input-error :messages="$errors->get('hora')" class="mt-2" />
        </div>
        <div class="mx-4 mb-2 flex">
            <div class="w-[50%] mr-2">
                <x-input-label class="px-2" for="estado" :value="__('Estado')" />
                <select name="estado" id="estado" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="Programada" @if ($item->estado == 'Programada')
                        {{"selected"}}
                    @endif>Programada</option>
                    <option value="Evaluada" @if ($item->estado == 'Evaluada')
                        {{"selected"}}
                    @endif>Evaluada</option>
                    <option value="Cancelada" @if ($item->estado == 'Cancelada')
                        {{"selected"}}
                    @endif>Cancelada</option>
                </select>
            </div>
            {{-- <div class="w-[50%]">
            <x-input-label for="estado" :value="__('Estado')" />
            <x-text-input id="estado" class="block mt-1 w-full dark:text-white" type="text" name="estado" required autofocus :value="$item->estado"/>
            <x-input-error :messages="$errors->get('estado')" class="mt-2" />
            </div> --}}
            <div class="w-[50%]">
                <x-input-label for="resultado" :value="__('Resultado')" />
                <x-text-input id="resultado" class="block mt-1 w-full dark:text-white" type="text" name="resultado" required autofocus :value="$item->resultado"/>
                <x-input-error :messages="$errors->get('resultado')" class="mt-2" />
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