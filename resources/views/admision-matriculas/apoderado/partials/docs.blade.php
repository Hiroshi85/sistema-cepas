<section class="overflow-hidden">
    <div class="text-center w-full relative">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('DOCUMENTOS') }}
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
            <form method="POST" action="{{ route('docsapoderado.store') }}" enctype="multipart/form-data" name="frm_nuevo_documento">
                @csrf
                <!-- Name -->
                <input type="hidden" name="idapoderado" value="{{$apoderado->idapoderado}}">
                <div class="flex flex-row flex-wrap">
                    <div class="mt-4 basis-1/2 px-2">
                        <x-input-label for="descripcion" :value="__('Descripción')" />
                        <x-text-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" required autofocus />
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>
                    <div class="mt-4 basis-1/2 px-2 h-[46px]">
                        <x-input-label for="imagen" :value="__('Imagen')" />
                        <input
                        class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] font-normal leading-[2.15] text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-gray-800 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-gray-800 focus:border-primary focus:text-gray-700 focus:shadow-te-primary focus:outline-none dark:border-gray-500 dark:text-neutral-200 dark:file:bg-gray-900 dark:file:text-neutral-100 dark:focus:border-primary"
                        id="imagen"
                        name="imagen"
                        type="file" required />
                        <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
                    </div>                                  
                </div>
                <div class="flex items-center justify-end mt-4 px-4">
                    <x-primary-button class="ml-4">
                        {{ __('Registrar') }}
                    </x-primary-button>
                    <x-secondary-button  type="reset" class="mx-2"><i class="fa-solid fa-rotate"></i></x-secondary-button>
                </div>
                
            </form> 
        </div>
    </div>

    {{-- TABLE --}}

    <table class="min-w-full text-left text-sm font-light pb-16 text-center text-gray-900 dark:text-gray-100">
        <thead class="border-b font-medium dark:border-neutral-500 dark:bg-slate-900">
          <tr>
            <th scope="col" class="px-6 py-4">#</th>
            <th scope="col" class="px-6 py-4">Descripción</th>
            <th scope="col" class="px-6 py-4">Imagen</th>
            <th scope="col" class="px-6 py-4">Fecha de registro</th>
            <th scope="col" class="px-6 py-4">Estado</th>
            <th scope="col" class="px-6 py-4">Acciones</th>
          </tr>
        </thead>
        <tbody>
            @if (count($documentos) == 0)
            <tr>
                <td colspan="2">
                    <h6 class="mt-4 mb-0 leading-normal text-size-sm dark:text-white">No hay registros</h6>
                </td>
            </tr>
            @else
            @php
                $i = 1
            @endphp
            @foreach ($documentos as $item)
            <tr
            class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
                <td class="whitespace-nowrap px-6 py-4 font-medium">
                    {{$i++}}
                </td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->descripcion}}</td>
                <td class="whitespace-nowrap px-6 py-4">
                    {{-- <img src="{{ asset($item->imagen) }}" alt="document"> --}}
                    @if ($item->imagen != null)
                        <x-primary-button
                            data-te-toggle="modal"
                            data-te-target="#ModalLg-{{$item->iddocumento}}"
                            data-te-ripple-init
                            data-te-ripple-color="light">
                            <i class="fa-solid fa-eye"></i>
                        </x-primary-button>
                    @else
                        {{"sin imagen"}}
                    @endif
                </td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->fecha_registro}}</td>
                
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
                    data-te-target="#modalEdit-{{$item->iddocumento}}"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    >
                    <i class="fas fa-edit"></i>
                </x-secondary-button>
                                                       
                    <x-danger-button
                        data-te-toggle="modal"
                        data-te-target="#exampleModalCenter-Doc{{$item->iddocumento}}"
                        data-te-ripple-init
                        data-te-ripple-color="light"
                    >
                        <i class="fas fa-trash"></i>
                    </x-danger-button>
                </td>
            </tr> 
            {{-- EDITAR --}}
            <x-modal-large :id="$item->iddocumento" :title="$item->descripcion">
                <img src="{{ asset($item->imagen) }}" alt="document" class="m-2 max-h-[80vh] mx-auto border dark:border-neutral-700">
            </x-modal-large>
            <x-modal-delete :id="$item->iddocumento" :entity="'Doc'" :route="'docsapoderado.destroy'" :element="$item->descripcion"></x-modal-delete>
            @include('admision-matriculas.apoderado.partials.update-doc', ['item' => $item])
            {{-- ELIMINAR --}}
            
            
            @endforeach
            @endif
        </tbody>
      </table>
</section>