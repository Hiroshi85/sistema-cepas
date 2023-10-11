<section class="flex gap-4">
    <div class="basis-10/12">
        {{-- <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Postulante') }}
            </h2>
        </header> --}}
    
        <form method="post" action="{{ route('postulante.update', $postulante->idpostulante) }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
            <div class="flex flex-row gap-4 flex-wrap">
                <div class="grow basis-1/2">
                    <x-input-label for="nombre" :value="__('Apellidos y Nombres')" />
                    <x-text-input id="nombre_apellidos" name="nombre_apellidos" type="text" class="mt-1 block w-full" :value="old('nombre_apellidos', $postulante->nombre_apellidos)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="grow">
                    <x-input-label for="fecha_nacimiento" :value="__('Fecha de nacimiento')" />
                    <x-text-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento" required autofocus :value="old('fecha_nacimiento', $postulante->fecha_nacimiento)" />
                    <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
                </div>

                <div class="grow">
                    <x-input-label for="dni" :value="__('DNI')" />
                    <x-text-input id="dni" class="block mt-1 w-full" type="text" name="dni" required autofocus :value="old('dni', $postulante->dni)"/>
                    <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                </div>
        
                <div class="grow">
                    <x-input-label for="domicilio" :value="__('Domicilio')" />
                    <x-text-input id="domicilio" name="domicilio" type="text" class="mt-1 block w-full" :value="old('domicilio', $postulante->domicilio)" required autocomplete="domicilio" />
                    <x-input-error class="mt-2" :messages="$errors->get('domicilio')" />                    
                </div>
            </div>
            
            <div class="flex flex-row gap-4 flex-wrap">
                <div class="grow">
                    <x-input-label for="numero_celular" :value="__('Número de celular')" />
                    <x-text-input id="numero_celular" class="block mt-1 w-full" type="text" name="numero_celular" required autofocus :value="old('numero_celular', $postulante->numero_celular)" />
                    <x-input-error :messages="$errors->get('numero_celular')" class="mt-2" />
                </div>

                <div class="grow">
                    <x-input-label for="nro_hermanos" :value="__('Nro. de Hermanos')" />
                    <x-text-input id="nro_hermanos" class="block mt-1 w-full" type="number" name="nro_hermanos" required autofocus :value="old('nro_hermanos', $postulante->nro_hermanos)"/>
                    <x-input-error :messages="$errors->get('nro_hermanos')" class="mt-2" />
                </div>

                <div class="grow mt-2">
                    <x-input-label for="idaula" :value="__('Aula')" />
                    <select 
                        data-te-select-init data-te-select-option-height="52" 
                        id="idaula" class="block mt-1 w-full" name="idaula" required
                        @if (Auth::user()->hasRole('apoderado'))
                            disabled
                        @endif>
                        @foreach ($aulas as $item)
                            <option @if ($item->idaula == $postulante->idaula)
                                selected
                            @endif value="{{$item->idaula}}" data-te-select-secondary-text="Vacantes disponibles: {{$item->nro_vacantes_disponibles}}">{{$item->grado}} {{$item->seccion}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('idaula')" class="mt-2" />
                </div>
                
                <div class="grow">
                    <x-input-label class="px-2" for="estado" :value="__('Estado')" />
                <select 
                    id="estado" name="estado"
                    class="@if($blockstate == true) {{"pointer-events-none"}} @endif w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    @if (Auth::user()->hasRole('apoderado'))
                        disabled
                    @endif
                    >
                    <option value="Registrado"  @if($postulante->estado == "Registrado")
                        {{"selected"}}
                    @endif>Registrado</option>
                    <option value="Pendiente" @if($postulante->estado == "Pendiente")
                        {{"selected"}}
                    @endif>Pendiente</option>
                    
                    <option value="Aceptado" @if($postulante->estado == 'Aceptado')
                        {{"selected"}}
                      @endif>Aceptado</option>
                      <option value="Rechazado" @if($postulante->estado == 'Rechazado')
                          {{"selected"}}
                      @endif>Rechazado</option>
                </select>
                </div>
            </div>
        
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Actualizar') }}</x-primary-button>
    
                <a href="{{ route('cancelar', ['ruta'=>'postulante.index']) }}">
                    <x-secondary-button>
                        {{__('Cancelar')}}
                    </x-secondary-button>
                </a>
            </div>
        </form>
    
    </div>
 
    <div class="basis-2/12">
        <img src="{{ asset('assets') }}/postulante.png" class="rounded-lg w-full">
    </div>
</section>
