<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo-sm class="block h-12 w-auto fill-current" />

                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    {{-- <x-nav-link :href="route('apoderados.index')" :active="request()->routeIs('apoderado.index')">
                        {{ __('Apoderado') }}
                    </x-nav-link> --}}
                    @role('admin|auxiliar')
                        <x-nav-link :href="route('asistenciaxdias.index')" :active="request()->routeIs('asistencia.index')">
                            {{ __('Asistencia') }}
                        </x-nav-link>
                    @endrole
                    @role('auxiliar|psicologo|admin')
                    <x-nav-link :href="route('conductas.index')" :active="request()->routeIs('conducta.index')">
                        {{ __('Conductas') }}
                    </x-nav-link>
                    @endrole
                    @role('admin|auxiliar|Docente')
                        <x-nav-link :href="route('comportamientos.index')" :active="request()->routeIs('comportamiento.index')">
                            {{ __('Comportamientos') }}
                        </x-nav-link>
                    @endrole
                    {{-- <x-nav-link :href="route('psicologos.index')" :active="request()->routeIs('psicologo.index')">
                        {{ __('Psicólogo') }}
                    </x-nav-link> --}}
                    @role('admin|psicologo')
                        <x-nav-link :href="route('pruebas.index')" :active="request()->routeIs('pruebas.index')">
                            {{ __('Prueba psicológica') }}
                        </x-nav-link>
                    @endrole
                    @role('admin|psicologo')
                        <x-nav-link :href="route('sesiones.index')" :active="request()->routeIs('sesiones.index')">
                            {{ __('Sesiones') }}
                        </x-nav-link>
                    @endrole
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @role('admin|auxiliar')
                <x-responsive-nav-link :href="route('asistenciaxdias.index')" :active="request()->routeIs('asistencia.index')">
                    {{ __('Asistencia') }}
                </x-responsive-nav-link>
            @endrole
            @role('auxiliar|psicologo|admin')
            <x-responsive-nav-link :href="route('conductas.index')" :active="request()->routeIs('conducta.index')">
                {{ __('Conducta') }}
            </x-responsive-nav-link>
            @endrole
            @role('admin|auxiliar|Docente')
                <x-responsive-nav-link :href="route('comportamientos.index')" :active="request()->routeIs('comportamiento.index')">
                    {{ __('Comportamiento') }}
                </x-responsive-nav-link>
            @endrole
            {{-- <x-responsive-nav-link :href="route('psicologos.index')" :active="request()->routeIs('psicologo.index')">
                {{ __('Psicólogo') }}
            </x-responsive-nav-link> --}}
            @role('admin|psicologo')
                <x-responsive-nav-link :href="route('pruebas.index')" :active="request()->routeIs('pruebas.index')">
                    {{ __('Prueba psicológica') }}
                </x-responsive-nav-link>
            @endrole
            @role('admin|psicologo')
                <x-responsive-nav-link :href="route('sesiones.index')" :active="request()->routeIs('sesiones.index')">
                    {{ __('Sesiones') }}
                </x-responsive-nav-link>
            @endrole
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
