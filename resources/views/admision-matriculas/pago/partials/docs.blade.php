<section class="overflow-hidden">
    <div class="text-center w-full relative">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('VOUCHERS DE PAGO') }}
            </h2>
        </header>
        <div class="hidden" id="myAlert">
            <x-alert></x-alert>
        </div>
    </div>

    <div class="my-2">
        <div class="pt-4 pr-4 text-gray-900 dark:text-gray-100 flex flex-row-reverse">
            <x-secondary-button
 
            type="button"
            data-te-collapse-init
            data-te-ripple-init
            data-te-ripple-color="light"
            data-te-target="#collapseExample"
            aria-expanded="false"
            aria-controls="collapseExample">
            <i class="fas fa-plus"></i>
          </x-secondary-button>

        </div>
        <div class="!visible hidden px-16" id="collapseExample" data-te-collapse-item>
            <form method="POST" action="{{ route('voucher.store') }}" enctype="multipart/form-data" name="frm_nuevo_voucher">
                @csrf
                <!-- Name -->
                <input type="hidden" name="idpago" value="{{$pago->idpago}}">
                <div class="flex flex-wrap">
                    <div class="flex flex-col md:flex-row w-full justify-center">
                        <div class="mt-4 grow basis-1/3 md:basis-1/8 px-2">
                            <x-input-label for="fecha_pago" :value="__('Fecha de pago')" />
                            <x-text-input id="fecha_pago" class="block mt-1 w-full" type="date" name="fecha_pago" required autofocus />
                            <x-input-error :messages="$errors->get('fecha_pago')" class="mt-2" />
                        </div>
                        <div class="mt-4 grow  basis-1/3 md:basis-1/16 px-2">
                            <x-input-label for="monto" :value="__('Monto pagado')" />
                            <x-text-input id="monto" class="block mt-1 w-full" type="text" name="monto" :value="old('monto')"  required autofocus />
                            <x-input-error :messages="$errors->get('monto')" class="mt-2" />
                        </div>
                        <div class="mt-4 grow  basis-1/3 md:basis-1/8 px-2">
                            <x-input-label for="codigo_operacion" :value="__('Código de operación')" />
                            <x-text-input id="codigo_operacion" class="block mt-1 w-full" type="text" name="codigo_operacion" required autofocus />
                            <x-input-error :messages="$errors->get('codigo_operacion')" class="mt-2" />
                        </div>
                    </div>
                   
                    <div class="my-4 w-full px-2 text-center flex flex-col items-center justify-center">
                        <x-input-label for="voucher" :value="__('Voucher')" />
                        <div class="flex items-center justify-center w-[500px]">
                            <label class="flex flex-col items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center">
                                    <div id="skeleton" class="flex flex-col items-center py-5">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Subir archivo</span></p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG o JPEG</p>
                                    </div>
                                    
                                    <img id="preview-image" class="max-w-[500px] max-h-[500px] text-gray-500 dark:text-gray-400 hidden" />
                                </div>
                               
                                <input id="voucher" name="voucher" type="file" class="hidden" onchange="previewImage(event)" accept=".png, .jpg, .jpeg"/>
                            </label>
                        </div> 
                        
                        <x-input-error :messages="$errors->get('voucher')" class="mt-2" />
                    </div>                                  
                </div>
                <div class="flex items-center justify-end m-4 px-4">
                    <x-primary-button class="ml-4">
                        {{ __('Registrar') }}
                    </x-primary-button>
                    <x-secondary-button  type="reset" class="mx-2" onclick="clearForm()"><i class="fa-solid fa-rotate"></i></x-secondary-button>
                </div>
                
            </form> 
        </div>
    </div>

    {{-- TABLE --}}

    <table class="min-w-full text-left text-sm font-light pb-16 text-center text-gray-900 dark:text-gray-100">
        <thead class="border-b font-medium dark:border-neutral-500 dark:bg-slate-900">
          <tr>
            <th scope="col" class="px-6 py-4">#</th>
            <th scope="col" class="px-6 py-4">Fecha de pago</th>
            <th scope="col" class="px-6 py-4">Monto</th>
            <th scope="col" class="px-6 py-4">Código de operación</th>
            <th scope="col" class="px-6 py-4">Voucher</th>
            <th scope="col" class="px-6 py-4">Estado</th>
            <th scope="col" class="px-6 py-4">Acciones</th>
          </tr>
        </thead>
        <tbody>
            @if (count($vouchers) == 0)
            <tr>
                <td colspan="2">
                    <h6 class="mt-4 mb-0 leading-normal text-size-sm dark:text-white">No hay registros</h6>
                </td>
            </tr>
            @else
            @php
                $i = 1
            @endphp
            @foreach ($vouchers as $item)
            <tr
            class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
                <td class="whitespace-nowrap px-6 py-4 font-medium">
                    {{$i++}}
                </td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->fecha_pago}}</td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->monto}}</td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->codigo_operacion}}</td>
                <td class="whitespace-nowrap px-6 py-4">
                    {{-- <img src="{{ asset($item->imagen) }}" alt="document"> --}}
                    @if ($item->voucher != null)
                        <x-primary-button
                            data-te-toggle="modal"
                            data-te-target="#ModalLg-{{$item->idvoucher}}"
                            data-te-ripple-init
                            data-te-ripple-color="light">
                            <i class="fa-solid fa-eye"></i>
                        </x-primary-button>
                    @else
                        {{"sin voucher"}}
                    @endif
                </td>
              
                <td class="whitespace-nowrap px-6 py-4 @switch($item->estado)
                    @case("Aceptado")
                        {{"text-green-500"}}
                        @break
                    @case("Pendiente")
                        {{"text-yellow-500"}}
                    @break
                    @case("Rechazado")
                        {{"text-red-500"}}
                        @break    
                    @endswitch
                ">{{$item->estado}}</td>

                <td class="whitespace-nowrap px-6 py-4">
                    <x-secondary-button
                    data-te-toggle="modal"
                    data-te-target="#modalEdit-{{$item->idvoucher}}"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    >
                    <i class="fas fa-edit"></i>
                </x-secondary-button>
                    @if(!Auth::user()->hasRole('apoderado'))                            
                    <x-danger-button
                        data-te-toggle="modal"
                        data-te-target="#exampleModalCenter-Doc{{$item->idvoucher}}"
                        data-te-ripple-init
                        data-te-ripple-color="light"
                    >
                        <i class="fas fa-trash"></i>
                    </x-danger-button>
                    @endif
                </td>
            </tr> 
            {{-- EDITAR --}}
            <x-modal-large :id="$item->idvoucher" :title="'Voucher de pago'">
                <img src="{{ asset($item->voucher) }}" alt="document" class="m-2 max-h-[80vh] mx-auto border dark:border-neutral-700">
            </x-modal-large>
            <x-modal-delete :id="$item->idvoucher" :entity="'Doc'" :route="'voucher.destroy'" :element="$item->fecha_pago.' S/.'.$item->monto"></x-modal-delete>
            @include('admision-matriculas.pago.partials.update-doc', ['item' => $item])
            {{-- ELIMINAR --}}
            
            
            @endforeach
            @endif
        </tbody>
      </table>
</section>

@push('scripts')
<script>
    function previewImage(event) {
        let skeleton = document.getElementById("skeleton");
        let preview = document.getElementById("preview-image");
        let  input = event.target;
        if (input.files && input.files[0]) {
            skeleton.classList.add('hidden');
            preview.classList.remove('hidden');

            let reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearForm(){
        let skeleton = document.getElementById("skeleton");
        let preview = document.getElementById("preview-image");
        preview.classList.add('hidden');
        skeleton.classList.remove('hidden');
    }
</script>
@endpush