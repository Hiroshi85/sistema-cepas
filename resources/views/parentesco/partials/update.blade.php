<x-modal-edit :id="$item->idapoderado" :ids="$item->idpostulante" :entity="$entity">
    <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-gray-800">
    <div
        class="flex  items-center justify-between  rounded-t-md border-b-2 border-gray-100 border-opacity-100 p-4 dark:border-opacity-50">
        <!--Modal title-->
        <span class="text-xl mx-auto uppercase dark:text-white">Actualizar relación de apoderado</span>
        <!--Close button-->
        <button
        type="button"
        class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
        data-te-modal-dismiss
        aria-label="Close">
        <i class="dark:text-white fa-solid fa-x text-xl self-end"></i>
        </button>
    </div>
    <form  method="POST" action="{{ route('parentesco.update',$item->idapoderado) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <!--Modal body-->
        <input type="hidden" name="idpostul" value="{{$item->idpostulante}}">
        <div class="flex">
            <div class="mt-4 pl-2 grow basis-1/2">
                <x-input-label for="apoderados" class="text-lg font-semibold"  :value="__('Apoderado')" />
                <x-text-input :value="isset($postulante) ? $item->nombre_apellidos : $apoderado->nombre_apellidos" disabled></x-text-input>
            </div>
            <div class="mt-4 pr-2 grow basis-1/2">
                <x-input-label for="postulante" class="text-lg font-semibold"  :value="__('Postulante')" />
                <x-text-input :value="isset($postulante) ? $postulante->nombre_apellidos : $item->nombre_apellidos" disabled></x-text-input>
            </div>
        </div>
        <div class="flex">
            <div class="mt-4 px-2 grow">
                <x-input-label for="parentesco" :value="__('Parentesco')" />
                <x-text-input id="parentesco" class="block mt-1 w-full" type="text" name="parentesco" :value="$item->parentesco" required autofocus />
                <x-input-error :messages="$errors->get('parentesco')" class="mt-2" />
            </div>
            <div class="mt-4 px-2 self-center text-center">
                <x-input-label for="convivencia" :value="__('¿Convive?')" />
                <input name="convivencia" id="convivencia" type="checkbox"
                @if($item->convivencia == 'si') checked @endif 
                class="px-2 rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                >
                <x-input-error :messages="$errors->get('convivencia')" class="mt-2" />
            </div>
        </div>
        
             
        <!--Modal footer-->
        <div
        class="gap-2 mt-4 flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md p-4 dark:border-opacity-50">
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

</x-modal-edit>