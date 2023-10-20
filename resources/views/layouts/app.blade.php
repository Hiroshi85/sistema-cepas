@php
    if (request()->is('*rrhh*')) {
        $module = 'rrhh';
    } elseif (request()->is('*seguimiento*')) {
        $module = 'seguimiento';
    } elseif (request()->is('*admision-matriculas*')) {
        $module= 'admision-matriculas';
    } elseif (request()->is('*desempeño*')) {
        $module = 'desempeño';
    } elseif (request()->is('*materiales_escolares*')) {
        $module = 'materiales_escolares';
    } elseif (request()->is('*academia*')){
        $module = 'academia';
    }
    else {
        $module = '';
    }
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Sistema de Gestión CEPAS' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/04a4547f2b.js" crossorigin="anonymous"></script>
    {{-- <script type="text/javascript" src="../node_modules/tw-elements/dist/js/tw-elements.umd.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Styles --}}
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-950" id="content">
        @switch($module)
            @case('rrhh')
                @include('layouts.rrhh.navigation')
            @break
            @case ('materiales_escolares')
                @include('layouts.materiales_escolares.navigation')
            @break
            @case('admision-matriculas')
                @if (!Auth::user()->hasRole('apoderado'))
                    @include('layouts.admision-matriculas.navigation')
                @else
                    @include('admision-matriculas.apoderados.layouts.nav')
                @endif
            @break
            @case('seguimiento')
                @include('layouts.seguimiento.navigation')
            @break
            @case('desempeño')
                @include('layouts.desempeño.navigation')
            @break
            @case('academia')
                @include('layouts.academia.navigation')
            @break
            @default
                @include('layouts.navigation')
        @endswitch

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-900 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        @livewire('common.toasts')
    </div>

    {{-- Scripts --}}
    <script type="text/javascript" src="{{ asset('assets') }}/js/functions.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/js/charts.js"></script>
    @stack('scripts') 
    @livewireScripts
    <script>
        Livewire.onLoad(() => {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                    '(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
                Livewire.emit('theme-load', {
                    theme: 'dark'
                });
            } else {
                document.documentElement.classList.remove('dark')
                Livewire.emit('theme-load', {
                    theme: 'light'
                });

            }
        });
        window.addEventListener('theme-toggle', event => {
            localStorage.theme = event.detail.theme;
            if (event.detail.theme === 'dark') {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
        });
    </script>
</body>

</html>
