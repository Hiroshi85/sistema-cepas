<x-app-layout>   
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Pagos') }}
            </h2>
            <h3 class="font-bold text-xl text-gray-800 dark:text-gray-200">
                @If(Auth::user()->hasRole('apoderado'))
                    {{ __('Sistema de apoderados') }}
                @endif 
            </h3>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="">
                    @include('admision-matriculas.pago.partials.update-pago')
                </div>
            </div>
        </div>
    </div>
    <div class="pb-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="">
                    @include('admision-matriculas.pago.partials.docs')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
