<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
       
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <script src="https://kit.fontawesome.com/04a4547f2b.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../node_modules/tw-elements/dist/js/tw-elements.umd.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets') }}/js/functions.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body class="font-sans antialiased"> 
    
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col" id="content">
           
            @include('apoderados.layouts.nav')
            <!-- Page Heading -->
            
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                </div>
            </header>
           

            <!-- Page Content -->
            <main>
                @yield('contenido')
            </main>
            
            @if(session('datos'))
                <script>
                    document.getElementById('myAlert').classList.remove('hidden');
                    setTimeout(function() {
                        document.querySelector('[data-te-alert-dismiss]').click();
                    }, 3000);
                </script>
            @endif
        </div>
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
