<section class="flex gap-4">
    <div class="basis-1/2 md:basis-9/12">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('DATOS PERSONALES') }}
            </h2>
        </header>
    
        <form method="post" action="{{ route('alumno.update', $alumno->idalumno) }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
            <div class="flex flex-row gap-4 flex-wrap">
                <div class="grow">
                    <x-input-label for="nombre" :value="__('Apellidos y Nombres')" />
                    <x-text-input id="nombre_apellidos" name="nombre_apellidos" type="text" class="mt-1 block w-full" :value="old('nombre_apellidos', $alumno->nombre_apellidos)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="grow">
                    <x-input-label for="fecha_nacimiento" :value="__('Fecha de nacimiento')" />
                    <x-text-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento" required autofocus :value="old('nombre_apellidos', $alumno->fecha_nacimiento)" />
                    <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
                </div>

                <div class="grow">
                    <x-input-label for="dni" :value="__('DNI')" />
                    <x-text-input id="dni" class="block mt-1 w-full" type="text" name="dni" required autofocus :value="old('nombre_apellidos', $alumno->dni)"/>
                    <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                </div>
        
                
            </div>
            
            <div class="flex flex-row gap-4 flex-wrap">
                <div class="grow">
                    <x-input-label for="domicilio" :value="__('Domicilio')" />
                    <x-text-input id="domicilio" name="domicilio" type="text" class="mt-1 block w-full" :value="old('domicilio', $alumno->domicilio)" required autocomplete="domicilio" />
                    <x-input-error class="mt-2" :messages="$errors->get('domicilio')" />                    
                </div>
            </div>
            
            <div class="flex flex-row gap-4 flex-wrap">
                <div class="grow">
                    <x-input-label for="numero_celular" :value="__('Número de celular')" />
                    <x-text-input id="numero_celular" class="block mt-1 w-full" type="text" name="numero_celular" required autofocus :value="old('nombre_apellidos', $alumno->numero_celular)" />
                    <x-input-error :messages="$errors->get('numero_celular')" class="mt-2" />
                </div>

                <div class="grow">
                    <x-input-label for="nro_hermanos" :value="__('Nro. de Hermanos')" />
                    <x-text-input id="nro_hermanos" class="block mt-1 w-full" type="number" name="nro_hermanos" required autofocus :value="old('nombre_apellidos', $alumno->nro_hermanos)"/>
                    <x-input-error :messages="$errors->get('nro_hermanos')" class="mt-2" />
                </div>

               
            </div>
            
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('MATRÍCULA') }}
            </h2>

            <div class="flex flex-row gap-4 flex-wrap">
                <div class="grow max-w-[50%] mt-2">
                    <x-input-label for="idaula" :value="__('Aula')" />
                    <select data-te-select-init data-te-select-option-height="52" id="idaula" class="block mt-1 w-full" name="idaula" required
                        @if(Auth::user()->hasRole('apoderado')) disabled @endif
                    >
                        @foreach ($aulas as $item)
                            <option @if ($item->idaula == $alumno->idaula)
                                selected
                            @endif value="{{$item->idaula}}" data-te-select-secondary-text="Vacantes disponibles: {{$item->nro_vacantes_disponibles}}">{{$item->grado}} {{$item->seccion}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('idaula')" class="mt-2" />
                </div>
                 @if(!Auth::user()->hasRole('apoderado')) 
                    <div class="grow">
                        <x-input-label for="estado" :value="__('Estado')" />
                        <x-text-input  id="estado" class="block mt-1 w-full" type="text" name="estado" required autofocus :value="$alumno->estado"/>
                        <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Actualizar') }}</x-primary-button>
    
                <a href="{{ route('cancelar', ['ruta'=>'alumno.index']) }}">
                    <x-secondary-button>
                        {{__('Cancelar')}}
                    </x-secondary-button>
                </a>
            </div>
        </form>
    
    </div>
 
    <div class="basis-1/2 md:basis-3/12 mt-8">
        <img src="{{ asset('assets') }}/postulante.png" class="rounded-lg" style="width: 400px">
    </div>
</section>