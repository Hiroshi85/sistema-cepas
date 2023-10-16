<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Apoderados') }}
        </h2>
    </x-slot>
    
    {{-- CRUD for apoderados --}}
    <div class="py-12">
        <div class="hidden" id="myAlert">
            <x-alert></x-alert>
        </div>
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="pt-4 pr-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <div class="ml-4 w-[30%]">
                        <form action="{{ route('apoderado.index') }}" method="GET" class="flex relative">
                            @csrf
                            <x-text-input id="search" name="search" class="w-full" :value="$search"/>
                            <x-primary-button class="absolute right-0 h-[100%] dark:bg-white dark:text-gray-800">
                                <i class="fas fa-search"></i>
                            </x-primary-button>
                        </form>
                        
                    </div>
                    <x-secondary-button
                    class="h-[75%]"
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
                    <form method="POST" action="{{ route('apoderado.store') }}" id="newApoderado" name="frm_nuevo_apoderado">
                        @csrf
                        <!-- Name -->
                        <div class="flex flex-row flex-wrap">
                            <div class="mt-4 grow md:basis-1/4 px-2">
                                <x-input-label for="dni" :value="__('DNI')" />
                                <x-text-input id="dni" class="block mt-1 w-full" type="text" name="dni" required autofocus />
                                <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                            </div>

                            <div class="mt-4 grow md:basis-1/2 px-2">
                                <x-input-label for="nombre_apellidos" :value="__('Apellidos y nombres')" />
                                <x-text-input id="nombre_apellidos" class="block mt-1 w-full" type="text" name="nombre_apellidos" required autofocus />
                                <x-input-error :messages="$errors->get('nombre_apellidos')" class="mt-2" />
                            </div>
                           
                            <div class="mt-4 grow md:basis-1/4 px-2">
                                <x-input-label for="fecha_nacimiento" :value="__('Fecha de nacimiento')" />
                                <x-text-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento" required autofocus />
                                <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
                            </div>
        
                            {{--  --}}
                            
                            <div class="mt-4 grow md:basis-1/4 px-2">
                                <x-input-label for="numero_celular" :value="__('Número de celular')" />
                                <x-text-input id="numero_celular" class="block mt-1 w-full" type="text" name="numero_celular" required autofocus />
                                <x-input-error :messages="$errors->get('numero_celular')" class="mt-2" />
                            </div>
                            <div class="mt-4 grow md:basis-1/4 px-2">
                                <x-input-label for="ocupacion" :value="__('Ocupación')" />
                                <x-text-input id="ocupacion" class="block mt-1 w-full" type="text" name="ocupacion" required autofocus />
                                <x-input-error :messages="$errors->get('ocupacion')" class="mt-2" />
                            </div>

                            <div class="mt-4 grow md:basis-1/4 px-2">
                                <x-input-label for="centro_trabajo" :value="__('Centro de trabajo')" />
                                <x-text-input id="centro_trabajo" class="block mt-1 w-full" type="text" name="centro_trabajo" required autofocus />
                                <x-input-error :messages="$errors->get('centro_trabajo')" class="mt-2" />
                            </div>
                            <div class="mt-4 grow md:basis-1/4 px-2">
                                <x-input-label for="correo" :value="__('Correo electrónico')" />
                                <x-text-input id="correo" class="block mt-1 w-full" type="email" name="correo" required autofocus />
                                <x-input-error :messages="$errors->get('correo')" class="mt-2" />
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
                                    <th scope="col" class="px-6 py-4">DNI</th>
                                    <th scope="col" class="px-6 py-4">Nombre</th>
                                  
                                    {{-- <th scope="col" class="px-6 py-4">Fecha de nacimiento</th> --}}
                                    <th scope="col" class="px-6 py-4">Celular</th>
                                    {{-- <th scope="col" class="px-6 py-4">Ocupación</th>
                                    <th scope="col" class="px-6 py-4">Centro de trabajo</th> --}}
                                    <th scope="col" class="px-6 py-4">Correo</th>
                                    <th scope="col" class="px-6 py-4">Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if (count($apoderados) == 0)
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="mb-0 leading-normal text-size-sm dark:text-white">No hay registros</h6>
                                        </td>
                                    </tr>
                                    @else
                                    @php
                                        $i = $apoderados->firstItem();
                                    @endphp
                                    @foreach ($apoderados as $item)
                                    <tr
                                    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                            {{$i++}}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->dni}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->nombre_apellidos}}</td>
                                     
                                        {{-- <td class="whitespace-nowrap px-6 py-4">{{$item->fecha_nacimiento}}</td>      --}}
                                        
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->numero_celular}}</td>
                                        {{-- <td class="whitespace-nowrap px-6 py-4">{{$item->ocupacion}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->centro_trabajo}}</td> --}}
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->correo}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <a href="{{ route('apoderado.edit', $item->idapoderado)}}"><x-secondary-button><i class="fas fa-edit"></i></x-secondary-button></a>
                                            <x-danger-button
                                                data-te-toggle="modal"
                                                data-te-target="#exampleModalCenter-{{$item->idapoderado}}"
                                                data-te-ripple-init
                                                data-te-ripple-color="light"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </x-danger-button>
                                        </td>
                                    </tr> 
                                    <x-modal-delete :id="$item->idapoderado" :route="'apoderado.destroy'" :element="$item->nombre_apellidos"></x-modal-delete>
                                    @endforeach
                                    @endif
                                </tbody>
                              </table>
                              <div class="mt-4">
                                {{ $apoderados->links() }}
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>