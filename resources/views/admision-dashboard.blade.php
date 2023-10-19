<x-app-layout>
    <section>
        <x-slot name="header">
            <div class="w-full justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Dashboard: Admisión y matrículas') }}
                </h2>
            </div>

        </x-slot>

        <div class="pt-12">
            <div class=" mx-auto sm:px-2 lg:px-8">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col md:flex-row gap-6">
                        {{-- CONTENT --}}
                        <div
                            class="relative flex flex-col rounded-lg bg-white-50 p-6 bg-gray-100 dark:bg-gray-800 w-full w-[50%]">
                            <div class="flex md:flex-row justify-between">
                                <h5
                                    class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                    Admisión
                                </h5>
                                @if ($admision <> null)
                                    <h5
                                        class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
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
                                        {{Date::parse($admision->fecha_apertura)->locale('es')->isoFormat('D [de] MMMM')}}
                                        -
                                        {{Date::parse($admision->fecha_cierre)->locale('es')->isoFormat('D [de] MMMM')}}
                                    </p>

                                    <p class="font-bold @if ($admision->estado == 'Aperturada')
                                            text-green-600
                                        @endif">
                                        {{$admision->estado}}
                                    </p>
                                </div>
                                @endif

                                <div class="w-full">
                                    <x-primary-button data-te-toggle="modal" data-te-target="#modalNew-Admision"
                                        data-te-ripple-init data-te-ripple-color="light">
                                        Nuevo
                                    </x-primary-button>
                                    @if ($admision <> null)
                                        <x-secondary-button data-te-toggle="modal"
                                            data-te-target="#modalEdit-Admision{{$admision->idadmision}}"
                                            data-te-ripple-init data-te-ripple-color="light">
                                            Editar
                                        </x-secondary-button>
                                        <a href="{{ route('admision.pdf.show', ['id'=>$admision->idadmision]) }}"
                                            class="flex flex-col items-center absolute right-5 bottom-2 dark:text-gray-100">
                                            <i class="fa-solid fa-file-pdf text-2xl"></i>
                                            <span class="text-xs">resultados</span>
                                        </a>
                                        @endif
                                </div>

                        </div>
                        {{-- --------------------------- --}}
                        <div
                            class="flex flex-col rounded-lg bg-white-50 p-6 bg-gray-100 dark:bg-gray-800 w-full w-[50%]">
                            <div class="flex md:flex-row justify-between">
                                <h5
                                    class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                    Matrícula
                                </h5>
                                @if ($matricula != null)
                                <h5
                                    class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
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
                                        {{Date::parse($matricula->fecha_apertura)->locale('es')->isoFormat('D [de] MMMM')}}
                                        -
                                        {{Date::parse($matricula->fecha_cierre)->locale('es')->isoFormat('D [de] MMMM')}}
                                    </p>

                                    <p class="font-bold @if ($matricula->estado == 'Aperturada')
                                            text-green-600
                                        @endif">
                                        {{$matricula->estado}}
                                    </p>
                                </div>
                                @endif

                                <div>
                                    <x-primary-button data-te-toggle="modal" data-te-target="#modalNew-Matricula"
                                        data-te-ripple-init data-te-ripple-color="light">
                                        Nuevo
                                    </x-primary-button>
                                    @if ($matricula != null)
                                    <x-secondary-button data-te-toggle="modal"
                                        data-te-target="#modalEdit-Matricula{{$matricula->idmatricula}}"
                                        data-te-ripple-init data-te-ripple-color="light">
                                        Editar
                                    </x-secondary-button>
                                    @endif

                                </div>

                        </div>
                        {{-- end content --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- Modals editar y nuevo --}}
        @include('admision-matriculas.matricula.partials.new')
        {{-- Matrícula edit--}}
        @if ($matricula != null)
        @include('admision-matriculas.matricula.partials.update', ['matricula' => $matricula])
        @endif
        {{-- Admisión --}}
        @include('admision-matriculas.admision.partials.new')
        {{-- Matrícula edit--}}
        @if ($admision != null)
        @include('admision-matriculas.admision.partials.update', ['admision' => $admision])
        @endif
    </section>

    <section>
        <div class="pt-4">
            <div class=" mx-auto sm:px-2 lg:px-8">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col lg:flex-row md:flex-row gap-2">
                        <div class="basis-3/4 flex flex-col">
                                <strong
                                    class="my-2 py-3.5 uppercase mx-auto"
                                    >Calendario de entrevistas</strong
                                >
                               @include('admision-matriculas.calendar.calendar')
                            </div>
                        
                        <div class="flex flex-col basis-1/4 items-center">
                            <strong
                                class="my-2 py-3.5 uppercase mx-auto"
                                >Estadísticas</strong
                            >
                            charts 
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
   
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar')
            const calendar = new Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($events),
                locale: 'es',
                headerToolbar: {
                    left: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek, prev,next today'
                },
            })
            calendar.render()
        })
    </script>
    @endpush
</x-app-layout>

