<section class="overflow-hidden overflow-x-auto">
    <div class="text-center w-full relative">
        <div class="hidden" id="myAlert">
            <x-alert></x-alert>
        </div>
    </div>
    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('secretario(a)'))
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
        <div class="!visible hidden px-16 flex" id="collapseExample" data-te-collapse-item>
            <form method="POST" action="{{ route('parentesco.store') }}" class="w-full">
                @csrf
                <!-- Name -->
                <div class="flex w-full">
                    <input type="hidden" name="idpostul" value="{{$postulante->idpostulante}}">
                    <div class="mt-4 px-1 grow">
                        <x-input-label for="apoderados" class="text-lg font-semibold"  :value="__('Seleccione apoderado')" />
                        <select id="idapoderado" name="idapoderado" data-te-select-init data-te-select-filter="true" data-te-select-option-height="52" required>
                            @foreach ($apoderados as $item)
                                <option value="{{$item->idapoderado}}" data-te-select-secondary-text="{{$item->dni}}">{{$item->nombre_apellidos}}</option>
                            @endforeach                                    
                        </select>
                    </div>
                    <div class="mt-4 px-2 grow">
                        <x-input-label for="parentesco" :value="__('Parentesco')" />
                        <x-text-input id="parentesco" class="block mt-1 w-full" type="text" name="parentesco" required autofocus />
                        <x-input-error :messages="$errors->get('parentesco')" class="mt-2" />
                    </div>
                    <div class="mt-4 px-2 self-center text-center">
                        <x-input-label for="convivencia" :value="__('¿Convive?')" />
                        <x-input-check id="convivencia" name="convivencia"/>
                        <x-input-error :messages="$errors->get('parentesco')" class="mt-2" />
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
    @endif

    {{-- TABLE --}}
    @if (count($parentescos) > 0)
    <table class="min-w-full text-left text-sm font-light pb-16 text-center text-gray-900 dark:text-gray-100">
        <thead class="border-b font-medium dark:border-neutral-500 dark:bg-slate-900">
          <tr>
            <th scope="col" class="px-6 py-4">#</th>
            <th scope="col" class="px-6 py-4">Apoderado</th>
            <th scope="col" class="px-6 py-4">Parentesco</th>
            <th scope="col" class="px-6 py-4">Convivencia</th>
            <th scope="col" class="px-6 py-4">Acciones</th>
          </tr>
        </thead>
        <tbody>
            @php
                $i = 1
            @endphp
            @foreach ($parentescos as $item)
            <tr
            class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
                <td class="whitespace-nowrap px-6 py-4 font-medium">
                    {{$i++}}
                </td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->nombre_apellidos}}</td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->parentesco}}</td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->convivencia}}</td>
                <td class="whitespace-nowrap px-6 py-4">
                    <x-secondary-button
                    data-te-toggle="modal"
                    data-te-target="#modalEdit-PA{{$item->idapoderado}}{{$item->idpostulante}}"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    >
                    <i class="fas fa-edit"></i>
                </x-secondary-button>
                                                       
                    <x-danger-button
                        data-te-toggle="modal"
                        data-te-target="#exampleModalCenter-Parent{{$item->idapoderado}}"
                        data-te-ripple-init
                        data-te-ripple-color="light"
                    >
                        <i class="fas fa-trash"></i>
                    </x-danger-button>
                </td>
            </tr> 
            {{-- EDITAR --}}
            
            <x-modal-delete :id="$item->idapoderado" :ids="$item->idpostulante" :entity="'Parent'" :route="'parentesco.destroy'" :element="$item->nombre_apellidos"></x-modal-delete>
            @include('admision-matriculas.parentesco.partials.update', ['item' => $item, 'postulante' => $postulante, 'entity' => 'PA'])
            {{-- ELIMINAR --}}
            
            
            @endforeach
          
        </tbody>
      </table>

      @else
      <div class="m-2">
       <h2 class="text-xs dark:text-white">No se encontraron registros de relación de parentesco</h2>
      </div>
  @endif
</section>