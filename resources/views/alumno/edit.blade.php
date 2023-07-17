<x-app-layout>    
    <div class="py-8">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="">
                    @include('alumno.partials.update-alumno')
                </div>
            </div>
        </div>
    </div>
    <div class="pb-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="">
                    @include('alumno.partials.docs')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
