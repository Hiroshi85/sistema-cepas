<section class="flex gap-4">
    <div class="basis-10/12">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Detalles de registro') }}
            </h2>
        </header>
    
        <form method="post" action="{{ route('aula.update', $aula->idaula) }}" class="mt-6 space-y-6">
            @csrf
            @method('PUT')
            <div class="flex flex-row gap-4 flex-wrap">
                <div class="mt-4 pr-16 basis-1/2 px-2">
                    <x-input-label for="grado" :value="__('Grado')" />
                    <x-text-input id="grado" class="block mt-1 w-full" type="number" name="grado" required autofocus :value="$aula->grado" />
                    <x-input-error :messages="$errors->get('grado')" class="mt-2" />
                </div>

                <div class="mt-4 pr-16 basis-1/2 px-2">
                    <x-input-label for="seccion" :value="__('Sección')" />
                    <x-text-input id="seccion" class="block mt-1 w-full" type="text" name="seccion" required autofocus :value="$aula->seccion" />
                    <x-input-error :messages="$errors->get('seccion')" class="mt-2" />
                </div>
               
                <div class="mt-4 pr-16 basis-1/2 px-2">
                    <x-input-label for="nro_vacantes_total" :value="__('Vacantes en total')" />
                    <x-text-input id="nro_vacantes_total" class="block mt-1 w-full" type="number" name="nro_vacantes_total" required autofocus :value="$aula->nro_vacantes_total" />
                    <x-input-error :messages="$errors->get('nro_vacantes_total')" class="mt-2" />
                </div> 
                <div class="mt-4 pr-16 basis-1/2 px-2">
                    <x-input-label for="nro_vacantes_disponibles" :value="__('Vacantes disponibles')" />
                    <x-text-input id="nro_vacantes_disponibles" class="block mt-1 w-full" type="number" name="nro_vacantes_disponibles" required autofocus :value="$aula->nro_vacantes_disponibles" />
                    <x-input-error :messages="$errors->get('nro_vacantes_disponibles')" class="mt-2" />
                </div> 
            </div>
            
        
            <div class="flex items-center gap-4">
              <x-primary-button>{{ __('Actualizar') }}</x-primary-button>

              <a href="{{ route('cancelar', ['ruta'=>'aula.index']) }}">
                  <x-secondary-button>
                      {{__('Cancelar')}}
                  </x-secondary-button>
              </a>
            </div>
        </form>
    
    </div>
</section>
