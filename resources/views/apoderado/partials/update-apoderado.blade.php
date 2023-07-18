<section class="flex gap-4">
    <div class="basis-10/12">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Datos de apoderado') }}
            </h2>
        </header>
    
        <form method="post" action="{{ route('apoderado.update', $apoderado->idapoderado) }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
            <div class="flex flex-row gap-4 flex-wrap">

                <div class="basis-1/4">
                    <x-input-label for="dni" :value="__('DNI')" />
                    <x-text-input id="dni" class="block mt-1 w-full" type="text" name="dni" required autofocus :value="old('nombre_apellidos', $apoderado->dni)"/>
                    <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                </div>

                <div class="grow">
                    <x-input-label for="nombre" :value="__('Apellidos y Nombres')" />
                    <x-text-input id="nombre_apellidos" name="nombre_apellidos" type="text" class="mt-1 block w-full" :value="old('nombre_apellidos', $apoderado->nombre_apellidos)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="basis-1/4">
                    <x-input-label for="fecha_nacimiento" :value="__('Fecha de nacimiento')" />
                    <x-text-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento" required autofocus :value="old('nombre_apellidos', $apoderado->fecha_nacimiento)" />
                    <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
                </div>
        
                
            </div>
            
            <div class="flex flex-row gap-4 flex-wrap">
                <div class="grow">
                    <x-input-label for="numero_celular" :value="__('Número de celular')" />
                    <x-text-input id="numero_celular" class="block mt-1 w-full" type="text" name="numero_celular" required autofocus :value="old('nombre_apellidos', $apoderado->numero_celular)" />
                    <x-input-error :messages="$errors->get('numero_celular')" class="mt-2" />
                </div>

                <div class="grow">
                    <x-input-label for="ocupacion" :value="__('Ocupación')" />
                    <x-text-input id="ocupacion" class="block mt-1 w-full" type="text" name="ocupacion" required autofocus :value="old('ocupacion', $apoderado->ocupacion)"/>
                    <x-input-error :messages="$errors->get('ocupacion')" class="mt-2" />
                </div>

                <div class="grow">
                    <x-input-label for="centro_trabajo" :value="__('Centro de trabajo')" />
                    <x-text-input id="centro_trabajo" class="block mt-1 w-full" type="text" name="centro_trabajo" required autofocus  :value="old('centro_trabajo', $apoderado->centro_trabajo)"/>
                    <x-input-error :messages="$errors->get('centro_trabajo')" class="mt-2" />
                </div>
                
                <div class="grow">
                    <x-input-label for="correo" :value="__('Correo electrónico')" />
                    <x-text-input id="correo" class="block mt-1 w-full" type="email" name="correo" required autofocus :value="old('correo', $apoderado->correo)"/>
                    <x-input-error :messages="$errors->get('correo')" class="mt-2" />
                </div>
            </div>
        
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Actualizar') }}</x-primary-button>
    
                <a href="{{ route('cancelar', ['ruta'=>'apoderado.index']) }}">
                    <x-secondary-button>
                        {{__('Cancelar')}}
                    </x-secondary-button>
                </a>
            </div>
        </form>
    
    </div>
 
    <div class="basis-2/12">
        <img src="{{ asset('assets') }}/postulante.png" class="rounded-lg" style="width: 500px">
    </div>
</section>
