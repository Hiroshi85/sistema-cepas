<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Alumnos') }}
        </h2>
    </x-slot>
    
    {{-- CRUD for alumnos --}}
    <div class="py-12 relative">
        <div class="hidden" id="myAlert">
            <x-alert></x-alert>
        </div>
        
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('alumno.index') }}" class="flex m-4 gap-5 w-full justify-between items-center">
                    @csrf

                    <div class="ml-4 w-[30%] mt-8">
                        <div class="flex relative">
                          
                            <x-text-input id="search" name="search" class="w-full" :value="$search">
                                
                            </x-text-input>
                            <x-primary-button class="absolute right-0 h-[100%] dark:bg-white dark:text-gray-800">
                                <i class="fas fa-search"></i>
                            </x-primary-button>
                        </div> 
                    </div>

                    @if($aulas != null)
                    <div class="flex gap-4 items-center mr-8">
                        <div>
                            <x-input-label class="mb-2">
                                {{ __('Grado') }}
                            </x-input-label>

                            <select name="grado" id="grado" data-te-select-init>
                                {{-- <option value=''>Seleccionar</option> --}}
                                @foreach ($aulas as $item)
                                <option @if ($grado[0]==$item->grado && $grado[2] == $item->seccion)
                                    selected
                                    @endif
                                    value="{{$item->grado}}|{{$item->seccion}}">{{$item->grado}} {{$item->seccion}}</option>
                                @endforeach
                            </select>
                        </div>

                        <x-primary-button class="max-h-8 self-end">
                            {{ __('Mostrar') }}
                        </x-primary-button>
                    </div>

                    @endif
                </form>
               
                
                <div class="text-gray-900 dark:text-gray-100">
                 
                    <div class="flex flex-col px-5">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                              <table class="min-w-full text-left text-sm font-light pb-16 text-center">
                                <thead class="border-b font-medium dark:border-neutral-500 dark:bg-slate-900">
                                  <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    {{-- <th scope="col" class="px-6 py-4">Aula</th> --}}
                                    <th scope="col" class="px-1 py-4">DNI</th>
                                    <th scope="col" class="px-6 py-4">Nombre</th>
                                    <th scope="col" class="px-6 py-4">Fecha de nacimiento</th>
                                    <th scope="col" class="px-2 py-4">Domicilio</th>
                                    <th scope="col" class="px-2 py-4">Celular</th>
                                    {{-- <th scope="col" class="px-6 py-4">Hermanos</th> --}}
                                    <th scope="col" class="px-6 py-4">Estado</th>
                                    <th scope="col" class="px-6 py-4">Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if (count($alumnos) == 0)
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="mt-4 mb-0 leading-normal text-size-sm dark:text-white">No hay registros</h6>
                                        </td>
                                    </tr>
                                    @else
                                    @php
                                        $i = 1
                                    @endphp
                                    @foreach ($alumnos as $item)
                                    <tr
                                    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                            {{$i++}}
                                        </td>
                                        {{-- <td class="whitespace-nowrap px-6 py-4">{{$item->grado}} {{$item->seccion}}</td> --}}
                                        <td class="whitespace-nowrap px-1 py-4">{{$item->dni}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->nombre_apellidos}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->fecha_nacimiento}}</td>     
                                        
                                        <td class="whitespace-nowrap py-4">{{$item->domicilio}}</td>
                                        <td class="whitespace-nowrap px-2 py-4">{{$item->numero_celular}}</td>
                                        {{-- <td class="whitespace-nowrap px-6 py-4">{{$item->nro_hermanos}}</td> --}}
                                        
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
                                            <a href="{{ route('alumno.edit', $item->idalumno)}}"><x-secondary-button><i class="fas fa-edit"></i></x-secondary-button></a>
                                            @if (!Auth::user()->hasRole('apoderado'))                                
                                                <x-danger-button
                                                    data-te-toggle="modal"
                                                    data-te-target="#exampleModalCenter-{{$item->idalumno}}"
                                                    data-te-ripple-init
                                                    data-te-ripple-color="light"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </x-danger-button>
                                            @endif
                                        </td>
                                    </tr> 
                                   
                                    {{-- ELIMINAR --}}
                                    <x-modal-delete :id="$item->idalumno" :route="'alumno.destroy'" :element="$item->nombre_apellidos"></x-modal-delete>
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