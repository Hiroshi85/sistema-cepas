<article>
    <h1 class="p-2 mb-6 uppercase font-bold text-xl dark:text-gray-100 text-center">
        {{$selectedNotification->data['type']}} por {{$selectedNotification->data['from']['name']}}
    </h1>
    
     <form  class="flex flex-col md:flex-row flex-wrap" method="POST" action="{{ route('voucher.update',$voucher->idvoucher) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <!--Modal body-->
            <div class="flex flex-col w-full p-4 md:basis-1/2">
                <label for="voucher">
                    <img id="preview-image" src="{{ asset($selectedNotification->data['voucher']['voucher']) }}" alt="document" class="mx-auto border dark:border-neutral-700 min-w-[40vh] max-w-[50%] md:max-w-[50%] h-auto">      
                </label>
              
                <div class="mt-4 basis-1 px-2 h-[40px]">
                    <x-text-input
                    class="m-0 w-nfull min-w-0 flex-auto cursor-pointer rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] font-normal leading-[2.15] text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-gray-200 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-gray-300 focus:border-primary focus:text-gray-700 focus:shadow-te-primary focus:outline-none dark:border-gray-500 dark:text-neutral-200 dark:file:bg-gray-800 dark:file:text-neutral-100 dark:focus:border-primary"
                    id="voucher"
                    name="voucher"
                    onchange="previewImage(event)"
                    type="file" />
                    <x-input-error :messages="$errors->get('voucher')" class="mt-2" />
                </div>
            </div>
            <div class="grow pb-12 md:basis-1/2">
                <div class="w-full flex">
                    <div class="mt-4 w-[50%] px-2">
                        <x-input-label for="fecha_pago" :value="__('Fecha de pago')" />
                        <x-text-input id="fecha_pago" class="block mt-1 w-full" type="date" name="fecha_pago" :value="$voucher->fecha_pago" required autofocus/>
                        <x-input-error :messages="$errors->get('fecha_pago')" class="mt-2" />
                    </div>
                    <div class="mt-4 w-[50%] px-2">
                        <x-input-label for="monto_update" :value="__('Monto')" />
                        <x-text-input id="monto_update" class="block mt-1 w-full" type="text" name="monto_update" :value="old('monto_update',$voucher->monto)" required autofocus/>
                        <x-input-error :messages="$errors->get('monto_update')" class="mt-2" />
                    </div>
                </div>
        
                <div class="w-full flex">
                    <div class="mt-4 w-[50%] px-2">
                        <x-input-label for="codigo_operacion" :value="__('Código de operación')" />
                        <x-text-input id="codigo_operacion" class="block mt-1 w-full" type="text" name="codigo_operacion" :value="$voucher->codigo_operacion" required autofocus/>
                        <x-input-error :messages="$errors->get('codigo_operacion')" class="mt-2" />
                    </div>
                    <div class="mt-5 w-[50%] px-2 h-[46px]">
                        <x-input-label class="px-2" for="estado" :value="__('Estado')" />
                        <select name="estado" id="estado" 
                        @if (Auth::user()->hasRole('apoderado'))
                            disabled
                        @endif
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="Registrado" @if ($voucher->estado == 'Registrado')
                                {{"selected"}}
                            @endif>Registrado</option>
                            <option value="Observado" @if ($voucher->estado == 'Observado')
                                {{"selected"}}
                            @endif>Observado</option>
                            <option value="Verificado" @if ($voucher->estado == 'Verificado')
                                {{"selected"}}
                            @endif>Verificado</option>
                        </select>
                    </div>           
                </div>      
            
            
            <div class="w-full mt-4 px-2">
                <x-input-label for="idmetodopago" :value="__('Medio de pago')" />
                <select class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="metodopago_update" id="metpago_update">
                    <optgroup label="Cuenta corriente">
                        @foreach ($metodos->where('tipo', "Cuenta corriente") as $method)
                            <option value="{{$method->idmetodopago}}" @if($voucher->metodo_pago == $method->idmetodopago) selected @endif>{{$method->metodo}}</option>
                        @endforeach 
                    </optgroup>
                    <optgroup label="Cuenta interbancaria">
                        @foreach ($metodos->where('tipo', 'Cuenta interbancaria') as $method)
                            <option value="{{$method->idmetodopago}}" @if($voucher->metodo_pago == $method->idmetodopago) selected @endif>{{$method->metodo}}</option>
                        @endforeach 
                    </optgroup>  
                    <optgroup label="Cuenta de ahorros">
                        @foreach ($metodos->where('tipo', 'Cuenta de ahorros') as $method)
                            <option value="{{$method->idmetodopago}}" @if($voucher->metodo_pago == $method->idmetodopago) selected @endif>{{$method->metodo}}</option>
    
                        @endforeach
                    </optgroup>
                    <optgroup label="Otro">
                        @foreach ($metodos->where('tipo', null) as $method)
                            <option value="{{$method->idmetodopago}}" @if($voucher->metodo_pago == $method->idmetodopago) selected @endif>{{$method->metodo}}</option>
                        @endforeach   
                    </optgroup>
                </select>
                <x-input-error :messages="$errors->get('metpago')" class="mt-2" />
            </div> 
            <div class="mt-4 basis-1 px-2">
                <x-input-label for="observacion" :value="__('Observación')" />
                <textarea 
                    @if (Auth::user()->hasRole('apoderado'))
                        disabled
                    @endif
                    name="observacion" id="observacion" 
                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm max-h-[200px] min-h-[50px]" rows="2">{{$voucher->observacion}}</textarea>    
                    <x-input-error :messages="$errors->get('observacion')" class="mt-2" />    
            </div>
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
            </div>
        </div>
    </form>
</article>
@push('scripts')
<script>
    function previewImage(event) {
        let preview = document.getElementById("preview-image");
        let  input = event.target;
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush