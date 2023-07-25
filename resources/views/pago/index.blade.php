<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pagos') }}
        </h2>
    </x-slot>
    
    {{-- CRUD for pagos --}}
    <div class="py-12">
        <div class="hidden" id="myAlert">
            <x-alert></x-alert>
        </div>
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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
                    <form method="POST" action="{{ route('pago.store') }}" id="frm_nuevo_pago" name="frm_nuevo_pago">
                        @csrf
                        <!-- Name -->
                        <div class="flex flex-row flex-wrap">
                            @if(!Auth::user()->hasRole('apoderado'))
                            <div class="mt-4 md:basis-1/4 px-2">
                                <x-input-label class="mb-2" for="idapoderado" :value="__('Apoderado')" />
                                <select data-te-select-init data-te-select-filter="true" data-te-select-option-height="52" name="idapoderado" id="idapoderado">
                                    @foreach ($apoderados as $item)
                                        <option value="{{$item->idapoderado}}" data-te-select-secondary-text="{{$item->dni}}">{{$item->nombre_apellidos}}</option>
                                    @endforeach     
                                </select>
                                <x-input-error :messages="$errors->get('idapoderado')" class="mt-2" />
                            </div>
                            @endif

                            <div class="mt-4 md:basis-1/3 px-2">
                                <x-input-label for="concepto" :value="__('Concepto')" />
                                <x-text-input id="concepto" class="block mt-1 w-full" type="text" name="concepto" required autofocus />
                                <x-input-error :messages="$errors->get('concepto')" class="mt-2" />
                            </div>
                           <div class="mt-4 md:basis-1/16 px-2">
                                <x-input-label for="monto" :value="__('Monto')" />
                                <x-text-input id="monto" class="block mt-1 w-full" type="text" name="monto" required autofocus />
                                <x-input-error :messages="$errors->get('monto')" class="mt-2" />
                           </div>
                            <div class="mt-4 md:basis-1/4 px-2">
                                <x-input-label for="fecha_vencimiento" :value="__('Fecha de vencimiento')" />
                                <x-text-input id="fecha_vencimiento" class="block mt-1 w-full" type="date" name="fecha_vencimiento" required autofocus />
                                <x-input-error :messages="$errors->get('fecha_vencimiento')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4 px-4">
                            <x-primary-button class="ml-4">
                                {{ __('Registrar') }}
                            </x-primary-button>
                            <x-secondary-button type="reset" class="mx-2"><i class="fa-solid fa-rotate"></i></x-secondary-button>
                        </div>
                        
                    </form> 
                </div>
                <div class="text-gray-900 dark:text-gray-100">
                 
                    <div class="flex flex-col px-5">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                              <table class="min-w-full text-left text-sm font-light pb-16">
                                <thead class="border-b font-medium dark:border-neutral-500 dark:bg-slate-900">
                                  <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Apoderado</th>
                                    <th scope="col" class="px-6 py-4">Concepto</th>
                                    <th scope="col" class="px-6 py-4">Monto S/.</th>
                                    <th scope="col" class="px-6 py-4">Fecha de vencimiento</th>
                                    <th scope="col" class="px-6 py-4">Estado</th>
                                    <th scope="col" class="px-6 py-4">Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if (count($pagos) == 0)
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="mb-0 leading-normal text-size-sm dark:text-white">No hay registros</h6>
                                        </td>
                                    </tr>
                                    @else
                                    @php
                                        $i = 1
                                    @endphp
                                    @foreach ($pagos as $item)
                                    <tr
                                    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                            {{$i++}}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->nombre_apellidos}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->concepto}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->monto}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->fecha_vencimiento}}</td>     
                                        
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->estado}}</td>
                                 
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <a href="{{ route('pago.edit', $item->idpago)}}"><x-secondary-button><i class="fas fa-edit"></i></x-secondary-button></a>
                                            @if(!Auth::user()->hasRole('apoderado'))
                                            <x-danger-button
                                                data-te-toggle="modal"
                                                data-te-target="#exampleModalCenter-{{$item->idpago}}"
                                                data-te-ripple-init
                                                data-te-ripple-color="light"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </x-danger-button>
                                            @endif
                                        </td>
                                    </tr> 
                                  
                                    <x-modal-delete :id="$item->idpago" :route="'pago.destroy'" :element="$item->nombre_apellidos"></x-modal-delete>
                                   
                                    @endforeach
                                    @endif
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>