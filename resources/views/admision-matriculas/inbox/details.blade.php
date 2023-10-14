<section class="w-full h-full">
    <div class="px-4 pt-4">
        <div class="border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
         <form  method="POST" action="{{ route('voucher.update',$selectedNotification->data['voucher']['idvoucher']) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!--Modal body-->
                <div class="w-full flex">
                    <div class="mt-4 w-[50%] px-2">
                        <x-input-label for="fecha_pago" :value="__('Fecha de pago')" />
                        <x-text-input id="fecha_pago" class="block mt-1 w-full" type="date" name="fecha_pago" :value="$selectedNotification->fecha_pago" required autofocus/>
                        <x-input-error :messages="$errors->get('fecha_pago')" class="mt-2" />
                    </div>
                    <div class="mt-4 w-[50%] px-2">
                        <x-input-label for="monto_update" :value="__('Monto')" />
                        <x-text-input id="monto_update" class="block mt-1 w-full" type="text" name="monto_update" :value="old('monto_update',$selectedNotification->monto)" required autofocus/>
                        <x-input-error :messages="$errors->get('monto_update')" class="mt-2" />
                    </div>
                </div>
           
                <div class="w-full flex">
                    <div class="mt-4 w-[50%] px-2">
                        <x-input-label for="codigo_operacion" :value="__('Código de operación')" />
                        <x-text-input id="codigo_operacion" class="block mt-1 w-full" type="text" name="codigo_operacion" :value="$selectedNotification->codigo_operacion" required autofocus/>
                        <x-input-error :messages="$errors->get('codigo_operacion')" class="mt-2" />
                    </div>
                    <div class="mt-5 w-[50%] px-2 h-[46px]">
                        <x-input-label class="px-2" for="estado" :value="__('Estado')" />
                        <select name="estado" id="estado" 
                        @if (Auth::user()->hasRole('apoderado'))
                            disabled
                        @endif
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="Registrado" @if ($selectedNotification->estado == 'Registrado')
                                {{"selected"}}
                            @endif>Registrado</option>
                            <option value="Observado" @if ($selectedNotification->estado == 'Observado')
                                {{"selected"}}
                            @endif>Observado</option>
                            <option value="Verificado" @if ($selectedNotification->estado == 'Verificado')
                                {{"selected"}}
                            @endif>Verificado</option>
                        </select>
                    </div>           
                </div>      
           
            <x-input-label class="px-4 mt-6" for="voucher" :value="__('Voucher')" />
            <img src="{{ asset($selectedNotification->data['voucher']['voucher']) }}" alt="document" class="m-2 w-[90%] max-w-[200px] mx-auto border dark:border-neutral-700">
            
            <div class="w-full mt-4 px-2">
                <x-input-label for="idmetodopago" :value="__('Medio de pago')" />
               <x-text-input id="metpago" class="block mt-1 w-full" type="text" name="metpago" :value="$selectedNotification->data['voucher']['metodo_pago']" required autofocus></x-text-input>
                <x-input-error :messages="$errors->get('metpago')" class="mt-2" />
            </div> 
            <div class="mt-4 basis-1 px-2">
                <x-input-label for="observacion" :value="__('Observación')" />
                <textarea 
                    @if (Auth::user()->hasRole('apoderado'))
                        disabled
                    @endif
                    name="observacion" id="observacion" 
                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="2">{{$selectedNotification->observacion}}</textarea>    
                    <x-input-error :messages="$errors->get('observacion')" class="mt-2" />    
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
     </div>
</section>
