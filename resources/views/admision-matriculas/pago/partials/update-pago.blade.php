<section class="flex gap-4">
    <div class="w-full">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Datos de pago') }}
            </h2>
        </header>
    
        <form method="post" action="{{ route('pago.update', $pago->idpago) }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
            
            <div class="flex flex-row flex-wrap w-full">
                            
                <div class="mt-4 md:basis-1/4 px-2">
                    <x-input-label class="mb-2" for="idapoderado" :value="__('Apoderado')" />
                    <select data-te-select-init data-te-select-filter="true" data-te-select-option-height="52" name="idapoderado" id="idapoderado"
                    @if (Auth::user()->hasRole('apoderado'))
                        disabled
                    @endif
                    >
                        @foreach ($apoderados as $item)
                            <option value="{{$item->idapoderado}}" data-te-select-secondary-text="{{$item->dni}}"
                                    @if ($item->idapoderado == $pago->idapoderado)
                                        selected
                                    @endif
                                >{{$item->nombre_apellidos}}</option>
                        @endforeach     
                    </select>
                    <x-input-error :messages="$errors->get('idapoderado')" class="mt-2" />
                </div>
                

                <div class="mt-4 md:basis-1/3 px-2">
                    <x-input-label for="concepto" :value="__('Concepto')" />
                    <x-text-input id="concepto" class="block mt-1 w-full" type="text" name="concepto" required autofocus :value="old('concepto', $pago->concepto)"/>
                    <x-input-error :messages="$errors->get('concepto')" class="mt-2" />
                </div>
               <div class="mt-4 md:basis-1/8 px-2">
                    <x-input-label for="monto" :value="__('Monto')" />
                    <x-text-input id="monto" class="block mt-1 w-full" type="text" name="monto" required autofocus :value="old('monto', $pago->monto)"/>
                    <x-input-error :messages="$errors->get('monto')" class="mt-2" />
               </div>
                <div class="mt-4 md:basis-1/8 px-2">
                    <x-input-label for="fecha_vencimiento" :value="__('Fecha de vencimiento')" />
                    <x-text-input id="fecha_vencimiento" class="block mt-1 w-full" type="date" name="fecha_vencimiento" required autofocus :value="$pago->fecha_vencimiento"/>
                    <x-input-error :messages="$errors->get('fecha_vencimiento')" class="mt-2" />
                </div>
                
                <div class="mt-4 md:basis-1/8 px-2">
                    <x-input-label class="px-2" for="estado" :value="__('Estado')" />
                    <select 
                        name="estado" id="estado"
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="Pendiente" @if ($pago->estado == 'Pendiente')
                            {{"selected"}}
                        @endif>Pendiente</option>
                        <option value="Pagado" @if ($pago->estado == 'Pagado')
                            {{"selected"}}
                        @endif>Pagado</option>
                        @if (!Auth::user()->hasRole('apoderado'))
                            <option value="Verificado" @if ($pago->estado == 'Verificado')
                                {{"selected"}}
                            @endif>Verificado</option>
                            <option value="Vencido" @if ($pago->estado == 'Vencido')
                                {{"selected"}}
                            @endif>Vencido</option>
                        @endif
                    </select>
                </div>
            </div>
            
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Asociar pago a un postulante / alumno') }}
            </h2>
            <div class="flex flex-wrap w-full">
                <div class="mt-4 md:basis-1/2 px-2">
                    <x-input-label class="mb-2" for="idpostulante" :value="__('Postulante')" />
                    <select data-te-select-init data-te-select-filter="true" data-te-select-option-height="52" name="idpostulante" id="idpostulante">
                        <option value="">Seleccionar</option>
                        @foreach ($postulantes as $item)
                            <option value="{{$item->idpostulante}}" data-te-select-secondary-text="{{$item->dni}}"
                                    @if ($item->idpostulante == $pago->idpostulante)
                                        selected
                                    @endif
                                >{{$item->nombre_apellidos}}</option>
                        @endforeach     
                    </select>
                    <x-input-error :messages="$errors->get('idpostulante')" class="mt-2" />
                </div>
    
                <div class="mt-4 md:basis-1/2 px-2">
                    <x-input-label class="mb-2" for="idalumno" :value="__('Alumno')" />
                    <select data-te-select-init data-te-select-filter="true" data-te-select-option-height="52" name="idalumno" id="idalumno">
                        <option value="">Seleccionar</option>
                        @foreach ($alumnos as $item)
                            <option value="{{$item->idalumno}}" data-te-select-secondary-text="{{$item->dni}}"
                                    @if ($item->idalumno == $pago->idalumno)
                                        selected
                                    @endif
                                >{{$item->nombre_apellidos}}</option>
                        @endforeach     
                    </select>
                    <x-input-error :messages="$errors->get('idalumno')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Actualizar') }}</x-primary-button>
    
                <a href="{{ route('cancelar', ['ruta'=>'pago.index']) }}">
                    <x-secondary-button>
                        {{__('Cancelar')}}
                    </x-secondary-button>
                </a>
            </div>
        </form>
    
    </div>
 
    {{-- <div class="basis-2/12">
        <img src="{{ asset('assets') }}/postulante.png" class="rounded-lg" style="width: 500px">
    </div> --}}
</section>
