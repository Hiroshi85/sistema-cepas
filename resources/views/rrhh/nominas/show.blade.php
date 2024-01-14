@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Empleados') }}
        </h2>

    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-gray-950 overflow-hidden shadow-sm sm:rounded-lg p-5">
            <div class="flex flex-col">
                <div class="px-4 sm:px-0">
                    <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">Información del
                        Empleado</h3>
                </div>
                <div class="mt-6 border-t border-gray-100 dark:border-gray-800">
                    <dl class="divide-y divide-gray-100 dark:divide-gray-800">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Nombre
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $empleado->nombre }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Fecha de
                                Nacimiento
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ Carbon::parse($empleado->fecha_nacimiento)->locale('es_ES')->isoFormat('LL') }}

                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">DNI
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $empleado->dni }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Email
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $empleado->email }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Teléfono
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $empleado->telefono }}
                            </dd>
                        </div>
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Puesto
                            </dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-300 sm:col-span-2 sm:mt-0">
                                {{ $empleado->puesto->nombre }}
                            </dd>
                        </div>

                    </dl>
                </div>
            </div>
            @if ($empleado->contratos->count() > 0)

                <div class="flex flex-col">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">Contratos
                        </h3>

                        <section
                            class="grid grid-cols-1 py-5 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                            @foreach ($empleado->contratos as $contrato)
                                @livewire('empleados.contrato-card', ['contrato' => $contrato], key($contrato->id))
                            @endforeach

                        </section>
                    </div>
            @endif
        </div>
    </div>
    </div>
</x-app-layout>
