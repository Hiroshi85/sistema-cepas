<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Entrevistas') }}
        </h2>
    </x-slot>
    
    {{-- CRUD for entrevistas --}}
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
                    <form method="POST" action="{{ route('entrevista.store') }}">
                        @csrf
                        <!-- Name -->
                        <div class="flex flex-col flex-wrap align-middle dark:text-white">
                            <div class="mt-4 px-2 w-[50%] mx-auto text-center">
                                <x-input-label for="postulantes" class="text-lg font-semibold"  :value="__('Seleccione postulante(s)')" />
                                <select 
                                    id="postulantes" name="postulantes[]" 
                                    data-te-select-init data-te-select-filter="true" 
                                    data-te-select-option-height="52" 
                                    data-te-select-clear-button="true"
                                    multiple required
                                    >
                                    @foreach ($postulantes as $item)
                                        <option value="{{$item->idpostulante}}" data-te-select-secondary-text="{{"DNI ".$item->dni}}">{{$item->nombre_apellidos}}</option>
                                    @endforeach                                    
                                  </select>
                                  <x-input-error :messages="$errors->get('postulantes')" class="mt-2" />
                                  <div class="p-4" data-te-select-custom-content-ref>
                                    <x-primary-button onclick="showEntrevistaForm(true)">
                                        Seleccionar
                                    </x-primary-button>
                                  </div>
                            </div>
                            <div id="entrevistaForm" class="flex flex-wrap hidden items-center">
                                <div class="basis-1/4 px-2">
                                    <x-input-label for="fecha" :value="__('Fecha')" />
                                    <x-text-input id="fecha" class="block mt-1 w-full" type="date" name="fecha" required autofocus />
                                    <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
                                </div>
                                {{-- <x-text-input id="form2" class="block mt-1 w-full" type="text" name="hora" required autofocus /> --}}
                            
                                <div class="basis-1/4 px-2">
                                    <x-input-label for="hora" :value="__('Hora')" />
                                    <x-text-input id="form2" class="block mt-1 w-full dark:text-white" type="time" name="hora" required autofocus />
                                
                                    <x-input-error :messages="$errors->get('hora')" class="mt-2" />
                                </div>
                                <div class="basis-1/4 px-2">
                                    <x-input-label for="tiempo" :value="__('Tiempo de evaluación (minutos)')" />
                                    <x-text-input id="tiempo" class="block mt-1 w-full" type="number" name="tiempo" required autofocus />
                                    <x-input-error :messages="$errors->get('tiempo')" class="mt-2" />
                                </div>
                                <div class="flex justify-end px-4 mt-4">
                                    <x-primary-button class="ml-4">
                                        {{ __('Registrar') }}
                                    </x-primary-button>
                                    <x-secondary-button  type="reset" onclick="showEntrevistaForm(false)" class="mx-2"><i class="fa-solid fa-rotate"></i></x-secondary-button>
                                </div>
                            </div>
                            
                        </div>
                    </form> 
                </div>
                <div class="text-gray-900 dark:text-gray-100">
                 
                    <div class="flex flex-col px-5">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                              <table class="min-w-full text-left text-sm font-light pb-16 text-center">
                                <thead class="border-b font-medium dark:border-neutral-500 dark:bg-slate-900 ">
                                  <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Postulante</th>
                                    <th scope="col" class="px-6 py-4">Fecha y hora</th>
                                    <th scope="col" class="px-6 py-4">Resultado</th>
                                    <th scope="col" class="px-6 py-4">Estado</th>
                                    <th scope="col" class="px-6 py-4">Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if (count($entrevistas) == 0)
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="mb-0 leading-normal text-size-sm dark:text-white">No hay registros</h6>
                                        </td>
                                    </tr>
                                    @else
                                    @php
                                        $i = 1
                                    @endphp
                                    @foreach ($entrevistas as $item)
                                    <tr
                                    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                            {{$i++}}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->nombre_apellidos}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->fecha}} {{\DateTime::createFromFormat('H:i:s', $item->hora)->format('h:i A')}}</td>
                                                                            
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->resultado ? $item->resultado : '-'}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->estado}}</td>

                                        <td class="whitespace-nowrap px-6 py-4">
                                            <x-secondary-button
                                                data-te-toggle="modal"
                                                data-te-target="#modalEdit-{{$item->identrevista}}"
                                                data-te-ripple-init
                                                data-te-ripple-color="light"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </x-secondary-button>
                                            <x-danger-button
                                                
                                                data-te-toggle="modal"
                                                data-te-target="#exampleModalCenter-{{$item->identrevista}}"
                                                data-te-ripple-init
                                                data-te-ripple-color="light"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </x-danger-button>
                                        </td>
                                    </tr> 
                                    {{-- EDITAR --}}
                                    @include('entrevista.partials.update-entrevista', ['item' => $item, 'postulantes'=>$postulantes])
                                    
                                    {{-- ELIMINAR --}}
                                    <x-modal-delete :id="$item->identrevista" :route="'entrevista.destroy'" :element="'Entrevista a '.$item->nombre_apellidos.' '.$item->fecha"></x-modal-delete>
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