<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Aulas') }}
        </h2>
    </x-slot>
    
    {{-- CRUD for aulas --}}
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
                    <form method="POST" action="{{ route('aula.store') }}" name="frm_nueva_aula">
                        @csrf
                        <!-- Name -->
                        <div class="flex flex-row flex-wrap align-middle">
                            <div class="mt-4 grow md:basis-1/4 px-2">
                                <x-input-label for="grado" :value="__('Grado')" />
                                <x-text-input id="grado" class="block mt-1 w-full" type="number" name="grado" required autofocus />
                                <x-input-error :messages="$errors->get('grado')" class="mt-2" />
                            </div>

                            <div class="mt-4 grow md:basis-1/4 px-2">
                                <x-input-label for="seccion" :value="__('Sección')" />
                                <x-text-input id="seccion" class="block mt-1 w-full" type="text" name="seccion" required autofocus />
                                <x-input-error :messages="$errors->get('seccion')" class="mt-2" />
                            </div>
                           
                            <div class="mt-4 grow md:basis-1/4 px-2">
                                <x-input-label for="vacantes" :value="__('Vacantes en total')" />
                                <x-text-input id="vacantes" class="block mt-1 w-full" type="number" name="vacantes" required autofocus />
                                <x-input-error :messages="$errors->get('vacantes')" class="mt-2" />
                            </div> 

                            <div class="mt-4 grow md:basis-1/4 px-2 self-end">
                                 <div class="flex items-center justify-end mt-4 px-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Registrar') }}
                                </x-primary-button>
                                <x-secondary-button type="reset" class="mx-2"><i class="fa-solid fa-rotate"></i></x-secondary-button>
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
                                <thead class="border-b font-medium dark:border-neutral-500 dark:bg-slate-900">
                                  <tr class="font-bold">
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Grado y sección</th>
                                    {{-- <th scope="col" class="px-6 py-4">Sección</th> --}}
                                    <th scope="col" class="px-6 py-4">Vacantes en total</th>
                                    <th scope="col" class="px-6 py-4">Vacantes disponibles</th>
                                    <th scope="col" class="px-6 py-4">Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if (count($aulas) == 0)
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="mb-0 leading-normal text-size-sm dark:text-white">No hay registros</h6>
                                        </td>
                                    </tr>
                                    @else
                                    @php
                                        $i = 1
                                    @endphp
                                    @foreach ($aulas as $item)
                                    <tr
                                    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600 @if($item->nro_vacantes_disponibles == 0) bg-red-400 @endif">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                            {{$i++}}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->grado}} {{$item->seccion}}</td>
                                        {{-- <td class="whitespace-nowrap px-6 py-4">{{$item->seccion}}</td> --}}
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->nro_vacantes_total}}</td>     
                                        
                                        <td class="whitespace-nowrap px-6 py-4">{{$item->nro_vacantes_disponibles}}</td>
                                        
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <a href="{{ route('aula.edit', $item->idaula)}}">
                                                <x-secondary-button><i class="fas fa-edit"></i></x-secondary-button>
                                            </a>
                                            <x-danger-button
                                                data-te-toggle="modal"
                                                data-te-target="#exampleModalCenter-{{$item->idaula}}"
                                                data-te-ripple-init
                                                data-te-ripple-color="light"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </x-danger-button>
                                        </td>
                                    </tr> 
                                    <x-modal-delete :id="$item->idaula" :route="'aula.destroy'" :element="$item->grado.' '.$item->seccion"></x-modal-delete>
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