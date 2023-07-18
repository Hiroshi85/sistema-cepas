<x-modal-edit :id="$item->iddocumento">
    <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-gray-800">
    <div
        class="flex  items-center justify-between  rounded-t-md border-b-2 border-gray-100 border-opacity-100 p-4 dark:border-opacity-50">
        <!--Modal title-->
        <span class="text-xl mx-auto uppercase dark:text-white">Actualizar documento</span>
        <!--Close button-->
        <button
        type="button"
        class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
        data-te-modal-dismiss
        aria-label="Close">
        <i class="dark:text-white fa-solid fa-x text-xl self-end"></i>
        </button>
    </div>
    <form  method="POST" action="{{ route('docsapoderado.update',$item->iddocumento) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <!--Modal body-->
        
            <div class="mt-4 w-full px-2">
                <x-input-label for="descripcion" :value="__('Descripción')" />
                <x-text-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" :value="old('nombre_apellidos', $item->descripcion)" required autofocus/>
                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
            </div>

            <div class="mt-5 w-full px-2 h-[46px]">
                <x-input-label class="px-2" for="estado" :value="__('Estado')" />
                <select 
                    name="estado" id="estado" 
                    @if(Auth::user()->hasRole('apoderado')) disabled @endif
                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="Registrado" @if ($item->estado == 'Registrado')
                        {{"selected"}}
                    @endif>Registrado</option>
                    <option value="Observado" @if ($item->estado == 'Observado')
                        {{"selected"}}
                    @endif>Observado</option>
                    <option value="Verificado" @if ($item->estado == 'Verificado')
                        {{"selected"}}
                    @endif>Verificado</option>
                </select>
            </div>           

      
       
        <x-input-label class="px-4 mt-6" for="imagen" :value="__('Imagen')" />
        <img src="{{ asset($item->imagen) }}" alt="document" class="m-2 w-[90%] mx-auto border dark:border-neutral-700">
        <div class="mt-4 basis-1 px-2 h-[46px]">
            <input
            class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] font-normal leading-[2.15] text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-gray-800 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-gray-800 focus:border-primary focus:text-gray-700 focus:shadow-te-primary focus:outline-none dark:border-gray-500 dark:text-neutral-200 dark:file:bg-gray-900 dark:file:text-neutral-100 dark:focus:border-primary"
            id="imagen"
            name="imagen"
            type="file" />
            <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
        </div>       
        <div class="mt-4 basis-1 px-2">
            <x-input-label for="observacion" :value="__('Observación')" />
            <textarea 
                name="observacion" id="observacion" 
                @if(Auth::user()->hasRole('apoderado')) disabled @endif
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="2">{{$item->observacion}}</textarea>    
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