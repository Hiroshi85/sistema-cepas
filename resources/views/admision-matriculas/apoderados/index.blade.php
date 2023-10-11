@extends('apoderados.layouts.app')

@section('header')
    <span class="dark:text-white text-2xl">Sistema de apoderados</span>
@endsection

@section('contenido')
<div class="py-12">
    <div class=" mx-auto sm:px-2 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col md:flex-row gap-6">
                {{-- CONTENT --}}
                <div
                    class="flex flex-col rounded-lg bg-white p-6 dark:bg-gray-900 w-full w-[50%]">
                    <div class="flex md:flex-row justify-between">
                        <h5
                        class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        Admisión
                        </h5>
                        @if ($admision <> null)
                            <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                {{$admision->año}}
                            </h5>
                        @endif
                        
                    </div>
                    @if ($admision <> null)
                        <h5 class="text-xl">
                            S/. {{$admision->tarifa}}
                        </h5>
                        <div class="flex flex-col md:flex-row md:justify-between">
                            <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
                                {{Date::parse($admision->fecha_apertura)->locale('es')->isoFormat('D [de] MMMM')}} - {{Date::parse($admision->fecha_cierre)->locale('es')->isoFormat('D [de] MMMM')}}
                            </p>
                            
                            <p class="font-bold @if ($admision->estado == 'Aperturada')
                                text-green-600
                            @endif">
                                {{$admision->estado}}
                            </p>
                        </div>
                    @endif
                    
                    
                   
                </div>
                {{-- --------------------------- --}}
                <div
                    class="flex flex-col rounded-lg bg-white p-6 dark:bg-gray-900 w-full w-[50%]">
                    <div class="flex md:flex-row justify-between">
                        <h5
                        class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        Matrícula
                        </h5>
                        @if ($matricula != null)
                            <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                             {{$matricula->año}}
                            </h5>
                        @endif
                        
                    </div>
                    @if ($matricula <> null)
                        <h5 class="text-xl">
                            S/. {{$matricula->tarifa}}
                        </h5>
                        <div class="flex flex-col md:flex-row md:justify-between">
                            <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
                                {{Date::parse($matricula->fecha_apertura)->locale('es')->isoFormat('D [de] MMMM')}} - {{Date::parse($matricula->fecha_cierre)->locale('es')->isoFormat('D [de] MMMM')}}
                            </p>
                            
                            <p class="font-bold @if ($matricula->estado == 'Aperturada')
                                text-green-600
                            @endif">
                                {{$matricula->estado}}
                            </p>
                        </div>
                    @endif
                   
                </div>
                {{-- end content --}}
            </div>
        </div>
    </div>
</div>
@endsection