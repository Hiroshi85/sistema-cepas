<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Postulantes') }}
            </h2>
            <h3 class="font-bold text-xl text-gray-800 dark:text-gray-200">
                @If(Auth::user()->hasRole('apoderado'))
                    {{ __('Sistema de apoderados') }}
                @endif 
            </h3>
        </div>
    </x-slot>
    
    {{-- CRUD for postulantes --}}
    <div class="py-12 relative">
        <div class="hidden" id="myAlert">
            <x-alert></x-alert>
        </div>
        
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="pt-4 pr-4 text-gray-900 dark:text-gray-100 flex justify-between">
                    <div class="ml-4 min-w-[250px] md:w-[30%]">
                        <form action="{{ route('postulante.index') }}" method="GET" class="flex relative">
                            @csrf
                            <x-text-input id="search" name="search" class="w-full" :value="$search">
                                
                            </x-text-input>
                            <x-primary-button class="absolute right-0 h-[100%] dark:bg-white dark:text-gray-800">
                                <i class="fas fa-search"></i>
                            </x-primary-button>
                        </form>
                    </div>
                    @if($admision == null) 
                        <p> Aún no se ha registrado un proceso de admisión </p>
                    @else
                        @if($admision->estado == "Aperturada")
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
                        @else
                            <p class="text-red-500">Admisión cerrada, fecha límite - {{Date::parse($admision->fecha_cierre)->locale('es')->isoFormat('D [de] MMMM [del] Y')}}</p>
                        @endif
                    @endif
                </div>
                <div class="!visible hidden px-16" id="collapseExample" data-te-collapse-item>
                    <form method="POST" action="{{ route('postulante.store') }}" id="newPostulante" name="newPostulante">
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
                                <x-input-label for="domicilio" :value="__('Domicilio')" />
                                <x-text-input id="domicilio" class="block mt-1 w-full" type="text" name="domicilio" required autofocus />
                                <x-input-error :messages="$errors->get('domicilio')" class="mt-2" />
                            </div>
                            <div class="mt-4 grow md:basis-1/4 px-2">
                                <x-input-label for="numero_celular" :value="__('Número de celular')" />
                                <x-text-input id="numero_celular" class="block mt-1 w-full" type="text" name="numero_celular" required autofocus />
                                <x-input-error :messages="$errors->get('numero_celular')" class="mt-2" />
                            </div>
                            <div class="mt-4 grow md:basis-1/4 px-2">
                                <x-input-label for="nro_hermanos" :value="__('Nro. de Hermanos')" />
                                <x-text-input id="nro_hermanos" class="block mt-1 w-full" type="number" name="nro_hermanos" required autofocus />
                                <x-input-error :messages="$errors->get('nro_hermanos')" class="mt-2" />
                            </div>
                            <div class="mt-6 grow md:basis-1/4 px-2">
                                <x-input-label for="idaula" :value="__('Aula')" />
                                <select data-te-select-init data-te-select-option-height="52" id="idaula" class="block mt-1 w-full" name="idaula" required>
                                    @foreach ($aulas as $item)
                                        <option value="{{$item->idaula}}" data-te-select-secondary-text="Vacantes disponibles: {{$item->nro_vacantes_disponibles}}">{{$item->grado}} {{$item->seccion}}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('idaula')" class="mt-2" />
                            </div>
                            @if(!Auth::user()->hasRole('apoderado'))
                                <div class="mt-4 grow px-2 w-full text-center">
                                    <x-input-label for="apoderados" class="text-lg font-semibold"  :value="__('Seleccione apoderado(s)')" />
                                    <select id="apoderados" name="apoderados[]" data-te-select-init data-te-select-filter="true" data-te-select-option-height="52" multiple required>
                                        @foreach ($apoderados as $item)
                                            <option value="{{$item->idapoderado}}" data-te-select-secondary-text="{{$item->dni}}">{{$item->nombre_apellidos}}</option>
                                        @endforeach                                    
                                    </select>
                                    <div class="p-4" data-te-select-custom-content-ref>
                                        <x-primary-button onclick="asignarApoderados()">
                                            Asignar
                                        </x-primary-button>
                                    </div>
                                </div>
                          
                                <div id="apoderados-container"></div>
                            @else   
                                {{-- Parentesco y convivencia de apoderado actual --}}
                              
                                <div class="mt-4 px-2 grow md:basis-1/4">
                                    <h2 class="dark:text-white">Relación con apoderado</h2>
                                    <x-input-label for="parentesco" :value="__('Parentesco')" />
                                    <x-text-input id="parentesco" class="block mt-1 w-full" type="text" name="parentesco" required autofocus />
                                    <x-input-error :messages="$errors->get('parentesco')" class="mt-2" />
                                </div>
                                <div class="mt-4 px-2 self-center text-center">
                                    <x-input-label for="convivencia" :value="__('¿Convive?')" />
                                    <input name="convivencia" id="convivencia" type="checkbox" class="px-2 rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                    <x-input-error :messages="$errors->get('parentesco')" class="mt-2" />
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center justify-end mt-4 px-4">
                            <x-primary-button 
                                class="ml-4"
                            >
                                {{ __('Registrar') }}
                            </x-primary-button>
                            <x-secondary-button  type="reset" onclick="resetea()" class="mx-2"><i class="fa-solid fa-rotate"></i></x-secondary-button>
                        </div>
                        
                    </form> 
                </div>
                <div class="text-gray-900 dark:text-gray-100">
                 
                    <div class="flex flex-col px-5">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                              <table class="min-w-full text-left text-sm font-light pb-16 text-center">
                                <thead class="border-b font-medium dark:border-neutral-500 dark:bg-slate-900">
                                  <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-2 py-4">Año de postulación</th>
                                    <th scope="col" class="py-4">DNI</th>
                                    <th scope="col" class="px-2 py-4">Nombre</th>
                                    <th scope="col" class="px-6 py-4">Fecha de nacimiento</th>
                                    <th scope="col" class="px-6 py-4">Domicilio</th>
                                    <th scope="col" class="px-6 py-4">Celular</th>
                                    {{-- <th scope="col" class="px-6 py-4">Hermanos</th> --}}
                                    <th scope="col" class="px-6 py-4">Estado</th>
                                    <th scope="col" class="px-6 py-4" data-te-fixed="true">Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if (count($postulantes) == 0)
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="mt-4 mb-0 leading-normal text-size-sm dark:text-white">No se encontraron registros</h6>
                                        </td>
                                    </tr>
                                    @else
                                    @php
                                        $i = 1
                                    @endphp
                                    @foreach ($postulantes as $item)
                                    <tr
                                    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                            {{$i++}}
                                        </td>
                                        <td class="whitespace-nowrap px-2 py-4">{{Date::parse($item->fecha_postulacion)->format('Y')}}</td>
                                        <td class="whitespace-nowrap py-4">{{$item->dni}}</td>
                                        <td class="whitespace-nowrap pl-2 py-4">{{$item->nombre_apellidos}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->fecha_nacimiento}}</td>     
                                        
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->domicilio}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->numero_celular}}</td>
                                        {{-- <td class="whitespace-nowrap px-6 py-4">{{$item->nro_hermanos}}</td> --}}
                                        
                                        <td class="whitespace-nowrap px-6 py-4 @switch($item->estado)
                                            @case("Aceptado")
                                                {{"text-green-500"}}
                                                @break
                                            @case("Entrevista pendiente")
                                                {{"text-yellow-500"}}
                                            @break
                                            @case("Rechazado")
                                                {{"text-red-500"}}
                                                @break   
                                            @case("En postulación")
                                                {{"text-blue-500"}}
                                                @break 
                                            @endswitch
                                        "
                                        >{{$item->estado}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <a href="{{ route('postulante.edit', $item->idpostulante)}}"><x-secondary-button><i class="fas fa-edit"></i></x-secondary-button></a>
                                            @if(!Auth::user()->hasRole('apoderado'))
                                                <x-danger-button
                                                    data-te-toggle="modal"
                                                    data-te-target="#exampleModalCenter-{{$item->idpostulante}}"
                                                    data-te-ripple-init
                                                    data-te-ripple-color="light"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </x-danger-button>
                                            @endif
                                        </td>
                                    </tr> 
                                    <x-modal-delete :id="$item->idpostulante" :route="'postulante.destroy'" :element="$item->nombre_apellidos"></x-modal-delete>
                                    @endforeach
                                    @endif
                                </tbody>
                              </table>
                          
                            </div>
                           
                          </div>
                          <div class="mx-5 mb-4">
                            {{ $postulantes->links() }}
                          </div>
                          
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>